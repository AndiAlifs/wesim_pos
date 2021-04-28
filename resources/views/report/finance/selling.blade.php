<html>
<body>
    <table>
        <tr>
            <td colspan="6">
                {{ strtoupper('Laporan Penjualan')}}
            </td>
        </tr>
    </table>
    
    <table>
        <thead>
            <tr>
                <th>Transaction id</th>
                <th>User Name</th>
                <th>User Member</th>
                <th>Jumlah Produk</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sellingTransaction as $row)
                <tr>
                    <td>{{ $row->transaction_number }}</td>
                    <td>{{ $row->user->name }}</td>
                    <td>{{ $row->member->name }}</td>
                    <td>{{ $row->product_count }}</td>
                    <td>{{ $row->total_price }}</td>
                    <td>{{ $row->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>