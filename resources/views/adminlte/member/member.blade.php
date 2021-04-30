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
                    <li class="breadcrumb-item active">Member</li>
                </ol>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Member</h3>
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
                                <div class="col-12 table-responsive">
                                    <table id="datatable_pagination"
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
                                                    Nomor Member</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                    Nama</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    Email</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Point
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($members as $row)
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">{{ $loop->iteration }}</td>
                                                    <td>{{ $row->member_id }}</td>
                                                    <td>{{ $row->name }}</td>
                                                    <td>{{ $row->email }}</td>
                                                    <td>{{ $row->point }}</td>
                                                    <td width="10%">
                                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                                            data-target="#modal-default{{ $row->id }}">
                                                            <abbr title="edit"><i class="nav-icon fas fa-edit"></i>
                                                        </button>
                                                        <a onclick="return confirm('Are you sure?')"
                                                            href="{{ route('delete_member', $row->id) }}"
                                                            class="btn btn-danger"><abbr title="Hapus"><i
                                                                    class="nav-icon fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <!-- modal update -->
                                                <div class="modal fade" id="modal-default{{ $row->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Member</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="post"
                                                                action="{{ route('update_member', $row->id) }}">
                                                                <div class="modal-body">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('PUT') }}
                                                                    <div class="form-group">
                                                                        <label>Nama</label>
                                                                        <input type="text" name="name" class="form-control"
                                                                            placeholder="" value="{{ $row->name }}">
                                                                        @if ($errors->has('name'))
                                                                            <div class="text-danger">
                                                                                {{ $errors->first('name') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Nomor Handphone</label>
                                                                        <input name="phone" class="form-control"
                                                                            placeholder=""
                                                                            value="{{ $row->phone }}"></input>
                                                                        @if ($errors->has('phone'))
                                                                            <div class="text-danger">
                                                                                {{ $errors->first('phone') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Email</label>
                                                                        <input name="email" class="form-control"
                                                                            placeholder=""
                                                                            value="{{ $row->email }}"></input>
                                                                        @if ($errors->has('email'))
                                                                            <div class="text-danger">
                                                                                {{ $errors->first('email') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Alamat</label>
                                                                        <input name="address" class="form-control"
                                                                            placeholder=""
                                                                            value="{{ $row->address }}"></input>
                                                                        @if ($errors->has('address'))
                                                                            <div class="text-danger">
                                                                                {{ $errors->first('address') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="small text-muted text-right">
                                                                        terdaftar <b>{{ $row->created_at }}</b> |
                                                                        perbaruan terakhir <b>{{ $row->updated_at }}</b>
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
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">No</th>
                                                <th rowspan="1" colspan="1">Nomor Member</th>
                                                <th rowspan="1" colspan="1">Nama</th>
                                                <th rowspan="1" colspan="1">Email</th>
                                                <th rowspan="1" colspan="1">Point</th>
                                                <th rowspan="1" colspan="1">Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <!-- modal update -->
                                    <div class="modal fade" id="modal-create-member">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Tambah Member</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="{{ route('create_member') }}">
                                                    <div class="modal-body">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}
                                                        <div class="form-group">
                                                            <label>Nama</label>
                                                            <input type="text" name="name" class="form-control"
                                                                placeholder="" value="">
                                                            @if ($errors->has('name'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('name') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nomor Handphone</label>
                                                            <input name="phone" class="form-control" placeholder=""></input>
                                                            @if ($errors->has('phone'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('phone') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input name="email" class="form-control" placeholder=""></input>
                                                            @if ($errors->has('email'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('email') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Alamat</label>
                                                            <input name="address" class="form-control"
                                                                placeholder=""></input>
                                                            @if ($errors->has('address'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('address') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="small text-muted text-right">
                                                            terdaftar <b>{{ $row->created_at }}</b> | perbaruan terakhir
                                                            <b>{{ $row->updated_at }}</b>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                        <input type="submit" class="btn btn-success" value="Simpan">
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                    <div class="float-right pt-3">
                                        <a class="btn btn-primary" href="" data-toggle="modal"
                                            data-target="#modal-create-member"><i class='fa fa-plus-circle'></i> Tambah</a>
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
