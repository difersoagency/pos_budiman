<form action="{{ route('supplier.store') }}" method="POST" id="formtambah">
    @csrf
    <div class="form-group tw-mr-3">
        <label for="nama_supplier" class="col-form-label">Nama Supplier:</label>
        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier">
    </div>

    <div class="form-group tw-mr-3">
        <label for="alamat_supplier" class="col-form-label">Alamat:</label>
        <input type="text" class="form-control" id="alamat_supplier" name="alamat">
    </div>

    <div class="tw-grid tw-grid-cols-2">
        <div class="form-group tw-mr-3">
            <label for="kota" class="col-form-label">Kota:</label>
            <div class="dropdown tw-mb-4">
                <select class="custom-select select2 kota" id="kota" name="kota_id">
                    @foreach ($kota as $k)
                        <option value="{{ $k->id }}">{{ Str::ucfirst($k->nama_kota) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="no-telp" class="col-form-label">No Telepon:</label>
            <input type="number" class="form-control" id="no-telp" name="telepon">
        </div>
    </div>
    <div class="row">
        <div class="col-6"><button type="button" class="btn tw-bg-prim-red tw-text-prim-white" data-dismiss="modal">Batal</button></div>
        <div class="col-6"><button type="submit" class="btn tw-bg-prim-blue tw-text-prim-white float-right">Save</button></div>
    </div>
</form>
