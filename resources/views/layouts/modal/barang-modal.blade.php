<div class="modal fade" id="barangModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="close tw-text-prim-red" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="tw-grid tw-grid-cols-2">
            <div class="form-group tw-mr-3">
              <label for="kode-barang" class="col-form-label">Kode Barang:</label>
              <input type="text" class="form-control" id="kode-barang">
            </div>
            <div class="form-group">
              <label for="nama-barang" class="col-form-label">Nama Barang:</label>
              <input type="text" class="form-control" id="nama-barang">
            </div>
          </div>
        
          <div class="tw-grid tw-grid-cols-2">
            <div class="form-group tw-mr-3">
              <label for="tipe" class="col-form-label">Tipe:</label>
              <div class="dropdown tw-mb-4">
                <select class="custom-select" id="tipe">
                  <option selected>Pilih Tipe</option>
                  <option value="1">Lampu</option>
                  <option value="2">Oli</option>
                  <option value="3">Ban</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="merk" class="col-form-label">Merk:</label>
              <div class="dropdown tw-mb-4">
                <select class="custom-select" id="merk">
                  <option selected>Pilih Merk</option>
                  <option value="1">Honda</option>
                  <option value="2">Yamaha</option>
                  <option value="3">Suzuki</option>
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
                <input type="text" class="form-control" aria-label="Amount" id="harga-jual">
              </div>
            </div>
            <div class="form-group">
            <label for="harga-beli" class="col-form-label">Harga Beli:</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp.</span>
                </div>
                <input type="text" class="form-control" aria-label="Amount" id="harga-beli">
              </div>
            </div>
          </div>

          <div class="tw-grid tw-grid-cols-2">
            <div class="form-group tw-mr-3">
              <label for="harga-jual" class="col-form-label">Stok:</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button class="min-btn w-outline-none tw-border-transparent tw-px-2" disabled>-</button>
                </div>
                <input type="text" class="form-control tw-w-4 tw-text-center" aria-label="Amount" id="stok-barang" value="0">
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