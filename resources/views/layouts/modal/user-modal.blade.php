<div class="modal fade" id="modalPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPop">Form Pegawai</h5>
        <button type="button" class="close tw-text-prim-red" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group tw-mr-3">
            <label for="kode-merk" class="col-form-label">Nama Pegawai:</label>
            <input type="text" class="form-control" id="kode-merk">
          </div>

          <div class="form-group">
            <label for="merk" class="col-form-label">Role:</label>
            <div class="dropdown tw-mb-4">
              <select class="custom-select input-select2" id="merk">
                <option selected>Pilih Role</option>
                <option value="1">Admin</option>
                <option value="2">Editor</option>
                <option value="3">Kasir</option>
              </select>
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