
        <form action="{{route('jasa.update', ['id' => $data->id])}}" method="POST">
          @csrf
            <!-- <div class="form-group tw-mr-3">
              <label for="kode-jasa" class="col-form-label">Kode Jasa:</label>
              <input type="text" class="form-control" id="kode-jasa" value=>
            </div> -->

            <div class="form-group tw-mr-3">
              <label for="nama-jasa" class="col-form-label">Nama Jasa:</label>
              <input type="text" class="form-control" id="nama-jasa" name="nama_jasa" value="{{$data->nama_jasa}}">
            </div>

            <div class="form-group tw-mr-3">
              <label for="harga-jasa" class="col-form-label">Harga:</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp.</span>
                </div>
                <input type="number" class="form-control" aria-label="Amount" id="harga-jasa"  name="harga"  value="{{$data->harga}}">
              </div>
            </div>

            <div class="row">
              <div class="col-6"><button type="button" class="btn tw-bg-prim-red tw-text-prim-white" data-dismiss="modal">Batal</button></div>
              <div class="col-6"><button type="submit" class="btn tw-bg-prim-blue tw-text-prim-white float-right">Save</button></div>
            </div>
        </form>
      
