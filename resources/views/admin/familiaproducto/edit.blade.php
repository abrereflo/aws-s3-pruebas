@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card ">
            <div class="card-header">
                <h1>EDITAR FAMILIA DE PRODUCTO</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('productfamily.update', $familiaproductos->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="contend">
                        <div class="form-group">
                            <label class="m-2">Tipo de Producto</label>
                            <select id="product_types_id" name="product_types_id" class="custom-select">
                                @foreach ( $tipoproductos as $tipoproducto )
                                    <option value="{{ $tipoproducto->id}}"  {{ $familiaproductos->product_types_id == $tipoproducto->id ? 'selected' : ''}}>{{ $tipoproducto->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="m-2">Familia Producto</label>
                            <input type="text" name="name" id="" value="{{$familiaproductos->name}}">
                        </div>
                        <div class="form-group">
                            <label class="m-2">Descripción</label>
                            <input type="text" name="description" id="" value="{{$familiaproductos->description}}">
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-danger" href="{{ route('productfamily.index')}}">Cancelar</a>
                            <button type="submit" class="btn btn-info">Registrar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div
@stop

@section('css')
@stop

@section('js')
@stop
