@extends('admin.layout')

@if(!empty($feature->language) && $feature->language->rtl == 1)
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
    <h4 class="page-title">Destacado</h4>
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
        <a href="#">Destacado</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form action="{{route('admin.feature.update')}}" method="post">
          <div class="card-header">
            <div class="card-title d-inline-block">Editar Destacado</div>
            <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('admin.feature.index') . '?language=' . request()->input('language')}}">
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
                  <input type="hidden" name="feature_id" value="{{$feature->id}}">
                  <div class="form-group">
                    <label for="">Icono **</label>
                    <div class="btn-group d-block">
                        <button type="button" class="btn btn-primary iconpicker-component"><i class="{{$feature->icon}}"></i></button>
                        <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                data-selected="fa-car" data-toggle="dropdown">
                        </button>
                        <div class="dropdown-menu"></div>
                    </div>
                    <input id="inputIcon" type="hidden" name="icon" value="{{$feature->icon}}">
                    @if ($errors->has('icon'))
                      <p class="mb-0 text-danger">{{$errors->first('icon')}}</p>
                    @endif
                    <div class="mt-2">
                      <small>NB: Haga clic en el signo desplegable para seleccionar un icono.</small>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="">Title **</label>
                    <input class="form-control" name="title" placeholder="Enter title" value="{{$feature->title}}">
                    @if ($errors->has('title'))
                      <p class="mb-0 text-danger">{{$errors->first('title')}}</p>
                    @endif
                  </div>
                  <div class="form-group">
                    <label>Color **</label>
                    <input class="jscolor form-control ltr" name="color" value="{{$feature->color}}">
                    @if ($errors->has('color'))
                      <p class="mb-0 text-danger">{{$errors->first('color')}}</p>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="">Número de serie **</label>
                    <input type="number" class="form-control ltr" name="serial_number" value="{{$feature->serial_number}}" placeholder="Ingrese un Número de serie">
                    @if ($errors->has('serial_number'))
                      <p class="mb-0 text-danger">{{$errors->first('serial_number')}}</p>
                    @endif
                    <p class="text-warning"><small>Cuanto mayor sea el número de serie, más tarde se mostrará la función.</small></p>
                  </div>
              </div>
            </div>
          </div>
          <div class="card-footer pt-3">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-success">Actualizar</button>
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
