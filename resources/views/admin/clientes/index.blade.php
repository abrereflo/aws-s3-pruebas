@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Clientes</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <a class="btn btn-info" data-toggle="modal" data-target="#ModalCreate">Regsitrar Nuevo</a>
            </div>
            <form action={{ route('client.buscar')}} method="post">
                @csrf
           <div class="col">
                <div class="input-group input-group-sm">

                    <input name="buscar" type="text" class="form-control" placeholder="Buscar">
                    <select id="columnasClientes" name="columnasClientes"  class="custom-select">
                        <option value="id">ID</option>
                        <option value="code">Codigo</option>
                        <option value="name">Nombre</option>
                        <option value="lastname">Apellido</option>
                    </select>
                    <select id="statu" name="statu" class="custom-select">
                            <option value="1" >Habilitado</option>
                            <option value="0" >Desavilidtado</option>
                    </select>
                    <span class="input-group-append ">
                          <button type="submit" class="fas fa-search btn-info"></button>
                          <a href="{{ route('client.index')}}" class="btn btn-info"><i class="fas fa-sync"></i></a>
                     </span>
                </div>
            </div>
        </form>


        </div>

    </div>

    <!--
        'code'
        'name'
        'lastname'
        'phone'
        'city'
        'address'
        'nit'
        'ci'
        'email'
        'statu'-->

    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr class="bg-info">
                  <th scope="col">#</th>
                  <th scope="col">Codigo</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Apellido</th>
                  <th scope="col">telefono</th>
                  <th scope="col">Ciudad</th>
                  <th scope="col">Calle</th>
                  <th scope="col">NIT</th>
                  <th scope="col">Carnet</th>
                  <th scope="col">Correo</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($clientes as $cliente )
                <tr>
                  <th scope="row">{{$cliente->id}}</th>
                    <td>{{$cliente->code}}</td>
                    <td>{{$cliente->name}}</td>
                    <td>{{$cliente->lastname}}</td>
                    <td>{{$cliente->phone}}</td>
                    <td>{{$cliente->city}}</td>
                    <td>{{$cliente->address}}</td>
                    <td>{{$cliente->nit}}</td>
                    <td>{{$cliente->ci}}</td>
                    <td>{{$cliente->email}}</td>
                  <td>
                      @if ($cliente->statu == true)
                          <p class=""> Habilitado</p>
                      @else
                          <p> Desabilitado</p>
                      @endif
                  </td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ route('client.show', $cliente)}}" class="btn btn-outline-primary"><i class="fas fa-eye"></i></a>
                      <a href="{{ route('client.edit', $cliente)}}" class="btn btn-outline-secondary"><i class="fas fa-edit"></i></a>

                          <div class="btn-group">
                              <div class="col">
                                  <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                      <input id="{{ $cliente->id }}" data-id="{{ $cliente->id }}" class="custom-control-input" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $cliente->statu ? 'checked' : '' }}>
                                      <label class="custom-control-label" for="{{ $cliente->id }}"></label>
                                  </div>
                              </div>


                          <form action="{{ route('client.delete', $cliente->id)}}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button id="Eliminar" type="submit" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                          </form>

                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
    </div>
    <div class="card-footer">

    </div>
</div>
@include('admin.clientes.create')
@stop

@section('css')

@stop

@section('js')

<script>
    //para estados
    $('.custom-control-input').change(function() {
    //Verifico el estado del checkbox, si esta seleccionado sera igual a 1 de lo contrario sera igual a 0
        var statu = $(this).prop('checked') == true ? 1 : 0;
        var id = $(this).data('id');
            console.log(statu);
        $.ajax({
            type: "GET",
            dataType: "json",
            //url: '/StatusNoticia',
            url: '{{ route('UpdateStatusclient') }}',
            data: {'statu': statu, 'id': id },
            success: function(data){
                $('#resp' + id).html(data.var);
                console.log(data.var)
            }
        });
      })
</script>
@stop
