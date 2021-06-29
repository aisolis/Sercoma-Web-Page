@extends('admin.layout')

@if(!empty($abe->language) && $abe->language->rtl == 1)
@section('styles')
<style>
    form input,
    form textarea,
    form select {
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
    <h4 class="page-title">Informacion Basica</h4>
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
        <a href="#">Configuraciones Básicas</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Informacion Basica</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form class="" action="{{route('admin.basicinfo.update', $lang_id)}}" method="post">
          @csrf
          <div class="card-header">
              <div class="row">
                  <div class="col-lg-10">
                      <div class="card-title">Actualizar información básica</div>
                  </div>
                  <div class="col-lg-2">
                      @if (!empty($langs))
                          <select name="language" class="form-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                              <option value="" selected disabled>Select a Language</option>
                              @foreach ($langs as $lang)
                                  <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                              @endforeach
                          </select>
                      @endif
                  </div>
              </div>
          </div>
          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                @csrf
                <div class="form-group">
                  <label>Título de la página **</label>
                  <input class="form-control" name="website_title" value="{{$abs->website_title}}">
                  @if ($errors->has('website_title'))
                    <p class="mb-0 text-danger">{{$errors->first('website_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Correo de contacto (Para administradores) **</label>
                  <input class="form-control ltr" name="contact_mail" value="{{$abs->contact_mail}}">
                  @if ($errors->has('contact_mail'))
                    <p class="mb-0 text-danger">{{$errors->first('contact_mail')}}</p>
                  @endif
                  <div class="text-warning">Este correo electrónico se utilizará para enviar correos electrónicos a los usuarios y para recibir correos electrónicos a través del formulario de contacto de los visitantes.</div>
                </div>
                <div class="form-group">
                  <label>Paquete / Presupuesto del Pedido Correo del destinatario **</label>
                  <input class="form-control ltr" name="order_mail" value="{{$abe->order_mail}}">
                  @if ($errors->has('order_mail'))
                    <p class="mb-0 text-danger">{{$errors->first('order_mail')}}</p>
                  @endif
                  <div class="text-warning">Este correo electrónico se utilizará para recibir notificaciones por correo cuando el cliente haga / solicite un pedido a través del formulario de pedido del paquete / solicite un formulario de cotización.</div>
                </div>
                <div class="form-group">
                  <label>Código de color base de la página **</label>
                  <input class="jscolor form-control ltr" name="base_color" value="{{$abs->base_color}}">
                  @if ($errors->has('base_color'))
                    <p class="mb-0 text-danger">{{$errors->first('base_color')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Código de color base secundario de la página **</label>
                  <input class="jscolor form-control ltr" name="secondary_base_color" value="{{$abs->secondary_base_color}}">
                  @if ($errors->has('secondary_base_color'))
                    <p class="mb-0 text-danger">{{$errors->first('secondary_base_color')}}</p>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" id="displayNotif" class="btn btn-success">Actualizar</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
