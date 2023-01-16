        <form action="{{ route('promo.store') }}" method="POST" id="formtambah_promo">
            @csrf
            <div class="form-group tw-mr-3">
                <label for="barang_id" class="col-form-label">Jenis :</label>
                <div class="flex justify-center">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="jenis" id="jenis1" value="barang" checked="true">
                        <label class="form-check-label inline-block text-gray-800" for="jenis1">Barang</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="jenis" id="jenis2" value="jasa">
                        <label class="form-check-label inline-block text-gray-800" for="jenis2">Jasa</label>
                    </div>
                </div>
            </div>
            <div class="form-group tw-mr-3" id="barang_input">
                <label for="barang_id" class="col-form-label">Barang :</label>
                <div class="dropdown tw-mb-4">
                    <select class="custom-select input-select2" id="barang_id" name="barang_id">
                        <option value=""></option>
                        @foreach ($data as $d)
                            <option value="{{ $d->id }}">{{ Str::ucfirst($d->nama_barang) }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="form-group tw-mr-3" id="jasa_input" hidden="true">
                <label for="jasa_id" class="col-form-label">Jasa :</label>
                <div class="dropdown tw-mb-4">
                    <select class="custom-select input-select2" id="jasa_id" name="jasa_id">
                        <option value=""></option>
                        @foreach ($jasa as $j)
                            <option value="{{ $j->id }}">{{ Str::ucfirst($j->nama_jasa) }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="tw-grid tw-grid-cols-2">
                <div class="form-group tw-mr-3">
                    <label for="kode-promo" class="col-form-label">Kode Promo:</label>
                    <input type="text" class="form-control" id="kode-promo" name="kode_promo">
                </div>
                <div class="form-group">
                    <label for="nama-promo" class="col-form-label">Nama Promo:</label>
                    <input type="text" class="form-control" id="nama-promo" name="nama_promo">
                </div>
            </div>

            <div class="tw-grid tw-grid-cols-2">
                <div class="form-group tw-mr-2">
                    <label for="tgl-mulai" class="col-form-label">Tanggal Mulai:</label>
                    <div class="dropdown tw-mb-4">
                        <input type="date" name="tgl_mulai" id="tgl-mulai" 
                            class="tw-px-5 tw-py-1 tw-w-full tw-border-gray-400 tw-border form-control">
                    </div>
                </div>
                <div class="form-group tw-mr-2">
                    <label for="tgl-selesai" class="col-form-label">Tanggal Selesai:</label>
                    <div class="dropdown tw-mb-4">
                        <input type="date" name="tgl_selesai" id="tgl-selesai"
                            class="ol-form-label tw-px-5 tw-py-1 tw-w-full tw-border-gray-400 tw-border form-control">
                    </div>
                </div>
            </div>

            <div class="tw-grid tw-grid-cols-2">
                <div class="form-group tw-mr-3">
                    <label for="discount" class="col-form-label">Discount:</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" aria-label="Amount" id="discount" max="100"
                            name="disc">
                        <div class="input-group-prepend">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="min-beli" class="col-form-label">Jumlah Min :</label>
                    <input type="number" class="form-control" aria-label="Amount" id="discount" max="100"
                        name="qty_sk">
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn tw-bg-prim-red tw-text-prim-white" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn tw-bg-prim-blue tw-text-prim-white">Save</button>
            </div>
        </form>
