@extends('admin.layout')

@section('content')
<div class="page-header">
    <h4 class="page-title">Disponibilidad de página</h4>
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
          <a href="#">Disponibilidad de página</a>
       </li>
    </ul>
 </div>
 <div class="row">
    <div class="col-md-12">
       <div class="card">
          <form class="" action="{{route('admin.avaibility.update', $lang_id)}}" method="post">
             @csrf
             <div class="card-header">
                <div class="row">
                   <div class="col-lg-10">
                      <div class="card-title">Actualizar la Disponibilidad de página</div>
                   </div>
                   <div class="col-lg-2">
                      @if (!empty($langs))
                      <select name="language" class="form-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                         <option value="" selected disabled>Selecciona un Lenguaje</option>
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
                         <label>Servicios **</label>
                         <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                            <input type="radio" name="is_service" value="1" class="selectgroup-input" {{$abs->is_service == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Activado</span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="is_service" value="0" class="selectgroup-input" {{$abs->is_service == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Desactivado</span>
                            </label>
                         </div>
                      </div>
                      <div class="form-group">
                         <label>Paquetes **</label>
                         <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                            <input type="radio" name="is_packages" value="1" class="selectgroup-input" {{$be->is_packages == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Activado</span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="is_packages" value="0" class="selectgroup-input" {{$be->is_packages == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Desactivado</span>
                            </label>
                         </div>
                      </div>
                      <div class="form-group">
                         <label>Orden de paquete **</label>
                         <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                            <input type="radio" name="is_order_package" value="1" class="selectgroup-input" {{$be->is_order_package == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Activado</span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="is_order_package" value="0" class="selectgroup-input" {{$be->is_order_package == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Desactivado</span>
                            </label>
                         </div>
                      </div>
                      <div class="form-group">
                         <label>Portafolio **</label>
                         <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                            <input type="radio" name="is_portfolio" value="1" class="selectgroup-input" {{$abs->is_portfolio == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Activado</span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="is_portfolio" value="0" class="selectgroup-input" {{$abs->is_portfolio == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Desactivado</span>
                            </label>
                         </div>
                      </div>
                      <div class="form-group">
                         <label>Miembros del equipo **</label>
                         <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                            <input type="radio" name="is_team" value="1" class="selectgroup-input" {{$abs->is_team == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Activado</span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="is_team" value="0" class="selectgroup-input" {{$abs->is_team == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Desactivado</span>
                            </label>
                         </div>
                      </div>
                      <div class="form-group">
                         <label>Carrera **</label>
                         <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                            <input type="radio" name="is_career" value="1" class="selectgroup-input" {{$abe->is_career == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Activado</span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="is_career" value="0" class="selectgroup-input" {{$abe->is_career == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Desactivado</span>
                            </label>
                         </div>
                      </div>
                      <div class="form-group">
                         <label>Calendario de eventos **</label>
                         <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                            <input type="radio" name="is_calendar" value="1" class="selectgroup-input" {{$abe->is_calendar == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Activado</span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="is_calendar" value="0" class="selectgroup-input" {{$abe->is_calendar == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Desactivado</span>
                            </label>
                         </div>
                      </div>
                      <div class="form-group">
                         <label>Galeria **</label>
                         <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                            <input type="radio" name="is_gallery" value="1" class="selectgroup-input" {{$abs->is_gallery == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Activado</span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="is_gallery" value="0" class="selectgroup-input" {{$abs->is_gallery == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Desactivado</span>
                            </label>
                         </div>
                      </div>
                      <div class="form-group">
                         <label>FAQ (preguntas frecuentes) **</label>
                         <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                            <input type="radio" name="is_faq" value="1" class="selectgroup-input" {{$abs->is_faq == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Activado</span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="is_faq" value="0" class="selectgroup-input" {{$abs->is_faq == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Desactivado</span>
                            </label>
                         </div>
                      </div>
                      <div class="form-group">
                         <label>Blogs **</label>
                         <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                            <input type="radio" name="is_blog" value="1" class="selectgroup-input" {{$abs->is_blog == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Activado</span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="is_blog" value="0" class="selectgroup-input" {{$abs->is_blog == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Desactivado</span>
                            </label>
                         </div>
                      </div>
                      <div class="form-group">
                         <label>Contacto **</label>
                         <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                            <input type="radio" name="is_contact" value="1" class="selectgroup-input" {{$abs->is_contact == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Activado</span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="is_contact" value="0" class="selectgroup-input" {{$abs->is_contact == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Desactivado</span>
                            </label>
                         </div>
                      </div>
                      <div class="form-group">
                         <label>Solicitar presupuesto **</label>
                         <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                            <input type="radio" name="is_quote" value="1" class="selectgroup-input" {{$abs->is_quote == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Activado</span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="is_quote" value="0" class="selectgroup-input" {{$abs->is_quote == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Desactivado</span>
                            </label>
                         </div>
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
