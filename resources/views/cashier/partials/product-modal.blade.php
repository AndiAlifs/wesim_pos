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
                        <input name="transaction_id" type="hidden" class="form-control" id="transaction_id"
                            value="1111">
                        <input name="product_id" type="hidden" class="form-control product_id" value="">
                    </div>
                    <div class="form-group text-center">
                        <h3 class="product_name">Judul</h3>
                    </div>
                    <div class="form-group row">
                        <label for="input-harga" class="col-sm-3 col-form-label">Harga</label>
                        <div class="col-sm-9">
                            <input name="price" type="number" class="form-control product_price" placeholder="Harga"
                                value="" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-number" class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm-9">
                            <input name="amount" type="number" class="form-control amount" id="amount"
                                placeholder="Jumlah" value="1" min="1">
                        </div>
                    </div>
                </div>
                <div>
                    <button data-dismiss="modal" type="button"
                        class="btn btn-block btn-modal bg-gradient-primary text-center modal-btn" id="modalbtn"
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