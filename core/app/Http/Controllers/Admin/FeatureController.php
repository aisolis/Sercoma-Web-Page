<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Language;
use App\Feature;
use Validator;
use Session;

class FeatureController extends Controller
{
    public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->first();
        $lang_id = $lang->id;
        $data['features'] = Feature::where('language_id', $lang_id)->orderBy('id', 'DESC')->get();
        $data['lang_id'] = $lang_id;
        return view('admin.home.feature.index', $data);
    }

    public function edit($id)
    {
        $data['feature'] = Feature::findOrFail($id);
        return view('admin.home.feature.edit', $data);
    }

    public function store(Request $request)
    {
        $count = Feature::where('language_id', $request->language_id)->count();
        if ($count == 4) {
            Session::flash('warning', '¡no puedes añadir mas de 4 destacados!');
            return "success";
        }

        $messages = [
            'language_id.required' => 'el campo de lenguaje es requerido'
        ];

        $rules = [
            'language_id' => 'required',
            'icon' => 'required',
            'title' => 'required|max:50',
            'color' => 'required',
            'serial_number' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $feature = new Feature;
        $feature->icon = $request->icon;
        $feature->language_id = $request->language_id;
        $feature->title = $request->title;
        $feature->color = $request->color;
        $feature->serial_number = $request->serial_number;
        $feature->save();

        Session::flash('success', '¡Destacado añadido corectamente!');
        return "success";
    }

    public function update(Request $request)
    {
        $rules = [
            'icon' => 'required',
            'title' => 'required|max:50',
            'color' => 'required',
            'serial_number' => 'required|integer',
        ];

        $request->validate($rules);

        $feature = Feature::findOrFail($request->feature_id);
        $feature->icon = $request->icon;
        $feature->title = $request->title;
        $feature->color = $request->color;
        $feature->serial_number = $request->serial_number;
        $feature->save();

        Session::flash('success', 'Característica actualizada con éxito!');
        return back();
    }

    public function delete(Request $request)
    {

        $feature = Feature::findOrFail($request->feature_id);
        $feature->delete();

        Session::flash('success', '¡Caracteristica eliminada con éxito!');
        return back();
    }
}
