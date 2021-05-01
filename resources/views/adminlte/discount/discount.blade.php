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
                    <li class="breadcrumb-item active">Diskon</li>
                </ol>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Diskon</h3>
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
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending">No
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending">ID
                                                    Produk</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                    Nama Produk</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Harga
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    Diskon (%)</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Total
                                                </th>
                                                <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="">Alasan</th>
                                                <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $row)
                                                @if ($row->discount_amount != 0)
                                                    <tr role="row" class="odd">
                                                        <td tabindex="0" class="sorting_1">{{ $loop->iteration }}</td>
                                                        <td>{{ $row->product_code }}</td>
                                                        <td>{{ $row->name }}</td>
                                                        <td>Rp. {{ $row->price }}</td>
                                                        <td>{{ $row->discount_amount }}%</td>
                                                        <td>Rp.
                                                            {{ $row->price - ($row->price * $row->discount_amount) / 100 }}
                                                        </td>
                                                        <td>{{ $row->discount_reason ?? 'Tidak ada' }}</td>
                                                        <td width="10%">
                                                            <button type="button" class="btn btn-warning"
                                                                data-toggle="modal"
                                                                data-target="#modal-default{{ $row->id }}">
                                                                <abbr title="edit"><i class="nav-icon fas fa-edit"></i>
                                                            </button>
                                                            <a onclick="return confirm('Are you sure?')"
                                                                href="{{ route('discount_destroy', $row->id) }}"
                                                                class="btn btn-danger"><abbr title="Hapus"><i
                                                                        class="nav-icon fas fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    <!-- modal update -->
                                                    <div class="modal fade" id="modal-default{{ $row->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Edit Diskon</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form method="post"
                                                                    action="{{ route('discount_update') }}">
                                                                    <div class="modal-body">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('PUT') }}

                                                                        <div class="form-group">
                                                                            <label>Produk</label>
                                                                            <input type="hidden" name="product_code"
                                                                                value="{{ $row->product_code }}">
                                                                            <input name="name" class="form-control"
                                                                                readonly="readonly" disabled
                                                                                value="{{ $row->name }}"></input>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Jumlah (%)</label>
                                                                            <input name="discount_amount" min="0" max="100"
                                                                                type="number"
                                                                                value="{{ $row->discount_amount }}"
                                                                                class="form-control"
                                                                                placeholder="Masukan Jumlah"></input>
                                                                            @if ($errors->has('discount_amount'))
                                                                                <div class="text-danger">
                                                                                    {{ $errors->first('discount_amount') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Alasan</label>
                                                                            <input name="discount_reason"
                                                                                value="{{ $row->discount_reason }}"
                                                                                class="form-control"
                                                                                placeholder="Alasan Diskon"></input>
                                                                            @if ($errors->has('discount_reason'))
                                                                                <div class="text-danger">
                                                                                    {{ $errors->first('discount_reason') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        <div class="small text-muted text-right">
                                                                            didaftarkan pada <b>{{ date('Y-m-d') }}</b>
                                                                        </div>
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
                                                @endif

                                            @endforeach
                                        </tbody>
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
                    <h4 class="modal-title">Tambah Diskon</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('discount_update') }}">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>Produk</label>
                            <select name="product_code" class="form-control">
                                @foreach ($products as $row)
                                    @if ($row->discount_amount == 0)
                                        <option value="{{ $row->product_code }}">{{ $row->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah (%)</label>
                            <input name="discount_amount" min="0" max="100" type="number" class="form-control"
                                placeholder="Masukan Jumlah "></input>
                            @if ($errors->has('discount_amount'))
                                <div class="text-danger">
                                    {{ $errors->first('discount_amount') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Alasan</label>
                            <input name="discount_reason" class="form-control" placeholder="Alasan Diskon"></input>
                            @if ($errors->has('discount_reason'))
                                <div class="text-danger">
                                    {{ $errors->first('discount_reason') }}
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
