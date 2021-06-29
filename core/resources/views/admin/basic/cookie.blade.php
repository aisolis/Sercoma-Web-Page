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
    <h4 class="page-title">Alerta de uso de Cookies</h4>
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
        <a href="#">Alerta de uso de Cookies</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form class="" action="{{route('admin.cookie.update', $lang_id)}}" method="post">
          @csrf
          <div class="card-header">
              <div class="row">
                  <div class="col-lg-10">
                      <div class="card-title">Uso de cookies</div>
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
                  <label>Activar o desactivar alerta de uso de coockies **</label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input type="radio" name="cookie_alert_status" value="1" class="selectgroup-input" {{$abe->cookie_alert_status == 1 ? 'checked' : ''}}>
                        <span class="selectgroup-button">Activado</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="cookie_alert_status" value="0" class="selectgroup-input" {{$abe->cookie_alert_status == 0 ? 'checked' : ''}}>
                        <span class="selectgroup-button">Desactivado</span>
                    </label>
                  </div>
                  @if ($errors->has('cookie_alert_status'))
                    <p class="mb-0 text-danger">{{$errors->first('cookie_alert_status')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Texto del boton de alerta de uso de cookies **</label>
                  <input class="form-control" name="cookie_alert_button_text" value="{{$abe->cookie_alert_button_text}}">
                  @if ($errors->has('cookie_alert_button_text'))
                    <p class="mb-0 text-danger">{{$errors->first('cookie_alert_button_text')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label for="">Texto de la alerta de uso de cookies **</label>
                  <textarea class="form-control summernote" name="cookie_alert_text" rows="3" placeholder="Enter Cookie Alert Text" data-height="100">{{$abe->cookie_alert_text}}</textarea>
                  <p id="errcontent" class="mb-0 text-danger em"></p>
                  @if ($errors->has('cookie_alert_text'))
                    <p class="mb-0 text-danger">{{$errors->first('cookie_alert_text')}}</p>
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

