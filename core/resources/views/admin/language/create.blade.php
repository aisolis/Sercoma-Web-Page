<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Añadir Lenguaje</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="ajaxForm" class="" action="{{route('admin.language.store')}}" method="POST">
          @csrf
          <input type="hidden" id="image" name="" value="">
          <div class="form-group">
            <label for="">Nombre **</label>
            <input type="text" class="form-control" name="name" placeholder="Ingrese el Nombre del lenguaje" value="">
            <p id="errname" class="mb-0 text-danger em"></p>
          </div>
          <div class="form-group">
            <label for="">Código **</label>
            <input type="text" class="form-control" name="code" placeholder="Ingrese el Código del lenguaje" value="">
            <p id="errcode" class="mb-0 text-danger em"></p>
          </div>
          <div class="form-group">
            <label for="">Dirección **</label>
            <select name="direction" class="form-control">
                <option value="" selected disabled>Seleccione una direccion</option>
                <option value="0">LTR (De izquierda a derecha)</option>
                <option value="1">RTL (De derecha a izquierda)</option>
            </select>
            <p id="errdirection" class="mb-0 text-danger em"></p>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button id="submitBtn" type="button" class="btn btn-primary">¡Listo!</button>
      </div>
    </div>
  </div>
</div>
