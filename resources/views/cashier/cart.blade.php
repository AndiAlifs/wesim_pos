<style>
    .vertical-center {
        margin-top: 20px;
    }

    .chart-item:hover {
        background-color: rgb(218, 240, 255);
    }

</style>

<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Keranjang Belanja</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div>
                {{-- list menu --}}
                @for ($i = 0; $i < 5; $i++)
                    <div class="card chart-item">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="p-2">
                                    <img src="https://images.immediate.co.uk/production/volatile/sites/30/2020/08/chorizo-mozarella-gnocchi-bake-cropped-9ab73a3.jpg?quality=90&resize=700%2C636" alt="" width="50px" height="50x">
                                    {{-- <b> {{ $row->name }}</b> --}}
                                </div>
                            </div>
                            <div class="col-sm-4 mt-2">
                                <div class="">
                                    <b>Ayam Bakar</b>
                                    <p class="small text-muted"> Rp. 30.000 </p>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="vertical-center border-right border-secondary">
                                    <div class="text-muted">
                                        <span>&#10005;</span> 300
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="vertical-center">
                                    Rp. 90.0000
                                    <button type="button" class="btn bg-gradient-danger btn-xs float-right mr-2">
                                        &#10005;
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
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
                        <span> Rp. 120.000</span> <br>
                        <span> Rp. 6.000</span>
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
                        <span> Rp. 126.000</span> <br>
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
