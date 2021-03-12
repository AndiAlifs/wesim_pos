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
                    {{-- @for ($i = 0; $i < 2; $i++) --}}
                        
                    {{-- @endfor --}}
                </div>
                <br>
                <hr>
                {{-- /.list menu --}}

                {{-- sub total --}}
                <div class="row">
                    <div class="col-7 text-muted">
                        <span>Sub Total : </span> <br>
                        <span>Pb (5%) : </span>
                    </div>
                    <div class="col-1 text-muted text-right">
                        <span>: </span> <br>
                        <span>: </span>
                    </div>
                    <div class="col-4">
                        Rp. <span class="total_harga">0</span> <br>
                        <span> Rp. 0</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-7 text-muted">
                        <span>Sub Total : </span> <br>
                    </div>
                    <div class="col-1 text-muted text-right">
                        <span>: </span> <br>
                    </div>
                    <div class="col-4">
                        Rp. <span class="total_harga">0</span> <br>
                    </div>
                </div>

                <div class="row mt-3">
                    <button type="button" class="btn btn-block bg-gradient-primary btn-lg">Bayar</button>
                </div>
                {{-- /.sub total --}}


            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>
