@extends('admin.layout')

@if(!empty($abs->language) && $abs->language->rtl == 1)
@section('styles')
<style>
    form input,
    form textarea,
    form select,
    select {
        direction: rtl;
    }
    form .note-editor.note-frame .note-editing-area .note-editable {
        direction: rtl;
        text-align: right;
    }
</style>
@endsection
@endif

@section('content')
<div class="page-header">
    <h4 class="page-title">Constructor de formularios</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{route('admin.dashboard')}}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Administrador de cotizaciones</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Constructor de formularios</a>
      </li>
    </ul>
  </div>

  <div class="row" id="app">
    <div class="col-lg-7">
      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card-title">Campos de entrada</div>
                </div>
                <div class="col-lg-4">
                    @if (!empty($langs))
                        <select name="language" class="form-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                            <option value="" selected disabled>Selecciona un lenguaje</option>
                            @foreach ($langs as $lang)
                                <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <p class="text-warning">**No crear<strong class="text-danger">Nombre y Correo Electronico</strong> estos campos de entrada, estarán en el formulario de Solicitar una cotización de forma predeterminada.</p>

            @if (count($inputs) > 0)

                @foreach ($inputs as $key => $input)
                    {{-- input type text --}}
                    @if ($input->type == 1)
                    <form action="{{route('admin.quote.inputDelete')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="input_id" value="{{$input->id}}">
                        <div class="form-group">
                        <label for="">{{$input->label}} @if($input->required == 1) <span>**</span> @elseif($input->required == 0) (Optional) @endif</label>
                        <div class="row">
                            <div class="col-md-10">
                            <input class="form-control" type="text" name="" value="" placeholder="{{$input->placeholder}}">
                            </div>
                            <div class="col-md-1">
                            <a class="btn btn-warning btn-md" href="{{route('admin.quote.inputEdit', $input->id) . '?language=' . request()->input('language')}}">
                                <i class="fas fa-edit"></i>
                            </a>
                            </div>
                            <div class="col-md-1">
                            <button class="btn btn-danger btn-md" type="submit">
                                <i class="fa fa-times"></i>
                            </button>
                            </div>
                        </div>
                        </div>
                    </form>
                    @elseif ($input->type == 2)
                    <form action="{{route('admin.quote.inputDelete')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="input_id" value="{{$input->id}}">
                        <div class="form-group">
                        <label for="">{{$input->label}} @if($input->required == 1) <span>**</span> @elseif($input->required == 0) (Optional) @endif</label>
                        <div class="row">
                            <div class="col-md-10">
                            <select class="form-control" name="">
                                <option value="" selected disabled>{{$input->placeholder}}</option>
                                @foreach ($input->quote_input_options as $key => $option)
                                <option value="">{{$option->name}}</option>
                                @endforeach
                            </select>
                            </div>

                            <div class="col-md-1">
                            <a class="btn btn-warning btn-md" href="{{route('admin.quote.inputEdit', $input->id) . '?language=' . request()->input('language')}}">
                                <i class="fas fa-edit"></i>
                            </a>
                            </div>
                            <div class="col-md-1">
                            <button class="btn btn-danger btn-md" type="submit">
                                <i class="fa fa-times"></i>
                            </button>
                            </div>
                        </div>
                        </div>
                    </form>
                    @elseif ($input->type == 3)
                    <form action="{{route('admin.quote.inputDelete')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="input_id" value="{{$input->id}}">
                        <div class="form-group">
                        <label for="">{{$input->label}} @if($input->required == 1) <span>**</span> @elseif($input->required == 0) (Optional) @endif</label>
                        <div class="row">
                            <div class="col-md-10">
                            @foreach ($input->quote_input_options as $key => $option)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customRadio{{$option->id}}" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio{{$option->id}}">{{$option->name}}</label>
                                </div>
                            @endforeach
                            </div>
                            <div class="col-md-1">
                            <a class="btn btn-warning btn-md" href="{{route('admin.quote.inputEdit', $input->id) . '?language=' . request()->input('language')}}">
                                <i class="fas fa-edit"></i>
                            </a>
                            </div>
                            <div class="col-md-1">
                            <button type="submit" class="btn btn-danger btn-md">
                                <i class="fa fa-times"></i>
                            </button>
                            </div>
                        </div>
                        </div>
                    </form>
                    @elseif ($input->type == 4)
                    <form action="{{route('admin.quote.inputDelete')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="input_id" value="{{$input->id}}">
                        <div class="form-group">
                        <label for="">{{$input->label}} @if($input->required == 1) <span>**</span> @elseif($input->required == 0) (Optional) @endif</label>
                        <div class="row">
                            <div class="col-md-10">
                            <textarea class="form-control" name="" rows="5" cols="80" placeholder="{{$input->placeholder}}"></textarea>
                            </div>
                            <div class="col-md-1">
                            <a class="btn btn-warning btn-md" href="{{route('admin.quote.inputEdit', $input->id) . '?language=' . request()->input('language')}}">
                                <i class="fas fa-edit"></i>
                            </a>
                            </div>
                            <div class="col-md-1">
                            <button type="submit" class="btn btn-danger btn-md">
                                <i class="fa fa-times"></i>
                            </button>
                            </div>
                        </div>
                        </div>
                    </form>
                    @endif
                @endforeach

            @endif

            <div class="form-group">
                <label for="">NDA file @if($ndaIn->required == 1) <span>**</span> @elseif($ndaIn->required == 0) (Optional) @endif</label>
                <div class="row">
                    <div class="col-md-10">
                        <input type="file">
                    </div>
                    <div class="col-md-1">
                    <a class="btn btn-warning btn-md" href="{{route('admin.quote.inputEdit', 10) . '?language=' . request()->input('language')}}">
                        <i class="fas fa-edit"></i>
                    </a>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>

    <div class="col-lg-5">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Crear entrada</div>
        </div>

        <form id="ajaxForm" action="{{route('admin.quote.form.store')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="language_id" value="{{$lang_id}}">
            <div class="form-group">
                <label for=""><strong>Tipo de campo</strong></label>
                <div class="">
                    <div class="form-check form-check-inline">
                        <input name="type" class="form-check-input" type="radio" id="inlineRadio1" value="1" v-model="type" @change="typeChange()">
                        <label class="form-check-label" for="inlineRadio1">Text Field</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="type" class="form-check-input" type="radio" id="inlineRadio2" value="2" v-model="type" @change="typeChange()">
                        <label class="form-check-label" for="inlineRadio2">Select</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="type" class="form-check-input" type="radio" id="inlineRadio3" value="3" v-model="type" @change="typeChange()">
                        <label class="form-check-label" for="inlineRadio3">Checkbox</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="type" class="form-check-input" type="radio" id="inlineRadio4" value="4" v-model="type" @change="typeChange()">
                        <label class="form-check-label" for="inlineRadio4">Textarea</label>
                    </div>
                </div>
                <p id="errtype" class="mb-0 text-danger em"></p>
            </div>

            <div class="form-group">
                <label>Requerido</label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input type="radio" name="required" value="1" class="selectgroup-input" checked>
                        <span class="selectgroup-button">Si</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="required" value="0" class="selectgroup-input">
                        <span class="selectgroup-button">No</span>
                    </label>
                </div>
                <p id="errrequired" class="mb-0 text-danger em"></p>
            </div>

            <div class="form-group">
                <label for=""><strong>Nombre de etiqueta</strong></label>
                <div class="">
                    <input type="text" class="form-control" name="label" value="" placeholder="Enter Label Name">
                </div>
                <p id="errlabel" class="mb-0 text-danger em"></p>
            </div>

            <div class="form-group" v-if="placeholdershow">
                <label for=""><strong>Texto de campo</strong></label>
                <div class="">
                    <input type="text" class="form-control" name="placeholder" value="" placeholder="Texto de campo">
                </div>
                <p id="errplaceholder" class="mb-0 text-danger em"></p>
            </div>


            <div class="form-group" v-if="counter > 0" id="optionarea">
                <label for=""><strong>Opciones</strong></label>
                <div class="row mb-2 counterrow" v-for="n in counter" :id="'counterrow'+n">
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="options[]" value="" placeholder="Option label">
                    </div>

                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-md text-white btn-sm" @click="removeOption(n)"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <p id="erroptions.0" class="mb-2 text-danger em"></p>
                <button type="button" class="btn btn-success btn-sm text-white" @click="addOption()"><i class="fa fa-plus"></i> Agregar  opción</button>
            </div>

            <div class="form-group text-center">
                <button id="submitBtn" type="submit" class="btn btn-primary btn-sm">Agregar campo</button>
            </div>
        </form>

      </div>

    </div>
  </div>
@endsection

@section('vuescripts')
  <script>
    var app = new Vue({
      el: '#app',
      data: {
        type: 1,
        counter: 0,
        placeholdershow: true
      },
      methods: {
        typeChange() {
          if (this.type == 3) {
            this.placeholdershow = false;
          } else {
            this.placeholdershow = true;
          }
          if (this.type == 2 || this.type == 3) {
            this.counter = 1;
          } else {
            this.counter = 0;
          }
        },
        addOption() {
          $("#optionarea").addClass('d-block');
          this.counter++;
        },
        removeOption(n) {
          $("#counterrow"+n).remove();
          if ($(".counterrow").length == 0) {
            this.counter = 0;
          }
        }
      }
    })
  </script>
@endsection