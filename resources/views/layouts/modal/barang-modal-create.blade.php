<form action="{{ route('barang.store') }}" method="POST" class="tw-h-96  tw-overflow-y-auto" id="formtambah_barang">
    @csrf
    <div class="tw-grid tw-grid-cols-2">
        <div class="form-group tw-mr-3">
            <label for="kode-barang" class="col-form-label">Kode Barang:</label>
            <input type="text" class="form-control" id="kode-barang" name="kode_barang">
        </div>
        <div class="form-group">
            <label for="nama-barang" class="col-form-label">Nama Barang:</label>
            <input type="text" class="form-control" id="nama-barang" name="nama_barang">
        </div>
    </div>

    <div class="tw-grid tw-grid-cols-2">
        <div class="form-group tw-mr-3">
            <label for="tipe" class="col-form-label">Tipe:</label>
            <div class="dropdown tw-mb-4">
                <select class="custom-select input-select2" id="tipe" name="tipe">
                    @foreach ($tipe as $t)
                    <option value="{{ $t->id }}">{{ Str::ucfirst($t->nama_tipe) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="merk" class="col-form-label">Merk:</label>
            <div class="dropdown tw-mb-4">
                <select class="custom-select input-select2" id="merk" name="merk">
                    @foreach ($merek as $m)
                    <option value="{{ $m->id }}">{{ Str::ucfirst($m->nama_merek) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="tw-grid tw-grid-cols-2">
        <div class="form-group tw-mr-3">
            <label for="satuan" class="col-form-label">Satuan:</label>
            <div class="dropdown tw-mb-4">
                <select class="custom-select input-select2 satuan" id="satuan" name="satuan">
                    @foreach ($satuan as $m)
                    <option value="{{ $m->id }}">{{ Str::ucfirst($m->nama_satuan) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="supplier" class="col-form-label">Supplier:</label>
            <div class="dropdown tw-mb-4">
                <select class="custom-select input-select2 supplier" id="supplier" name="supplier">
                @foreach ($supplier as $m)
                    <option value="{{ $m->id }}">{{ Str::ucfirst($m->nama_supplier) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="tw-grid tw-grid-cols-2">
        <div class="form-group tw-mr-3">
            <label for="harga-jual" class="col-form-label">Harga Jual:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                </div>
                <input type="text" class="form-control" aria-label="Amount" id="harga-jual" name="harga_jual" value="0">
            </div>
            <small class="text-danger" id="msg-harga_jual"></small>
        </div>
        <div class="form-group">
            <label for="harga-beli" class="col-form-label">Harga Beli:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                </div>
                <input type="text" class="form-control" aria-label="Amount" id="harga-beli" name="harga_beli" value="0">
            </div>
            <small class="text-danger" id="msg-harga_beli"></small>
        </div>
    </div>

    <div class="tw-grid tw-grid-cols-2">
        <div class="form-group tw-mr-3">
            <label for="harga-jual" class="col-form-label">Stok:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <button type="button" class="min-btn w-outline-none tw-border-transparent tw-px-2" disabled>-</button>
                </div>
                <input type="text" class="form-control tw-w-4 tw-text-center" aria-label="Amount" id="stok-barang" value="0" name="stok">
                <div class="input-group-prepend">
                    <button type="button" class="plus-btn tw-outline-none tw-border-transparent
                                        tw-px-2">+</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn tw-bg-prim-red tw-text-prim-white" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn save tw-bg-prim-blue tw-text-prim-white">Save</button>
    </div>


</form>