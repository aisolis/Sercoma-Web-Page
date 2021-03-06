@extends('admin.layout')

@section('content')
<div class="page-header">
   <h4 class="page-title">Paquetes</h4>
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
         <a href="#">Administrador de paquetes</a>
      </li>
      <li class="separator">
         <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
         <a href="#">Paquetes</a>
      </li>
   </ul>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header">
            <div class="row">
               <div class="col-lg-4">
                  <div class="card-title d-inline-block">Paquetes</div>
               </div>
               <div class="col-lg-3">
                  @if (!empty($langs))
                  <select name="language" class="form-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                     <option value="" selected disabled>Selecciona un lenguaje</option>
                     @foreach ($langs as $lang)
                     <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                     @endforeach
                  </select>
                  @endif
               </div>
               <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
                  <a href="#" class="btn btn-primary float-lg-right float-left btn-sm" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i> Agregar paquete</a>
                  <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete" data-href="{{route('admin.package.bulk.delete')}}"><i class="flaticon-interface-5"></i> Eliminar</button>
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-lg-12">
                  @if (count($packages) == 0)
                  <h3 class="text-center">No se han encontrado paquetes</h3>
                  @else
                  <div class="table-responsive">
                     <table class="table table-striped mt-3">
                        <thead>
                           <tr>
                              <th scope="col">
                                 <input type="checkbox" class="bulk-check" data-val="all">
                              </th>
                              <th scope="col">Titulo</th>
                              <th scope="col">Moneda</th>
                              <th scope="col">Precio</th>
                              <th scope="col">Detalles</th>
                              <th scope="col">N??mero de serie</th>
                              <th scope="col">Acciones</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($packages as $key => $package)
                           <tr>
                              <td>
                                 <input type="checkbox" class="bulk-check" data-val="{{$package->id}}">
                              </td>
                              <td>{{strlen(convertUtf8($package->title)) > 30 ? convertUtf8(substr($package->title, 0, 30)) . '...' : convertUtf8($package->title)}}</td>
                              <td>{{convertUtf8($package->currency)}}</td>
                              <td>{{convertUtf8($package->price)}}</td>
                              <td>
                                 <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#detailsModal{{$package->id}}"><i class="fas fa-eye"></i> Mirar</button>
                              </td>
                              <th scope="col">{{$package->serial_number}}</th>
                              <td>
                                 <a class="btn btn-secondary btn-sm editbtn" href="#editModal" data-toggle="modal" data-package_id="{{$package->id}}" data-title="{{$package->title}}" data-currency="{{$package->currency}}" data-price="{{$package->price}}" data-description="{{ $package->description }}" data-serial_number="{{$package->serial_number}}" data-meta_keywords="{{$package->meta_keywords}}" data-meta_description="{{$package->meta_description}}">
                                 <span class="btn-label">
                                 <i class="fas fa-edit"></i>
                                 </span>
                                 Editar
                                 </a>
                                 <form class="deleteform d-inline-block" action="{{route('admin.package.delete')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="package_id" value="{{$package->id}}">
                                    <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                    <span class="btn-label">
                                    <i class="fas fa-trash"></i>
                                    </span>
                                    Eliminar
                                    </button>
                                 </form>
                              </td>
                           </tr>
                           <!-- Services Modal -->
                           <div class="modal fade" id="detailsModal{{$package->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLongTitle">Detalles</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       {!! convertUtf8($package->description) !!}
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
                  @endif
               </div>
            </div>
         </div>
         <div class="card-footer">
            <div class="row">
               <div class="d-inline-block mx-auto">
                  {{$packages->appends(['language' => request()->input('language')])->links()}}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Create Package Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Agregar paquete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="ajaxForm" class="modal-form" action="{{route('admin.package.store')}}" method="POST">
               @csrf
               <div class="form-group">
                  <label for="">Language **</label>
                  <select id="language" name="language_id" class="form-control">
                     <option value="" selected disabled>Selecciona un lenguaje</option>
                     @foreach ($langs as $lang)
                     <option value="{{$lang->id}}">{{$lang->name}}</option>
                     @endforeach
                  </select>
                  <p id="errlanguage_id" class="mb-0 text-danger em"></p>
               </div>
               <div class="form-group">
                  <label for="">Titulo **</label>
                  <input type="text" class="form-control" name="title" placeholder="Ingresa un titulo" value="">
                  <p id="errtitle" class="mb-0 text-danger em"></p>
               </div>
               <div class="form-group">
                  <label for="">Moneda **</label>
                  <input type="text" class="form-control" name="currency" placeholder="Ingresa una moneda" value="">
                  <p id="errcurrency" class="mb-0 text-danger em"></p>
               </div>
               <div class="form-group">
                  <label for="">Precio **</label>
                  <input type="text" class="form-control" name="price" placeholder="Ingresa un precio" value="">
                  <p id="errprice" class="mb-0 text-danger em"></p>
               </div>
               <div class="form-group">
                  <label for="">Descipci??n **</label>
                  <textarea class="form-control summernote" name="description" rows="8" cols="80" placeholder="Ingresa una descripci??n" data-height="300"></textarea>
                  <p id="errdescription" class="mb-0 text-danger em"></p>
               </div>
               <div class="form-group">
                  <label for="">N??mero de serie **</label>
                  <input type="number" class="form-control ltr" name="serial_number" value="" placeholder="Ingrese un N??mero de serie">
                  <p id="errserial_number" class="mb-0 text-danger em"></p>
                  <p class="text-warning"><small>Cuanto mayor sea el n??mero de serie, m??s tarde se mostrar?? el paquete en todas partes.</small></p>
               </div>
               <div class="form-group">
                  <label>Palabras clave</label>
                  <input class="form-control" name="meta_keywords" value="" placeholder="Ingrese palabras clave" data-role="tagsinput">
                  <p id="errmeta_keywords" class="mb-0 text-danger em"></p>
               </div>
               <div class="form-group">
                  <label>Meta Descripciones</label>
                  <textarea class="form-control" name="meta_description" rows="5" placeholder="Ingrese meta descripciones"></textarea>
                  <p id="errmeta_description" class="mb-0 text-danger em"></p>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button id="submitBtn" type="button" class="btn btn-primary">??Listo!</button>
         </div>
      </div>
   </div>
