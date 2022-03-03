<form action="{{ route('product.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="h2">Nuevo Familia de Producto</h4>
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

                <div class="modal-body">
                    <div class="contend">
                        <div class="row">
                            <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="m-2">Familia de Producto</label>
                                        <select id="product_families_id" name="product_families_id" class="custom-select">
                                            @foreach ( $familiaproductos as $familiaproducto )
                                            @if ($familiaproducto->statu)
                                                <option value="{{ $familiaproducto->id}}">{{ $familiaproducto->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
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
                                    <label class="m-2">Producto</label>
                                    <input type="text" name="name" id="name">
                                </div>
                                <div class="form-group">
                                    <label class="m-2">Costo</label>
                                    <input type="text" name="cost" id="cost">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="m-2">Costo Venta</label>
                                    <input type="text" name="salePrice" id="salePrice">
                                </div>
                                <div class="form-group">
                                    <label class="m-2">Costo Facturado</label>
                                    <input type="text" name="invoicePrice" id="invoicePrice">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="m-2">description</label>
                            <input type="text" name="description" id="description">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="m-2">Stock</label>
                                    <input type="text" name="stock" id="stock">
                                </div>
                                <div class="form-group">
                                    <!-- <label for="customFile">Custom File</label> -->

                                    <div class="custom-file">
                                   <input type="file" name="image" accept="image/png, image/jpeg" />
                                    </div>
                                  </div>
                            </div>
                        </div>



                        <div class="btn-group">
                            <a class="btn btn-danger" href="{{ route('product.index')}}">Cancelar</a>
                            <button type="submit" class="btn btn-info">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
