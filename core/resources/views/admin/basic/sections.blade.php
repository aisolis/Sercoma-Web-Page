@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Sección de Personalización</h4>
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
        <a href="#">Sección de Personalización</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form class="" action="{{route('admin.sections.update', $lang_id)}}" method="post">
          @csrf
          <div class="card-header">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card-title">Personalizar Secciones</div>
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
                  <label>Sección de funciones **</label>
                  <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                            <input type="radio" name="feature_section" value="1" class="selectgroup-input" {{$abs->feature_section == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Activar</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="feature_section" value="0" class="selectgroup-input" {{$abs->feature_section == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Desactivar</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                  <label>Sección de Introducción **</label>
                  <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                            <input type="radio" name="intro_section" value="1" class="selectgroup-input" {{$abs->intro_section == 1 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Activar</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="intro_section" value="0" class="selectgroup-input" {{$abs->intro_section == 0 ? 'checked' : ''}}>
                            <span class="selectgroup-button">Desactivar</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                  <label>Sección de servicio **</label>
                  <div class="selectgroup w-100">
										<label class="selectgroup-item">
											<input type="radio" name="service_section" value="1" class="selectgroup-input" {{$abs->service_section == 1 ? 'checked' : ''}}>
											<span class="selectgroup-button">Activar</span>
										</label>
										<label class="selectgroup-item">
											<input type="radio" name="service_section" value="0" class="selectgroup-input" {{$abs->service_section == 0 ? 'checked' : ''}}>
											<span class="selectgroup-button">Desactivar</span>
										</label>
									</div>
                </div>
                <div class="form-group">
                  <label>Sección de aproximación **</label>
                  <div class="selectgroup w-100">
										<label class="selectgroup-item">
											<input type="radio" name="approach_section" value="1" class="selectgroup-input" {{$abs->approach_section == 1 ? 'checked' : ''}}>
											<span class="selectgroup-button">Activar</span>
										</label>
										<label class="selectgroup-item">
											<input type="radio" name="approach_section" value="0" class="selectgroup-input" {{$abs->approach_section == 0 ? 'checked' : ''}}>
											<span class="selectgroup-button">Desactivar</span>
										</label>
									</div>
                </div>
                <div class="form-group">
                  <label>Sección de Estadística **</label>
                  <div class="selectgroup w-100">
										<label class="selectgroup-item">
											<input type="radio" name="statistics_section" value="1" class="selectgroup-input" {{$abs->statistics_section == 1 ? 'checked' : ''}}>
											<span class="selectgroup-button">Activar</span>
										</label>
										<label class="selectgroup-item">
											<input type="radio" name="statistics_section" value="0" class="selectgroup-input" {{$abs->statistics_section == 0 ? 'checked' : ''}}>
											<span class="selectgroup-button">Desactivar</span>
										</label>
									</div>
                </div>
                <div class="form-group">
                  <label>Sección de Portafolio **</label>
                  <div class="selectgroup w-100">
										<label class="selectgroup-item">
											<input type="radio" name="portfolio_section" value="1" class="selectgroup-input" {{$abs->portfolio_section == 1 ? 'checked' : ''}}>
											<span class="selectgroup-button">Activar</span>
										</label>
										<label class="selectgroup-item">
											<input type="radio" name="portfolio_section" value="0" class="selectgroup-input" {{$abs->portfolio_section == 0 ? 'checked' : ''}}>
											<span class="selectgroup-button">Desactivar</span>
										</label>
									</div>
                </div>
                <div class="form-group">
                  <label>Sección de testimonios **</label>
                  <div class="selectgroup w-100">
										<label class="selectgroup-item">
											<input type="radio" name="testimonial_section" value="1" class="selectgroup-input" {{$abs->testimonial_section == 1 ? 'checked' : ''}}>
											<span class="selectgroup-button">Activar</span>
										</label>
										<label class="selectgroup-item">
											<input type="radio" name="testimonial_section" value="0" class="selectgroup-input" {{$abs->testimonial_section == 0 ? 'checked' : ''}}>
											<span class="selectgroup-button">Desactivar</span>
										</label>
									</div>
                </div>
                <div class="form-group">
                  <label>Sección de equipo **</label>
                  <div class="selectgroup w-100">
										<label class="selectgroup-item">
											<input type="radio" name="team_section" value="1" class="selectgroup-input" {{$abs->team_section == 1 ? 'checked' : ''}}>
											<span class="selectgroup-button">Activar</span>
										</label>
										<label class="selectgroup-item">
											<input type="radio" name="team_section" value="0" class="selectgroup-input" {{$abs->team_section == 0 ? 'checked' : ''}}>
											<span class="selectgroup-button">Desactivar</span>
										</label>
									</div>
                </div>
                <div class="form-group">
                  <label>Sección de precios **</label>
                  <div class="selectgroup w-100">
										<label class="selectgroup-item">
											<input type="radio" name="pricing_section" value="1" class="selectgroup-input" {{$be->pricing_section == 1 ? 'checked' : ''}}>
											<span class="selectgroup-button">Activar</span>
										</label>
										<label class="selectgroup-item">
											<input type="radio" name="pricing_section" value="0" class="selectgroup-input" {{$be->pricing_section == 0 ? 'checked' : ''}}>
											<span class="selectgroup-button">Desactivar</span>
										</label>
									</div>
                </div>
                <div class="form-group">
                  <label>Sección de noticias **</label>
                  <div class="selectgroup w-100">
										<label class="selectgroup-item">
											<input type="radio" name="news_section" value="1" class="selectgroup-input" {{$abs->news_section == 1 ? 'checked' : ''}}>
											<span class="selectgroup-button">Activar</span>
										</label>
										<label class="selectgroup-item">
											<input type="radio" name="news_section" value="0" class="selectgroup-input" {{$abs->news_section == 0 ? 'checked' : ''}}>
											<span class="selectgroup-button">Desactivar</span>
										</label>
									</div>
                </div>
                <div class="form-group">
                  <label>Sección de Llamado a la Acción **</label>
                  <div class="selectgroup w-100">
										<label class="selectgroup-item">
											<input type="radio" name="call_to_action_section" value="1" class="selectgroup-input" {{$abs->call_to_action_section == 1 ? 'checked' : ''}}>
											<span class="selectgroup-button">Activar</span>
										</label>
										<label class="selectgroup-item">
											<input type="radio" name="call_to_action_section" value="0" class="selectgroup-input" {{$abs->call_to_action_section == 0 ? 'checked' : ''}}>
											<span class="selectgroup-button">Desactivar</span>
										</label>
									</div>
                </div>
                <div class="form-group">
                  <label>Sección de socios **</label>
                  <div class="selectgroup w-100">
										<label class="selectgroup-item">
											<input type="radio" name="partner_section" value="1" class="selectgroup-input" {{$abs->partner_section == 1 ? 'checked' : ''}}>
											<span class="selectgroup-button">Activar</span>
										</label>
										<label class="selectgroup-item">
											<input type="radio" name="partner_section" value="0" class="selectgroup-input" {{$abs->partner_section == 0 ? 'checked' : ''}}>
											<span class="selectgroup-button">Desactivar</span>
										</label>
									</div>
                </div>
                <div class="form-group">
                  <label>Sección de pie de página superior **</label>
                  <div class="selectgroup w-100">
										<label class="selectgroup-item">
											<input type="radio" name="top_footer_section" value="1" class="selectgroup-input" {{$abs->top_footer_section == 1 ? 'checked' : ''}}>
											<span class="selectgroup-button">Activar</span>
										</label>
										<label class="selectgroup-item">
											<input type="radio" name="top_footer_section" value="0" class="selectgroup-input" {{$abs->top_footer_section == 0 ? 'checked' : ''}}>
											<span class="selectgroup-button">Desactivar</span>
										</label>
									</div>
                </div>
                <div class="form-group">
                  <label>Sección de derechos de autor **</label>
                  <div class="selectgroup w-100">
										<label class="selectgroup-item">
											<input type="radio" name="copyright_section" value="1" class="selectgroup-input" {{$abs->copyright_section == 1 ? 'checked' : ''}}>
											<span class="selectgroup-button">Activar</span>
										</label>
										<label class="selectgroup-item">
											<input type="radio" name="copyright_section" value="0" class="selectgroup-input" {{$abs->copyright_section == 0 ? 'checked' : ''}}>
											<span class="selectgroup-button">Desactivar</span>
										</label>
									</div>
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
