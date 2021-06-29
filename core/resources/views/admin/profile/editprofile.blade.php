@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Perfil</h4>
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
        <a href="#">Configuración de perfil</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Perfil</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Actualizar Perfil</div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form class="mb-3 dm-uploader drag-and-drop-zone px-4" enctype="multipart/form-data" action="{{route('admin.propic.update')}}" method="POST">
                <div class="form-row">
                  <div class="col-md-12 d-md-block d-sm-none mb-3">
                    @if (!empty(Auth::guard('admin')->user()->image))
                      <img src="{{asset('assets/admin/img/propics/'.Auth::guard('admin')->user()->image)}}" alt="..." class="img-thumbnail">
                    @else
                      <img src="{{asset('assets/admin/img/propics/blank_user.jpg')}}" alt="..." class="img-thumbnail">
                    @endif
                  </div>
                  <div class="col-sm-12">
                    <div class="from-group mb-2">
                      <input type="text" class="form-control progressbar" aria-describedby="fileHelp" placeholder="No hay una imagen cargada..." readonly="readonly" />

                      <div class="progress mb-2 d-none">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                          role="progressbar"
                          style="width: 0%;"
                          aria-valuenow="0" aria-valuemin="0" aria-valuemax="0">
                          0%
                        </div>
                      </div>
                    </div>
                    <div class="mt-4">
                      <div role="button" class="btn btn-primary mr-2">
                        <i class="fa fa-search"></i> Buscar Archivos
                        <input type="file" title='Click to add Files' name="image" />
                      </div>
                      <small class="status text-muted">Seleccione un archivo o arrástrelo sobre esta área..</small>
                      <p class="text-warning mb-0 mt-2">Cargue la imagen de tamaño de escuadra para obtener la mejor calidad.</p>
                      <p class="text-warning mb-0">Solo se permiten archivos con extenciones jpg, jpeg y png.</p>
                      <p class="text-danger mb-0 em" id="errimage"></p>
                    </div>
                  </div>
                </div>
              </form>

               <form action="{{route('admin.updateProfile')}}" method="post" role="form">
                 {{csrf_field()}}
                 <div class="form-body">
                    <div class="form-group">
                        <div class="col-md-12">
                          <label>Nombre de usuario</label>
                        </div>
                       <div class="col-md-12">
                          <input class="form-control input-lg" name="username" value="{{$admin->username}}" placeholder="Nombre de usuario" type="text">
                          @if ($errors->has('username'))
                            <p style="margin:0px;" class="text-danger">{{$errors->first('username')}}</p>
                          @endif
                       </div>
                    </div>
                     <div class="form-group">
                         <div class="col-md-12">
                           <label>Email</label>
                         </div>
                        <div class="col-md-12">
                           <input class="form-control input-lg" name="email" value="{{$admin->email}}" placeholder="Ingresa tu Email" type="text">
                           @if ($errors->has('email'))
                             <p style="margin:0px;" class="text-danger">{{$errors->first('email')}}</p>
                           @endif
                        </div>
                     </div>
                    <div class="form-group">
                        <div class="col-md-12">
                          <label>Primer Nombre</label>
                        </div>
                       <div class="col-md-12">
                          <input class="form-control input-lg" name="first_name" value="{{$admin->first_name}}" placeholder="Primer nombre" type="text">
                          @if ($errors->has('first_name'))
                            <p style="margin:0px;" class="text-danger">{{$errors->first('first_name')}}</p>
                          @endif
                       </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                       <label>Apellidos</label>
                      </div>
                       <div class="col-md-12">
                          <input class="form-control input-lg" name="last_name" value="{{$admin->last_name}}" placeholder="Ingresa tu Apellidos" type="last_name">
                          @if ($errors->has('last_name'))
                            <p style="margin:0px;" class="text-danger">{{$errors->first('last_name')}}</p>
                          @endif
                       </div>
                    </div>
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

      </div>
    </div>
  </div>

@endsection
