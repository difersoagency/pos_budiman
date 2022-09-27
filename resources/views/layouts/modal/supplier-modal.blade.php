<div class="modal fade" id="modalPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Supplier</h5>
                <button type="button" class="close tw-text-prim-red" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="tw-grid tw-grid-cols-2">
                        <div class="form-group tw-mr-3">
                            <label for="no-pegawai" class="col-form-label">Nama Supplier :</label>
                            <input type="text" class="form-control" id="no-pegawai">
                        </div>
                        <div class="form-group">
                            <label for="nama-pegawai" class="col-form-label">No.Telepon:</label>
                            <input type="number" class="form-control" id="nama-pegawai">
                        </div>
                    </div>

                    <div class="tw-grid tw-grid-cols-1">
                        <div class="form-group">
                            <label for="kota" class="col-form-label">Kota:</label>
                            <div class="dropdown tw-mb-4">
                                <select class="custom-select input-select2" id="kota">
                                    <option selected>Pilih Kota</option>
                                    <option value="1">Surabaya</option>
                                    <option value="2">Jakarta</option>
                                    <option value="3">Yogyakarta</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="tw-grid tw-grid-cols-1">
                        <div class="form-group">
                            <label for="alamat-supplier" class="col-form-label">Alamat :</label>
                            <input type="text" class="form-control" id="alamat-supplier">
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn tw-bg-prim-red tw-text-prim-white" data-dismiss="modal">Batal</button>
                <button type="button" class="btn tw-bg-prim-blue tw-text-prim-white">Save</button>
            </div>
        </div>
    </div>
</div>