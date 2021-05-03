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
                        <h3 class="display-4 text-center text-uppercase">Daftar Pembelian</h3>
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
