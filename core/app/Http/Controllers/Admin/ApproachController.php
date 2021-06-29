<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BasicSetting as BS;
use App\Point;
use App\Language;
use Session;
use Validator;

class ApproachController extends Controller
{
    public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->firstOrFail();
        $data['lang_id'] = $lang->id;
        $data['abs'] = $lang->basic_setting;
        $data['points'] = Point::where('language_id', $data['lang_id'])->orderBy('id', 'DESC')->get();

        return view('admin.home.approach.index', $data);
    }

    public function store(Request $request)
    {
        $messages = [
            'language_id.required' => 'El campo de idioma es obligatorio.'
        ];

        $rules = [
            'language_id' => 'required',
            'title' => 'required|max:80',
            'short_text' => 'required|max:200',
            'serial_number' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $point = new Point;
        $point->language_id = $request->language_id;
        $point->icon = $request->icon;
        $point->title = $request->title;
        $point->short_text = $request->short_text;
        $point->serial_number = $request->serial_number;
        $point->save();

        Session::flash('success', '¡Nuevo punto agregado con éxito!');
        return "¡Listo!";
    }

    public function pointedit($id)
    {
        $data['point'] = Point::findOrFail($id);
        return view('admin.home.approach.edit', $data);
    }

    public function update(Request $request, $langid)
    {
        $request->validate([
            'approach_section_title' => 'required|max:80',
            'approach_section_subtitle' => 'required|max:80',
            'approach_section_button_text' => 'nullable|max:20',
            'approach_section_button_url' => 'nullable|max:300',
        ]);

        $bs = BS::where('language_id', $langid)->firstOrFail();
        $bs->approach_title = $request->approach_section_title;
        $bs->approach_subtitle = $request->approach_section_subtitle;
        $bs->approach_button_text = $request->approach_section_button_text;
        $bs->approach_button_url = $request->approach_section_button_url;
        $bs->save();

        Session::flash('success', 'Texto actualizado con éxito!', '¡Listo!');
        return back();
    }

    public function pointupdate(Request $request)
    {
        $rules = [
            'title' => 'required|max:80',
            'short_text' => 'required|max:200',
            'serial_number' => 'required|integer',
        ];

        $request->validate($rules);

        $point = Point::findOrFail($request->pointid);
        $point->icon = $request->icon;
        $point->title = $request->title;
        $point->short_text = $request->short_text;
        $point->serial_number = $request->serial_number;
        $point->save();

        Session::flash('success', 'Punto actualizado con éxito!');
        return back();
    }

    public function pointdelete(Request $request)
    {

        $point = Point::findOrFail($request->pointid);
        $point->delete();

        Session::flash('success', '¡Punto eliminado con éxito!');
        return back();
    }
}
