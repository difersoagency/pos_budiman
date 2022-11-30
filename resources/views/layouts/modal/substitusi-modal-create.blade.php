<form method="POST" class="tw-h-96  tw-overflow-y-auto">
    @csrf
    <div class="mx-2 mt-4">
        <label for="koreksi_tanggal">Tgl Pembuatan</label>
        <input type="date" placeholder="Tanggal Transaksi" class="form-control koreksi_tanggal" name="koreksi_tanggal" id="koreksi_tanggal">
    </div>
    <div class="mx-2 mt-4">
        <label for="booking_id">Barang 1</label>
        <div class="dropdown" style="width:100%;">
            <select class="custom-select sub_1 tw-text-prim-white" id="substitusi_barang_1" name="substitusi_barang_1">
                <option value="1">Barang 1</option>
                <option value="2">Barang 2</option>
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
            <select class="custom-select sub_2 tw-text-prim-white" id="substitusi_barang_2" name="substitusi_barang_2">
                <option value="1">Barang 1</option>
                <option value="2">Barang 2</option>
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
    let barang1 = document.querySelector('#substitusi_barang_1');
    let barang2 = document.querySelector('#substitusi_barang_2');
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