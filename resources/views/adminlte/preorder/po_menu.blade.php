<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h5 class=""><b>Daftar Menu</b></h5>
                </div>
                <div class="col-4">
                    <div class="input-group input-group-sm">
                        <input type="search" class="form-control search-box" value="" id="search-box" autofocus
                            placeholder="Cari Produk disini" name="key" oninput="searchBox(this.value)"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="input-group-text" onclick=""><i class="fas fa-search"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body overflow-auto menu px-0 py-4">
            {{-- product part --}}
            <div class="product-part px-3">
                <div>
                    <div class="row" id="product-list">
                        @foreach ($product as $row)
                            <div class="col-3">
                                <div type="button" onclick="callModal('',{{ $row->id }})"
                                    class="btn justify-content-center product-item card p-0 div-hover"
                                    data-toggle="modal" data-target="#modal-default" id="product-item">
                                    <div class="card-body p-0">
                                        <div>
                                            <b class="text-dark">{{ $row->name }}</b><br>
                                            <small class="text-dark">
                                                Rp.{{ number_format($row->prices->last()->harga_beli, 0, ',', '.') }}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="card-footer m-0 p-0 progress-group text-left">
                                        <span class="progress progress-md stock-progress rounded-bottom">
                                            @php
                                                $progress = floor(($row->inventory->in_stock / $row->inventory->full_stock) * 100);
                                                $bg_color = '';
                                                if ($progress < 21) {
                                                    $bg_color = 'bg-danger';
                                                } elseif ($progress < 41) {
                                                    $bg_color = 'bg-warning';
                                                } else {
                                                    $bg_color = 'bg-success';
                                                }
                                            @endphp
                                            <span class="progress-bar rounded-bottom-left {{ $bg_color }}"
                                                id="modal-progress-bar"
                                                style="width: {{ $progress }}%; transition: 0s;">
                                            </span>
                                            <small style="position: absolute; left: 25%;">
                                                stok:
                                                <b id="modal-in-stock">{{ $row->inventory->in_stock }}</b>/
                                                <span id="modal-full-stock">{{ $row->inventory->full_stock }}</span>
                                            </small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- /.product part --}}

        </div>
        <!-- /.card-body -->
    </div>
</div>
