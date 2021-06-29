@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Copia de seguridad</h4>
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
        <a href="#">Copia de seguridad</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Backup Lists</div>
          <form class="d-inline-block float-right" action="{{route('admin.backup.store')}}" method="post">
            @csrf
            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Crear una copia de seguridad</button>
          </form>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="alert alert-warning" role="alert">
                Asegúrese de que su base de datos esté respaldada con frecuencia. Haga clic en "Crear copia de seguridad" para hacer una copia de seguridad manual de su base de datos. La copia de seguridad se almacena en la carpeta [core / storage / app / public /] y se puede descargar de la lista a continuación (pero no se puede acceder públicamente).
              </div>

              @if (count($backups) == 0)
                <h3 class="text-center">No se han encontrado copias de seguridad</h3>
              @else
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">Fecha y hora</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($backups as $key => $backup)
                        <tr>
                          <td>{{$backup->created_at}}</td>
                          <td>
                            <form class="d-inline-block" action="{{route('admin.backup.download', $backup->id)}}" method="post">
                              @csrf
                              <input type="hidden" name="filename" value="{{$backup->filename}}">
                              <button type="submit" class="btn btn-secondary btn-sm">
                                <span class="btn-label">
                                  <i class="fas fa-arrow-alt-circle-down"></i>
                                </span>
                                Descargar
                              </button>
                            </form>
                            <form class="deleteform d-inline-block" action="{{route('admin.backup.delete', $backup->id)}}" method="post">
                              @csrf
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

        <div class="card-footer">
          <div class="row">
            <div class="d-inline-block mx-auto">
              {{$backups->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
