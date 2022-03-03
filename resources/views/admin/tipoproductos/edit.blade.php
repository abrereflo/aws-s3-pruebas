@extends('adminlte::page')

@section('title', 'EPY Electronica')

@section('content_header')

@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header">
                <h1>EDITAR TIPO DE PRODUCTOS</h1>
            </div>
            <div class="card-body">
                <form class="card-header" action="{{ route('producttype.update', $tipoproductos->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="contend">
                            <div class="form-group">
                                <label class="m-2">Tipo Producto</label>
                                <input type="text" name="name" id="" value="{{ $tipoproductos->name}}">
                            </div>
                            <div class="form-group">
                                 <label class="m-2">Descripción</label>
                                 <input type="text" name="description" id="" value="{{$tipoproductos->description}}">
                            </div>
                            <div class="btn-group">
                                <a class="btn btn-danger" href="{{ route('producttype.index')}}">Cancelar</a>
                                <button type="submit" class="btn btn-info">Registrar</button>
                            </div>
                         </div>

                    </div>
                </form>

        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')


@stop
