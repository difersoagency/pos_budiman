<div class="modal fade" id="modalPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Merk</h5>
        <button type="button" class="close tw-text-prim-red" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group tw-mr-3">
              <label for="kode-merk" class="col-form-label">Kode Merk:</label>
              <input type="text" class="form-control" id="kode-merk">
            </div>

            <div class="form-group tw-mr-3">
              <label for="nama-merk" class="col-form-label">Nama Merk:</label>
              <input type="text" class="form-control" id="nama-merk">
            </div>

            <div class="tw-grid tw-grid-cols-2">
            <div class="form-group tw-mr-3">
              <label for="jumlah-merk" class="col-form-label">Jumlah Barang:</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button class="min-btn w-outline-none tw-border-transparent tw-px-2" disabled>-</button>
                </div>
                <input type="text" class="form-control tw-w-4 tw-text-center" aria-label="Amount" id="jumlah-merk" value="0">
                <div class="input-group-prepend">
                  <button class="plus-btn tw-outline-none tw-border-transparent tw-px-2">+</button>
                </div>
              </div>
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