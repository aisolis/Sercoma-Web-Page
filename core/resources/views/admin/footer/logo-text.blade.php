@extends('admin.layout')

@php
$selLang = \App\Language::where('code', request()->input('language'))->first();
@endphp
@if(!empty($selLang) && $selLang->rtl == 1)
@section('styles')
<style>
    form:not(.modal-form) input,
    form:not(.modal-form) textarea,
    form:not(.modal-form) select,
    select[name='language'] {
        direction: rtl;
    }
    form:not(.modal-form) .note-editor.note-frame .note-editing-area .note-editable {
        direction: rtl;
        text-align: right;
    }
</style>
@endsection
@endif

@section('content')
  <div class="page-header">
    <h4 class="page-title">Logos y textos</h4>
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
        <a href="#">Footer</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Logos y Textos</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card-title">Actualizar Logos y Textos</div>
                </div>
                <div class="col-lg-2">
                    @if (!empty($langs))
                        <select name="language" class="form-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                            <option value="" selected disabled>Selecciona un lenguaje</option>
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
              <form class="mb-3 dm-uploader drag-and-drop-zone" enctype="multipart/form-data" action="{{route('admin.footer.upload', $lang_id)}}" method="POST">
                <div class="form-row">
                  <div class="col-12 mb-2">
                    <label for=""><strong>Logo del Pie de p??gina **</strong></label>
                  </div>
                  <div class="col-md-12 d-md-block d-sm-none mb-3">
                        @if (!empty($abs->footer_logo))
                            <img src="{{asset('assets/front/img/'.$abs->footer_logo)}}" alt="..." class="img-thumbnail">
                        @else
                            <img src="{{asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail">
                        @endif
                  </div>
                  <div class="col-sm-12">
                    <div class="from-group mb-2">
                      <input type="text" class="form-control progressbar" aria-describedby="fileHelp" placeholder="Hay imagenes cargadas.." readonly="readonly" />

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
                        <input type="file" title='Haga clic para agregar archivos' name="footer_logo" />
                      </div>
                      <small class="status text-muted">Seleccione un archivo o arr??strelo sobre esta ??rea...</small>
                      <p class="text-warning mb-0 mt-2">Cargue una imagen de 140X55 px para obtener la mejor calidad.</p>
                      <p class="text-warning mb-0">Solo se permiten archivos con extenci??n jpg, jpeg y png.</p>
                      <p class="text-danger mb-0 em" id="errfooter_logo"></p>
                    </div>
                  </div>
                </div>
              </form>


              <form id="ajaxForm" action="{{route('admin.footer.update', $lang_id)}}" method="post">
                @csrf
                <div class="form-group">
                  <label for="">Texto del pie de p??gina **</label>
                  <input type="text" class="form-control" name="footer_text" value="{{$abs->footer_text}}">
                  <p id="errfooter_text" class="em text-danger mb-0"></p>
                </div>
                <div class="form-group">
                  <label for="">Bolet??n de texto **</label>
                  <input type="text" class="form-control" name="newsletter_text" value="{{$abs->newsletter_text}}">
                  <p id="errnewsletter_text" class="em text-danger mb-0"></p>
                </div>
                <div class="form-group">
                  <label for="">Copyright **</label>
                  <textarea id="copyright_text" name="copyright_text" class="summernote form-control" data-height="150">{{$abs->copyright_text}}</textarea>
                  <p id="errcopyright_text" class="em text-danger mb-0"></p>
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
