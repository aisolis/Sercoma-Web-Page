@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Añadir miembro</h4>
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
        <a href="#">Página de inicio</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Añadir miembro</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Añadir miembro</div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('admin.member.index') . '?language=' . request()->input('language')}}">
            <span class="btn-label">
              <i class="fas fa-backward" style="font-size: 12px;"></i>
            </span>
            Volver
          </a>
        </div>
        <div class="card-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form class="mb-3 dm-uploader drag-and-drop-zone" enctype="multipart/form-data" action="{{route('admin.member.upload')}}" method="POST">
                <div class="form-row px-2">
                  <div class="col-12 mb-2">
                    <label for=""><strong>Imágen **</strong></label>
                  </div>
                  <div class="col-md-12 d-md-block d-sm-none mb-3">
                    <img src="{{asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail">
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
                        <input type="file" title='Haga clic para agregar archivos' />
                      </div>
                      <small class="status text-muted">Seleccione un archivo o arrástrelo sobre esta área...</small>
                      <p class="em text-danger mb-0" id="errmember_image"></p>
                    </div>
                  </div>
                </div>
              </form>

              <form id="ajaxForm" class="" action="{{route('admin.member.store')}}" method="POST">
                @csrf
                <input type="hidden" id="image" name="" value="">
                <div class="form-group">
                    <label for="">Lenguajes **</label>
                    <select name="language_id" class="form-control">
                        <option value="" selected disabled>Selecciona un lenguaje</option>
                        @foreach ($langs as $lang)
                            <option value="{{$lang->id}}">{{$lang->name}}</option>
                        @endforeach
                    </select>
                    <p id="errlanguage_id" class="mb-0 text-danger em"></p>
                </div>
                <div class="form-group">
                  <label for="">Nombre **</label>
                  <input type="text" class="form-control" name="name" value="" placeholder="Ingresa un nombre">
                  <p id="errname" class="mb-0 text-danger em"></p>
                </div>
                <div class="form-group">
                  <label for="">Rango **</label>
                  <input type="text" class="form-control" name="rank" value="" placeholder="Ingrese un rango">
                  <p id="errrank" class="mb-0 text-danger em"></p>
                </div>
                <div class="form-group">
                  <label for="">Facebook</label>
                  <input type="text" class="form-control ltr" name="facebook" value="" placeholder="Ingresa una url de facebook">
                  <p id="errfacebook" class="mb-0 text-danger em"></p>
                </div>
                <div class="form-group">
                  <label for="">Twitter</label>
                  <input type="text" class="form-control ltr" name="twitter" value="" placeholder="Ingresa una url de twitter">
                  <p id="errtwitter" class="mb-0 text-danger em"></p>
                </div>
                <div class="form-group">
                  <label for="">Instagram</label>
                  <input type="text" class="form-control ltr" name="instagram" value="" placeholder="Ingresa una url de instagram">
                  <p id="errinstagram" class="mb-0 text-danger em"></p>
                </div>
                <div class="form-group">
                  <label for="">Linkedin</label>
                  <input type="text" class="form-control ltr" name="linkedin" value="" placeholder="Ingresa una url de linkedin">
                  <p id="errlinkedin" class="mb-0 text-danger em"></p>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="form">
            <div class="form-group from-show-notify row">
              <div class="col-12 text-center">
                <button type="submit" id="submitBtn" class="btn btn-success">¡Listo!</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

@endsection


@section('scripts')
<script>
    $(document).ready(function() {
        $("select[name='language_id']").on('change', function() {
            $(".request-loader").addClass("show");
            let url = "{{url('/')}}/admin/rtlcheck/" + $(this).val();
            console.log(url);
            $.get(url, function(data) {
                $(".request-loader").removeClass("show");
                if (data == 1) {
                    $("form input").each(function() {
                        if (!$(this).hasClass('ltr')) {
                            $(this).addClass('rtl');
                        }
                    });
                    $("form select").each(function() {
                        if (!$(this).hasClass('ltr')) {
                            $(this).addClass('rtl');
                        }
                    });
                    $("form textarea").each(function() {
                        if (!$(this).hasClass('ltr')) {
                            $(this).addClass('rtl');
                        }
                    });
                } else {
                    $("form input, form select, form textarea").removeClass('rtl');
                }
            })
        });
    });
</script>
@endsection
