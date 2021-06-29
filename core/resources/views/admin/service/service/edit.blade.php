@extends('admin.layout')

@if(!empty($service->language) && $service->language->rtl == 1)
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
   <h4 class="page-title">Editar Servicio</h4>
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
         <a href="#">Página de servicio</a>
      </li>
      <li class="separator">
         <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
         <a href="#">Editar Servicio</a>
      </li>
   </ul>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header">
            <div class="card-title d-inline-block">Editar Servicio</div>
            @if ($service->language_id > 0)
            <a class="btn btn-info btn-sm float-right d-inline-block" href="{{ route('admin.service.index') . '?language=' . request()->input('language') }}">
            <span class="btn-label">
            <i class="fas fa-backward" style="font-size: 12px;"></i>
            </span>
            Volver
            </a>
            @else
            <a class="btn btn-info btn-sm float-right d-inline-block" href="{{ route('admin.service.index') }}">
            <span class="btn-label">
            <i class="fas fa-backward" style="font-size: 12px;"></i>
            </span>
            Volver
            </a>
            @endif
         </div>
         <div class="card-body pt-5 pb-5">
            <div class="row">
               <div class="col-lg-6 offset-lg-3">
                  <form class="mb-3 dm-uploader drag-and-drop-zone" enctype="multipart/form-data" action="{{route('admin.service.uploadUpdate', $service->id)}}" method="POST">
                     @csrf
                     <div class="form-row px-2">
                        <div class="col-12 mb-2">
                           <label for=""><strong>Imágen **</strong></label>
                        </div>
                        <div class="col-md-12 d-md-block d-sm-none mb-3">
                           <img src="{{asset('assets/front/img/services/'.$service->main_image)}}" alt="..." class="img-thumbnail">
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
                  </form>
                  <form id="ajaxForm" class="" action="{{route('admin.service.update')}}" method="post">
                     @csrf
                     <input type="hidden" name="service_id" value="{{$service->id}}">
                     <div class="form-group">
                        <label for="">Title **</label>
                        <input type="text" class="form-control" name="title" value="{{$service->title}}" placeholder="Enter title">
                        <p id="errtitle" class="mb-0 text-danger em"></p>
                     </div>
                     <div class="form-group">
                        <label for="">Categoria **</label>
                        <select class="form-control" name="category">
                           <option value="" selected disabled>Seleccione una categoria</option>
                           @foreach ($ascats as $key => $ascat)
                           <option value="{{$ascat->id}}" {{$ascat->id == $service->scategory_id ? 'selected' : ''}}>{{$ascat->name}}</option>
                           @endforeach
                        </select>
                        <p id="errcategory" class="mb-0 text-danger em"></p>
                     </div>
                     <div class="form-group">
                        <label for="">Contenido **</label>
                        <textarea class="form-control summernote" name="content" data-height="300" placeholder="Ingrese contenido">{{$service->content}}</textarea>
                        <p id="errcontent" class="mb-0 text-danger em"></p>
                     </div>
                     <div class="form-group">
                        <label for="">Número de serie**</label>
                        <input type="number" class="form-control ltr" name="serial_number" value="{{$service->serial_number}}" placeholder="Enter Serial Number">
                        <p id="errserial_number" class="mb-0 text-danger em"></p>
                        <p class="text-warning"><small>Cuanto mayor sea el número de serie, más tarde se mostrará el servicio en todas partes.</small></p>
                     </div>
                     <div class="form-group">
                        <label>Palabras clave</label>
                        <input class="form-control" name="meta_keywords" value="{{$service->meta_keywords}}" placeholder="Ingrese Palabras clave" data-role="tagsinput">
                        @if ($errors->has('meta_keywords'))
                        <p class="mb-0 text-danger">{{$errors->first('meta_keywords')}}</p>
                        @endif
                     </div>
                     <div class="form-group">
                        <label>Meta Descripciones</label>
                        <textarea class="form-control" name="meta_description" rows="5" placeholder="Ingrese Meta Descripciones">{{$service->meta_description}}</textarea>
                        @if ($errors->has('meta_description'))
                        <p class="mb-0 text-danger">{{$errors->first('meta_description')}}</p>
                        @endif
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
