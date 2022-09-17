<div class="modal fade" id="modalPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Pelanggan</h5>
        <button type="button" class="close tw-text-prim-red" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group tw-mr-3">
              <label for="nama-pelanggan" class="col-form-label">Nama Pelanggan:</label>
              <input type="text" class="form-control" id="nama-pelanggan">
            </div>

            <div class="form-group tw-mr-3">
              <label for="alamat-pelanggan" class="col-form-label">Alamat Pelanggan:</label>
              <input type="text" class="form-control" id="alamat-pelanggan">
            </div>
        
          <div class="tw-grid tw-grid-cols-2">
            <div class="form-group tw-mr-3">
              <label for="kota" class="col-form-label">Kota:</label>
              <div class="dropdown tw-mb-4">
                <select class="custom-select" id="tipe">
                  <option selected>Pilih Kota</option>
                  <option value="1">Surabaya</option>
                  <option value="2">Depok</option>
                  <option value="3">Banjarmasin</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="no-telp" class="col-form-label">No Telepon:</label>
              <input type="number" class="form-control" id="no-telp">
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