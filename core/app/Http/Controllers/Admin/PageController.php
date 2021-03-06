<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\Language;
use App\BasicSetting as BS;
use Session;
use Validator;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->first();
        $lang_id = $lang->id;
        $data['apages'] = Page::where('language_id', $lang_id)->orderBy('id', 'DESC')->get();

        $data['lang_id'] = $lang_id;
        return view('admin.page.index', $data);
    }

    public function create()
    {
        $data['tpages'] = Page::where('language_id', 0)->get();
        return view('admin.page.create', $data);
    }

    public function store(Request $request)
    {
        $slug = make_slug($request->name);

        $messages = [
            'language_id.required' => 'El campo de idioma es obligatorio.',
        ];

        $rules = [
            'language_id' => 'required',
            'name' => 'required|max:25',
            'title' => 'required|max:30',
            'subtitle' => 'required|max:38',
            'body' => 'required',
            'status' => 'required',
            'serial_number' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $page = new Page;
        $page->language_id = $request->language_id;
        $page->name = $request->name;
        $page->title = $request->title;
        $page->subtitle = $request->subtitle;
        $page->slug = $slug;
        $page->body = $request->body;
        $page->status = $request->status;
        $page->serial_number = $request->serial_number;
        $page->meta_keywords = $request->meta_keywords;
        $page->meta_description = $request->meta_description;
        $page->save();

        Session::flash('success', '??P??gina creada con ??xito!');
        return "success";
    }

    public function edit($pageID)
    {
        $data['page'] = Page::findOrFail($pageID);
        return view('admin.page.edit', $data);
    }

    public function update(Request $request)
    {
        $slug = make_slug($request->name);

        $rules = [
            'name' => 'required|max:30',
            'title' => 'required|max:40',
            'subtitle' => 'required|max:50',
            'body' => 'required',
            'status' => 'required',
            'serial_number' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $pageID = $request->pageid;

        $page = Page::findOrFail($pageID);
        $page->name = $request->name;
        $page->title = $request->title;
        $page->subtitle = $request->subtitle;
        $page->slug = $slug;
        $page->body = $request->body;
        $page->status = $request->status;
        $page->serial_number = $request->serial_number;
        $page->meta_keywords = $request->meta_keywords;
        $page->meta_description = $request->meta_description;
        $page->save();

        Session::flash('success', 'P??gina actualizada con ??xito!');
        return "success";
    }

    public function delete(Request $request)
    {
        $pageID = $request->pageid;
        $page = Page::findOrFail($pageID);
        $page->delete();
        Session::flash('success', '??P??gina eliminada con ??xito!');
        return redirect()->back();
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        foreach ($ids as $id) {
            $page = Page::findOrFail($id);
            $page->delete();
        }

        Session::flash('success', '??P??ginas eliminadas con ??xito!');
        return "success";
    }

    public function parentlink(Request $request)
    {
        if (empty($request->language)) {
            $data['lang_id'] = 0;
            $data['abs'] = BS::firstOrFail();
        } else {
            $lang = Language::where('code', $request->language)->firstOrFail();
            $data['lang_id'] = $lang->id;
            $data['abs'] = $lang->basic_setting;
        }
        return view('admin.page.parent-link', $data);
    }

    public function updateParentLink(Request $request, $langid)
    {

        $request->validate([
            'parent_link_name' => 'required',
        ]);

        $bs = BS::where('language_id', $langid)->firstOrFail();
        $bs->parent_link_name = $request->parent_link_name;
        $bs->save();

        Session::flash('success', 'Nombre del enlace padre actualizado correctamente');
        return back();
    }
}
