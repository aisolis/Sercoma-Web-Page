@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Roles</h4>
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
        <a href="#">{{$role->name}}</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Administrador de permisos</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Administrador de permisos</div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('admin.role.index')}}">
            <span class="btn-label">
              <i class="fas fa-backward" style="font-size: 12px;"></i>
            </span>
            Back
          </a>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              {{--  onsubmit="return false;" --}}
              <form id="permissionsForm" class="" action="{{route('admin.role.permissions.update')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="role_id" value="{{Request::route('id')}}">

                @php
                  $permissions = $role->permissions;
                  if (!empty($role->permissions)) {
                    $permissions = json_decode($permissions, true);
                    // dd($permissions);
                  }
                @endphp

                <div class="form-group">
                  <label for="">Permisos: </label>
                	<div class="selectgroup selectgroup-pills mt-2">
                		<label class="selectgroup-item">
                			<input type="hidden" name="permissions[]" value="Dashboard" class="selectgroup-input">
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Basic Settings" class="selectgroup-input" @if(is_array($permissions) && in_array('Basic Settings', $permissions)) checked @endif>
                			<span class="selectgroup-button">Configuraicones B??sicas</span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Subscribers" class="selectgroup-input" @if(is_array($permissions) && in_array('Subscribers', $permissions)) checked @endif>
                			<span class="selectgroup-button">Suscriptores</span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Packages" class="selectgroup-input" @if(is_array($permissions) && in_array('Packages', $permissions)) checked @endif>
                			<span class="selectgroup-button">Paquetes</span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Quote Management" class="selectgroup-input" @if(is_array($permissions) && in_array('Quote Management', $permissions)) checked @endif>
                			<span class="selectgroup-button">Administrador de cotizaciones</span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Home Page" class="selectgroup-input" @if(is_array($permissions) && in_array('Home Page', $permissions)) checked @endif>
                			<span class="selectgroup-button">P??gina de inicio</span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Footer" class="selectgroup-input" @if(is_array($permissions) && in_array('Footer', $permissions)) checked @endif>
                			<span class="selectgroup-button">Pie de p??gina</span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Pages" class="selectgroup-input" @if(is_array($permissions) && in_array('Pages', $permissions)) checked @endif>
                			<span class="selectgroup-button">P??ginas</span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Service Page" class="selectgroup-input" @if(is_array($permissions) && in_array('Service Page', $permissions)) checked @endif>
                			<span class="selectgroup-button">P??gina de servicios</span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Portfolio Management" class="selectgroup-input" @if(is_array($permissions) && in_array('Portfolio Management', $permissions)) checked @endif>
                			<span class="selectgroup-button">Administrador de portafolios</span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Career Page" class="selectgroup-input" @if(is_array($permissions) && in_array('Career Page', $permissions)) checked @endif>
                			<span class="selectgroup-button">P??gina de carrera</span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Event Calendar" class="selectgroup-input" @if(is_array($permissions) && in_array('Event Calendar', $permissions)) checked @endif>
                			<span class="selectgroup-button">Calendario de eventos</span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Gallery Management" class="selectgroup-input" @if(is_array($permissions) && in_array('Gallery Management', $permissions)) checked @endif>
                			<span class="selectgroup-button">Administrar galeria</span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="FAQ Management" class="selectgroup-input" @if(is_array($permissions) && in_array('FAQ Management', $permissions)) checked @endif>
                			<span class="selectgroup-button">Administrador de FAQ</span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Blogs" class="selectgroup-input" @if(is_array($permissions) && in_array('Blogs', $permissions)) checked @endif>
                			<span class="selectgroup-button">Blogs</span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Contact Page" class="selectgroup-input" @if(is_array($permissions) && in_array('Contact Page', $permissions)) checked @endif>
                			<span class="selectgroup-button">P??gina de contacto</span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Role Management" class="selectgroup-input" @if(is_array($permissions) && in_array('Role Management', $permissions)) checked @endif>
                			<span class="selectgroup-button">Administrador de roles</span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Users Management" class="selectgroup-input" @if(is_array($permissions) && in_array('Users Management', $permissions)) checked @endif>
                			<span class="selectgroup-button">Administrador de usuarios</span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Language Management" class="selectgroup-input" @if(is_array($permissions) && in_array('Language Management', $permissions)) checked @endif>
                			<span class="selectgroup-button">Administrador de lenguajes</span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Backup" class="selectgroup-input" @if(is_array($permissions) && in_array('Backup', $permissions)) checked @endif>
                			<span class="selectgroup-button">Copia de seguridad</span>
                		</label>
                	</div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="form">
            <div class="form-group from-show-notify row">
              <div class="col-12 text-center">
                <button type="submit" id="submitBtn" class="btn btn-success" onclick="document.getElementById('permissionsForm').submit();">Actualizar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
