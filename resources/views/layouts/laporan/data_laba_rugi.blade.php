<table style="border:1px solid #000">
    <thead>
        <tr>
            <th colspan="6" style="text-align:center">
                {{$header}}
            </th>
        </tr>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>No Transaksi</th>
            <th>Supplier / Customer</th>
            <th>Pendapatan</th>
            <th>Pengeluaran</th>
        </tr>
    </thead>
    <?php $total_jual = 0; $total_beli = 0; ?>
    <tbody>
        @foreach($data as $i)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$i['tanggal']}}</td>
            <td>{{$i['nomor']}}</td>
            <td>{{$i['user']}}</td>
            <td>{{$i['total_jual']}}</td>
            <td>{{$i['total_beli']}}</td>
        </tr>
        <?php $total_jual = $total_jual + $i['total_jual']; 
        $total_beli = $total_beli + $i['total_beli']; ?>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">Total</th>
            <th>{{$total_jual}}</th>
            <th>{{$total_beli}}</th>
        </tr>
    </tfoot>
</table>