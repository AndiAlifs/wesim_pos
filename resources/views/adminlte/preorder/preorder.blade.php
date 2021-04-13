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
                    <li class="breadcrumb-item active">Pembelian</li>
                </ol>

                <!-- Card Daftar Pembelian -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-table"></i> Daftar Pembelian</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatable_pagination"
                                        class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                                        aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending">No
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending">
                                                    Nomor Pre Order
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    User
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    Supplier
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">
                                                    Jumlah Produk
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">
                                                    Total Harga
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">
                                                    Tanggal PO
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">
                                                    Perkiraan Sampai
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">
                                                    Aksi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($purchaseTransaction as $row)
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">{{ $loop->iteration }}</td>
                                                    <td>{{ $row->transaction_number }}</td>
                                                    <td>{{ $row->user->name }}</td>
                                                    <td>{{ $row->supplier->name }}</td>
                                                    <td>{{ $row->product_count }}</td>
                                                    <td>{{ $row->total_price }}</td>
                                                    <td>{{ $row->created_at }}</td>
                                                    <td>{{ $row->created_at }}</td>
                                                    <td width="10%">
                                                        <button type="button" class="btn btn-success my-2" data-toggle="modal"
                                                            data-target="#modal-default{{ $row->id }}">
                                                            <i class="nav-icon fas fa-edit"></i>Confirm Ship
                                                        </button>
                                                        <a onclick="return confirm('Are you sure?')" href=""
                                                            class="btn btn-danger"><i
                                                                    class="nav-icon fas fa-trash"></i>Delete</a>
                                                    </td>
                                                </tr>

                                                <div class="modal fade" id="modal-default{{ $row->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Confirm Ship</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="post" action="/product/update/{{ $row->id }}">
                                                                <div class="modal-body">
                                                                    {{ csrf_field() }}

                                                                    @foreach ($row->purchases as $item)
                                                                        <div class="form-group">
                                                                            <img src="{{ $item->product->image }}" width="100em">
                                                                            <span class="ml-3 text-uppercase">{{ $item->product->name }}</span>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Jumlah produk diterima</label>
                                                                            <input type="text" name="name" class="form-control"
                                                                                placeholder="Masukan jumlah"
                                                                                >
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Harga Satuan</label>
                                                                            <div class="row">
                                                                                <div class="col-1">Rp. </div>
                                                                                <div class="col-11">
                                                                                    <input type="text" name="name" class="form-control"
                                                                                        placeholder="Masukan harga persatuan"
                                                                                        value="{{ $item->product->prices->last()->harga_beli }}">

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                        
                                                                    @endforeach
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <div class="form-group">
                                                                        <button class="btn bg-success" type="submit">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->

                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">No</th>
                                                <th rowspan="1" colspan="1">Nomor Pre Order</th>
                                                <th rowspan="1" colspan="1">User</th>
                                                <th rowspan="1" colspan="1">Supplier</th>
                                                <th rowspan="1" colspan="1">Jumlah Produk</th>
                                                <th rowspan="1" colspan="1">Total Harga</th>
                                                <th rowspan="1" colspan="1">Tanggal PO</th>
                                                <th rowspan="1" colspan="1">Perkiraan Sampai</th>
                                                <th rowspan="1" colspan="1">Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="float-right pt-3">
                                        <a class="btn btn-primary" href="{{ route('preorder_cashier') }}"><i
                                                class='fa fa-plus-circle'></i>
                                            Tambah</a>
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

@endsection
