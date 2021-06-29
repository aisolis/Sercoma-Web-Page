<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Archive;
use Validator;
use Session;

class ArchiveController extends Controller
{
    public function index() {
      $data['archives'] = Archive::all();
      return view('admin.blog.archive.index', $data);
    }

    public function store(Request $request) {
      $rules = [
        'date' => 'required|max:255',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $archive = new Archive;
      $archive->date = $request->date;
      $archive->save();

      Session::flash('success', '¡Archivo agregado exitosamente!');
      return "success";
    }

    public function update(Request $request) {
      $rules = [
        'date' => 'required|max:255',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $archive = Archive::findOrFail($request->archive_id);
      $archive->date = $request->date;
      $archive->save();

      Session::flash('success', '¡Archivo actualizado con éxito!');
      return "success";
    }

    public function delete(Request $request) {

      $archive = Archive::findOrFail($request->archive_id);
      $archive->delete();

      Session::flash('success', '¡Archivo eliminado con éxito!');
      return back();
    }
}
