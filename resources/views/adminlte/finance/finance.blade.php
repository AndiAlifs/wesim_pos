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
                    <li class="breadcrumb-item active">Keuangan</li>
                </ol>
                <div class="card">
                    <div class="bg-info p-2 rounded card-title">
                        <h3 class="display-4 text-center text-uppercase">Informasi Keuangan</h3>
                        @if ($waktu['bulan_name_start'] == $waktu['bulan_name_end'] && $waktu['tahun_start'] == $waktu['tahun_end'])
                            <h4 class="text-center">{{ $waktu['bulan_name_start'] . ' ' . $waktu['tahun_start'] }}</h4>
                        @else
                            <h4 class="text-center">{{ $waktu['bulan_name_start'] . ' ' . $waktu['tahun_start'] }} -
                                {{ $waktu['bulan_name_end'] . ' ' . $waktu['tahun_end'] }}</h4>
                        @endif
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="" method="get">
                            <div class="form-row mb-2">

                                <div class="col-3">
                                    <label for="bulan_start"><i class="fas fa-calendar"></i> Dari</label>
                                    <select name="bulan_start" id="bulan_start" class="form-control">
                                        <option value="1" {{ $waktu['bulan_start'] == '01' ? 'selected' : '' }}>Januari
                                        </option>
                                        <option value="2" {{ $waktu['bulan_start'] == '02' ? 'selected' : '' }}>Februari
                                        </option>
                                        <option value="3" {{ $waktu['bulan_start'] == '03' ? 'selected' : '' }}>Maret
                                        </option>
                                        <option value="4" {{ $waktu['bulan_start'] == '04' ? 'selected' : '' }}>April
                                        </option>
                                        <option value="5" {{ $waktu['bulan_start'] == '05' ? 'selected' : '' }}>Mei
                                        </option>
                                        <option value="6" {{ $waktu['bulan_start'] == '06' ? 'selected' : '' }}>Juni
                                        </option>
                                        <option value="7" {{ $waktu['bulan_start'] == '07' ? 'selected' : '' }}>Juli
                                        </option>
                                        <option value="8" {{ $waktu['bulan_start'] == '08' ? 'selected' : '' }}>Agustus
                                        </option>
                                        <option value="9" {{ $waktu['bulan_start'] == '09' ? 'selected' : '' }}>September
                                        </option>
                                        <option value="10" {{ $waktu['bulan_start'] == '10' ? 'selected' : '' }}>Oktober
                                        </option>
                                        <option value="11" {{ $waktu['bulan_start'] == '11' ? 'selected' : '' }}>November
                                        </option>
                                        <option value="12" {{ $waktu['bulan_start'] == '12' ? 'selected' : '' }}>Desember
                                        </option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label for="tahun_start"> .</label>
                                    <select name="tahun_start" id="tahun_start" class="form-control">
                                        <option value="2020" {{ $waktu['tahun_start'] == '2020' ? 'selected' : '' }}>2020
                                        </option>
                                        <option value="2021" {{ $waktu['tahun_start'] == '2021' ? 'selected' : '' }}>2021
                                        </option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label for="bulan_end"><i class="fas fa-calendar"></i> Sampai</label>
                                    <select name="bulan_end" id="bulan_end" class="form-control">
                                        <option value="1" {{ $waktu['bulan_end'] == '01' ? 'selected' : '' }}>Januari
                                        </option>
                                        <option value="2" {{ $waktu['bulan_end'] == '02' ? 'selected' : '' }}>Februari
                                        </option>
                                        <option value="3" {{ $waktu['bulan_end'] == '03' ? 'selected' : '' }}>Maret
                                        </option>
                                        <option value="4" {{ $waktu['bulan_end'] == '04' ? 'selected' : '' }}>April
                                        </option>
                                        <option value="5" {{ $waktu['bulan_end'] == '05' ? 'selected' : '' }}>Mei
                                        </option>
                                        <option value="6" {{ $waktu['bulan_end'] == '06' ? 'selected' : '' }}>Juni
                                        </option>
                                        <option value="7" {{ $waktu['bulan_end'] == '07' ? 'selected' : '' }}>Juli
                                        </option>
                                        <option value="8" {{ $waktu['bulan_end'] == '08' ? 'selected' : '' }}>Agustus
                                        </option>
                                        <option value="9" {{ $waktu['bulan_end'] == '09' ? 'selected' : '' }}>September
                                        </option>
                                        <option value="10" {{ $waktu['bulan_end'] == '10' ? 'selected' : '' }}>Oktober
                                        </option>
                                        <option value="11" {{ $waktu['bulan_end'] == '11' ? 'selected' : '' }}>November
                                        </option>
                                        <option value="12" {{ $waktu['bulan_end'] == '12' ? 'selected' : '' }}>Desember
                                        </option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label for="tahun_end">.</label>
                                    <select name="tahun_end" id="tahun_end" class="form-control">
                                        <option value="2020" {{ $waktu['tahun_end'] == '2020' ? 'selected' : '' }}>2020
                                        </option>
                                        <option value="2021" {{ $waktu['tahun_end'] == '2021' ? 'selected' : '' }}>2021
                                        </option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label for="submit"> Cari </label>
                                    <button type="submit" class="btn btn-primary btn-block form-control"> <i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>


                        <a href="/report/finance?bulan_start={{ (int) $waktu['bulan_start'] }}&tahun_start={{ $waktu['tahun_start'] }}&bulan_end={{ (int) $waktu['bulan_end'] }}&tahun_end={{ $waktu['tahun_end'] }}"
                            class="btn btn-success btn-block my-2"><i class="fa file-excel-o" aria-hidden="false"></i>
                            Export to Excel</a>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div id="dataFinance1" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 table-responsive">
                                    <table id="dataFinance" class="table table-bordered table-striped dataTable dtr-inline"
                                        role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Rendering engine: activate to sort column ascending">
                                                    Transaction Id</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending">Nama
                                                </th>
                                                {{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Amount</th> --}}
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-sort="descending"
                                                    aria-label="Platform(s): activate to sort column ascending">Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Debit
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Kredit
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($finances as $row)
                                                <tr role="row">
                                                    <td>TRX-{{ substr($row->transaction_date, 5, 2) }}21-{{ $row->id }}
                                                    </td>
                                                    <td>{{ $row->transaction_name }}</td>
                                                    {{-- <td>{{ $row->amount }}</td> --}}
                                                    <td>{{ $row->transaction_date }}</td>
                                                    @if ($row->jenis == 'debit')
                                                        <td>Rp. {{ $row->amount }}</td>
                                                        <td></td>
                                                    @else
                                                        <td></td>
                                                        <td>Rp. {{ $row->amount }}</td>
                                                    @endif
                                                    <td>
                                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                                            data-target="#modal-default{{ $row->id }}">
                                                            <i class="nav-icon fas fa-edit"></i>
                                                        </button>
                                                        <a onclick="return confirm('Are you sure?')"
                                                            href="/user/destroy/{{ $row->id }}"
                                                            class="btn btn-danger"><i class="nav-icon fas fa-trash"></i></a>
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
                                                            {{-- <form method="post" action="/user/update/{{ $row->id }}">
                                                        <div class="modal-body">
                                                            {{ csrf_field() }}
                                                            {{ method_field('PUT') }}

                                                            <div class="form-group">
                                                                <label>Nama</label>
                                                                <input type="text" name="name" class="form-control" placeholder="Masukan Nama" value="{{ $row->name }}">
                                                                @if ($errors->has('name'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('name')}}
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Username</label>
                                                                <input type="text" name="username" class="form-control" placeholder="Masukan Username" value="{{ $row->username }}">
                                                                @if ($errors->has('username'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('username')}}
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="text" name="email" class="form-control" placeholder="Masukan Email" value="{{ $row->email }}">
                                                                @if ($errors->has('email'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('email')}}
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Password</label>
                                                                <input type="password" name="password" class="form-control" placeholder="Masukan Password" value="">
                                                                @if ($errors->has('password'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('password')}}
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Role</label>
                                                                <br>
                                                                <select name="role" id="role">
                                                                    @foreach ($roles as $role)

                                                                    <option value="{{ $role->id }}" {{ $role->role_name == $row->role->role_name ? 'selected' : ''}}>{{ $role->role_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('role'))
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
                                                <th class="bg-info" rowspan="1" colspan="3">Total</th>
                                                <th class="bg-danger" rowspan="1" colspan="1">Rp. {{ $kas['debit'] }}
                                                </th>
                                                <th class="bg-success" rowspan="1" colspan="1">Rp. {{ $kas['kredit'] }}
                                                </th>
                                                <th class="bg-secondary" rowspan="1" colspan="1">Aksi</th>
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
                    <h4 class="modal-title">Tambah Transaski</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('finance_store') }}">
                    <div class="modal-body">
                        @csrf

                        <div class="form-group">
                            <label>Id Transaksi</label>
                            <input type="text" name="id" class="form-control" placeholder="Masukan id"
                                value="TRX-0321-{{ $finances->count() + 1 }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Nama Transaski</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Nama Transaksi"
                                value="">
                            @if ($errors->has('name'))
                                <div class="text-danger">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Tanggal Transakski</label>
                            <input type="date" name="date" class="form-control" placeholder="Masukan tanggal transaksi "
                                value="">
                            @if ($errors->has('date'))
                                <div class="text-danger">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Jenis Transaksi</label>
                            <br>
                            <select name="type" id="type">
                                <option value="debit">Debit</option>
                                <option value="kredit">Kredit</option>
                            </select>
                            @if ($errors->has('role'))
                                <div class="text-danger">
                                    {{ $errors->first('role') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Jumlah Transaksi</label>
                            <input type="number" name="amount" class="form-control" placeholder="Masukan jumlah transaksi "
                                value="">
                            @if ($errors->has('amount'))
                                <div class="text-danger">
                                    {{ $errors->first('amount') }}
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

@push('scripts-footer')
    @if ($kas['debit'] != $kas['kredit'])
        <script>
            alert('Kredit dan debit tidak seimbang');

        </script>
    @endif

    <script>
        $('#dataFinance').dataTable({
            "lengthMenu": [
                ['all']
            ]
        });

    </script>
@endpush
