<!-- Create Gallery Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Crear Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="mb-3 dm-uploader drag-and-drop-zone" enctype="multipart/form-data" action="{{route('admin.user.upload')}}" method="POST">
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
                  <input type="file" title='Buscar archivos' />
                </div>
                <small class="status text-muted">Seleccione un archivo o arrástrelo sobre esta área...</small>
                <p class="text-warning mb-0 mt-2">Cargue la imagen de tamaño de escuadra para obtener la mejor calidad.</p>
                <p class="em text-danger mb-0" id="erruser"></p>
              </div>
            </div>
          </div>
        </form>

        <form id="ajaxForm" class="" action="{{route('admin.user.store')}}" method="POST">
          @csrf
          <input type="hidden" id="image" name="" value="">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="">Nombre de usuario **</label>
                <input type="text" class="form-control" name="username" placeholder="Ingrese un nombre de usuario" value="">
                <p id="errusername" class="mb-0 text-danger em"></p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="">Email **</label>
                <input type="text" class="form-control" name="email" placeholder="Ingresa tu email" value="">
                <p id="erremail" class="mb-0 text-danger em"></p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="">Primer Nombre **</label>
                <input type="text" class="form-control" name="first_name" placeholder="Ingrese el primer nombre" value="">
                <p id="errfirst_name" class="mb-0 text-danger em"></p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="">Apellido **</label>
                <input type="text" class="form-control" name="last_name" placeholder="Ingrese el apellido" value="">
                <p id="errlast_name" class="mb-0 text-danger em"></p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="">Contraseña **</label>
                <input type="password" class="form-control" name="password" placeholder="Ingresa una contraseña" value="">
                <p id="errpassword" class="mb-0 text-danger em"></p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="">Vuelve a introducir la contraseña **</label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="Escribe la contraseña de nueva" value="">
                <p id="errpassword_confirmation" class="mb-0 text-danger em"></p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label for="">Role **</label>
                <select class="form-control" name="role">
                  <option value="" selected disabled>Selecciona un Rol</option>
                  @foreach ($roles as $key => $role)
                  <option value="{{$role->id}}">{{$role->name}}</option>
                  @endforeach
                </select>
                <p id="errrole" class="mb-0 text-danger em"></p>
              </div>
            </div>
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
