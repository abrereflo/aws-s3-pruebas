@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Cotizaciones</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <a class="btn btn-info" href="{{ route('quote.create') }}" >Regsitrar Nuevo</a>
                </div>
                <form action={{ route('quote.buscar') }} method="post">
                    @csrf
                    <div class="col">
                        <div class="input-group input-group-sm">

                            <input name="buscar" type="text" class="form-control" placeholder="Buscar">
                            <select id="columnasCotizaciones" name="columnasCotizaciones" class="custom-select">
                                <option value="id">ID</option>
                                <option value="code">Codigo</option>
                                <option value="name">Nombre</option>
                                <option value="lastname">Apellido</option>
                            </select>
                            <select id="statu" name="statu" class="custom-select">
                                <option value="1">Habilitado</option>
                                <option value="0">Desavilidtado</option>
                            </select>
                            <span class="input-group-append ">
                                <button type="submit" class="fas fa-search btn-info"></button>
                                <a href="{{ route('quote.index') }}" class="btn btn-info"><i
                                        class="fas fa-sync"></i></a>
                            </span>
                        </div>
                    </div>
                </form>


            </div>

        </div>

        {{-- id
    clients_id
    date
    number
    totalprice
    statu --}}

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr class="bg-info">
                        <th scope="col">#</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Numero de pedido</th>
                        <th scope="col">Total</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cotizaciones as $quote)
                        <tr>
                            <th scope="row">{{ $quote->id }}</th>
                            <td>{{ $quote->clients_id }}</td>
                            <td>{{ $quote->date }}</td>
                            <td>{{ $quote->number }}</td>
                            <td>{{ $quote->totalprice }}</td>
                            <td>{{ $quote->statu }}</td>
                            <td>
                                @if ($quote->statu == true)
                                    <p class=""> Habilitado</p>
                                @else
                                    <p> Desabilitado</p>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('quote.show', $quote) }}" class="btn btn-outline-primary"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="{{ route('quote.edit', $quote) }}" class="btn btn-outline-secondary"><i
                                            class="fas fa-edit"></i></a>

                                    <div class="btn-group">
                                        <div class="col">
                                            <div
                                                class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input id="{{ $quote->id }}" data-id="{{ $quote->id }}"
                                                    class="custom-control-input" type="checkbox" data-onstyle="success"
                                                    data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                    data-off="InActive" {{ $quote->statu ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="{{ $quote->id }}"></label>
                                            </div>
                                        </div>


                                        <form action="{{ route('quote.delete', $quote->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button id="Eliminar" type="submit" class="btn btn-outline-danger"><i
                                                    class="fas fa-trash-alt"></i></button>
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
                url: '{{ route('UpdateStatusquote') }}',
                data: {
                    'statu': statu,
                    'id': id
                },
                success: function(data) {
                    $('#resp' + id).html(data.var);
                    console.log(data.var)
                }
            });
        })
    </script>
@stop
