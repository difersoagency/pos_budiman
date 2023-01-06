
        <form action="{{ route('merek.store') }}" method="POST" id="formtambah_merk">
          @csrf
            
          <div class="form-group tw-mr-3">
              <label for="nama-merk" class="col-form-label">Kode Merk:</label>
              <input type="text" class="form-control" id="kode-merk" name="kode_merek">
            </div>
            <div class="form-group tw-mr-3">
              <label for="nama-merk" class="col-form-label">Nama Merk:</label>
              <input type="text" class="form-control" id="nama-merk" name="nama_merek">
            </div>

            
          <div class="row">
              <div class="col-6"><button type="button" class="btn tw-bg-prim-red tw-text-prim-white" data-dismiss="modal">Batal</button></div>
              <div class="col-6"><button type="submit" class="float-right btn tw-bg-prim-blue tw-text-prim-white ">Save</button></div>
          </div>

        </form>
      