@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Favicon</h4>
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
        <a href="#">Favicon</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card-title">Actualizar Favicon</div>
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
        <div class="card-body pt-5 pb-4">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form class="mb-3 dm-uploader drag-and-drop-zone" enctype="multipart/form-data" action="{{route('admin.favicon.update', $lang_id)}}" method="POST">
                <div class="form-row">
                  <div class="col-md-12 d-md-block d-sm-none mb-3">
                    @if (!empty($abs->favicon))
                      <img src="{{asset('assets/front/img/'.$abs->favicon)}}" alt="..." class="img-thumbnail">
                    @else
                      <img src="{{asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail">
                    @endif
                  </div>
                  <div class="col-sm-12">
                    <div class="from-group mb-2">
                      <input type="text" class="form-control progressbar" aria-describedby="fileHelp" placeholder="no se ha cargado una imagen..." readonly="readonly" />

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
                        <i class="fa fa-search"></i> Buscar archivos
                        <input type="file" title='Haga clic para agregar archivos' name="favicon" />
                      </div>
                      <small class="status text-muted">Seleccione un archivo o arrástrelo sobre esta área...</small>
                      <p class="text-warning mb-0 mt-2">Cargue una imagen de 40X40 o una imagen de tamaño de escuadra para obtener la mejor calidad.</p>
                      <p class="text-warning mb-0">Solo se permiten archivos con extención jpg, jpeg y png.</p>
                      <p class="text-danger mb-0 em" id="errfavicon"></p>
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