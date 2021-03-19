<!DOCTYPE html>

<head>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
        }

        table {
            /* width: 100%; */
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <h3 style="text-align: center" >Laporan Keuangan</h3>
    <h4 style="text-align: center" >Maret 2021</h4>        
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
                    <td>TRX-0321-{{ $row->id }}</td>
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