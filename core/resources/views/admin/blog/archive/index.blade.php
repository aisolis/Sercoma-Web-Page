@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Archivos</h4>
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
        <a href="#">Blogs</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Archivos</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Archivos</div>
          <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i> Agregar archivo</a>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              @if (count($archives) == 0)
                <h3 class="text-center">No se han encontrado archivos...</h3>
              @else
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($archives as $key => $archive)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          @php
                            $myArr = explode('-', $archive->date);
                            $monthNum  = $myArr[0];
                            $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                            $monthName = $dateObj->format('F');
                          @endphp
                          <td>{{$monthName}} {{$myArr[1]}}</td>
                          <td>
                            <a class="btn btn-secondary btn-sm editbtn" href="#editModal" data-toggle="modal" data-archive_id="{{$archive->id}}" data-date="{{$archive->date}}">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                              Editar
                            </a>
                            <form class="deleteform d-inline-block" action="{{route('admin.archive.delete')}}" method="post">
                              @csrf
                              <input type="hidden" name="archive_id" value="{{$archive->id}}">
                              <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                <span class="btn-label">
                                  <i class="fas fa-trash"></i>
                                </span>
                                Eliminar
                              </button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- modal del archivo -->
  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Agregar archivo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="ajaxForm" class="" action="{{route('admin.archive.store')}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="">Fecha **</label>
              <input class="form-control datepicker" name="date" placeholder="Ingresa una fecha">
              <p id="errdate" class="mb-0 text-danger em"></p>
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

  <!-- editar modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Editar archivo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="ajaxEditForm" class="" action="{{route('admin.archive.update')}}" method="POST">
            @csrf
            <input id="inarchive_id" type="hidden" name="archive_id">
            <div class="form-group">
              <label for="">Fecha **</label>
              <input id="indate" class="form-control datepicker" name="date" placeholder="Ingresa una Fecha">
              <p id="eerrdate" class="mb-0 text-danger em"></p>
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
    $('.datepicker').datepicker({
        format: 'mm-yyyy',
        viewMode: "months",
        minViewMode: "months",
        autoclose: true
    });
  </script>
@endsection
