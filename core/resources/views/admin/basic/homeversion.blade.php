@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Temas del Home</h4>
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
        <a href="#">Temas del home</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
            <div class="card-header">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card-title">Temas del home</div>
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
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
                <div class="row">

                  <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{asset('assets/admin/img/versions/static.jpg')}}" alt="" style="width:100%;">
                            <h3 class="text-center text-white mt-3 mb-0">Tema estatico</h3>
                        </div>
                        <div class="card-footer text-center">
                            @if ($abs->home_version == 'static')
                            <span class="badge badge-success">Activo</span>
                            @else
                            <form class="deleteform d-inline-block" action="{{route('admin.homeversion.update', $lang_id)}}" method="post">
                                @csrf
                                <input type="hidden" name="home_version" value="static">
                                <button type="submit" class="btn btn-info btn-sm confirmbtn">
                                <span class="btn-label">
                                    <i class="fas fa-arrow-alt-circle-down"></i>
                                </span>
                                Activar
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body">
                        <img src="{{asset('assets/admin/img/versions/slider.jpg')}}" alt="" style="width:100%;">
                        <h3 class="text-center text-white mt-3 mb-0">Tema con Slider</h3>
                      </div>
                      <div class="card-footer text-center">
                        @if ($abs->home_version == 'slider')
                          <span class="badge badge-success">Activo</span>
                        @else
                          <form class="deleteform d-inline-block" action="{{route('admin.homeversion.update', $lang_id)}}" method="post">
                            @csrf
                            <input type="hidden" name="home_version" value="slider">
                            <button type="submit" class="btn btn-info btn-sm confirmbtn">
                              <span class="btn-label">
                                <i class="fas fa-arrow-alt-circle-down"></i>
                              </span>
                              Activar
                            </button>
                          </form>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body">
                        <img src="{{asset('assets/admin/img/versions/video.jpg')}}" alt="" style="width:100%;">
                        <h3 class="text-center text-white mt-3 mb-0">Tema con video</h3>
                      </div>
                      <div class="card-footer text-center">
                        @if ($abs->home_version == 'video')
                          <span class="badge badge-success">Activo</span>
                        @else
                          <form class="deleteform d-inline-block" action="{{route('admin.homeversion.update', $lang_id)}}" method="post">
                            @csrf
                            <input type="hidden" name="home_version" value="video">
                            <button type="submit" class="btn btn-info btn-sm confirmbtn">
                              <span class="btn-label">
                                <i class="fas fa-arrow-alt-circle-down"></i>
                              </span>
                              Activar
                            </button>
                          </form>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body">
                        <img src="{{asset('assets/admin/img/versions/water.jpg')}}" alt="" style="width:100%;">
                        <h3 class="text-center text-white mt-3 mb-0">Tema "water"</h3>
                      </div>
                      <div class="card-footer text-center">
                        @if ($abs->home_version == 'water')
                          <span class="badge badge-success">Activo</span>
                        @else
                          <form class="deleteform d-inline-block" action="{{route('admin.homeversion.update', $lang_id)}}" method="post">
                            @csrf
                            <input type="hidden" name="home_version" value="water">
                            <button type="submit" class="btn btn-info btn-sm confirmbtn">
                              <span class="btn-label">
                                <i class="fas fa-arrow-alt-circle-down"></i>
                              </span>
                              Activar
                            </button>
                          </form>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body">
                        <img src="{{asset('assets/admin/img/versions/parallax.jpg')}}" alt="" style="width:100%;">
                        <h3 class="text-center text-white mt-3 mb-0">Tema Parallax</h3>
                      </div>
                      <div class="card-footer text-center">
                        @if ($abs->home_version == 'parallax')
                          <span class="badge badge-success">Activo</span>
                        @else
                          <form class="deleteform d-inline-block" action="{{route('admin.homeversion.update', $lang_id)}}" method="post">
                            @csrf
                            <input type="hidden" name="home_version" value="parallax">
                            <button type="submit" class="btn btn-info btn-sm confirmbtn">
                              <span class="btn-label">
                                <i class="fas fa-arrow-alt-circle-down"></i>
                              </span>
                              Activar
                            </button>
                          </form>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body">
                        <img src="{{asset('assets/admin/img/versions/particles.jpg')}}" alt="" style="width:100%;">
                        <h3 class="text-center text-white mt-3 mb-0">Tema con particulas</h3>
                      </div>
                      <div class="card-footer text-center">
                        @if ($abs->home_version == 'particles')
                          <span class="badge badge-success">Activo</span>
                        @else
                          <form class="deleteform d-inline-block" action="{{route('admin.homeversion.update', $lang_id)}}" method="post">
                            @csrf
                            <input type="hidden" name="home_version" value="particles">
                            <button type="submit" class="btn btn-info btn-sm confirmbtn">
                              <span class="btn-label">
                                <i class="fas fa-arrow-alt-circle-down"></i>
                              </span>
                              Activar
                            </button>
                          </form>
                        @endif
                      </div>
                    </div>
                  </div>

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
  $('.confirmbtn').on('click', function(e) {
    e.preventDefault();
    swal({
      title: '¿Estas seguro?',
      text: "¿Quieres aplicar este tema a tu home?",
      type: 'warning',
      buttons:{
        confirm: {
          text : 'Si',
          className : 'btn btn-success'
        },
        cancel: {
          text : 'No',
          visible: true,
          className: 'btn btn-danger'
        }
      }
    }).then((Delete) => {
      if (Delete) {
        $(this).parent(".deleteform").submit();
      } else {
        swal.close();
      }
    });
  });
  </script>
@endsection
