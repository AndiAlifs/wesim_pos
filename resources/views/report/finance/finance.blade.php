<!DOCTYPE html>

<body>
    <table>
        <tr>
            <td colspan="5">
                {{ strtoupper('Laporan Keuangan')}}
            </td>
        </tr>
        <tr>
            <td colspan="5">
                @if (($waktu["bulan_name_start"] == $waktu["bulan_name_end"]) && ($waktu["tahun_start"] == $waktu["tahun_end"]))
                        {{ strtoupper($waktu["bulan_name_start"]." ".$waktu["tahun_start"]) }}
                @else
                        {{ strtoupper($waktu["bulan_name_start"]." ".$waktu["tahun_start"]." - ".$waktu["bulan_name_end"]." ".$waktu["tahun_end"]) }}
                @endif
            </td>
        </tr>
    </table>
    <table>
        <thead>
            <tr >
                <th>Transaction Id</th>
                <th>Nama</th>
                <th>Date</th>
                <th>Debit</th>
                <th>Kredit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($finances as $row)
                <tr role="row">
                    <td>TRX-{{substr($row->transaction_date,5,2)}}21-{{ $row->id }}</td>
                    <td>{{ $row->transaction_name }}</td>
                    <td>{{ $row->transaction_date }}</td>
                    @if ($row->jenis == "debit")
                        <td>Rp. {{ $row->amount }}</td>
                        <td></td>
                    @else
                        <td></td>
                        <td>Rp. {{ $row->amount }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th colspan="1">Rp. {{ $kas["debit"]}}</th>
                <th colspan="1">Rp. {{ $kas["kredit"]}}</th>
            </tr>
        </tfoot>
    </table>
</body>

</html>