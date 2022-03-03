@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1> Lista de Familia de Productos</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <a class="btn btn-info" data-toggle="modal" data-target="#ModalCreate">Regsitrar Nuevo</a>
                </div>
                <form action={{ route('productfamily.buscar')}} method="post">
                    @csrf
                    <div class="col">
                        <div class="input-group input-group-sm">

                            <input name="buscar" type="text" class="form-control" placeholder="Buscar">
                            <select id="columnasFamiliaProducto" name="columnasFamiliaProducto"  class="custom-select">
                                <option value="id">Codigo</option>
                                <option value="name">Familia</option>
                                <option value="productstype">Tipo</option>
                            </select>
                            <select id="statu" name="statu" class="custom-select">
                                    <option value="1" >Habilitado</option>
                                    <option value="0" >Desavilidtado</option>
                            </select>
                            <span class="input-group-append ">
                                <button type="submit" class="fas fa-search btn-info"></button>
                                <a href="{{ route('productfamily.index')}}" class="btn btn-info"><i class="fas fa-sync"></i></a>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification')}}
                </div>
             @endif
            <table class="table table-striped">
                <thead>
                    <tr class="bg-info">
                      <th scope="col">#</th>
                      <th scope="col">Famlia Producto</th>
                      <th scope="col">Tipo de Producto</th>
                      <th scope="col">Descripción</th>
                      <th scope="col">Estado</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($familiaproductos as $familiaproducto )
                    <tr>
                      <th scope="row">{{$familiaproducto->id}}</th>
                        <td>{{$familiaproducto->name}}</td>
                        <td>{{$familiaproducto->productstype->name}}</td>
                        <td>{{$familiaproducto->description}}</td>
                        <td id="resp{{ $familiaproducto->id }}">
                            @if ($familiaproducto->statu == true)
                            <p class="text-success">Habilitado</p>
                            @else
                            <p class="text-danger">Desabilitado</p>
                            @endif
                        </td>
                      <td>
                          <a href="{{ route('productfamily.show', $familiaproducto)}}" class="btn btn-outline-primary"><i class="fas fa-eye"></i></a>
                          <a href="{{ route('productfamily.edit', $familiaproducto)}}" class="btn btn-outline-secondary"><i class="fas fa-edit"></i></a>

                              <div class="btn-group">
                                  <div class="col">
                                      <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                          <input id="{{ $familiaproducto->id }}" data-id="{{ $familiaproducto->id }}" class="custom-control-input" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $familiaproducto->statu ? 'checked' : '' }}>
                                          <label class="custom-control-label" for="{{ $familiaproducto->id }}"></label>
                                      </div>
                                  </div>


                              <form action="{{ route('productfamily.delete', $familiaproducto->id)}}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button id="Eliminar" type="submit" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                              </form>

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


    @include('admin.familiaproducto.create')
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
            url: '{{ route('UpdateStatusFamiliaProducto') }}',
            data: {'statu': statu, 'id': id },
            success: function(data){
                $('#resp' + id).html(data.var);
                console.log(data.var)
            }
        });
      })
</script>
@stop
