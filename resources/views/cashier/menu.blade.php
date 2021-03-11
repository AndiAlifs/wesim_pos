<style>
    .product-item:hover, .category-item:hover {
        background-color:rgb(218, 240, 255);
        cursor: pointer;
    }   
</style>

<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Menu</h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">

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
                                    <img src="https://images.immediate.co.uk/production/volatile/sites/30/2020/08/chorizo-mozarella-gnocchi-bake-cropped-9ab73a3.jpg?quality=90&resize=700%2C636" alt="" width="100%" height="100px">
                                    <b> {{ $row->name }}</b>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- /.category part --}}

            {{-- product part --}}
            <div class="product-part px-3 py-4" onclick="addToCart({{$row->id}})">
                <div class="row px-1">
                    <h3>Produk</h3>
                </div>
                <div>
                    <div class="row">
                        @foreach ($product as $row)
                            <div class="col-sm-2">
                                <div class="card justify-content-center px-1 py-1 product-item">
                                    <img src="https://images.immediate.co.uk/production/volatile/sites/30/2020/08/chorizo-mozarella-gnocchi-bake-cropped-9ab73a3.jpg?quality=90&resize=700%2C636" alt="" width="100%" height="100px">
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


<script>

    function addToCart(id){
        
    }

</script>