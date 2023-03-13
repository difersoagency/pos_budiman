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
            <th>Customer</th>
            <th>Tanggal Bayar</th>
            <th>Pembayaran</th>
            <th>No Pembayaran</th>
            <th>Tgl Jatuh Tempo</th>
            <th>Jumlah Dibayar</th>
        </tr>
    </thead>
    <?php $total = 0; ?>
    <tbody>
        @foreach($data as $i)
        <tr>
            <td rowspan="{{count($i['detail'])}}">{{$loop->iteration}}</td>
            <td rowspan="{{count($i['detail'])}}">{{($i['no_trans_jual']) ? $i['no_trans_jual'] : ''}} </td>
            <td rowspan="{{count($i['detail'])}}">{{($i['customer']) ? $i['customer'] : ''}}</td>
            @foreach($i['detail'] as $j)
            @if($loop->iteration > 1)
            <tr>
            @endif
            <td>{{($j['tgl_bayar']) ? $j['tgl_bayar'] : ''}}</td>
            <td>{{($j['pembayaran']) ? $j['pembayaran'] : ''}}</td>
            <td>{{($j['no_giro']) ? $j['no_giro'] : ''}}</td>
            <td>{{($j['tgl_jatuh_tempo']) ? $j['tgl_jatuh_tempo'] : ''}}</td>
            <td>{{($j['total_bayar']) ? $j['total_bayar'] : ''}}</td>
        </tr>
        <?php $total = $total + $j['total_bayar']; ?>
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