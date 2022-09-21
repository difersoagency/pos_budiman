
        <form action="{{route('tipe.store')}}" method="POST">
          @csrf
            <div class="form-group tw-mr-3">
              <label for="kode-tipe" class="col-form-label">Kode tipe:</label>
              <input type="text" class="form-control" id="kode-tipe" name="kode_tipe">
            </div>

            <div class="form-group tw-mr-3">
              <label for="nama-tipe" class="col-form-label">Nama tipe:</label>
              <input type="text" class="form-control" id="nama-tipe" name="nama_tipe">
            </div>

          <div class="row">
            <div class="col-6"><button type="button" class="btn tw-bg-prim-red tw-text-prim-white" data-dismiss="modal">Batal</button></div>
            <div class="col-6"><button type="submit" class="btn tw-bg-prim-blue tw-text-prim-white float-right">Save</button></div>
          </div>
        </form>
      