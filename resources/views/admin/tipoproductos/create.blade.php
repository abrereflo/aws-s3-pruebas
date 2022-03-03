<form action="{{ route('producttype.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div    class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="h2">Nuevo Tipo de Producto</h4>
                </div>
                <div class="modal-body">
                    <div class="contend">
                        <div class="form-group">
                            <label class="m-2">Tipo Producto</label>
                            <input type="text" name="name" id="">
                        </div>
                        <div class="form-group">
                            <label class="m-2">Descripción</label>
                            <input type="text" name="description" id="">
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-danger" href="{{ route('producttype.index')}}">Cancelar</a>
                            <button type="submit" class="btn btn-info">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

