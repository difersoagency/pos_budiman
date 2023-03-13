<table style="border:1px solid #000">
    <thead>
        <tr>
            <th colspan="8" style="text-align:center">
                {{$header}}
            </th>
        </tr>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Merk</th>
            <th>Nama</th>
            <th>Satuan</th>
            <th>Stok</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
        </tr>
    </thead>
    <?php $total = 0; ?>
    <tbody>
        @foreach($data as $i)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$i['kode']}}</td>
            <td>{{$i['merek']}}</td>
            <td>{{$i['nama']}}</td>
            <td>{{$i['satuan']}}</td>
            <td>{{$i['stok']}}</td>
            <td>{{$i['harga_beli']}}</td>
            <td>{{$i['harga_jual']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>