<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <h3 class="">Keranjang Belanja</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body cart">
            <div>
                <div class="cart-list overflow-auto cart-scrollbar" id="cart-list">
                    {{-- list menu --}}
                </div>
                {{-- /.list menu --}}

                {{-- sub total --}}
                <hr>
                <div class="row">
                    <div class="col-5 text-muted">
                        <span>Total </span> <br>
                    </div>
                    <div class="col-2 text-muted text-right">
                        <span>: </span> <br>
                    </div>
                    <div class="col-5">
                        <h4>Rp. <b><span class="total-price" id="total-price">0</span></b></h4>
                    </div>
                </div>
                <div class="row">
                    <button type="button" class="btn col-3 bg-gradient-danger btn-lg ml-1 mr-1"
                        onclick="deleteCart()">Batal</button>
                    <button type="button" class="btn col-3 bg-gradient-warning btn-lg ml-1 mr-1"
                        onclick="addNewTransaction()">Hold</button>
                    <button type="button" class="btn col-5 bg-gradient-primary btn-lg ml-1 mr-1" data-toggle="modal"
                        data-target="#modal-pay" onclick="callPayModal()">Bayar</button>
                </div>
                {{-- /.sub total --}}


            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>
