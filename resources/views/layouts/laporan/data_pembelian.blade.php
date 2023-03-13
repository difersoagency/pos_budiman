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
            <th>Supplier</th>
            <th>Pembayaran</th>
            <th>No Pembayaran</th>
            <th>Tgl Jatuh Tempo</th>
            <th>Jumlah Dibayar</th>
            <th>Hutang Lunas</th>
            <th>Sisa Hutang</th>
            <th>Total Pembelian</th>
        </tr>
    </thead>
    <?php $total_pembelian = 0; ?>
    <tbody>
        @foreach($data as $i)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{($i[0]['no_po']) ? $i[0]['no_po'] : ''}} </td>
            <td>{{($i[0]['tgl_trans_beli']) ? $i[0]['tgl_trans_beli'] : ''}}</td>
            <td>{{($i[0]['tgl_max_garansi']) ? $i[0]['tgl_max_garansi'] : ''}}</td>
            <td>{{($i[0]['supplier']) ? $i[0]['supplier'] : ''}}</td>
            <td>{{($i[0]['pembayaran']) ? $i[0]['pembayaran'] : ''}}</td>
            <td>{{($i[0]['no_giro']) ? $i[0]['no_giro'] : ''}}</td>
            <td>{{($i[0]['tgl_jatuh_tempo']) ? $i[0]['tgl_jatuh_tempo'] : ''}}</td>
            <td>{{($i[0]['bayar_beli']) ? $i[0]['bayar_beli'] : ''}}</td>
            <td>{{($i[0]['hutang_lunas']) ? $i[0]['hutang_lunas'] : ''}}</td>
            <td>{{($i[0]['sisa_hutang']) ? $i[0]['sisa_hutang'] : ''}}</td>
            <td>{{($i[0]['total_beli']) ? $i[0]['total_beli'] : ''}}</td>
        </tr>
        <?php $total_pembelian = $total_pembelian + $i[0]['total_beli']; ?>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="11"  style="text-align:center">
                Total Pembelian
            </th>
            <th>{{$total_pembelian}}</th>
        </tr>
    </tfoot>
</table>