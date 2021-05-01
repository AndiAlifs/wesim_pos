{{-- product --}}
<div class="row" id="hide-product-list" style="display: none">
    {{-- @foreach ($product as $row) --}}
    <div class="col-sm-2" style="min-width: 125px; max-width: 125px;">
        <a href="#">
            <div type="button" class="btn card justify-content-center px-1 py-1 product-item" id="product-item"
                data-toggle="modal" data-target="#modal-default" onclick="callModal('','{{ '$row->id' }}')">
                <img src="" alt="" id="product-image">
                <div>
                    <b class="text-dark" id="product-name">{{ '$row->product->name' }}</b><br>
                    <small class="text-dark" id="product-price">
                        Rp.{{ '$row->product->prices->last()->harga_jual' }}</small>
                </div>
            </div>
        </a>
    </div>
    {{-- @endforeach --}}
</div>

<!-- -------------------------------product modal------------------------------------- -->
<div class="modal fade modal-class" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-head modal-product-head" id="#modal-image">
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
                        <b>
                            <h3 id="modal-name">Nama Produk</h3>
                        </b>
                        <div class="progress-group text-left" id="stock-bar">
                            <span id="stock-tittle">Stock :</span>
                            <span class="float-right">
                                <b id="modal-in-stock">310</b>/
                                <span id="modal-full-stock">400</span>
                            </span>
                            <div class="progress progress-sm stock-progress">
                                <div class="progress-bar" id="modal-progress-bar" style="width: 0%; transition: 0s;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-harga" class="col-sm-3 col-form-label">Harga (Rp)</label>
                        <div class="col-sm-9">
                            <input name="price" type="text" class="form-control" id="modal-price" placeholder="Harga"
                                value="" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-number" class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm-9">
                            <input name="amount" type="number" class="form-control modal-amount" id="modal-amount"
                                placeholder="Jumlah" value="1" min="1" oninput="modalInput(this.value)">
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




{{-- ------------------------cart item--------------------------- --}}
<div class="hide-list" id="hide-list">
    <div class="card cart-item border" id="cart-item" type="button">
        <div class="row">
            <div class="col-8 border-right border-secondary cart-hover" data-toggle="modal"
                data-target="#modal-default">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="p-1">
                            <img src="" alt="" width="60px" height="60x" id="set-image">
                            {{-- <b> {{ $row->name }}</b> --}}
                        </div>
                    </div>
                    <div class="col-sm-6 mt-2 overflow-hidden">
                        <div>
                            <b class="overflow-hidden no-wrap" id="set-name">Lorem, ipsum dolor.</b>
                            <p class="small text-muted">Rp. <span id="set-price">xx.xxx</span> </p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="vertical-center">
                            <div class="text-muted">
                                <span>&#10005;</span><span id="set-amount">xxx</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="vertical-center">
                    Rp. <span id="set-total">xx.xxx</span>
                    <span id="close-btn">
                        {{-- <button type="button" class="btn bg-gradient-danger btn-xs float-right mr-2" onclick="deleteCart()">&#10005;</button> --}}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- -------------------------------modal bayar------------------------------------- -->
<div class="modal modal-class" id="modal-pay">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-head">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group pay-row row">
                        <div class="col form-group">
                            <small><label for="transaction-number" class="col col-form-label text-muted small">Nomor
                                    Transaksi</label></small>
                            <div class="col-sm">
                                <input type="text" class="form-control pay-input" id="transaction-number"
                                    placeholder="Nomor Transaksi" disabled>
                            </div>
                        </div>
                        <div class="col form-group">
                            <small><label for="inputEmail3"
                                    class="col col-form-label text-muted">Tanggal</label></small>
                            <div class="col-sm">
                                <input type="datetime-local" class="form-control pay-input" id="transaction-date"
                                    placeholder="Tanggal" value="" disabled>
                            </div>

                        </div>
                    </div>
                    <div class="form-group pay-row row">
                        <div class="col form-group">
                            <small><label for="member-id"
                                    class="col col-form-label text-muted small">Pelanggann</label></small>
                            <div class="col-sm">
                                <input name="member-id" list="member-id" class="form-control" id="member-input"
                                    placeholder="--Pilih Pelanggann--" value="UMUM (1000001)" onfocus="this.value = ''">
                                <datalist id="member-id">
                                    @foreach ($member as $row)
                                        <option value="{{ $row->name . ' (' . $row->member_id . ')' }}">
                                    @endforeach
                                </datalist>
                            </div>
                        </div>
                        <div class="col form-group">
                            <small><label for="cashier-id" class="col col-form-label text-muted">Kasir</label></small>
                            <div class="col-sm">
                                <input name="cashier-id" type="text" class="form-control pay-input" id="cashier-id"
                                    placeholder="Cashier" value="{{ Auth::user()->name }}"
                                    data-user-id="{{ Auth::user()->id }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group pay-row row">
                        <div class="form-group col">
                            <label for="total-pay" class="col col-form-label text-muted">Total Belanja (Rp)</label>
                            <div class="col-sm">
                                <input type="text" class="form-control pay-input-total" id="total-pay"
                                    placeholder="Total Belanja" value="0" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group pay-row row">
                        <div class="col-5 form-group">
                            <small><label for="cash-pay" class="col col-form-label text-muted small">Bayar Tunai (Rp)
                                </label></small>
                            <div class="col-sm">
                                <input type="text" class="form-control pay-input number-input" id="cash-pay"
                                    placeholder="Jumlah Uang Bayar" oninput="cashPayInput()" value="0">
                            </div>
                        </div>
                        <div class="col-7 form-group">
                            <small><label for="non-cash-pay" class="col col-form-label text-muted">Bayar
                                    Non-Tunai (Rp)</label></small>
                            <div class="col row">
                                <input list="pay-bank" class="form-control pay-input col-4 mx-2"
                                    placeholder="--Pilih Bank--">
                                <datalist id="pay-bank">
                                    <option value="BNI">
                                    <option value="BRI">
                                    <option value="BTN">
                                    <option value="MANDIRI">
                                    <option value="Bank Sultra">
                                </datalist>
                                <input type="text" class="form-control pay-input col-7 mx-2" id="non-cash-pay-cost"
                                    placeholder="Jumlah Bayar" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group pay-row row">
                        <div class="col-5"></div>
                        <div class="col-7 form-group">
                            <small><label for="paid_cost" class="col col-form-label text-muted">Total
                                    Bayar
                                    (Rp)</label></small>
                            <div class="col-sm">
                                <input type="text" class="form-control pay-input" id="paid-cost"
                                    placeholder="Total Bayar" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group pay-row row">
                        <div class="col-5"></div>
                        <div class="col-7 form-group">
                            <small><label for="return-cost" class="col col-form-label text-muted">Kembalian
                                    (Rp)</label></small>
                            <div class="col-sm">
                                <input type="text" class="form-control pay-input" id="return-cost"
                                    placeholder="Kembalian" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <div class="form-check">
                                {{-- <input type="checkbox" class="form-check-input" id="exampleCheck2"> --}}
                                {{-- <label class="form-check-label" for="exampleCheck2">Remember me</label> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <button data-dismiss="modal" type="button"
                        class="btn btn-block btn-modal bg-gradient-primary text-center modal-btn"
                        onclick="payTransaction()">
                        <b>Bayar</b>
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
