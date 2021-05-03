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
                    <li class="breadcrumb-item active">Gudang</li>
                </ol>
                <div class="card">
                    <div class="card-header">Data Gudang</h3>
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
                                <div class="col-sm-12 table-responsive">
                                    <table id="datatable_pagination"
                                        class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                                        aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                {{-- <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No</th> --}}
                                                <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Browser: activate to sort column ascending">ID Produk</th>
                                                <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending">Nama Produk
                                                </th>
                                                <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Platform(s): activate to sort column ascending">Minimum
                                                    Stock</th>
                                                <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Maximum
                                                    Stock</th>
                                                <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Platform(s): activate to sort column ascending">In Stock
                                                </th>
                                                {{-- <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Incoming
                                                    Stock</th> --}}
                                                <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Stock
                                                    Status</th>
                                                <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($inventories as $row)
                                                <tr role="row" class="odd">
                                                    {{-- <td tabindex="0" class="sorting_1">{{ $loop->iteration }}</td> --}}
                                                    <td>PRD-{{ $row->product->id }}</td>
                                                    <td>
                                                        <img src="{{ asset('image/product/gambarIndomie' . rand(1, 3) . '.JPG') }}"
                                                            alt="" height="60em">
                                                        <br>
                                                        {{ $row->product->name }}
                                                    </td>
                                                    <td>{{ $row->min_stock }}</td>
                                                    <td>{{ $row->full_stock }}</td>
                                                    @if ($row->in_stock < $row->min_stock)
                                                        <td class="text-danger font-weight-bolder">
                                                            {{ $row->in_stock }}
                                                        </td>
                                                    @else
                                                        <td>
                                                            {{ $row->in_stock }}
                                                        </td>
                                                    @endif
                                                    {{-- <td>{{ $row->incoming }}</td> --}}
                                                    <td>
                                                        @if ($row->in_stock < 20)
                                                            <div class="progress my-1">
                                                                <div class="progress-bar w-100 h-30 bg-danger"
                                                                    role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                                    aria-valuemax="100">
                                                                    {{ round(($row->in_stock / $row->full_stock) * 100) }}%
                                                                </div>
                                                            </div>
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-danger my-1">Low
                                                                Stock</button>
                                                        @else
                                                            <div class="progress my-1">
                                                                <div class="progress-bar w-100 h-30  bg-info"
                                                                    role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                                    aria-valuemax="100">
                                                                    {{ round(($row->in_stock / $row->full_stock) * 100) }}%
                                                                </div>
                                                            </div>
                                                        @endif
                                                        {{-- @if ($row->incoming > 0)
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-info my-1">On
                                                                Delivery</button>
                                                        @endif --}}

                                                    </td>
                                                    <td>
                                                        {{-- @if ($row->incoming > 0)
                                                            <a onclick="return confirm('Konfirmasi PO telah diterima?')"
                                                                href="/inventory/confirm_ship/{{ $row->id }}"
                                                                class="btn btn-sm my-1 btn-success">
                                                                <i class="nav-icon fas fa-truck"></i> Confirm Ship
                                                            </a>
                                                        @endif --}}
                                                        <button type="button" class="btn btn-sm my-1 btn-warning"
                                                            data-toggle="modal"
                                                            data-target="#modal-tambah-{{ $row->id }}">
                                                            <i class="nav-icon fas fa-edit"></i> Edit Stock
                                                        </button>
                                                        <a onclick="return confirm('Are you sure?')"
                                                            href="/product/destroy/{{ $row->id }}"
                                                            class="btn btn-sm my-1 btn-danger">
                                                            <i class="nav-icon fas fa-trash"></i> Delete Stock
                                                        </a>
                                                    </td>
                                                </tr>

                                                <div class="modal fade" id="modal-tambah-{{ $row->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Stok</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <form method="post"
                                                                action="/inventory/update/{{ $row->id }}">
                                                                <div class="modal-body">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('PUT') }}

                                                                    <div class="form-group">
                                                                        <label>Produk Id</label>
                                                                        <p>PRD-{{ $row->product->id }}</p>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Nama Produk</label>
                                                                        <p>{{ $row->product->name }}</p>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>In Stock</label>
                                                                        <input type="text" name="in_stock"
                                                                            class="form-control"
                                                                            placeholder="Masukan jumlah stock saat ini "
                                                                            value="{{ $row->in_stock }}">
                                                                        @if ($errors->has('in_stock'))
                                                                            <div class="text-danger">
                                                                                {{ $errors->first('in_stock') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    {{-- <div class="form-group">
                                                                        <label>Incoming Stock</label>
                                                                        <input type="text" name="incoming_stock"
                                                                            class="form-control"
                                                                            placeholder="Masukan jumlah stock yang akan datang"
                                                                            value="{{ $row->incoming }}">
                                                                        @if ($errors->has('incoming_stock'))
                                                                            <div class="text-danger">
                                                                                {{ $errors->first('incoming_stock') }}
                                                                            </div>
                                                                        @endif
                                                                    </div> --}}

                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">Close</button>
                                                                    <input type="submit" class="btn btn-success"
                                                                        value="Simpan">
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
                                        <!-- <tfoot>
                                                                                                                                                        <tr>
                                                                                                                                                            <th rowspan="1" colspan="1">No</th>
                                                                                                                                                            <th rowspan="1" colspan="1">Name</th>
                                                                                                                                                            <th rowspan="1" colspan="1">Username</th>
                                                                                                                                                            <th rowspan="1" colspan="1">Em  ail</th>
                                                                                                                                                            <th rowspan="1" colspan="1">Role</th>
                                                                                                                                                            <th rowspan="1" colspan="1">Aksi</th>
                                                                                                                                                        </tr>
                                                                                                                                                    </tfoot> -->
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

@endsection
