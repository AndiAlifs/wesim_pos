<div class="col-md-7">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h5 class=""><b>Daftar Menu</b></h5>
                </div>
                <div class="col-4">
                    <div class="input-group input-group-sm">
                        <input type="search" class="form-control search-box" value="" id="search-box" autofocus
                            placeholder="Cari Produk disini" name="key" oninput="" aria-label="Search">
                        <div class="input-group-append">
                            <button class="input-group-text" onclick=""><i class="fas fa-search"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body overflow-auto menu">
            {{-- product part --}}
            <div class="product-part px-3">
                <div>
                    <div class="row" id="product-list">
                        @foreach ($product as $row)
                            <div class="col-sm-2">
                                <a href="#">
                                    <div type="button" onclick=""
                                        class="btn card justify-content-center px-1 py-1 product-item"
                                        data-toggle="modal" data-target="#modal-default" id="product-item">
                                        <div>
                                            <b class="text-dark">{{ $row->name }}</b><br>
                                            <small class="text-dark">
                                                Rp.{{ number_format($row->price, 0, ',', '.') }}</small>
                                        </div>
                                    </div>
                                </a>
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
