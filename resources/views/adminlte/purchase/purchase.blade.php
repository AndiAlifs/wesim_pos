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
                    <div class="bg-info p-2 rounded-top card-title">
                        <h3 class="display-4 text-center text-uppercase">Daftar Pembelian
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 table-responsive">
                                    <table id="example2"
                                        class="table table-bordered table-striped dataTable dtr-inline table-responsive"
                                        role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending">No
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending">
                                                    Nomor Transaksi
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
                                                    Tanggal
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
                                                    <td>{{ $row->updated_at }}</td>
                                                    <td width="10%">
                                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                                            data-target="#modal-default">
                                                            <abbr title="edit"><i class="nav-icon fas fa-edit"></i>
                                                        </button>
                                                        <a onclick="return confirm('Are you sure?')" href=""
                                                            class="btn btn-danger"><abbr title="Hapus"><i
                                                                    class="nav-icon fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">No</th>
                                                <th rowspan="1" colspan="1">Nomor Transaksi</th>
                                                <th rowspan="1" colspan="1">User</th>
                                                <th rowspan="1" colspan="1">Supplier</th>
                                                <th rowspan="1" colspan="1">Jumlah Produk</th>
                                                <th rowspan="1" colspan="1">Total Harga</th>
                                                <th rowspan="1" colspan="1">Tanggal</th>
                                                <th rowspan="1" colspan="1">Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="float-right pt-3">
                                        <a class="btn btn-primary" href=""><i class='fa fa-plus-circle'></i>
                                            Print</a>
                                        <a class="btn btn-success" href="{{ route('report_purchase') }}"><i
                                                class='fa fa-plus-circle'></i>
                                            Export To Excel</a>
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
