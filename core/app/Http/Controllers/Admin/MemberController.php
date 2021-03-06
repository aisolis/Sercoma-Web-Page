<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;
use App\Language;
use App\BasicSetting as BS;
use Validator;
use Session;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->firstOrFail();
        $data['lang_id'] = $lang->id;
        $data['abs'] = $lang->basic_setting;
        $data['members'] = Member::where('language_id', $data['lang_id'])->get();

        return view('admin.home.member.index', $data);
    }

    public function create()
    {
        return view('admin.home.member.create');
    }

    public function edit($id)
    {
        $data['member'] = Member::findOrFail($id);
        return view('admin.home.member.edit', $data);
    }

    public function upload(Request $request)
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
            return response()->json(['errors' => $validator->errors(), 'id' => 'member']);
        }

        $filename = time() . '.' . $img->getClientOriginalExtension();
        $request->session()->put('member_image', $filename);
        $request->file('file')->move('assets/front/img/members/', $filename);
        return response()->json(['status' => "session_put", "image" => "member_image", 'filename' => $filename]);
    }

    public function teamUpload(Request $request, $langid)
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
            return response()->json(['errors' => $validator->errors(), 'id' => 'team_bg']);
        }

        if ($request->hasFile('file')) {
            $bs = BS::where('language_id', $langid)->firstOrFail();
            @unlink('assets/front/img/' . $bs->team_bg);
            $filename = uniqid() .'.'. $img->getClientOriginalExtension();
            $img->move('assets/front/img/', $filename);

            $bs->team_bg = $filename;
            $bs->save();

        }

        return response()->json(['status' => "success", 'image' => 'Imagen de fondo de la secci??n del equipo']);
    }

    public function uploadUpdate(Request $request, $id)
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
            return response()->json(['errors' => $validator->errors(), 'id' => 'member']);
        }

        $member = Member::findOrFail($id);
        if ($request->hasFile('file')) {
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $request->file('file')->move('assets/front/img/members/', $filename);
            @unlink('assets/front/img/members/' . $member->image);
            $member->image = $filename;
            $member->save();
        }

        return response()->json(['status' => "success", "image" => "Member image", 'member' => $member]);
    }

    public function store(Request $request)
    {
        $messages = [
            'language_id.required' => 'El campo de idioma es obligatorio.'
        ];

        $rules = [
            'language_id' => 'required',
            'member_image' => 'required',
            'name' => 'required|max:80',
            'rank' => 'required|max:80',
            'facebook' => 'nullable|max:80',
            'twitter' => 'nullable|max:80',
            'linkedin' => 'nullable|max:80',
            'instagram' => 'nullable|max:80',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $member = new Member;
        $member->language_id = $request->language_id;
        $member->image = $request->member_image;
        $member->name = $request->name;
        $member->rank = $request->rank;
        $member->facebook = $request->facebook;
        $member->twitter = $request->twitter;
        $member->linkedin = $request->linkedin;
        $member->instagram = $request->instagram;
        $member->save();

        Session::flash('success', '??Miembro agregado con ??xito!');
        return "success";
    }

    public function update(Request $request)
    {
        $rules = [
            'name' => 'required|max:70',
            'rank' => 'required|max:70',
            'facebook' => 'nullable|max:70',
            'twitter' => 'nullable|max:70',
            'linkedin' => 'nullable|max:70',
            'instagram' => 'nullable|max:70',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $member = Member::findOrFail($request->member_id);
        $member->name = $request->name;
        $member->rank = $request->rank;
        $member->facebook = $request->facebook;
        $member->twitter = $request->twitter;
        $member->linkedin = $request->linkedin;
        $member->instagram = $request->instagram;
        $member->save();

        Session::flash('success', '??Miembro actualizado
        con ??xito!');
        return "success";
    }

    public function textupdate(Request $request, $langid)
    {
        $request->validate([
            'team_section_title' => 'required|max:25',
            'team_section_subtitle' => 'required|max:80',
        ]);

        $bs = BS::where('language_id', $langid)->firstOrFail();
        $bs->team_section_title = $request->team_section_title;
        $bs->team_section_subtitle = $request->team_section_subtitle;
        $bs->save();

        Session::flash('success', 'Texto actualizado con ??xito!');
        return back();
    }

    public function delete(Request $request)
    {

        $member = Member::findOrFail($request->member_id);
        @unlink('assets/front/img/members/' . $member->image);
        $member->delete();

        Session::flash('success', '??Miembro eliminado con ??xito!');
        return back();
    }
}
