@extends('admin.layout')


@if(!empty($point->language) && $point->language->rtl == 1)
@section('styles')
<style>
    form input,
    form textarea,
    form select {
        direction: rtl;
    }
    .nicEdit-main {
        direction: rtl;
        text-align: right;
    }
</style>
@endsection
@endif



@section('content')
  <div class="page-header">
    <h4 class="page-title">Sección de acercamiento</h4>
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
        <a href="#">Página de inicio</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Sección de acercamiento</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form id="pointForm" action="{{route('admin.approach.point.update')}}" method="post" onsubmit="update(event)">
          <div class="card-header">
            <div class="card-title d-inline-block">Editar punto</div>
            <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('admin.approach.index') . '?language=' . request()->input('language')}}">
							<span class="btn-label">
								<i class="fas fa-backward" style="font-size: 12px;"></i>
							</span>
							Volver
						</a>
          </div>
          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                @csrf
                <input type="hidden" name="pointid" value="{{$point->id}}">
                <div class="form-group">
                  <label for="">Icono Social **</label>
                  <div class="btn-group d-block">
                      <button type="button" class="btn btn-primary iconpicker-component"><i class="{{$point->icon}}"></i></button>
                      <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                              data-selected="fa-car" data-toggle="dropdown">
                      </button>
                      <div class="dropdown-menu"></div>
                  </div>
                  <input id="inputIcon" type="hidden" name="icon" value="{{$point->icon}}">
                  @if ($errors->has('icon'))
                    <p class="mb-0 text-danger">{{$errors->first('icon')}}</p>
                  @endif
                  <div class="mt-2">
                    <small>NB: haga clic en el signo desplegable para seleccionar un icono.</small>
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Titulo **</label>
                  <input type="text" class="form-control" name="title" value="{{$point->title}}" placeholder="Ingrese un titulo">
                  @if ($errors->has('title'))
                    <p class="mb-0 text-danger">{{$errors->first('title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label for="">Texto corto **</label>
                  <input type="text" class="form-control" name="short_text" value="{{$point->short_text}}" placeholder="Ingrese un texto corto">
                  @if ($errors->has('short_text'))
                    <p class="mb-0 text-danger">{{$errors->first('short_text')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label for="">Número de serie **</label>
                  <input type="number" class="form-control ltr" name="serial_number" value="{{$point->serial_number}}" placeholder="ingrese un Número de serie">
                  @if ($errors->has('serial_number'))
                    <p class="mb-0 text-danger">{{$errors->first('serial_number')}}</p>
                  @endif
                  <p class="text-warning"><small>Cuanto mayor sea el número de serie, más tarde se mostrará el punto en la sección de aproximación.</small></p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer pt-3">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-lg-3 col-md-3 col-sm-12">

                </div>
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


@section('scripts')
  <script>
    $(document).ready(function() {
      $('.icp').on('iconpickerSelected', function(event){
        $("#inputIcon").val($(".iconpicker-component").find('i').attr('class'));
      });
    });
  </script>
@endsection
