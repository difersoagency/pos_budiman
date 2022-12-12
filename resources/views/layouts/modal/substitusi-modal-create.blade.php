<form method="POST" action="{{route('substitusi.store')}}" class="tw-h-96  tw-overflow-y-auto">
    @csrf
    <div class="mx-2 mt-4">
        <label for="koreksi_tanggal">Tgl Pembuatan</label>
        <input type="date" placeholder="Tanggal Transaksi" class="form-control tgl_subtitusi" name="tgl_subtitusi" id="tgl_subtitusi">
    </div>
    <div class="mx-2 mt-4">
        <label for="booking_id">Barang 1</label>
        <div class="dropdown" style="width:100%;">
            <select class="custom-select sub_1 tw-text-prim-white" id="barang_id_1" name="barang_id_1">
                @foreach($barang as $b)
                <option value="{{$b->id}}">{{$b->nama_barang}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mt-4 tw-w-full tw-text-center">
        <a class="switch-sub tw-bg-transparent tw-border-transparent tw-cursor-pointer">
            <div class="icon-switch"></div>
        </a>
    </div>
    <div class="mx-2 mt-4">
        <label for="booking_id">Barang 2</label>
        <div class="dropdown" style="width:100%;">
            <select class="custom-select sub_2 tw-text-prim-white" id="barang_id_2" name="barang_id_2">
                @foreach($barang as $b)
                <option value="{{$b->id}}">{{$b->nama_barang}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn tw-bg-prim-red tw-text-prim-white" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn save tw-bg-prim-blue tw-text-prim-white">Save</button>
    </div>


</form>

<script>
    $('.sub_1').select2();
    $('.sub_2').select2();
    // Switch Substitution
    let barang1 = document.querySelector('#barang_id_1');
    let barang2 = document.querySelector('#barang_id_2');
    let buttonSwitch = document.querySelector('a.switch-sub');

    buttonSwitch.addEventListener('click', function() {
        let value1 = barang1.value;
        let value2 = barang2.value;
        console.log(value1);
        console.log(value2);

        $('.sub_1').val(value2);
        $('.sub_2').val(value1);
        $('.sub_1').trigger('change');
        $('.sub_2').trigger('change');
    });
</script>