</div>
<!-- Edit Package Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Editar Paquete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="ajaxEditForm" class="" action="{{route('admin.package.update')}}" method="POST">
               @csrf
               <input id="inpackage_id" type="hidden" name="package_id" value="">
               <div class="form-group">
                  <label for="">Titulo **</label>
                  <input id="intitle" type="text" class="form-control" name="title" value="" placeholder="Ingrese un titulo">
                  <p id="eerrtitle" class="mb-0 text-danger em"></p>
               </div>
               <div class="form-group">
                  <label for="">Moneda **</label>
                  <input id="incurrency" type="text" class="form-control" name="currency" value="" placeholder="Ingrese una moneda">
                  <p id="eerrcurrency" class="mb-0 text-danger em"></p>
               </div>
               <div class="form-group">
                  <label for="">Precio **</label>
                  <input id="inprice" type="text" class="form-control" name="price" placeholder="Ingrese un precio" value="">
                  <p id="eerrprice" class="mb-0 text-danger em"></p>
               </div>
               <div class="form-group">
                  <label for="">Descripci??n **</label>
                  <textarea id="indescription" class="form-control summernote" name="description" placeholder="Ingrese una descripci??n" data-height="200"></textarea>
                  <p id="eerrdescription" class="mb-0 text-danger em"></p>
               </div>
               <div class="form-group">
                  <label for="">N??mero de serie **</label>
                  <input id="inserial_number" type="number" class="form-control ltr" name="serial_number" value="" placeholder="Ingrese un N??mero de serie">
                  <p id="eerrserial_number" class="mb-0 text-danger em"></p>
                  <p class="text-warning"><small>Cuanto mayor sea el n??mero de serie, m??s tarde se mostrar?? el paquete en todas partes.</small></p>
               </div>
               <div class="form-group">
                  <label>Palabras clave</label>
                  <input id="inmeta_keywords" class="form-control" name="meta_keywords" value="" placeholder="Ingrese Palabras clave" data-role="tagsinput">
                  <p id="eerrmeta_keywords" class="mb-0 text-danger em"></p>
               </div>
               <div class="form-group">
                  <label>Meta Descripciones</label>
                  <textarea id="inmeta_description" class="form-control" name="meta_description" rows="5" placeholder="Ingrese Meta Descripciones"></textarea>
                  <p id="eerrmeta_description" class="mb-0 text-danger em"></p>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button id="updateBtn" type="button" class="btn btn-primary">Guardar cambios</button>
         </div>
      </div>
   </div>
</div>
@endsection
@section('scripts')
<script>
   $(document).ready(function() {

       // make input fields RTL
       $("select[name='language_id']").on('change', function() {
           $(".request-loader").addClass("show");
           let url = "{{url('/')}}/admin/rtlcheck/" + $(this).val();
           // console.log(url);
           $.get(url, function(data) {
               $(".request-loader").removeClass("show");
               if (data == 1) {
                   $("form.modal-form input").each(function() {
                       if (!$(this).hasClass('ltr')) {
                           $(this).addClass('rtl');
                       }
                   });
                   $("form.modal-form select").each(function() {
                       if (!$(this).hasClass('ltr')) {
                           $(this).addClass('rtl');
                       }
                   });
                   $("form.modal-form textarea").each(function() {
                       if (!$(this).hasClass('ltr')) {
                           $(this).addClass('rtl');
                       }
                   });
                   $("form.modal-form .summernote").each(function() {
                       $(this).siblings('.note-editor').find('.note-editable').addClass('rtl text-right');
                   });

               } else {
                   $("form.modal-form input, form.modal-form select, form.modal-form textarea").removeClass('rtl');
                   $("form.modal-form .summernote").siblings('.note-editor').find('.note-editable').removeClass('rtl text-right');
               }
           })
       });
   });
</script>
@endsection
