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
              <label for="kode-jasa" class="col-form-label">Kode Jasa:</label>
              <input type="text" class="form-control" id="kode-jasa">
            </div>

            <div class="form-group tw-mr-3">
              <label for="nama-jasa" class="col-form-label">Nama Jasa:</label>
              <input type="text" class="form-control" id="nama-jasa">
            </div>

            <div class="form-group tw-mr-3">
              <label for="harga-jasa" class="col-form-label">Harga:</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp.</span>
                </div>
                <input type="number" class="form-control" aria-label="Amount" id="harga-jasa">
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