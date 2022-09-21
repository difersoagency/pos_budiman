<form action="{{ route('promo.update', ['id' => $data->id]) }}" method="POST">
    @csrf

    <div class="form-group tw-mr-3">
        <label for="barang_id" class="col-form-label">Barang :</label>
        <div class="dropdown tw-mb-4">
            <select class="custom-select input-select2" id="barang_id" name="barang_id">
                @foreach ($barang as $b)
                    <option value="{{ $b->id }}" @if ($b->id == $data->barang_id) selected @endif>
                        {{ Str::ucfirst($b->nama_barang) }}</option>
                @endforeach

            </select>
        </div>
    </div>
    <div class="tw-grid tw-grid-cols-2">
        <div class="form-group tw-mr-3">
            <label for="kode-promo" class="col-form-label">Kode Promo:</label>
            <input type="text" class="form-control" id="kode-promo" name="kode_promo"
                value="{{ $data->kode_promo }}">
        </div>
        <div class="form-group">
            <label for="nama-promo" class="col-form-label">Nama Promo:</label>
            <input type="text" class="form-control" id="nama-promo" name="nama_promo"
                value="{{ $data->nama_promo }}">
        </div>
    </div>

    <div class="tw-grid tw-grid-cols-2">
        <div class="form-group tw-mr-2">
            <label for="tgl-mulai" class="col-form-label">Tanggal Mulai:</label>
            <div class="dropdown tw-mb-4">
                <input type="date" name="tgl_mulai" id="tgl-mulai"
                    class="tw-px-5 tw-py-1 tw-w-full tw-border-gray-400 tw-border" value="{{ $data->tgl_mulai }}">
            </div>
        </div>
        <div class="form-group tw-mr-2">
            <label for="tgl-selesai" class="col-form-label">Tanggal Selesai:</label>
            <div class="dropdown tw-mb-4">
                <input type="date" name="tgl_selesai" id="tgl-selesai"
                    class="ol-form-label tw-px-5 tw-py-1 tw-w-full tw-border-gray-400 tw-border"
                    value="{{ $data->tgl_selesai }}">
            </div>
        </div>
    </div>

    <div class="tw-grid tw-grid-cols-2">
        <div class="form-group tw-mr-3">
            <label for="discount" class="col-form-label">Discount:</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" aria-label="Amount" id="discount" max="100"
                    name="disc" value="{{ $data->disc }}">
                <div class="input-group-prepend">
                    <span class="input-group-text">%</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="min-beli" class="col-form-label">Jumlah Min :</label>
            <input type="number" class="form-control" aria-label="Amount" id="discount" max="100" name="qty_sk"
                value="{{ $data->qty_sk }}">
        </div>
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn tw-bg-prim-red tw-text-prim-white" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn tw-bg-prim-blue tw-text-prim-white">Save</button>
    </div>
</form>
