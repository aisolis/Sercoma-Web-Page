<?php

namespace App\Http\Controllers\Admin;

use App\BasicSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Package;
use App\PackageOrder;
use App\Language;
use App\Mail\ContactMail;
use App\PackageInput;
use App\PackageInputOption;
use Illuminate\Support\Facades\Mail;
use Validator;
use Session;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->first();

        $lang_id = $lang->id;
        $data['packages'] = Package::where('language_id', $lang_id)->orderBy('id', 'DESC')->paginate(10);

        $data['lang_id'] = $lang_id;

        return view('admin.package.index', $data);
    }

    public function form(Request $request)
    {
        $lang = Language::where('code', $request->language)->firstOrFail();
        $data['lang_id'] = $lang->id;
        $data['abs'] = $lang->basic_setting;
        $data['inputs'] = PackageInput::where('language_id', $data['lang_id'])->get();

        $data['ndaIn'] = PackageInput::find(1);
        return view('admin.package.form', $data);
    }

    public function formstore(Request $request)
    {

        $inname = make_input_name($request->label);
        $inputs = PackageInput::where('language_id', $request->language_id)->get();

        $messages = [
            'options.*.required_if' => 'Se requieren opciones si se selecciona el tipo de campo dropdown/checkbox',
            'placeholder.required_unless' => 'El texto del campo es obligatorio a menos que el tipo de campo sea checkbox'
        ];

        $rules = [
            'label' => [
                'required',
                function ($attribute, $value, $fail) use ($inname, $inputs) {
                    foreach ($inputs as $key => $input) {
                        if ($input->name == $inname) {
                            $fail("El campo de entrada ya existe.");
                        }
                    }
                },
            ],
            'placeholder' => 'required_unless:type,3',
            'type' => 'required',
            'options.*' => 'required_if:type,2,3'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $input = new PackageInput;
        $input->language_id = $request->language_id;
        $input->type = $request->type;
        $input->label = $request->label;
        $input->name = $inname;
        $input->placeholder = $request->placeholder;
        $input->required = $request->required;
        $input->save();

        if ($request->type == 2 || $request->type == 3) {
            $options = $request->options;
            foreach ($options as $key => $option) {
                $op = new PackageInputOption;
                $op->package_input_id = $input->id;
                $op->name = $option;
                $op->save();
            }
        }

        Session::flash('success', '??Campo de entrada agregado con ??xito!');
        return "success";
    }

    public function inputDelete(Request $request)
    {
        $input = PackageInput::find($request->input_id);
        $input->package_input_options()->delete();
        $input->delete();
        Session::flash('success', '??Campo de entrada eliminado con ??xito!');
        return back();
    }

    public function inputEdit($id)
    {
        $data['input'] = PackageInput::find($id);
        if (!empty($data['input']->package_input_options)) {
            $options = $data['input']->package_input_options;
            $data['options'] = $options;
            $data['counter'] = count($options);
        }
        return view('admin.package.form-edit', $data);
    }

    public function inputUpdate(Request $request)
    {
        $inname = make_input_name($request->label);
        $input = PackageInput::find($request->input_id);
        $inputs = PackageInput::where('language_id', $input->language_id)->get();

        // return $request->options;
        $messages = [
            'options.required_if' => 'Options are required',
            'placeholder.required_unless' => 'Placeholder is required',
            'label.required_unless' => 'Label is required',
        ];

        $rules = [
            'label' => [
                'required_unless:type,5',
                function ($attribute, $value, $fail) use ($inname, $inputs, $input) {
                    foreach ($inputs as $key => $in) {
                        if ($in->name == $inname && $inname != $input->name) {
                            $fail("El campo de entrada ya existe.");
                        }
                    }
                },
            ],
            'placeholder' => 'required_unless:type,3,5',
            'options' => [
                'required_if:type,2,3',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->type == 2 || $request->type == 3) {
                        foreach ($request->options as $option) {
                            if (empty($option)) {
                                $fail('Todos los campos de opciones son obligatorios.');
                            }
                        }
                    }
                },
            ]
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }


        if ($request->type != 5) {
            $input->label = $request->label;
            $input->name = $inname;
        }

        // if input is checkbox then placeholder is not required
        if ($request->type != 3 && $request->type != 5) {
            $input->placeholder = $request->placeholder;
        }
        $input->required = $request->required;
        if ($request->type == 5) {
            $input->active = $request->active;
        }
        $input->save();

        if ($request->type == 2 || $request->type == 3) {
            $input->package_input_options()->delete();
            $options = $request->options;
            foreach ($options as $key => $option) {
                $op = new PackageInputOption;
                $op->package_input_id = $input->id;
                $op->name = $option;
                $op->save();
            }
        }

        Session::flash('success', '??Campo de entrada actualizado con ??xito!');
        return "success";
    }

    public function options($id)
    {
        $options = PackageInputOption::where('package_input_id', $id)->get();
        return $options;
    }

    public function store(Request $request)
    {

        $messages = [
            'language_id.required' => 'El campo de idioma es obligatorio.',
        ];

        $rules = [
            'language_id' => 'required',
            'title' => 'required|max:40',
            'currency' => 'required|max:20',
            'price' => 'required|numeric',
            'description' => 'required',
            'serial_number' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $package = new Package;
        $package->language_id = $request->language_id;
        $package->title = $request->title;
        $package->currency = $request->currency;
        $package->price = $request->price;
        $package->serial_number = $request->serial_number;
        $package->meta_keywords = $request->meta_keywords;
        $package->meta_description = $request->meta_description;
        $package->description = $request->description;
        $package->save();

        Session::flash('success', '??Paquete agregado con ??xito!');
        return "success";
    }

    public function update(Request $request)
    {
        $package = Package::findOrFail($request->package_id);

        $rules = [
            'title' => 'required|max:70',
            'currency' => 'required|max:30',
            'price' => 'required|numeric',
            'description' => 'required',
            'serial_number' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $package->title = $request->title;
        $package->currency = $request->currency;
        $package->price = $request->price;
        $package->serial_number = $request->serial_number;
        $package->meta_keywords = $request->meta_keywords;
        $package->meta_description = $request->meta_description;
        $package->description = $request->description;
        $package->save();

        Session::flash('success', 'Paquete actualizado con ??xito!');
        return "success";
    }

    public function delete(Request $request)
    {
        $package = Package::findOrFail($request->package_id);
        $package->delete();

        Session::flash('success', '??Paquete eliminado con ??xito!');
        return back();
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        foreach ($ids as $id) {
            $package = Package::findOrFail($id);
            $package->delete();
        }

        Session::flash('success', 'Paquetes eliminados con ??xito!');
        return "success";
    }

    public function all()
    {
        $data['orders'] = PackageOrder::orderBy('id', 'DESC')->paginate(10);
        return view('admin.package.orders', $data);
    }

    public function pending()
    {
        $data['orders'] = PackageOrder::where('status', 0)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.package.orders', $data);
    }

    public function processing()
    {
        $data['orders'] = PackageOrder::where('status', 1)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.package.orders', $data);
    }

    public function completed()
    {
        $data['orders'] = PackageOrder::where('status', 2)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.package.orders', $data);
    }

    public function rejected()
    {
        $data['orders'] = PackageOrder::where('status', 3)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.package.orders', $data);
    }

    public function status(Request $request)
    {
        $po = PackageOrder::find($request->order_id);
        $po->status = $request->status;
        $po->save();

        Session::flash('success', '??El estado del pedido cambi?? correctamente!');
        return back();
    }

    public function mail(Request $request)
    {
        $rules = [
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $settings = BasicSetting::first();
        $from = $settings->contact_mail;

        $sub = $request->subject;
        $msg = $request->message;
        $to = $request->email;

        Mail::to($to)->send(new ContactMail($from, $sub, $msg));

        Session::flash('success', '??El correo enviado con ??xito!');
        return "success";
    }

    public function orderDelete(Request $request)
    {
        $order = PackageOrder::findOrFail($request->order_id);
        @unlink('assets/front/ndas/'.$order->nda);
        $order->delete();

        Session::flash('success', 'Orden de paquete eliminada con ??xito!');
        return back();
    }

    public function bulkOrderDelete(Request $request)
    {
        $ids = $request->ids;

        foreach ($ids as $id) {
            $order = PackageOrder::findOrFail($id);
            @unlink('assets/front/ndas/'.$order->nda);
            $order->delete();
        }

        Session::flash('success', '??Pedidos borrados con ??xito!');
        return "success";
    }
}
