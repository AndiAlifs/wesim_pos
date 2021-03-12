<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h3 class="">Daftar Menu</h3>
                </div>
                <div class="col-4">
                    <div class="float-left">
                        <form class="form-inline" action="" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control fokus" autofocus value="{{ old('cari') }}"
                                    id="fokus">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                        </form>
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
                        <div class="col-sm-2">
                            <div class="card justify-content-center px-1 py-1 category-item">
                                <img src="#" alt="" width="100%" height="100px">
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
                                data-toggle="modal" data-target="#modal-default{{ $row->id }}"">
                                    <img src=" #" alt="" width="100%" height="100px">
                                <div>
                                    <b>{{ $row->name }}</b><br>
                                    <small> Rp.{{ $row->price }}</small>
                                </div>
                            </div>
                        </div>

                        <!-- modal -->
                        <div class="modal fade modal-class" id="modal-default{{ $row->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header modal-head">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" class="form-horizontal mx-3"
                                        action="{{ route('add_to_cart') }}">

                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}

                                        <div class="modal-body">
                                            <div class="form-group text-center">
                                                <h3>{{ $row->name }}</h3>
                                            </div>
                                            <div class="form-group">
                                                <input name="transaction_id" type="hidden" class="form-control"
                                                    value="1111" disabled>
                                                <input name="price" type="hidden" class="form-control"
                                                    value="{{ $row->id }}" disabled>
                                            </div>
                                            <div class="form-group row">
                                                <label for="input-harga{{ $row->id }}"
                                                    class="col-sm-3 col-form-label">Harga</label>
                                                <div class="col-sm-9">
                                                    <input name="price" type="email" class="form-control"
                                                        id="input-harga{{ $row->id }}" placeholder="Harga"
                                                        value="Rp. {{ $row->price }}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="input-number{{ $row->id }}"
                                                    class="col-sm-3 col-form-label">Jumlah</label>
                                                <div class="col-sm-9">
                                                    <input name="amount" type="number" class="form-control price"
                                                        id="modal{{ $row->id }}" placeholder="Jumlah"
                                                        onchange="totalPay( {{ $loop->iteration }}, {{ $row->price }})"
                                                        value="1" min="1">
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            {{-- number_format(number,desimal_digit, desimal_seperator, thousand_seperator) --}}
                                            <button class="btn btn-block btn-modal bg-gradient-primary text-center"
                                                type="submit"
                                                {{-- onclick="addToCart( {{ $loop->iteration }}, '{{ $row->name }}'
                                                ,{{ $row->price }},{{ $row->id }})" --}}>
                                                <b>Masukkan
                                                    ke
                                                    Keranjang</b>
                                                {{ number_format($row->price, 0, ',', '.') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->

                        @endforeach
                    </div>
                </div>
            </div>
            {{-- /.product part --}}

        </div>
        <!-- /.card-body -->
    </div>
</div>

{{-- add to row list --}}
<div class="hide-list" id="hide-list">
    <div class="card cart-item">
        <div class="row">
            <div class="col-sm-2">
                <div class="p-2">
                    <img src="#" alt="" width="50px" height="50x">
                    {{-- <b> {{ $row->name }}</b> --}}
                </div>
            </div>
            <div class="col-sm-4 mt-2">
                <div>
                    <b class="set_name">Ayam Bakar</b>
                    <p class="small text-muted set_price"> Rp. 30.000 </p>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="vertical-center border-right border-secondary">
                    <div class="text-muted">
                        <span>&#10005;</span><span class="set_ammount">300</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="vertical-center">
                    <span class="set_total">Rp. 90.0000</span>
                    <button type="button" class="btn bg-gradient-danger btn-xs float-right mr-2" onclick="deleteCart()">
                        &#10005;
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function totalPay(index, price) {
        // get price value from input index
        ammount = $('.price')[index - 1].value;

        // set price to btn-modal
        total = new Intl.NumberFormat('id-ID').format(price * ammount);
        $('.btn-modal')[index - 1].innerHTML = '<b>Masukkan ke Keranjang</b> ' + (total);
    }

    var list, total_harga = 0;

    function addToCart(index, name, price, id) {
        // get price value from input index
        ammount = $('.price')[index - 1].value;

        // set new data to .new-list
        $('.cart-item')[0].addClass = 'cart-' + id;
        $('.set_name')[0].innerHTML = name;
        $('.set_price')[0].innerHTML = new Intl.NumberFormat('id-ID').format(price);
        $('.set_ammount')[0].innerHTML = new Intl.NumberFormat('id-ID').format(ammount);

        total = new Intl.NumberFormat('id-ID').format(price * ammount);
        $('.set_total')[0].innerHTML = total;

        // set new list to .cart-list
        list = $('.hide-list')[0].innerHTML;
        $('.cart-list')[0].innerHTML += list;

        parseInt(total);
        total_harga = total_harga + (price * ammount);

        $('.total_harga')[0].innerHTML = new Intl.NumberFormat('id-ID').format(total_harga);
        $('.total_harga')[1].innerHTML = new Intl.NumberFormat('id-ID').format(total_harga);
    }

    function deleteCart() {

    }

</script>
