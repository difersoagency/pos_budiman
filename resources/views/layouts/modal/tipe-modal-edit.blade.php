
        <form action="{{route('tipe.update', ['id' => $data->id])}}" method="POST" id="formedit_tipe">
          @csrf
            <div class="form-group tw-mr-3">
              <label for="kode-tipe" class="col-form-label">Kode Tipe:</label>
              <input type="text" class="form-control" id="kode-tipe" name="kode_tipe" value="{{$data->kode_tipe}}">
            </div>

            <div class="form-group tw-mr-3">
              <label for="nama-tipe" class="col-form-label">Nama Tipe:</label>
              <input type="text" class="form-control" id="nama-tipe" name="nama_tipe" value="{{$data->nama_tipe}}">
            </div>
            
          <div class="row">
            <div class="col-6"><button type="button" class="btn tw-bg-prim-red tw-text-prim-white" data-dismiss="modal">Batal</button></div>
            <div class="col-6"><button type="submit" class="btn tw-bg-prim-blue tw-text-prim-white float-right">Save</button></div>
          </div>
        </form>
      