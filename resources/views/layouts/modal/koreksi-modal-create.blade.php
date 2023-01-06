<form action="{{ route('koreksi.store') }}" method="POST" class="tw-h-96  tw-overflow-y-auto"  id="formtambah_koreksi">
    @csrf
    <div class="mx-2 mt-4">
        <label for="koreksi_tanggal">Tgl Transaksi</label>
        <input type="date" placeholder="Tanggal Transaksi" class="form-control koreksi_tanggal" name="koreksi_tanggal" id="koreksi_tanggal">
    </div>
    <div class="mx-2 mt-4">
        <label for="booking_id">Jenis</label>
        <div class="dropdown" style="width:100%;">
            <select class="custom-select selects tw-text-prim-white" id="koreksi_jenis" name="koreksi_jenis">
                <option value="in">Penambahan Stok</option>
                <option value="out">Pengurangan Stok</option>
            </select>
        </div>
    </div>
    <div class="mx-2 mt-4">
        <label for="booking_id">Nama Barang</label>
        <div class="dropdown" style="width:100%;">
            <select class="custom-select barang tw-text-prim-white" id="koreksi_barang" name="koreksi_barang">
            </select>
        </div>
    </div>
    <div class="mx-2 mt-4">
        <label for="no_trans_jual">Jumlah Stock</label>
        <input type="number" placeholder="Jumlah" class="form-control koreksi_jumlah" name="koreksi_jumlah" id="koreksi_jumlah" min="0">
        <small id="stok_get">Stok sekarang : - </small>
    </div>
    <div class="tw-w-full tw-col-span-2 mt-4 mx-2">
        <label for="koreksi_keterangan">Keterangan</label>
        <textarea name="koreksi_keterangan" id="koreksi_keterangan" cols="30" rows="5" class="form-control koreksi_keterangan"></textarea>
    </div>
   
    <div class="modal-footer">
        <button type="button" class="btn tw-bg-prim-red tw-text-prim-white" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn save tw-bg-prim-blue tw-text-prim-white">Save</button>
    </div>


</form>