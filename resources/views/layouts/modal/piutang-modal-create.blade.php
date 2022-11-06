<form action="{{route( 'store_detail_piutang', ['id' => $id] )}}" method="POST">
@csrf
            <div class="form-group tw-mr-3">
              <label for="tgl_piutang" class="col-form-label">Tgl Piutang:</label>
              <input type="date" class="form-control" id="tgl_piutang" name="tgl_piutang" value="">
            </div>

            <div class="form-group tw-mr-3">
              <label for="harga-jasa" class="col-form-label">Total Bayar:</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp.</span>
                </div>
                <input type="number" class="form-control" aria-label="" id="total_bayar" name="total_bayar"  value="">
              </div>
            </div>

            <div class="row">
              <div class="col-6"><button type="button" class="btn tw-bg-prim-red tw-text-prim-white" data-dismiss="modal">Batal</button></div>
              <div class="col-6"><button type="submit" class="btn tw-bg-prim-blue tw-text-prim-white float-right">Simpan</button></div>
            </div>
</form>