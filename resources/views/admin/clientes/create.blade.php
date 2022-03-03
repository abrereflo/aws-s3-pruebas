<form action="{{ route('client.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="h2">Nuevo Cliente</h4>
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
                <div class="modal-body">
                    <div class="contend">
                        <div class="row">
                            <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="m-2">Familia de Producto</label>

                                    </div>
                                    <div class="form-group">
                                        <label class="m-2">Codigo</label>
                                        <input type="text" name="code" id="code">
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="m-2">Nombre</label>
                                    <input type="text" name="name" id="name">
                                </div>
                                <div class="form-group">
                                    <label class="m-2">Apellido</label>
                                    <input type="text" name="lastname" id="lastname">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="m-2">Celular</label>
                                    <input type="text" name="phone" id="phone">
                                </div>
                                <div class="form-group">
                                    <label class="m-2">Ciudad</label>
                                    <input type="text" name="city" id="city">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="m-2">Dirección</label>
                            <input type="text" name="address" id="address">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="m-2">NIT</label>
                                    <input type="text" name="nit" id="nit">
                                </div>
                                <div class="form-group">
                                    <label class="m-2">CI</label>
                                    <input type="text" name="ci" id="ci">
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="m-2">Correo</label>
                            <input type="email" name="email" id="email">
                        </div>


                        <div class="btn-group">
                            <a class="btn btn-danger" href="{{ route('client.index')}}">Cancelar</a>
                            <button type="submit" class="btn btn-info">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
