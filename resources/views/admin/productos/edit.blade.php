@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="card ">
        <div class="card-header">
            <h1>EDITAR PRODUCTO</h1>
        </div>
        <div class="card-body">
             <form action="{{ route('product.update', $producto->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                <div class="contend">
                            <div class="row">
                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="m-2">Familia de Producto</label>
                                            <select id="product_families_id" name="product_families_id" class="custom-select">
                                                @foreach ( $familiaproductos as $familiaproducto )
                                                <option value="{{ $familiaproducto->id}}"   {{ $producto->product_families_id == $familiaproducto->id ? 'selected' : ''}}>{{$familiaproducto->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="m-2">Codigo</label>
                                            <input type="text" name="code" id="code" value="{{$producto->code}}">
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="m-2">Producto</label>
                                        <input type="text" name="name" id="name" value="{{$producto->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="m-2">Costo</label>
                                        <input type="text" name="cost" id="cost" value="{{$producto->cost}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="m-2">Costo Venta</label>
                                        <input type="text" name="salePrice" id="salePrice" value="{{$producto->salePrice}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="m-2">Costo Facturado</label>
                                        <input type="text" name="invoicePrice" id="invoicePrice" value="{{$producto->invoicePrice}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="m-2">description</label>
                                <input type="text" name="description" id="description" value="{{$producto->description}}">
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="m-2">Stock</label>
                                        <input type="text" name="stock" id="stock" value="{{$producto->stock}}">
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="customFile">Custom File</label> -->

                                        <div class="custom-file">
                                        <input type="file" name="image" accept="image/png, image/jpeg" />
                                        </div>
                                        <div class="form-group">
                                            <img src="{{ Storage::url($producto->image) }}" height="200" width="200" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <div class="btn-group">
                                <a class="btn btn-danger" href="{{ route('product.index')}}">Cancelar</a>
                                <button type="submit" class="btn btn-info">Registrar</button>
                    </div>
                 </div>
            </form>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
