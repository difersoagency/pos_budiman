
        <form action="{{route('satuan.update', ['id' => $data->id])}}" method="POST"  id="formedit_satuan">
          @csrf
            <div class="form-group tw-mr-3">
              <label for="kode-satuan" class="col-form-label">Kode Satuan:</label>
              <input type="text" class="form-control" id="kode-satuan" name="kode_satuan" value="{{$data->kode_satuan}}">
            </div>

            <div class="form-group tw-mr-3">
              <label for="nama-satuan" class="col-form-label">Nama Satuan:</label>
              <input type="text" class="form-control" id="nama-satuan" name="nama_satuan" value="{{$data->nama_satuan}}">
            </div>
            
          <div class="row">
            <div class="col-6"><button type="button" class="btn tw-bg-prim-red tw-text-prim-white" data-dismiss="modal">Batal</button></div>
            <div class="col-6"><button type="submit" class="btn tw-bg-prim-blue tw-text-prim-white float-right">Save</button></div>
          </div>
        </form>
      