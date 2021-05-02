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
                    <li class="breadcrumb-item active">Riwayat Harga</li>
                </ol>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Product</h3>
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
                                <div class="table-responsive">
                                    <table id="datatable_pagination"
                                        class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                                        aria-describedby="example1_info" data-ordering="false">
                                        <thead>
                                            <tr role="row">
                                                <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Browser: activate to sort column ascending">ID
                                                    Produk</th>
                                                <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending">
                                                    Nama Produk</th>
                                                <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Harga
                                                    Beli</th>
                                                <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Harga
                                                    Jual</th>
                                                <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Profit
                                                </th>
                                                <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Update
                                                </th>
                                                <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                                    aria-label="">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($prices as $row)
                                                <tr role="row" class="odd">
                                                    <td>
                                                        <img src="https://bwipjs-api.metafloor.com/?bcid=ean13&text={{ $row->product_code }}"
                                                            alt="{{ $row->product_code }}" height="60em">
                                                        {{ $row->product->product_code }}
                                                    </td>
                                                    <td>
                                                        <img src="{{ $row->product->image }}"
                                                            alt="" height="60em">
                                                        <br>
                                                        {{ $row->product->name }}
                                                    </td>
                                                    <td>Rp. {{ $row->harga_beli }}</td>
                                                    <td>Rp.
                                                        {{ $row->harga_jual }}</td>
                                                    <td class="font-weight-bolder text-success">{{ $row->profit * 100 }}%
                                                    </td>
                                                    <td>{{ $row->last_update }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning m-1"
                                                            data-toggle="modal"
                                                            data-target="#modal-edit-{{ $row->id }}">
                                                            <i class="nav-icon fas fa-edit"></i>
                                                        </button>
                                                        <a onclick="return confirm('Are you sure?')"
                                                            href="/user/destroy/{{ $row->id }}"
                                                            class="btn btn-sm btn-danger m-1"><i
                                                                class="nav-icon fas fa-trash"></i></a>
                                                    </td>


                                                    <div class="modal fade" id="modal-edit-{{ $row->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Edit Harga Produk</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <form method="post" action="{{ route('price_update') }}">
                                                                    <div class="modal-body">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('PUT') }}

                                                                        <div class="form-group row">
                                                                            <div class="col-2">
                                                                                <img src="{{ $row->product->image }}"
                                                                                    width="100em">
                                                                            </div>
                                                                            <div class="col-9 p-3 pl-5">
                                                                                <span
                                                                                    class="text-uppercase">{{ $row->product->name }}</span><br>
                                                                                <span>{{ $row->product->product_code }}
                                                                                </span>
                                                                            </div>
                                                                        </div>

                                                                        <div>
                                                                            <input type="text" id="product_id"
                                                                                name="product_id" hidden
                                                                                value="{{ $row->product_id }}">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Harga Beli</label>
                                                                            <div class="row">
                                                                                <div class="col-1 pt-1">Rp. </div>
                                                                                <div class="col-11">
                                                                                    <input type="number" name="harga_beli"
                                                                                        class="form-control"
                                                                                        placeholder="Masukan harga persatuan"
                                                                                        value="{{ $row->harga_beli }}"
                                                                                        readonly>

                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Harga Jual</label>
                                                                            <div class="row">
                                                                                <div class="col-1 pt-1">Rp. </div>
                                                                                <div class="col-11">
                                                                                    <input type="number" name="harga_jual"
                                                                                        class="form-control"
                                                                                        placeholder="Masukan harga persatuan"
                                                                                        value="{{ $row->harga_jual }}">
                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Profit</label></label>
                                                                            <div class="row">
                                                                                <input type="number" name="profit"
                                                                                    class="form-control"
                                                                                    placeholder="Masukan harga persatuan"
                                                                                    value="{{ $row->profit }}"
                                                                                    step="0.01">
                                                                            </div>
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
                                                </tr>
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

@push('script-footer')
    <script>
        $('#datatable_pagination').DataTable({
            "ordering": true
        });

    </script>
@endpush
