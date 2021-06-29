@extends('admin.layout')

@if(!empty($job->language) && $job->language->rtl == 1)
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
    <h4 class="page-title">Editar trabajo</h4>
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
        <a href="#">Página de carrera</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Editar trabajo</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Editar trabajo</div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('admin.job.index') . '?language=' . request()->input('language')}}">
            <span class="btn-label">
              <i class="fas fa-backward" style="font-size: 12px;"></i>
            </span>
            Volver
          </a>
        </div>
        <div class="card-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-12">

                <form id="ajaxForm" class="" action="{{route('admin.job.update')}}" method="post">
                    @csrf
                    <input type="hidden" name="job_id" value="{{$job->id}}">
                    <div id="sliders"></div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Titulo **</label>
                                <input type="text" class="form-control" name="title" value="{{$job->title}}"
                                    placeholder="Ingrese un titulo">
                                <p id="errtitle" class="mb-0 text-danger em"></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Categoria **</label>
                                <select class="form-control" name="jcategory_id">
                                    <option value="" selected disabled>Seleccione una categoria</option>
                                    @foreach ($jcats as $key => $jcat)
                                    <option value="{{$jcat->id}}" {{$job->jcategory_id == $jcat->id ? 'selected' : ''}}>{{$jcat->name}}</option>
                                    @endforeach
                                </select>
                                <p id="errjcategory_id" class="mb-0 text-danger em"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Estado del empleo **</label>
                                <input type="text" class="form-control" name="employment_status" value="{{$job->employment_status}}"
                                    data-role="tagsinput">
                                <p class="text-warning mb-0"><small>Use una coma (,) para separar los estados. por ejemplo: a tiempo completo, a tiempo parcial.</small></p>
                                <p id="erremployment_status" class="mb-0 text-danger em"></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Vacantes **</label>
                                <input type="number" class="form-control" name="vacancy" value="{{$job->vacancy}}"
                                    placeholder="Ingrese el numero de vacantes" min="1">
                                <p id="errvacancy" class="mb-0 text-danger em"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Plazo de solicitud **</label>
                                <input id="deadline" type="text" class="form-control datepicker ltr" name="deadline" value="{{$job->deadline}}" placeholder="Ingrese la fecha límite de solicitud" autocomplete="off">
                                <p id="errdeadline" class="mb-0 text-danger em"></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Años de experiencia **</label>
                                <input type="text" class="form-control" name="experience" value="{{$job->experience}}"
                                    placeholder="Ingrese años de experiencia">
                                <p id="errexperience" class="mb-0 text-danger em"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Responsabilidades laborales **</label>
                                <textarea class="form-control summernote" id="jobRes" name="job_responsibilities" data-height="150"
                                    placeholder="Ingrese las responsabilidades laborales">{{$job->job_responsibilities}}</textarea>
                                <p id="errjob_responsibilities" class="mb-0 text-danger em"></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Requisitos educativos **</label>
                                <textarea class="form-control summernote" id="eduReq" name="educational_requirements" data-height="150"
                                    placeholder="Ingrese los requisitos educativos">{{$job->educational_requirements}}</textarea>
                                <p id="erreducational_requirements" class="mb-0 text-danger em"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Requisitos de experiencia **</label>
                                <textarea class="form-control summernote" id="expReq" name="experience_requirements" data-height="150"
                                    placeholder="ingrese los Requisitos de experiencia">{{$job->experience_requirements}}</textarea>
                                <p id="errexperience_requirements" class="mb-0 text-danger em"></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Requerimientos adicionales</label>
                                <textarea class="form-control summernote" id="addReq" name="additional_requirements" data-height="150"
                                    placeholder="Ingrese requisitos adicionales">{{$job->additional_requirements}}</textarea>
                                <p id="erradditional_requirements" class="mb-0 text-danger em"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Salario **</label>
                                <textarea class="form-control summernote" id="salary" name="salary" data-height="150"
                                    placeholder="Ingrese el salario">{{$job->salary}}</textarea>
                                <p id="errsalary" class="mb-0 text-danger em"></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Beneficios</label>
                                <textarea class="form-control summernote" id="benefits" name="benefits" data-height="150"
                                    placeholder="Ingrese compensación y otros beneficios">{{$job->benefits}}</textarea>
                                <p id="errbenefits" class="mb-0 text-danger em"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">locación de trabajo **</label>
                                <input type="text" class="form-control" name="job_location" value="{{$job->job_location}}"
                                    placeholder="Ingrese la locación de trabajo">
                                <p id="errjob_location" class="mb-0 text-danger em"></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Email <span class="text-warning">(Donde los solicitantes enviarán sus CV)</span> **</label>
                                <input type="email" class="form-control ltr" name="email" value="{{$job->email}}"
                                    placeholder="Introducir la dirección de correo electrónico">
                                <p id="erremail" class="mb-0 text-danger em"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Leer antes de aplicar</label>
                                <textarea class="form-control summernote" id="read_before_apply" name="read_before_apply" data-height="150"
                                    placeholder="Leer antes de aplicar">{{$job->read_before_apply}}</textarea>
                                <p id="errread_before_apply" class="mb-0 text-danger em"></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Número de serie **</label>
                                <input type="number" class="form-control ltr" name="serial_number" value="{{$job->serial_number}}" placeholder="ingrese un numero de serie">
                                <p id="errserial_number" class="mb-0 text-danger em"></p>
                                <p class="text-warning"><small>Cuanto mayor sea el número de serie, más tarde se mostrará el trabajo.</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Palabras clave</label>
                                <input class="form-control" name="meta_keywords" value="{{$job->meta_keywords}}" placeholder="Ingresa palabras clave" data-role="tagsinput">
                             </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Meta Descripciones</label>
                                <textarea class="form-control" name="meta_description" rows="3" placeholder="Ingrese meta descripciones">{{$job->meta_description}}</textarea>
                             </div>
                        </div>
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

@section('scripts')
<script>
$(document).ready(function() {
    var today = new Date();
    $("#deadline").datepicker({
      autoclose: true,
      endDate : today,
      todayHighlight: true
    });
});
</script>
@endsection
