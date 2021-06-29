@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Editar Lenguajes</h4>
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
        <a href="#">Configurar Lenguajes</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Editar Lenguaje</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Editar Lenguaje</div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('admin.language.index')}}">
            <span class="btn-label">
              <i class="fas fa-backward" style="font-size: 12px;"></i>
            </span>
            Volver
          </a>
        </div>
        <div class="card-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">

              <form id="ajaxForm" class="" action="{{route('admin.language.update')}}" method="post">
                @csrf
                <input type="hidden" name="language_id" value="{{$language->id}}">
                <div class="form-group">
                  <label for="">Nombre **</label>
                  <input type="text" class="form-control" name="name" placeholder="Ingrese el nombre del lenguaje" value="{{$language->name}}">
                  <p id="errname" class="mb-0 text-danger em"></p>
                </div>
                <div class="form-group">
                  <label for="">Código **</label>
                  <input type="text" class="form-control" name="code" placeholder="Ingrese el código del lenguaje" value="{{$language->code}}">
                  <p id="errcode" class="mb-0 text-danger em"></p>
                </div>
                <div class="form-group">
                  <label for="">Dirección **</label>
                  <select name="direction" class="form-control">
                      <option value="" selected disabled>Seleccione una direccion</option>
                      <option value="0" {{$language->rtl == 0 ? 'selected' : ''}}>LTR (De izquierda a derecha)</option>
                      <option value="1" {{$language->rtl == 1 ? 'selected' : ''}}>RTL (De derecha a izquierda)</option>
                  </select>
                  <p id="errdirection" class="mb-0 text-danger em"></p>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="form">
            <div class="form-group from-show-notify row">
              <div class="col-12 text-center">
                <button type="submit" id="submitBtn" class="btn btn-success">Actualizar</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

@endsection
