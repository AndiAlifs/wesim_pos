<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h3 class="daftar">Daftar Menu</h3>
                </div>
                <div class="col-4">
                    <div class="float-left">
                        {{-- <form> --}}
                        <div class="input-group">
                            <input type="text" class="form-control search-box" value="" id="fokus" autofocus
                                placeholder="Cari Produk disini">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                        {{-- </form> --}}
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
                        @foreach ($category as $row)
                            <div class="col-2 text-center">
                                <div class="card justify-content-center px-1 py-1 category-item">
                                    <img src="https://images.immediate.co.uk/production/volatile/sites/30/2020/08/chorizo-mozarella-gnocchi-bake-cropped-9ab73a3.jpg?quality=90&resize=700%2C636"
                                        alt="" width="100%" height="100px">
                                    <b> {{ $row->name }}</b>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- /.category part --}}

            {{-- product part --}}
            <div class="product-part px-3 py-4">
                <div class="row px-1">
                    <h3>Produk</h3>
                </div>
                <div>
                    <div class="row">
                        @foreach ($product as $row)
                            <div class="col-sm-2">
                                <div type="button" class="btn card justify-content-center px-1 py-1 product-item"
                                    data-toggle="modal" data-target="#modal-default"
                                    onclick="callModal('{{ $row->id }}','{{ $row->price }}','{{ $row->name }}')">
                                    <img src="
                                    https://images.immediate.co.uk/production/volatile/sites/30/2020/08/chorizo-mozarella-gnocchi-bake-cropped-9ab73a3.jpg?quality=90&resize=700%2C636"
                                        alt="" width="100%" height="100px">
                                    <div>
                                        <b>{{ $row->name }}</b><br>
                                        <small> Rp.{{ $row->price }}</small>
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
