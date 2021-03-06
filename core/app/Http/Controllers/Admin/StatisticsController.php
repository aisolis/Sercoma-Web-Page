<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BasicSetting as BS;
use App\Statistic;
use App\Language;
use Session;
use Validator;

class StatisticsController extends Controller
{
    public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->first();

        $lang_id = $lang->id;
        $data['statistics'] = Statistic::where('language_id', $lang_id)->orderBy('id', 'DESC')->get();

        $data['lang_id'] = $lang_id;
        $data['selLang'] = Language::where('code', $request->language)->first();

        return view('admin.home.statistics.index', $data);
    }

    public function store(Request $request)
    {
        $messages = [
            'language_id.required' => 'El campo de idioma es obligatorio.'
        ];

        $count = Statistic::where('language_id', $request->language_id)->count();
        if ($count == 4) {
            Session::flash('warning', '¡No puede agregar más de 4 estadísticas!');
            return "success";
        }

        $rules = [
            'language_id' => 'required',
            'title' => 'required|max:20',
            'quantity' => 'required|integer',
            'serial_number' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $statistic = new Statistic;
        $statistic->language_id = $request->language_id;
        $statistic->icon = $request->icon;
        $statistic->title = $request->title;
        $statistic->quantity = $request->quantity;
        $statistic->serial_number = $request->serial_number;
        $statistic->save();

        Session::flash('success', '¡Nueva estadística agregada con éxito!');
        return "success";
    }

    public function edit($id)
    {
        $data['statistic'] = Statistic::findOrFail($id);
        if (!empty($data['statistic']->language)) {
            $data['selLang'] = $data['statistic']->language;
        }

        return view('admin.home.statistics.edit', $data);
    }

    public function update(Request $request)
    {
        $rules = [
            'title' => 'required|max:20',
            'quantity' => 'required|integer',
            'serial_number' => 'required|integer',
        ];

        $request->validate($rules);

        $statistic = Statistic::findOrFail($request->statisticid);
        $statistic->icon = $request->icon;
        $statistic->title = $request->title;
        $statistic->quantity = $request->quantity;
        $statistic->serial_number = $request->serial_number;
        $statistic->save();

        Session::flash('success', '¡Estadística actualizada con éxito!');
        return back();
    }

    public function delete(Request $request)
    {

        $statistic = Statistic::findOrFail($request->statisticid);
        $statistic->delete();

        Session::flash('success', '¡Estadística eliminada con éxito!');
        return back();
    }
}
