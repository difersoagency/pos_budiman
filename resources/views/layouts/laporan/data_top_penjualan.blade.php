<table style="border:1px solid #000">
    <thead>
        <tr>
            <th colspan="6" style="text-align:center">
                {{$header}}
            </th>
        </tr>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Merek</th>
            <th>Nama</th>
            <th>Satuan</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <?php $total = 0; ?>
    <tbody>
        @foreach($data as $i)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$i['kode']}}</td>
            <td>{{$i['nama']}}</td>
            <td>{{$i['jumlah']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>