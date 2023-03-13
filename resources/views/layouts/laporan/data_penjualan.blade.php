<table style="border:1px solid #000">
    <thead>
        <tr>
            <th colspan="12" style="text-align:center">
                {{$header}}
            </th>
        </tr>
        <tr>
            <th>No</th>
            <th>No Transaksi</th>
            <th>Tgl Transaksi</th>
            <th>Batas Garansi</th>
            <th>Customer</th>
            <th>Pembayaran</th>
            <th>No Pembayaran</th>
            <th>Tgl Jatuh Tempo</th>
            <th>Jumlah Dibayar</th>
            <th>Piutang Lunas</th>
            <th>Sisa Piutang</th>
            <th>Total Penjualan</th>
        </tr>
    </thead>
    <?php $total_penjualan = 0; ?>
    <tbody>
        @foreach($data as $i)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{($i[0]['no_trans_jual']) ? $i[0]['no_trans_jual'] : ''}} </td>
            <td>{{($i[0]['tgl_trans_jual']) ? $i[0]['tgl_trans_jual'] : ''}}</td>
            <td>{{($i[0]['tgl_max_garansi']) ? $i[0]['tgl_max_garansi'] : ''}}</td>
            <td>{{($i[0]['customer']) ? $i[0]['customer'] : ''}}</td>
            <td>{{($i[0]['pembayaran']) ? $i[0]['pembayaran'] : ''}}</td>
            <td>{{($i[0]['no_giro']) ? $i[0]['no_giro'] : ''}}</td>
            <td>{{($i[0]['tgl_jatuh_tempo']) ? $i[0]['tgl_jatuh_tempo'] : ''}}</td>
            <td>{{($i[0]['bayar_jual']) ? $i[0]['bayar_jual'] : ''}}</td>
            <td>{{($i[0]['piutang_lunas']) ? $i[0]['piutang_lunas'] : ''}}</td>
            <td>{{($i[0]['sisa_piutang']) ? $i[0]['sisa_piutang'] : ''}}</td>
            <td>{{($i[0]['total_jual']) ? $i[0]['total_jual'] : ''}}</td>
        </tr>
        <?php $total_penjualan = $total_penjualan + $i[0]['total_jual']; ?>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="11"  style="text-align:center">
                Total Penjualan
            </th>
            <th>{{$total_penjualan}}</th>
        </tr>
    </tfoot>
</table>