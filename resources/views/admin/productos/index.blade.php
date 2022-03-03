@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Productos</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <a class="btn btn-info" data-toggle="modal" data-target="#ModalCreate">Regsitrar Nuevo</a>
            </div>
            <form action={{ route('product.buscar')}} method="post">
                @csrf
           <div class="col">
                <div class="input-group input-group-sm">

                    <input name="buscar" type="text" class="form-control" placeholder="Buscar">
                    <select id="columnasProducto" name="columnasProducto"  class="custom-select">
                        <option value="id">ID</option>
                        <option value="name">Producto</option>
                        <option value="code">Codigo</option>
                        <option value="productfamily">Familia</option>
                    </select>
                    <select id="statu" name="statu" class="custom-select">
                            <option value="1" >Habilitado</option>
                            <option value="0" >Desavilidtado</option>
                    </select>
                    <span class="input-group-append ">
                          <button type="submit" class="fas fa-search btn-info"></button>
                          <a href="{{ route('product.index')}}" class="btn btn-info"><i class="fas fa-sync"></i></a>
                     </span>
                </div>
            </div>
        </form>


        </div>

    </div>

    <!--'product_families_id'
    'code'
    'name'
    'image'
    'description'
    'cost'
    'salePrice'
    'invoicePrice'
    'stock'
    'statu'-->

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
                  <th scope="col">Codigo</th>
                  <th scope="col">Producto</th>
                  <th scope="col">Flm Producto</th>
                  <th scope="col">Imagen</th>
                  <th scope="col">Costo</th>
                  <th scope="col">Precio Venta</th>
                  <th scope="col">Precio factura</th>
                  <th scope="col">Stock</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($productos as $producto )
                <tr>
                  <th scope="row">{{$producto->id}}</th>
                    <td>{{$producto->code}}</td>
                    <td>{{$producto->name}}</td>
                    <td>{{$producto->productfamily->name}}</td>
                    <td><img src="{{ Storage::url($producto->image) }}" height="75" width="75" alt="" /> </td>
                    <td>{{$producto->cost}}</td>
                    <td>{{$producto->salePrice}}</td>
                    <td>{{$producto->invoicePrice}}</td>
                    <td>{{$producto->stock}}</td>
                    <td id="resp{{ $producto->id }}">
                        @if ($producto->statu == true)
                        <p class="text-success">Habilitado</p>
                        @else
                        <p class="text-danger">Desabilitado</p>
                        @endif
                    </td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ route('product.show', $producto)}}" class="btn btn-outline-primary"><i class="fas fa-eye"></i></a>
                      <a href="{{ route('product.edit', $producto)}}" class="btn btn-outline-secondary"><i class="fas fa-edit"></i></a>

                          <div class="btn-group">
                              <div class="col">
                                  <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                      <input id="{{ $producto->id }}" data-id="{{ $producto->id }}" class="custom-control-input" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $producto->statu ? 'checked' : '' }}>
                                      <label class="custom-control-label" for="{{ $producto->id }}"></label>
                                  </div>
                              </div>


                          <form action="{{ route('product.delete', $producto->id)}}" method="POST">
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


@include('admin.productos.create')
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
            url: '{{ route('UpdateStatusProducto') }}',
            data: {'statu': statu, 'id': id },
            success: function(data){
                $('#resp' + id).html(data.var);
                console.log(data.var)
            }
        });
      })
</script>
@stop
