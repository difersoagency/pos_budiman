<table style="border:1px solid #000">
    <thead>
        <tr>
            <th colspan="7" style="text-align:center">
                {{$header}}
            </th>
        </tr>
        <tr>
            <th>No</th>
            <th>Tgl Transaksi</th>
            <th>No Transaksi</th>
            <th>Barang</th>
            <th>Jenis</th>
            <th>Jumlah Masuk</th>
            <th>Jumlah Keluar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $i)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$i['tgl_transaksi']}}</td>
            <td>{{$i['nomor']}}</td>
            <td>{{$i['barang']}}</td>
            <td>{{$i['jenis']}}</td>
            <td>{{$i['jumlah_masuk']}}</td>
            <td>{{$i['jumlah_keluar']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>