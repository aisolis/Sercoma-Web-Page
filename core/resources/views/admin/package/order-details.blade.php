<!-- Details Modal -->
<div class="modal fade" id="detailsModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Detalles</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <strong style="text-transform: capitalize;">Nombre:</strong>
                </div>
                <div class="col-lg-8">{{$order->name}}</div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-4">
                    <strong style="text-transform: capitalize;">Email:</strong>
                </div>
                <div class="col-lg-8">{{$order->email}}</div>
            </div>
            <hr>

          @php
            $fields = json_decode($order->fields, true);
          @endphp

          @foreach ($fields as $key => $field)
          <div class="row">
            <div class="col-lg-4">
              <strong style="text-transform: capitalize;">{{str_replace("_"," ",$key)}}:</strong>
            </div>
            <div class="col-lg-8">
                @if (is_array($field))
                    @php
                        $str = implode(", ", $field);
                    @endphp
                    {{convertUtf8($str)}}
                @else
                    {{convertUtf8($field)}}
                @endif
            </div>
          </div>
          <hr>
          @endforeach
          <div class="row">
            <div class="col-lg-4">
              <strong>Título del paquete:</strong>
            </div>
            <div class="col-lg-8">
              {{convertUtf8($order->package_title)}}
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-4">
              <strong>Precio del paquete:</strong>
            </div>
            <div class="col-lg-8">
              {{convertUtf8($order->package_price)}}
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-4">
              <strong>Fecha de orden:</strong>
            </div>
            <div class="col-lg-8">
              {{$order->created_at}}
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-4">
              <strong>Estado:</strong>
            </div>
            <div class="col-lg-8">
              @if ($order->status == 0)
                <span class="badge badge-warning">Pendiente</span>
              @elseif ($order->status == 1)
                <span class="badge badge-secondary">Procesandose</span>
              @elseif ($order->status == 2)
                <span class="badge badge-success">Completado</span>
              @elseif ($order->status == 3)
                <span class="badge badge-danger">Rechazado</span>
              @endif
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-4">
              <strong>Descripción del paquete:</strong>
            </div>
            <div class="col-lg-8">
              {!! $order->package_description !!}
            </div>
          </div>
          <hr>
          @if (!empty($order->nda))
          <div class="row">
            <div class="col-lg-4">
              <strong>Archivo NDA:</strong>
            </div>
            <div class="col-lg-8">
              <a class="btn btn-secondary btn-sm" href="{{asset('assets/front/ndas/'.$order->nda)}}" target="_blank">
                <span class="btn-label">
                  <i class="fa fa-eye"></i>
                </span>
                Ver
              </a>
            </div>
          </div>
          <hr>
          @endif

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
