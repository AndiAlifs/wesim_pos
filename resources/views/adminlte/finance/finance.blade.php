@extends('adminlte.master')

@section('content')
<div class="container-fluid"
    <div class="d-flex justify-content-center">
        <h3 class="display-4">Informasi Keuangan</h3>
        <h4 class="d-flex display-5">Maret 2021</h4>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
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
                                <table id="datatable_pagination" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Id</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Nama</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Amount</th>
                                            <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="descending" aria-label="Platform(s): activate to sort column ascending">Date</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Debit</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Kredit</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($finances as $row)
                                        <tr role="row">
                                            <td>0321-TRX-{{ $row->id }}</td>
                                            <td>{{ $row->transaction_name }}</td>
                                            <td>{{ $row->amount }}</td>
                                            <td class="sorting_1" >{{ $row->transaction_date }}</td>
                                            @if ($row->jenis == "debit")
                                                <td>Rp. {{ $row->amount }}</td>
                                                <td></td>
                                            @else
                                                <td></td>
                                                <td>Rp. {{ $row->amount }}</td>
                                            @endif
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default{{ $row->id }}">
                                                    <i class="nav-icon fas fa-edit"></i>
                                                </button>
                                                <a onclick="return confirm('Are you sure?')" href="/user/destroy/{{ $row->id }}" class="btn btn-danger"><i class="nav-icon fas fa-trash"></i></a>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modal-default{{ $row->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit User</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    {{-- <form method="post" action="/user/update/{{ $row->id }}">
                                                        <div class="modal-body">
                                                            {{ csrf_field() }}
                                                            {{ method_field('PUT') }}

                                                            <div class="form-group">
                                                                <label>Nama</label>
                                                                <input type="text" name="name" class="form-control" placeholder="Masukan Nama" value="{{ $row->name }}">
                                                                @if($errors->has('name'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('name')}}
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Username</label>
                                                                <input type="text" name="username" class="form-control" placeholder="Masukan Username" value="{{ $row->username }}">
                                                                @if($errors->has('username'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('username')}}
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="text" name="email" class="form-control" placeholder="Masukan Email" value="{{ $row->email }}">
                                                                @if($errors->has('email'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('email')}}
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Password</label>
                                                                <input type="password" name="password" class="form-control" placeholder="Masukan Password" value="">
                                                                @if($errors->has('password'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('password')}}
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Role</label>
                                                                <br>
                                                                <select name="role" id="role">
                                                                    @foreach($roles as $role)

                                                                    <option value="{{ $role->id }}" {{ $role->role_name == $row->role->role_name ? 'selected' : ''}}>{{ $role->role_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if($errors->has('role'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('role')}}
                                                                </div>
                                                                @endif
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <input type="submit" class="btn btn-success" value="Simpan">
                                                        </div>
                                                    </form> --}}
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
                                            <th class="bg-info" rowspan="1" colspan="4">Total</th>
                                            <th class="bg-danger" rowspan="1" colspan="1">Rp. {{ $kas["debit"]}}</th>
                                            <th class="bg-success" rowspan="1" colspan="1">Rp. {{ $kas["kredit"]}}</th>
                                            <th class="bg-secondary" rowspan="1" colspan="1">Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="float-right pt-3">
                                    <a class="btn btn-primary" href="" data-toggle="modal" data-target="#modal-store"><i class='fa fa-plus-circle'></i> Tambah</a>
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
            <form method="post" action="{{route('user_store')}}">
                <div class="modal-body">
                    @csrf

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukan Nama" value="">
                        @if($errors->has('name'))
                        <div class="text-danger">
                            {{ $errors->first('name')}}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukan Username" value="">
                        @if($errors->has('username'))
                        <div class="text-danger">
                            {{ $errors->first('username')}}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Masukan Email" value="">
                        @if($errors->has('email'))
                        <div class="text-danger">
                            {{ $errors->first('email')}}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukan Password" value="">
                        @if($errors->has('password'))
                        <div class="text-danger">
                            {{ $errors->first('password')}}
                        </div>
                        @endif
                    </div>
                    {{-- <div class="form-group">
                        <label>Role</label>
                        <br>
                        <select name="role" id="role">
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('role'))
                        <div class="text-danger">
                            {{ $errors->first('role')}}
                        </div>
                        @endif
                    </div> --}}
                    
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