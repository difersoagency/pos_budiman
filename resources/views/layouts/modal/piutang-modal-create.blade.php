<form action="{{route( 'store_detail_piutang', ['id' => $id] )}}" method="POST" id="formpiutang">
@csrf
            <div class="form-group tw-mr-3">
              <label for="tgl_piutang" class="col-form-label">Tgl Piutang:</label>
              <input type="date" class="form-control" id="tgl_piutang" name="tgl_piutang" value="">
            </div>

            <div class="form-group tw-mr-3">
              <label for="pembayaran_id" class="col-form-label">Pembayaran:</label>
              <select class="select2 pembayaran_id custom-select" id="pembayaran_id" name="pembayaran_id">
                @foreach($p as $pem)
                  <option value="{{$pem->id}}">{{$pem->nama_bayar}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group tw-mr-3" id="input_giro" hidden="true">
              <label for="no_giro" class="col-form-label">Nomor:</label>
              <input type="text" class="form-control" id="no_giro" name="no_giro" value="" placeholder="Nomor Giro/Debit/Kredit">
            </div>

            <div class="form-group tw-mr-3"  hidden="true">
              <label for="sisa" class="col-form-label">Nomor:</label>
              <input type="text" class="form-control" id="sisa" name="sisa" value="" placeholder="Nomor Giro/Debit/Kredit">
            </div>

            <div class="form-group tw-mr-3">
              <label for="harga-jasa" class="col-form-label">Total Bayar:</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp.</span>
                </div>
                <input type="text" class="form-control" aria-label="" id="total_bayar" name="total_bayar"  value="">
              </div>
              <small class="text-muted text-danger" id="msg-alert"></small>
            </div>

            <div class="row">
              <div class="col-6"><button type="button" class="btn tw-bg-prim-red tw-text-prim-white" data-dismiss="modal">Batal</button></div>
              <div class="col-6"><button type="submit" class="btn tw-bg-prim-blue tw-text-prim-white float-right">Simpan</button></div>
            </div>
</form>