<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <h3 class="">Keranjang Belanja</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body cart">
            <div>
                <div class="cart-list overflow-auto cart-scrollbar">
                    {{-- list menu --}}

                </div>
                {{-- /.list menu --}}

                {{-- sub total --}}
                <div class="row">
                    <div class="col-7 text-muted">
                        <span>Sub Total </span> <br>
                        <span>Pb (5%) </span>
                    </div>
                    <div class="col-1 text-muted text-right">
                        <span>: </span> <br>
                        <span>: </span>
                    </div>
                    <div class="col-4">
                        Rp. <span class="total-harga">0</span> <br>
                        <span> Rp. 0</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-5 text-muted">
                        <span>Total </span> <br>
                    </div>
                    <div class="col-2 text-muted text-right">
                        <span>: </span> <br>
                    </div>
                    <div class="col-5">
                        <h4>Rp. <b><span class="total-price">0</span></b></h4>
                    </div>
                </div>
                <div class="row">
                    <button type="button" class="btn col-3 bg-gradient-danger btn-lg ml-1 mr-1"
                        onclick="deleteCart()">Batal</button>
                    <button type="button" class="btn col-3 bg-gradient-warning btn-lg ml-1 mr-1"
                        onclick="addNewTransaction()">Hold</button>
                    <button type="button" class="btn col-5 bg-gradient-primary btn-lg ml-1 mr-1">Bayar</button>
                </div>
                {{-- /.sub total --}}


            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>
