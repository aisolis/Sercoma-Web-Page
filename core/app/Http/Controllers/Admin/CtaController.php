<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BasicSetting as BS;
use App\Language;
use Validator;
use Session;

class CtaController extends Controller
{
    public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->firstOrFail();
        $data['lang_id'] = $lang->id;
        $data['abs'] = $lang->basic_setting;

        return view('admin.home.cta', $data);
    }

    public function upload(Request $request, $langid)
    {
        $img = $request->file('file');
      $allowedExts = array('jpg', 'png', 'jpeg', 'PNG','svg', 'webp');

        $rules = [
            'file' => [
                function ($attribute, $value, $fail) use ($img, $allowedExts) {
                    if (!empty($img)) {
                        $ext = $img->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Solo se permite la imagen png, jpg, jpeg");
                        }
                    }
                },
            ],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $validator->getMessageBag()->add('error', 'true');
            return response()->json(['errors' => $validator->errors(), 'id' => 'cta_bg']);
        }

        if ($request->hasFile('file')) {
            $bs = BS::where('language_id', $langid)->firstOrFail();
            @unlink('assets/front/img/' . $bs->cta_bg);
            $filename = uniqid() .'.'. $img->getClientOriginalExtension();
            $img->move('assets/front/img/', $filename);

            $bs->cta_bg = $filename;
            $bs->save();

        }

        return response()->json(['status' => "success", 'image' => 'Background image']);
    }

    public function update(Request $request, $langid)
    {
        $rules = [
            'cta_section_text' => 'required|max:90',
            'cta_section_button_text' => 'required|max:20',
            'cta_section_button_url' => 'required|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $bs = BS::where('language_id', $langid)->firstOrFail();
        $bs->cta_section_text = $request->cta_section_text;
        $bs->cta_section_button_text = $request->cta_section_button_text;
        $bs->cta_section_button_url = $request->cta_section_button_url;
        $bs->save();

        Session::flash('success', 'Textos actualizados con éxito!');
        return "success";
    }
}
