<!-- -------------------------------modal------------------------------------- -->
<div class="modal fade modal-class" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-head">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-group">
                        <input name="modal-id" type="hidden" class="form-control" id="modal-id" value="">
                        <input name="modal-product-id" type="hidden" class="form-control" id="modal-product-id"
                            value="">
                    </div>
                    <div class="form-group text-center">
                        <h3 id="modal-name">Judul</h3>
                    </div>
                    <div class="form-group row">
                        <label for="input-harga" class="col-sm-3 col-form-label">Harga</label>
                        <div class="col-sm-9">
                            <input name="price" type="number" class="form-control" id="modal-price" placeholder="Harga"
                                value="" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-number" class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm-9">
                            <input name="amount" type="number" class="form-control modal-amount" id="modal-amount"
                                placeholder="Jumlah" value="1" min="1">
                        </div>
                    </div>
                </div>
                <div>
                    <button data-dismiss="modal" type="button"
                        class="btn btn-block btn-modal bg-gradient-primary text-center modal-btn" id="modal-btn"
                        onclick="addToCart()">
                        <b>Masukkan ke Keranjang</b>
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
