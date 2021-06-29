<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Job;
use App\Jcategory;
use App\Language;
use Validator;
use Session;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->first();

        $lang_id = $lang->id;
        $data['jobs'] = Job::where('language_id', $lang_id)->orderBy('id', 'DESC')->paginate(10);

        return view('admin.job.job.index', $data);
    }

    public function edit($id)
    {
        $data['job'] = Job::findOrFail($id);
        $data['jcats'] = Jcategory::where('status', 1)->where('language_id', $data['job']->language_id)->get();
        return view('admin.job.job.edit', $data);
    }

    public function create()
    {
        $data['jcats'] = Jcategory::all();
        $data['tjobs'] = Job::where('language_id', 0)->get();
        return view('admin.job.job.create', $data);
    }

    public function store(Request $request)
    {
        $slug = make_slug($request->title);

        $messages = [
            'jcategory_id.required' => 'El campo de categoría es obligatorio',
            'language_id.required' => 'El campo de idioma es obligatorio.'
        ];

        $rules = [
            'language_id' => 'required',
            'deadline' => 'required|date',
            'experience' => 'required',
            'jcategory_id' => 'required',
            'title' => 'required|max:255',
            'vacancy' => 'required|integer',
            'employment_status' => 'required|max:255',
            'job_responsibilities' => 'required',
            'educational_requirements' => 'required',
            'experience_requirements' => 'required',
            'additional_requirements' => 'nullable',
            'job_location' => 'required|max:255',
            'salary' => 'required',
            'email' => 'required|email|max:255',
            'benefits' => 'nullable',
            'read_before_apply' => 'nullable',
            'serial_number' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $in = $request->all();
        $in['slug'] = $slug;
        $in['job_responsibilities'] = $request->job_responsibilities;
        $in['educational_requirements'] = $request->educational_requirements;
        $in['experience_requirements'] = $request->experience_requirements;
        $in['additional_requirements'] = $request->additional_requirements;
        $in['salary'] = $request->salary;
        $in['benefits'] = $request->benefits;
        $in['read_before_apply'] = $request->read_before_apply;
        Job::create($in);

        Session::flash('success', 'Trabajo publicado con éxito!');
        return "success";
    }

    public function update(Request $request)
    {

        $messages = [
            'jcategory_id.required' => 'El campo de categoría es obligatorio'
        ];

        $rules = [
            'deadline' => 'required|date',
            'experience' => 'required',
            'jcategory_id' => 'required',
            'title' => 'required|max:255',
            'vacancy' => 'required|integer',
            'employment_status' => 'required|max:255',
            'job_responsibilities' => 'required',
            'educational_requirements' => 'required',
            'experience_requirements' => 'required',
            'additional_requirements' => 'nullable',
            'job_location' => 'required|max:255',
            'salary' => 'required',
            'email' => 'required|email|max:255',
            'benefits' => 'nullable',
            'read_before_apply' => 'nullable',
            'serial_number' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $slug = make_slug($request->title);
        $job = Job::findOrFail($request->job_id);
        $in = $request->all();
        $in['slug'] = $slug;
        $in['job_responsibilities'] = $request->job_responsibilities;
        $in['educational_requirements'] = $request->educational_requirements;
        $in['experience_requirements'] = $request->experience_requirements;
        $in['additional_requirements'] = $request->additional_requirements;
        $in['salary'] = $request->salary;
        $in['benefits'] = $request->benefits;
        $in['read_before_apply'] = $request->read_before_apply;
        $job->fill($in)->save();

        Session::flash('success', 'Detalles del trabajo actualizados con éxito!');
        return "success";
    }

    public function delete(Request $request)
    {
        $job = Job::findOrFail($request->job_id);
        $job->delete();

        Session::flash('success', '¡Trabajo eliminado con éxito!');
        return back();
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        foreach ($ids as $id) {
            $job = Job::findOrFail($id);
            $job->delete();
        }

        Session::flash('success', '¡Trabajos eliminados con éxito!');
        return "success";
    }

    public function getcats($langid)
    {
        $jcategories = Jcategory::where('language_id', $langid)->get();

        return $jcategories;
    }
}
