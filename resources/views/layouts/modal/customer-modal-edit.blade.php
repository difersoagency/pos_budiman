<form action="{{ route('customer.update', ['id' => $data->id]) }}" method="POST" id="formedit_customer">
    @csrf
    <div class="form-group tw-mr-3">
        <label for="nama-pelanggan" class="col-form-label">Nama Pelanggan:</label>
        <input type="text" class="form-control" id="nama-pelanggan" name="nama_customer"
            value="{{ $data->nama_customer }}">
    </div>

    <div class="form-group tw-mr-3">
        <label for="alamat-pelanggan" class="col-form-label">Alamat Pelanggan:</label>
        <input type="text" class="form-control" id="alamat-pelanggan" name="alamat" value="{{ $data->alamat }}">
    </div>

    <div class="tw-grid tw-grid-cols-2">
        <div class="form-group tw-mr-3">
            <label for="kota" class="col-form-label">Kota:</label>
            <div class="dropdown tw-mb-4">
                <select class="custom-select select2" id="tipe" name="kota_id">
                    @foreach ($kota as $k)
                        <option value="{{ $k->id }}" @if ($k->id == $data->kota_id) selected @endif>
                            {{ $k->nama_kota }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="no-telp" class="col-form-label">No Telepon:</label>
            <input type="number" class="form-control" id="no-telp" name="telepon" value="{{ $data->telepon }}">
        </div>
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn tw-bg-prim-red tw-text-prim-white" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn tw-bg-prim-blue tw-text-prim-white">Save</button>
    </div>
</form>
