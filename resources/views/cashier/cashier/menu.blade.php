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
                            <button class="input-group-text" onclick="searchBox($('#search-box').val())"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body overflow-auto menu">
            {{-- category part --}}
            <div class="category-part px-3">
                <div class="row px-1">
                    <h3>Kategori Produk</h3>
                </div>
                <div>
                    <div class="row">
                        <div class="col-2 text-center btn">
                            <a href="{{ route('cashier') }}">
                                <div class="card justify-content-center px-1 py-1 category-item">
                                    <img src="https://images.immediate.co.uk/production/volatile/sites/30/2020/08/chorizo-mozarella-gnocchi-bake-cropped-9ab73a3.jpg?quality=90&resize=700%2C636"
                                        alt="" width="100%" height="100px">
                                    <b class="text-dark"> Semua Kategori</b>
                                </div>
                            </a>
                        </div>
                        @foreach ($category as $row)
                            <div class="col-2 text-center btn">
                                <a href="{{ route('filter_category', $row->id) }}">
                                    <div class="card justify-content-center px-1 py-1 category-item">
                                        <img src="https://images.immediate.co.uk/production/volatile/sites/30/2020/08/chorizo-mozarella-gnocchi-bake-cropped-9ab73a3.jpg?quality=90&resize=700%2C636"
                                            alt="" width="100%" height="100px">
                                        <b class="text-dark"> {{ $row->name }}</b>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- /.category part --}}

            {{-- product part --}}
            <div class="product-part px-3 py-4">
                <div class="row px-1">
                    <h3>
                        Daftar Produk
                        <b id="product-category">
                            {{ Route::is('filter_category') ? '| Kategori ' . $product[0]->category->name : '' }}
                        </b>
                    </h3>
                </div>
                <div>
                    <div class="row" id="product-list">
                        @foreach ($product as $row)
                            <div class="col-sm-2">
                                <a href="#">
                                    <div type="button" onclick="callModal('','{{ $row->id }}')"
                                        class="btn card justify-content-center px-1 py-1 product-item"
                                        data-toggle="modal" data-target="#modal-default" id="product-item">
                                        <img src="
                                    https://images.immediate.co.uk/production/volatile/sites/30/2020/08/chorizo-mozarella-gnocchi-bake-cropped-9ab73a3.jpg?quality=90&resize=700%2C636"
                                            alt="" width="100%" height="100px">
                                        <div>
                                            <b class="text-dark">{{ $row->product->name }}</b><br>
                                            <small class="text-dark"> Rp.{{ $row->product->price }}</small>
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
