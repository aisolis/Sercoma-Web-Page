<div class="modal fade" id="createStatisticModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <form id="ajaxForm" class="modal-form" action="{{route('admin.statistics.store')}}" method="POST">
           <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Agregar Estadística</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
           </div>
           <div class="modal-body">
              <div class="row">
                 <div class="col-lg-12">
                    @csrf
                    <div class="form-group">
                        <label for="">Lenguaje **</label>
                        <select name="language_id" class="form-control">
                            <option value="" selected disabled>Seleccione un lenguaje</option>
                            @foreach ($langs as $lang)
                                <option value="{{$lang->id}}">{{$lang->name}}</option>
                            @endforeach
                        </select>
                        <p id="errlanguage_id" class="mb-0 text-danger em"></p>
                    </div>
                    <div class="form-group">
                       <label for="">Icono **</label>
                       <div class="btn-group d-block">
                          <button type="button" class="btn btn-primary iconpicker-component"><i
                             class="fa fa-fw fa-heart"></i></button>
                          <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                             data-selected="fa-car" data-toggle="dropdown">
                          </button>
                          <div class="dropdown-menu"></div>
                       </div>
                       <input id="inputIcon" type="hidden" name="icon" value="fas fa-heart">
                       <div class="mt-2">
                          <small>NB:Haga clic en el signo desplegable para seleccionar un icono.</small>
                       </div>
                    </div>
                    <div class="form-group">
                       <label for="">Titulo **</label>
                       <input type="text" class="form-control" name="title" value="" placeholder="Ingrese un titulo">
                       <p id="errtitle" class="mb-0 text-danger em"></p>
                    </div>
                    <div class="form-group">
                       <label for="">Cantidad **</label>
                       <div class="input-group mb-3">
                          <input type="text" class="form-control" name="quantity" value="" placeholder="Ingrese una cantidad" aria-describedby="basic-addon2">
                          <div class="input-group-append">
                             <span class="input-group-text" id="basic-addon2">+</span>
                          </div>
                       </div>
                       <p id="errquantity" class="mb-0 text-danger em"></p>
                    </div>
                    <div class="form-group">
                      <label for="">Número de serie **</label>
                      <input type="number" class="form-control ltr" name="serial_number" value="" placeholder="Enter Serial Number">
                      <p id="errserial_number" class="mb-0 text-danger em"></p>
                      <p class="text-warning"><small>Cuanto mayor sea el número de serie, más tarde se mostrará la estadística.</small></p>
                    </div>
                 </div>
              </div>
           </div>
           <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button id="submitBtn" type="submit" class="btn btn-success">¡Listo!</button>
           </div>
         </form>
      </div>
   </div>
</div>
