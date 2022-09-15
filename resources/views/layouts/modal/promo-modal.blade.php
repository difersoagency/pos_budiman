<div class="modal fade" id="promoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Promo</h5>
        <button type="button" class="close tw-text-prim-red" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="tw-grid tw-grid-cols-2">
            <div class="form-group tw-mr-3">
              <label for="kode-promo" class="col-form-label">Kode Promo:</label>
              <input type="text" class="form-control" id="kode-promo">
            </div>
            <div class="form-group">
              <label for="nama-promo" class="col-form-label">Nama Promo:</label>
              <input type="text" class="form-control" id="nama-promo">
            </div>
          </div>
        
          <div class="tw-grid tw-grid-cols-2">
            <div class="form-group tw-mr-2">
              <label for="tgl-mulai" class="col-form-label">Tanggal Mulai:</label>
              <div class="dropdown tw-mb-4">
                <input type="date" name="tgl-mulai" id="tgl-mulai" class="tw-px-5 tw-py-1 tw-w-full tw-border-gray-400 tw-border">
              </div>
            </div>
            <div class="form-group tw-mr-2">
              <label for="tgl-selesai" class="col-form-label">Tanggal Selesai:</label>
              <div class="dropdown tw-mb-4">
                <input type="date" name="tgl-selesai" id="tgl-selesai" class="tw-px-5 tw-py-1 tw-w-full tw-border-gray-400 tw-border">
              </div>
            </div>
          </div>
          
          <div class="tw-grid tw-grid-cols-2">
            <div class="form-group tw-mr-3">
              <label for="discount" class="col-form-label">Discount:</label>
              <div class="input-group mb-3">
                <input type="number" class="form-control" aria-label="Amount" id="discount" max="100">
                <div class="input-group-prepend">
                  <span class="input-group-text">%</span>
                </div>
              </div>
            </div>
            <div class="form-group">
            <label for="min-beli" class="col-form-label">Min.Pembelian:</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp.</span>
                </div>
                <input type="text" class="form-control" aria-label="Amount" id="min-beli">
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