<div class="modal fade" id="modalPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Pegawai</h5>
        <button type="button" class="close tw-text-prim-red" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="tw-grid tw-grid-cols-2">
            <div class="form-group tw-mr-3">
              <label for="no-pegawai" class="col-form-label">Nomor Pegawai:</label>
              <input type="text" class="form-control" id="no-pegawai">
            </div>
            <div class="form-group">
              <label for="nama-pegawai" class="col-form-label">Nama Pegawai:</label>
              <input type="text" class="form-control" id="nama-pegawai">
            </div>
          </div>
        
          <div class="tw-grid tw-grid-cols-2">
            <div class="form-group tw-mr-3">
              <label for="tipe" class="col-form-label">Gender:</label>
              <div class="dropdown tw-mb-4">
                <select class="custom-select" id="tipe">
                  <option selected>Jenis Kelamin</option>
                  <option value="1">Laki-Laki</option>
                  <option value="2">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="form-group tw-mr-3">
              <label for="tel-pegawai" class="col-form-label">No.Telepon:</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">+62</span>
                </div>
                <input type="number" class="form-control" aria-label="Amount" id="tel-pegawai">
              </div>
            </div>
          </div>
          
          
          <div class="tw-grid tw-grid-cols-1">
            <div class="form-group">
              <label for="email-pegawai" class="col-form-label">Alamat Email:</label>
              <input type="text" class="form-control" id="email-pegawai">
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