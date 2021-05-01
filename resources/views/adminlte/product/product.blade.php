@extends('adminlte.master')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Admin</a>
                    </li>
                    <li class="breadcrumb-item active">Produk</li>
                </ol>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Produk</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatable_pagination"
                                        class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                                        aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                {{-- <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No</th> --}}
                                                <th class="sorting" tabindex="0" aria-controls="example1"
                                                    aria-label="Browser: activate to sort column ascending">ID
                                                    Produk</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1"
                                                    aria-label="Browser: activate to sort column ascending">
                                                    Barcode</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1"
                                                    aria-label="CSS grade: activate to sort column ascending">
                                                    Nama Produk</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1"
                                                    aria-label="CSS grade: activate to sort column ascending">
                                                    Kategori Produk</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1"
                                                    aria-label="Platform(s): activate to sort column ascending">
                                                    Produser Produk</th>
                                                {{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Harga
                                                    Beli</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Harga
                                                    Jual</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Profit
                                                </th> --}}
                                                {{-- <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="">Deskripsi</th> --}}
                                                <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product as $row)
                                                <tr role="row" class="odd">
                                                    {{-- <td tabindex="0" class="sorting_1">PRD-2021-{{ $row->id }}</td> --}}
                                                    <td>
                                                        {{ $row->product_code }}
                                                    </td>
                                                    <td>
                                                        <img src="https://bwipjs-api.metafloor.com/?bcid=ean13&text={{ $row->product_code }}"
                                                            alt="{{ $row->product_code }}" height="60em">
                                                    </td>
                                                    <td>
                                                        <img src="{{ asset('image/product/gambarIndomie' . rand(1, 3) . '.JPG') }}"
                                                            alt="" height="60em">
                                                        <br>
                                                        {{ $row->name }}
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="btn-sm btn btn-{{ $warnaBg[$row->category->first()->id % 6] }} rounded-pill btn-block">
                                                            {{ $row->category->first()->name }}</div>
                                                    </td>
                                                    <td>{{ $row->producer }}</td>
                                                    {{-- <td>Rp. {{ $row->purchase_price }}</td> --}}
                                                    {{-- <td>Rp.
                                                        {{ $row->price - ($row->price * $row->discount_amount) / 100 }}
                                                    </td> --}}
                                                    {{-- <td class="text-success font-weight-bold">Rp.
                                                        {{ $row->price - $row->purchase_price }}</td> --}}
                                                    {{-- <td>{{ $row->description }}</td> --}}
                                                    <td>
                                                        {{-- <button type="button" class="btn-sm btn-warning" data-toggle="modal" data-target="#modal-default{{ $row->id }}">
                                                                                        <i class="nav-icon fas fa-edit"></i>
                                                                                    </button> --}}
                                                        <!-- <a class="btn-sm btn-warning> <i class="nav-icon fas fa-edit"></i></a> -->
                                                        <a onclick="return confirm('Are you sure?')"
                                                            href="/product/destroy/{{ $row->id }}"
                                                            class="btn-sm btn-danger"><i
                                                                class="nav-icon fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        {{-- <tfoot>
                                            <tr>
                                                <th>ID Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Kategori Produk</th>
                                                <th>Produser Produk</th>
                                                {{-- <th>Harga Beli</th>
                                                <th>Harga Jual</th>
                                                <th>Profit</th> --}}
                                        {{-- <th>Deskripsi</th> --}}
                                        {{-- <th>Aksi</th>
                                            </tr>
                                        </tfoot> --}}
                                    </table>
                                    <div class="float-right pt-3">
                                        <a class="btn btn-primary" href="" data-toggle="modal" data-target="#modal-store"><i
                                                class='fa fa-plus-circle'></i> Tambah</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>

    <!-- modal store -->
    <div class="modal fade" id="modal-store">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Produk</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('category_store') }}">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Nama" value="">
                            @if ($errors->has('name'))
                                <div class="text-danger">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" class="form-control" placeholder="Masukan Deskripsi"></textarea>
                            @if ($errors->has('description'))
                                <div class="text-danger">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                        </div>
                        <div class="small text-muted text-right">
                            didaftarkan pada <b>{{ date('Y-m-d') }}</b>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success" value="Simpan">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection
