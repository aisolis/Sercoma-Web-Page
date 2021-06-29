@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Lenguajes</h4>
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
        <a href="#">Configurar Lenguajes</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Lenguajes</div>
          <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i> Añadir Lenguaje</a>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              @if (count($languages) == 0)
                <h3 class="text-center">NO SE HAN ENCONTRADO LENGUAJES</h3>
              @else
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Código</th>
                        <th scope="col">Aparencia en el sitio</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($languages as $key => $language)
                        <tr>
                          <td>{{$loop->iteration + 1}}</td>
                          <td>{{convertUtf8($language->name)}}</td>
                          <td>{{$language->code}}</td>
                          <td>
                            @if ($language->is_default == 1)
                              <strong class="badge badge-success">Default</strong>
                            @else
                              <form class="d-inline-block" action="{{route('admin.language.default', $language->id)}}" method="post">
                                @csrf
                                <button class="btn btn-primary btn-sm" type="submit" name="button">Convertir en Predeterminado</button>
                              </form>
                            @endif
                          </td>
                          <td>
                            <a class="btn btn-secondary btn-sm" href="{{route('admin.language.editKeyword', $language->id)}}">
                            <span class="btn-label">
                              <i class="fas fa-edit"></i>
                            </span>
                            Editar palabras claves
                            </a>
                            <a class="btn btn-secondary btn-sm" href="{{route('admin.language.edit', $language->id)}}">
                            <span class="btn-label">
                              <i class="fas fa-edit"></i>
                            </span>
                            Editar
                            </a>
                            <form class="deleteform d-inline-block" action="{{route('admin.language.delete', $language->id)}}" method="post">
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

      </div>
    </div>
  </div>
  @includeif('admin.language.create')
@endsection
