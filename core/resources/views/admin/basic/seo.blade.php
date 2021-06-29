@extends('admin.layout')

@if(!empty($abe->language) && $abe->language->rtl == 1)
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
    <h4 class="page-title">Informacion de SEO</h4>
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
        <a href="#">Informacion de SEO</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form class="" action="{{route('admin.seo.update', $lang_id)}}" method="post">
          @csrf
          <div class="card-header">
              <div class="row">
                  <div class="col-lg-10">
                      <div class="card-title">Actualizar informacion de SEO</div>
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
                  <label>Meta palabras clave para la página de inicio</label>
                  <input class="form-control" name="home_meta_keywords" value="{{$abe->home_meta_keywords}}" placeholder="Palabras clave" data-role="tagsinput">
                  @if ($errors->has('home_meta_keywords'))
                    <p class="mb-0 text-danger">{{$errors->first('home_meta_keywords')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta descripción para la página de inicio</label>
                  <textarea class="form-control" name="home_meta_description" rows="5" placeholder="Ingresar meta descripción">{{$abe->home_meta_description}}</textarea>
                  @if ($errors->has('home_meta_description'))
                    <p class="mb-0 text-danger">{{$errors->first('home_meta_description')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta palabras clave para la página de servicios</label>
                  <input class="form-control" name="services_meta_keywords" value="{{$abe->services_meta_keywords}}" placeholder="Palabras clave" data-role="tagsinput">
                  @if ($errors->has('services_meta_keywords'))
                    <p class="mb-0 text-danger">{{$errors->first('services_meta_keywords')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta descripciónes para la página de servicios</label>
                  <textarea class="form-control" name="services_meta_description" rows="5" placeholder="Ingresar meta descripción">{{$abe->services_meta_description}}</textarea>
                  @if ($errors->has('services_meta_description'))
                    <p class="mb-0 text-danger">{{$errors->first('services_meta_description')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta palabras clave para paquetes</label>
                  <input class="form-control" name="packages_meta_keywords" value="{{$abe->packages_meta_keywords}}" placeholder="Palabras clave" data-role="tagsinput">
                  @if ($errors->has('packages_meta_keywords'))
                    <p class="mb-0 text-danger">{{$errors->first('packages_meta_keywords')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta descripción para paquetes</label>
                  <textarea class="form-control" name="packages_meta_description" rows="5" placeholder="Ingresar meta descripción">{{$abe->packages_meta_description}}</textarea>
                  @if ($errors->has('packages_meta_description'))
                    <p class="mb-0 text-danger">{{$errors->first('packages_meta_description')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta palabras clave para carteras</label>
                  <input class="form-control" name="portfolios_meta_keywords" value="{{$abe->portfolios_meta_keywords}}" placeholder="Palabras clave" data-role="tagsinput">
                  @if ($errors->has('portfolios_meta_keywords'))
                    <p class="mb-0 text-danger">{{$errors->first('portfolios_meta_keywords')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta descripción para carteras</label>
                  <textarea class="form-control" name="portfolios_meta_description" rows="5" placeholder="Ingresar meta descripción">{{$abe->portfolios_meta_description}}</textarea>
                  @if ($errors->has('portfolios_meta_description'))
                    <p class="mb-0 text-danger">{{$errors->first('portfolios_meta_description')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta palabras clave para la página del equipo</label>
                  <input class="form-control" name="team_meta_keywords" value="{{$abe->team_meta_keywords}}" placeholder="Palabras clave" data-role="tagsinput">
                  @if ($errors->has('team_meta_keywords'))
                    <p class="mb-0 text-danger">{{$errors->first('team_meta_keywords')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta descripción para la página del equipo</label>
                  <textarea class="form-control" name="team_meta_description" rows="5" placeholder="Ingresar meta descripción">{{$abe->team_meta_description}}</textarea>
                  @if ($errors->has('team_meta_description'))
                    <p class="mb-0 text-danger">{{$errors->first('team_meta_description')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta palabras clave para la página de carrera</label>
                  <input class="form-control" name="career_meta_keywords" value="{{$abe->career_meta_keywords}}" placeholder="Palabras clave" data-role="tagsinput">
                  @if ($errors->has('career_meta_keywords'))
                    <p class="mb-0 text-danger">{{$errors->first('career_meta_keywords')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta descripción para la página de carrera</label>
                  <textarea class="form-control" name="career_meta_description" rows="5" placeholder="Ingresar meta descripción">{{$abe->career_meta_description}}</textarea>
                  @if ($errors->has('career_meta_description'))
                    <p class="mb-0 text-danger">{{$errors->first('career_meta_description')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta palabras clave para la página del calendario de eventos</label>
                  <input class="form-control" name="calendar_meta_keywords" value="{{$abe->calendar_meta_keywords}}" placeholder="Palabras clave" data-role="tagsinput">
                  @if ($errors->has('calendar_meta_keywords'))
                    <p class="mb-0 text-danger">{{$errors->first('calendar_meta_keywords')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Metadescripción para la página del calendario de eventos</label>
                  <textarea class="form-control" name="calendar_meta_description" rows="5" placeholder="Ingresar meta descripción">{{$abe->calendar_meta_description}}</textarea>
                  @if ($errors->has('calendar_meta_description'))
                    <p class="mb-0 text-danger">{{$errors->first('calendar_meta_description')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta palabras clave para la página de la galería</label>
                  <input class="form-control" name="gallery_meta_keywords" value="{{$abe->gallery_meta_keywords}}" placeholder="Palabras clave" data-role="tagsinput">
                  @if ($errors->has('gallery_meta_keywords'))
                    <p class="mb-0 text-danger">{{$errors->first('gallery_meta_keywords')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta descripción para la página de la galería</label>
                  <textarea class="form-control" name="gallery_meta_description" rows="5" placeholder="Ingresar meta descripción">{{$abe->gallery_meta_description}}</textarea>
                  @if ($errors->has('gallery_meta_description'))
                    <p class="mb-0 text-danger">{{$errors->first('gallery_meta_description')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta palabras clave para la página de FAQ</label>
                  <input class="form-control" name="faq_meta_keywords" value="{{$abe->faq_meta_keywords}}" placeholder="Palabras clave" data-role="tagsinput">
                  @if ($errors->has('faq_meta_keywords'))
                    <p class="mb-0 text-danger">{{$errors->first('faq_meta_keywords')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Metadescripción para la página de FAQ</label>
                  <textarea class="form-control" name="faq_meta_description" rows="5" placeholder="Ingresar meta descripción">{{$abe->faq_meta_description}}</textarea>
                  @if ($errors->has('faq_meta_description'))
                    <p class="mb-0 text-danger">{{$errors->first('faq_meta_description')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta palabras clave para la página de blogs</label>
                  <input class="form-control" name="blogs_meta_keywords" value="{{$abe->blogs_meta_keywords}}" placeholder="Palabras clave" data-role="tagsinput">
                  @if ($errors->has('blogs_meta_keywords'))
                    <p class="mb-0 text-danger">{{$errors->first('blogs_meta_keywords')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Metadescripción para la página de blogs</label>
                  <textarea class="form-control" name="blogs_meta_description" rows="5" placeholder="Ingresar meta descripción">{{$abe->blogs_meta_description}}</textarea>
                  @if ($errors->has('blogs_meta_description'))
                    <p class="mb-0 text-danger">{{$errors->first('blogs_meta_description')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta palabras clave para la página de contacto</label>
                  <input class="form-control" name="contact_meta_keywords" value="{{$abe->contact_meta_keywords}}" placeholder="Palabras clave" data-role="tagsinput">
                  @if ($errors->has('contact_meta_keywords'))
                    <p class="mb-0 text-danger">{{$errors->first('contact_meta_keywords')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta descripción para la página de contacto</label>
                  <textarea class="form-control" name="contact_meta_description" rows="5" placeholder="Ingresar meta descripción">{{$abe->contact_meta_description}}</textarea>
                  @if ($errors->has('contact_meta_description'))
                    <p class="mb-0 text-danger">{{$errors->first('contact_meta_description')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta palabras clave para la página de cotización</label>
                  <input class="form-control" name="quote_meta_keywords" value="{{$abe->quote_meta_keywords}}" placeholder="Palabras clave" data-role="tagsinput">
                  @if ($errors->has('quote_meta_keywords'))
                    <p class="mb-0 text-danger">{{$errors->first('quote_meta_keywords')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta descripción para la página de cotización</label>
                  <textarea class="form-control" name="quote_meta_description" rows="5" placeholder="Ingresar meta descripciónes">{{$abe->quote_meta_description}}</textarea>
                  @if ($errors->has('quote_meta_description'))
                    <p class="mb-0 text-danger">{{$errors->first('quote_meta_description')}}</p>
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
