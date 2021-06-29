@extends('admin.layout')

@if(!empty($abs->language) && $abs->language->rtl == 1)
@section('styles')
<style>
    form input,
    form textarea,
    form select {
        direction: rtl;
    }
    form .note-editor.note-frame .note-editing-area .note-editable {
        direction: rtl;
        text-align: right;
    }
</style>
@endsection
@endif

@section('content')
  <div class="page-header">
    <h4 class="page-title">Cabeceras de página</h4>
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
        <a href="#">Cabeceras de página</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form class="" action="{{route('admin.heading.update', $lang_id)}}" method="post">
          @csrf
          <div class="card-header">
              <div class="row">
                  <div class="col-lg-10">
                      <div class="card-title">Actualizar cabeceras de páginas</div>
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
          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                @csrf
                <div class="form-group">
                  <label>Titulo de sección de servicio **</label>
                  <input class="form-control" name="service_title" value="{{$abs->service_title}}">
                  @if ($errors->has('service_title'))
                    <p class="mb-0 text-danger">{{$errors->first('service_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Sub titulo de sección servicio **</label>
                  <input class="form-control" name="service_subtitle" value="{{$abs->service_subtitle}}">
                  @if ($errors->has('service_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('service_subtitle')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Detalles del titulo de la sección de servicio**</label>
                  <input class="form-control" name="service_details_title" value="{{$abs->service_details_title}}">
                  @if ($errors->has('service_details_title'))
                    <p class="mb-0 text-danger">{{$errors->first('service_details_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Titulo de portafolio **</label>
                  <input class="form-control" name="portfolio_title" value="{{$abs->portfolio_title}}">
                  @if ($errors->has('portfolio_title'))
                    <p class="mb-0 text-danger">{{$errors->first('portfolio_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Sub titulo de portafolio **</label>
                  <input class="form-control" name="portfolio_subtitle" value="{{$abs->portfolio_subtitle}}">
                  @if ($errors->has('portfolio_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('portfolio_subtitle')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Detalles del titulo de portafolio **</label>
                  <input class="form-control" name="portfolio_details_title" value="{{$abs->portfolio_details_title}}">
                  @if ($errors->has('portfolio_details_title'))
                    <p class="mb-0 text-danger">{{$errors->first('portfolio_details_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Titulo de sección de FAQ **</label>
                  <input class="form-control" name="faq_title" value="{{$abs->faq_title}}">
                  @if ($errors->has('faq_title'))
                    <p class="mb-0 text-danger">{{$errors->first('faq_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Sub titulo de sección de FAQ **</label>
                  <input class="form-control" name="faq_subtitle" value="{{$abs->faq_subtitle}}">
                  @if ($errors->has('faq_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('faq_subtitle')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Titulo de sección de precios **</label>
                  <input class="form-control" name="pricing_title" value="{{$abe->pricing_title}}">
                  @if ($errors->has('pricing_title'))
                    <p class="mb-0 text-danger">{{$errors->first('pricing_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Sub titulo de sección de precios **</label>
                  <input class="form-control" name="pricing_subtitle" value="{{$abe->pricing_subtitle}}">
                  @if ($errors->has('pricing_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('pricing_subtitle')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Titulo de Blog **</label>
                  <input class="form-control" name="blog_title" value="{{$abs->blog_title}}">
                  @if ($errors->has('blog_title'))
                    <p class="mb-0 text-danger">{{$errors->first('blog_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Sub titulo de Blog **</label>
                  <input class="form-control" name="blog_subtitle" value="{{$abs->blog_subtitle}}">
                  @if ($errors->has('blog_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('blog_subtitle')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Detalles del titulo del Blog **</label>
                  <input class="form-control" name="blog_details_title" value="{{$abs->blog_details_title}}">
                  @if ($errors->has('blog_details_title'))
                    <p class="mb-0 text-danger">{{$errors->first('blog_details_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Titulo de la galeria **</label>
                  <input class="form-control" name="gallery_title" value="{{$abs->gallery_title}}">
                  @if ($errors->has('gallery_title'))
                    <p class="mb-0 text-danger">{{$errors->first('gallery_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Sub titulo de la galeria **</label>
                  <input class="form-control" name="gallery_subtitle" value="{{$abs->gallery_subtitle}}">
                  @if ($errors->has('gallery_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('gallery_subtitle')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Titulo de carrera **</label>
                  <input class="form-control" name="career_title" value="{{$abe->career_title}}">
                  @if ($errors->has('career_title'))
                    <p class="mb-0 text-danger">{{$errors->first('career_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Sub titulo de carrera **</label>
                  <input class="form-control" name="career_subtitle" value="{{$abe->career_subtitle}}">
                  @if ($errors->has('career_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('career_subtitle')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Titulo de calendario de eventos **</label>
                  <input class="form-control" name="event_calendar_title" value="{{$abe->event_calendar_title}}">
                  @if ($errors->has('event_calendar_title'))
                    <p class="mb-0 text-danger">{{$errors->first('event_calendar_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Sub titulo de calendario de eventos **</label>
                  <input class="form-control" name="event_calendar_subtitle" value="{{$abe->event_calendar_subtitle}}">
                  @if ($errors->has('event_calendar_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('event_calendar_subtitle')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Titulo de equipo **</label>
                  <input class="form-control" name="team_title" value="{{$abs->team_title}}">
                  @if ($errors->has('team_title'))
                    <p class="mb-0 text-danger">{{$errors->first('team_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Subtitulo de equipo **</label>
                  <input class="form-control" name="team_subtitle" value="{{$abs->team_subtitle}}">
                  @if ($errors->has('team_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('team_subtitle')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Titulo de contacto **</label>
                  <input class="form-control" name="contact_title" value="{{$abs->contact_title}}">
                  @if ($errors->has('contact_title'))
                    <p class="mb-0 text-danger">{{$errors->first('contact_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Sub titulo de contacto **</label>
                  <input class="form-control" name="contact_subtitle" value="{{$abs->contact_subtitle}}">
                  @if ($errors->has('contact_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('contact_subtitle')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Titulo de cita**</label>
                  <input class="form-control" name="quote_title" value="{{$abs->quote_title}}">
                  @if ($errors->has('quote_title'))
                    <p class="mb-0 text-danger">{{$errors->first('quote_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Sub titulo de cita **</label>
                  <input class="form-control" name="quote_subtitle" value="{{$abs->quote_subtitle}}">
                  @if ($errors->has('quote_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('quote_subtitle')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Titulo de página de error **</label>
                  <input class="form-control" name="error_title" value="{{$abs->error_title}}">
                  @if ($errors->has('error_title'))
                    <p class="mb-0 text-danger">{{$errors->first('error_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Sub titulo de página de error **</label>
                  <input class="form-control" name="error_subtitle" value="{{$abs->error_subtitle}}">
                  @if ($errors->has('error_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('error_subtitle')}}</p>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="form">
              <div class="form-group from-show-notify row">
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
