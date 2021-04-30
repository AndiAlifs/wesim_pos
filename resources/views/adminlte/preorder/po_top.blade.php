<div class="card p-3">
    <div class="row">
        <div class="col-8 border-right">
            <div class="row">
                <div class="col">
                    <small class="text-muted">Nomor Preorder:</small>
                    <h5 class="m-0"><b id="dtl-trx">{{ $purchaseTransaction->transaction_number }}</b></h5>
                    <input type="hidden" id="purchase-transaction-id" value="{{ $purchaseTransaction->id }}">
                </div>
                <div class="col">
                    <small class="text-muted">User: </small>
                    <input type="hidden" id="dtl-user" value="{{ Auth::user()->id }}">
                    <h5 class="m-0"><b>{{ Auth::user()->name }}</b></h5>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <small class="text-muted">Pemasok: </small>
                    <div class="row">
                        <div class="input-group input-group-sm col-9">
                            <input name="supplier-id" list="supplier-id" class="form-control" id="supplier-input"
                                placeholder="---Pilih Supplier---" value="UMUM (1)" onfocus="this.value = ''"
                                onchange="addSupplier(this.value)">
                            <datalist id="supplier-id">
                                <option value="--- Tambah Supplier ---">
                                    @foreach ($supplier as $row)
                                <option value="{{ $row->name . ' (' . $row->id . ')' }}">
                                    @endforeach
                            </datalist>
                            {{-- <div class="input-group-append">
                                <a href="{{ route('supplier') }}" class="input-group-text pl-3 pr-3"> + </a>
                            </div> --}}
                        </div>

                    </div>
                </div>
                <div class="col form-group">
                    <small class="text-muted">Tanggal Transaksi: </small>
                    <div class="input-group input-group-sm col-9">
                        <input type="datetime-local" class="form-control" id="dtl-date" placeholder="Tanggal" value=""
                            disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="row pt-3">
                <div class="col-3">Total </div>
                <div class="col-1 text-right">:</div>
                <div class="col-8">
                    <h4>Rp. <b><span class="total-price" id="total-price">0</span></b></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <a href="{{ __('preorder') }}" id="preorder-link"
                        class="btn btn-block bg-gradient-danger ml-auto">
                        Batal
                    </a>
                </div>
                <div class="col-8">
                    <button type="button" class="btn btn-block bg-gradient-primary ml-auto"
                        onclick="order()">Order</button>
                </div>
            </div>
        </div>
    </div>
</div>
