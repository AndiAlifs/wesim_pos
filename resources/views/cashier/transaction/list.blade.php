<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <h5 class=""><b>{{ count($sellingTransaction) }} Transaksi Hari Ini</b></h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body transaction-body p-0">
            <div>
                {{-- list transaction --}}
                <div class="transaction-height overflow-auto cart-scrollbar" id="today-transaction">
                    {{-- <div class="row border">
                        <div class="col p-2 pl-4"><b>#Nomor Transaksi</b></div>
                        <div class="col p-2 pl-4"><b>#Total Belanja</b></div>
                    </div> --}}
                    <?php
                    $trx_total_price = 0;
                    if (!count($sellingTransaction)) {
                    echo '<b class="text-muted">
                        <center>Tidak Ada Transaksi Hari Ini!!!</center>
                    </b>';
                    }
                    ?>
                    @foreach ($sellingTransaction as $row)
                        <?php $trx_total_price += $row->total_price; ?>
                        <div class="cart-item list-hover border-bottom pl-4 p-2 text-dark list-item" id="list-item"
                            type="button" onclick="detailTransaction({{ $row->id }})">
                            <div class="row">
                                <div class="col-7">
                                    <div class="row">
                                        <div class="col mt-2 overflow-hidden">
                                            <div>
                                                <b class="overflow-hidden no-wrap">{{ $row->transaction_number }}</b>
                                                <br>
                                                <span class="text-muted">{{ $row->updated_at }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="pt-1">
                                        <small class="text-muted">Total Belanja: </small>
                                        <h5><b>Rp. {{ number_format($row->total_price, 0, ',', '.') }}</b></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- /.list transaction --}}

                {{-- sub total --}}
                <hr>
                <div class="row mr-3 ml-3">
                    <div class="col-5 text-muted">
                        <span>Total </span> <br>
                    </div>
                    <div class="col-1 text-muted text-right">
                        <span>: </span> <br>
                    </div>
                    <div class="col-6">
                        <h4>Rp. <b><span class="total-price" id="trx-total-price"><?php echo
                                    number_format($trx_total_price, 0, ',', '.'); ?></span></b></h4>
                    </div>
                </div>
                <div class="row mb-3 mr-3">
                    <button type="button" class="btn col-6 bg-gradient-primary ml-1 mr-1 ml-auto"
                        onclick="printArea($('#today-transaction'))">
                        <i class="nav-icon fas fa-print mr-2"></i>
                        Print
                    </button>
                </div>
                {{-- /.sub total --}}
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>
