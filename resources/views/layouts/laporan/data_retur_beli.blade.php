<table style="border:1px solid #000">
    <thead>
        <tr>
            <th colspan="8" style="text-align:center">
                {{$header}}
            </th>
        </tr>
        <tr>
            <th>No</th>
            <th>No Transaksi</th>
            <th>Supplier</th>
            <th>Tanggal Retur</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <?php $total = 0; ?>
    <tbody>
        @foreach($data as $i)
        <tr>
            <td rowspan="{{count($i['detail'])}}">{{$loop->iteration}}</td>
            <td rowspan="{{count($i['detail'])}}">{{$i['no_po']}} </td>
            <td rowspan="{{count($i['detail'])}}">{{$i['supplier']}}</td>
            <td rowspan="{{count($i['detail'])}}">{{$i['tgl_retur_beli']}}</td>
            @foreach($i['detail'] as $j)
            @if($loop->iteration > 1)
            <tr>
            @endif
            <td>{{$j['barang']}}</td>
            <td>{{$j['jumlah']}}</td>
            <td>{{$j['harga']}}</td>
            <td>{{$j['total']}}</td>
            </tr>
            <?php $total = $total + $j['total']; ?>
            @endforeach
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="7"  style="text-align:center">
                Total Pembayaran
            </th>
            <th>{{$total}}</th>
        </tr>
    </tfoot>
</table>