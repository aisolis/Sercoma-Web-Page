@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Contraseña</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="#">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Configuración del perfil</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Contraseña</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form action="{{route('admin.updatePassword')}}" method="post" role="form">
          <div class="card-header">
            <div class="card-title">Actualizar contraseña</div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                 {{csrf_field()}}
                 <div class="form-body">
                    <div class="form-group">
                       <label>Contraseña actual</label>
                       <div class="">
                          <input class="form-control" name="old_password" placeholder="Contraseña actual" type="password">
                          @if ($errors->has('old_password'))
                          <span class="text-danger">
                              {{"Debe rellenar los campos!"}}
                          </span>
                          @else
                          @if ($errors->first('oldPassMatch'))
                          <span class="text-danger">
                              {{"La contraseña anterior no coincide con la contraseña existente!"}}
                          </span>
                          @endif
                          @endif
                       </div>
                    </div>
                    <div class="form-group">
                       <label>Nueva contraseña</label>
                       <div class="">
                          <input class="form-control" name="password" placeholder="Nueva contraseña" type="password">
                          @if ($errors->has('password'))
                          <span class="text-danger">
                               {{"La contraseñas no coinciden!"}}
                          </span>
                          @endif
                       </div>
                    </div>
                    <div class="form-group">
                       <label>Escriba de nuevo la nueva contraseña</label>
                       <div class="">
                          <input class="form-control" name="password_confirmation" placeholder="Escriba de nuevo la nueva contraseña" type="password">
                       </div>
                    </div>
                 </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="row">
               <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-success">¡Listo!</button>
               </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
