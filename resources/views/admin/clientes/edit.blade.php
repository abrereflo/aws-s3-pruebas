@extends('adminlte::page')

@section('title', 'EPY Electronica')

@section('content_header')

@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header">
                <h1>EDITAR CLIENTE</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('client.update', $clientes->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="contend">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="m-2">Codigo</label>
                                    <input type="text" name="code" id="code" value="{{ $clientes->code}}">
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="m-2">Nombre</label>
                                <input type="text" name="name" id="name" value="{{ $clientes->name}}" >
                            </div>
                            <div class="form-group">
                                <label class="m-2">Apellido</label>
                                <input type="text" name="lastname" id="lastname" value="{{$clientes->lastname}}" >
                            </div>
                        </div>
                    </div>
                   <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="m-2">Celular</label>
                                <input type="text" name="phone" id="phone" value="{{ $clientes->phone}}">
                            </div>
                            <div class="form-group">
                                <label class="m-2">Ciudad</label>
                                <input type="text" name="city" id="city" value="{{ $clientes->city}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="m-2">Dirección</label>
                        <input type="text" name="address" id="address" value="{{ $clientes->address}}">
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="m-2">NIT</label>
                                <input type="text" name="nit" id="nit" value="{{ $clientes->nit}}">
                            </div>
                            <div class="form-group">
                                <label class="m-2">CI</label>
                                <input type="text" name="ci" id="ci" value="{{ $clientes->ci}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="m-2">Correo</label>
                        <input type="email" name="email" id="email" value="{{ $clientes->email}}">
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-danger" href="{{ route('client.index')}}">Cancelar</a>
                        <button type="submit" class="btn btn-info">Registrar</button>
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
