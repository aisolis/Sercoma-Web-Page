<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CalendarEvent;
use App\Language;
use Validator;
use Session;

class CalendarController extends Controller
{
    public function index(Request $request) {
        $lang = Language::where('code', $request->language)->first();

        $lang_id = $lang->id;
        $data['events'] = CalendarEvent::where('language_id', $lang_id)->orderBy('id', 'DESC')->paginate(10);

        $data['lang_id'] = $lang_id;

        return view('admin.calendar.index', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $calendar = new CalendarEvent;
        $calendar->language_id = $request->language_id;
        $calendar->title = $request->title;
        $calendar->start_date = $request->start_date;
        $calendar->end_date = $request->end_date;

        $calendar->save();

        Session::flash('success', '¡Evento agregado al calendario con éxito!');
        return "success";
    }

    public function update(Request $request)
    {
        $messages = [
            'start_date.required' => 'Se requiere período de evento',
            'end_date.required' => 'Se requiere período de evento',
        ];

        $rules = [
            'title' => 'required|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $calendar = CalendarEvent::findOrFail($request->event_id);
        $calendar->title = $request->title;
        $calendar->start_date = $request->start_date;
        $calendar->end_date = $request->end_date;
        $calendar->save();

        Session::flash('success', 'Fecha del evento actualizada en el calendario con éxito!');
        return "success";
    }

    public function delete(Request $request)
    {
        $calendar = CalendarEvent::findOrFail($request->event_id);
        $calendar->delete();

        Session::flash('success', '¡Evento eliminado con éxito!');
        return back();
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        foreach ($ids as $id) {
            $calendar = CalendarEvent::findOrFail($id);
            $calendar->delete();
        }

        Session::flash('success', '¡Eventos eliminados con éxito!');
        return "success";
    }
}
