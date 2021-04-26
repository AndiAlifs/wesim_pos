<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h5 class=""><b>Detail Transaksi</b></h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body transaction-body p-0">
            {{-- detail --}}
            <div class="transaction-height overflow-auto cart-scrollbar" id="detail-transaction">
                <div class="row pl-4 p-3">
                    <div class="col"><small class="text-muted">Nomor Transaksi: </small>
                        <h5 class="m-0"><b id="dtl-trx">-</b></h5>
                    </div>
                    <div class="col"><small class="text-muted">Tanggal Transaksi: </small>
                        <h5 class="m-0"><b id="dtl-date">-</b></h5>
                    </div>
                    <div class="col"><small class="text-muted">Pelanggan: </small>
                        <h5 class="m-0"><b id="dtl-member">-</b></h5>
                    </div>
                </div>
                <div>
                    <table class="table table-head-fixed m-0" id="table-detail-transaction">
                        <thead>
                            <tr>
                                <th width="1%">No.</th>
                                <th>Nama Produk</th>
                                <th>Qty.</th>
                                <th>Harga</th>
                                <th>Diskon</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- /.detail --}}

            {{-- sub total --}}
            <hr>
            <div class="row mr-3 ml-3">
                <div class="col-7 text-muted">
                    <span>Total </span> <br>
                </div>
                <div class="col-2 text-muted text-right">
                    <span>: </span> <br>
                </div>
                <div class="col-3">
                    <h4>Rp. <b><span class="total-price" id="total-price">0</span></b></h4>
                </div>
            </div>
            <div class="row mb-3 mr-3">
                <button type="button" class="btn col-3 bg-gradient-primary ml-1 mr-1 ml-auto" data-toggle="modal"
                    data-target="#modal-pay" onclick="printArea($('#detail-transaction'))">
                    <i class="nav-icon fas fa-print mr-2"></i>
                    Print
                </button>
            </div>
            {{-- /.sub total --}}
        </div>
        <!-- /.card-body -->
    </div>
</div>
