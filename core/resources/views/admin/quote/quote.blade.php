@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Quotes</h4>
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
        <a href="#">Administrador de cotizaciones</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Cotizaciones</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card-title d-inline-block">Cotizaciones</div>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete" data-href="{{route('admin.quote.bulk.delete')}}"><i class="flaticon-interface-5"></i> Eliminar</button>
                </div>
            </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              @if (count($quotes) == 0)
                <h3 class="text-center">No se encontraron cotizaciones</h3>
              @else
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">
                            <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo electronico</th>
                        <th scope="col">Detalles</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Mail</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($quotes as $key => $quote)
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="{{$quote->id}}">
                          </td>
                          <td>{{convertUtf8($quote->name)}}</td>
                          <td>{{convertUtf8($quote->email)}}</td>
                          <td>
                            <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#detailsModal{{$quote->id}}"><i class="fas fa-eye"></i> Ver</button>
                          </td>
                          <td>
                            <form id="statusForm{{$quote->id}}" class="d-inline-block" action="{{route('admin.quotes.status')}}" method="post">
                              @csrf
                              <input type="hidden" name="quote_id" value="{{$quote->id}}">
                              <select class="form-control" name="status" onchange="document.getElementById('statusForm{{$quote->id}}').submit();">
                                <option value="0" {{$quote->status == 0 ? 'selected' : ''}}>Pendiente</option>
                                <option value="1" {{$quote->status == 1 ? 'selected' : ''}}>Procesadonse</option>
                                <option value="2" {{$quote->status == 2 ? 'selected' : ''}}>Completado</option>
                                <option value="3" {{$quote->status == 3 ? 'selected' : ''}}>Rechazado</option>
                              </select>
                            </form>
                          </td>
                          <td>
                            <a href="#" class="btn btn-primary btn-sm editbtn" data-target="#mailModal" data-toggle="modal" data-email="{{$quote->email}}"><i class="far fa-envelope"></i> Enviar</a>
                          </td>
                          <td>
                            <form class="deleteform d-inline-block" action="{{route('admin.quote.delete')}}" method="post">
                              @csrf
                              <input type="hidden" name="quote_id" value="{{$quote->id}}">
                              <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                <span class="btn-label">
                                  <i class="fas fa-trash"></i>
                                </span>
                                Eliminar
                              </button>
                            </form>
                          </td>
                        </tr>

                        @includeif('admin.quote.quote-details')
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
              {{$quotes->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Send Mail Modal -->
  <div class="modal fade" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Enviar correo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="ajaxEditForm" class="" action="{{route('admin.quotes.mail')}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="">Correo del cliente **</label>
              <input id="inemail" type="text" class="form-control" name="email" value="" placeholder="Ingrese el correo del cliente">
              <p id="eerremail" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
              <label for="">Asunto **</label>
              <input id="insubject" type="text" class="form-control" name="subject" value="" placeholder="Ingrese el asunto">
              <p id="eerrsubject" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
              <label for="">Mensaje **</label>
              <textarea id="inmessage" class="form-control summernote" name="message" data-height="150" placeholder="Ingrese el mensaje"></textarea>
              <p id="eerrmessage" class="mb-0 text-danger em"></p>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button id="updateBtn" type="button" class="btn btn-primary">Enviar Correo</button>
        </div>
      </div>
    </div>
  </div>
@endsection
