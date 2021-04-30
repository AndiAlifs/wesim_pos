@extends('adminlte.master')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar User</h3>
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
                                        class="table table-bordered table-striped dataTable dtr-inline table-responsive"
                                        role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending">No
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending">Nama
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                    Username</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    Email</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Role</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Last
                                                    Login</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Last IP
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Status
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user as $row)
                                                {{-- <p>{{ $row }}</p> --}}
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">{{ $loop->iteration }}</td>
                                                    <td>{{ $row->name }}</td>
                                                    <td>{{ $row->username }}</td>
                                                    <td>{{ $row->email }}</td>
                                                    <td>{{ $row->role->role_name }}</td>
                                                    <td>{{ $row->last_login }}</td>
                                                    <td>{{ $row->last_ip }}</td>
                                                    <td>
                                                        @if ($row->status == 'active')
                                                            <span class="text-success font-weight-bold">Active</span>
                                                        @else
                                                            <span class="text-danger font-weight-bold">Not Active</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning m-1"
                                                            data-toggle="modal"
                                                            data-target="#modal-default{{ $row->id }}">
                                                            <i class="nav-icon fas fa-edit"></i>
                                                        </button>
                                                        <a onclick="return confirm('Are you sure?')"
                                                            href="/user/destroy/{{ $row->id }}"
                                                            class="btn btn-sm btn-danger m-1"><i
                                                                class="nav-icon fas fa-trash"></i></a>
                                                    </td>
                                                </tr>

                                                <div class="modal fade" id="modal-default{{ $row->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit User</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="post" action="/user/update/{{ $row->id }}">
                                                                <div class="modal-body">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('PUT') }}

                                                                    <div class="form-group">
                                                                        <label>Nama</label>
                                                                        <input type="text" name="name" class="form-control"
                                                                            placeholder="Masukan Nama"
                                                                            value="{{ $row->name }}">
                                                                        @if ($errors->has('name'))
                                                                            <div class="text-danger">
                                                                                {{ $errors->first('name') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Username</label>
                                                                        <input type="text" name="username"
                                                                            class="form-control"
                                                                            placeholder="Masukan Username"
                                                                            value="{{ $row->username }}">
                                                                        @if ($errors->has('username'))
                                                                            <div class="text-danger">
                                                                                {{ $errors->first('username') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Email</label>
                                                                        <input type="text" name="email" class="form-control"
                                                                            placeholder="Masukan Email"
                                                                            value="{{ $row->email }}">
                                                                        @if ($errors->has('email'))
                                                                            <div class="text-danger">
                                                                                {{ $errors->first('email') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Password</label>
                                                                        <input type="password" name="password"
                                                                            class="form-control"
                                                                            placeholder="Masukan Password" value="">
                                                                        @if ($errors->has('password'))
                                                                            <div class="text-danger">
                                                                                {{ $errors->first('password') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Status</label>
                                                                        <br>
                                                                        <select name="status" id="status">
                                                                            @if ($row->status == 'active')
                                                                                <option value="active" selected>Active
                                                                                </option>
                                                                                <option value="not active">Not Active
                                                                                </option>
                                                                            @else
                                                                                <option value="active">Active</option>
                                                                                <option value="not active" selected>Not
                                                                                    Active</option>
                                                                            @endif
                                                                        </select>
                                                                        @if ($errors->has('status'))
                                                                            <div class="text-danger">
                                                                                {{ $errors->first('status') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Role</label>
                                                                        <br>
                                                                        <select name="role" id="role">
                                                                            @foreach ($roles as $role)

                                                                                <option value="{{ $role->id }}"
                                                                                    {{ $role->role_name == $row->role->role_name ? 'selected' : '' }}>
                                                                                    {{ $role->role_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @if ($errors->has('role'))
                                                                            <div class="text-danger">
                                                                                {{ $errors->first('role') }}
                                                                            </div>
                                                                        @endif
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
                                                <th rowspan="1" colspan="1">Name</th>
                                                <th rowspan="1" colspan="1">Username</th>
                                                <th rowspan="1" colspan="1">Email</th>
                                                <th rowspan="1" colspan="1">Role</th>
                                                <th rowspan="1" colspan="1">Last Login</th>
                                                <th rowspan="1" colspan="1">Last IP</th>
                                                <th rowspan="1" colspan="1">Status</th>
                                                <th rowspan="1" colspan="1">Aksi</th>
                                            </tr>
                                        </tfoot>
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
                    <h4 class="modal-title">Tambah User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('user_store') }}">
                    <div class="modal-body">
                        @csrf

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
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukan Username" value="">
                            @if ($errors->has('username'))
                                <div class="text-danger">
                                    {{ $errors->first('username') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Masukan Email" value="">
                            @if ($errors->has('email'))
                                <div class="text-danger">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukan Password"
                                value="">
                            @if ($errors->has('password'))
                                <div class="text-danger">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <br>
                            <select name="role" id="role">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('role'))
                                <div class="text-danger">
                                    {{ $errors->first('role') }}
                                </div>
                            @endif
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
