@extends('admin.layout')

@if(!empty($testimonial->language) && $testimonial->language->rtl == 1)
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
    <h4 class="page-title">Editar Testimoniales</h4>
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
        <a href="#">Editar Testimoniales</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Editar Testimoniales</div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('admin.testimonial.index') . '?language=' . request()->input('language')}}">
            <span class="btn-label">
              <i class="fas fa-backward" style="font-size: 12px;"></i>
            </span>
            Back
          </a>
        </div>
        <div class="card-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form class="mb-3 dm-uploader drag-and-drop-zone" enctype="multipart/form-data" action="{{route('admin.testimonial.uploadUpdate', $testimonial->id)}}" method="POST">
                @csrf
                <div class="form-row px-2">
                  <div class="col-12 mb-2">
                    <label for=""><strong>Imágen **</strong></label>
                  </div>
                  <div class="col-md-12 d-md-block d-sm-none mb-3">
                    <img src="{{asset('assets/front/img/testimonials/'.$testimonial->image)}}" alt="..." class="img-thumbnail">
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
                        <i class="fa fa-search"></i> Buscar archivos
                        <input type="file" title='Haga clic para agregar archivos'  />
                      </div>
                      <small class="status text-muted">Seleccione un archivo o arrástrelo sobre esta área...</small>
                    </div>
                  </div>
                </div>
                <p class="text-warning mb-0 mt-2">Cargue la imagen 70X70 px o la imagen en tamaño escuadra para obtener la mejor calidad.</p>
              </form>

              <form id="ajaxForm" class="" action="{{route('admin.testimonial.update')}}" method="post">
                @csrf
                <input type="hidden" name="testimonial_id" value="{{$testimonial->id}}">
                <div class="form-group">
                  <label for="">Comentario **</label>
                  <textarea class="form-control" name="comment" rows="3" cols="80" placeholder="Ingrese un comentario">{{$testimonial->comment}}</textarea>
                  <p id="errcomment" class="mb-0 text-danger em"></p>
                </div>
                <div class="form-group">
                  <label for="">Nombre **</label>
                  <input type="text" class="form-control" name="name" value="{{$testimonial->name}}" placeholder="Ingrese un nombre">
                  <p id="errname" class="mb-0 text-danger em"></p>
                </div>
                <div class="form-group">
                  <label for="">Rango **</label>
                  <input type="text" class="form-control" name="rank" value="{{$testimonial->rank}}" placeholder="Ingrese un rango">
                  <p id="errrank" class="mb-0 text-danger em"></p>
                </div>
                <div class="form-group">
                  <label for="">Número de serie **</label>
                  <input type="number" class="form-control ltr" name="serial_number" value="{{$testimonial->serial_number}}" placeholder="Ingrese un Número de serie">
                  <p id="errserial_number" class="mb-0 text-danger em"></p>
                  <p class="text-warning"><small>Cuanto mayor sea el número de serie, más tarde se mostrará el testimonio.</small></p>
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
