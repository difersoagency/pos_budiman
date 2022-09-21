
        <form action="{{route('pegawai.update', ['id' => $data->id])}}" method="POST">
          @csrf
          <div class="tw-grid tw-grid-cols-2">
            <div class="form-group tw-mr-3">
              <label for="no-pegawai" class="col-form-label">Nomor Pegawai:</label>
              <input type="text" class="form-control" id="no-pegawai" name="kode_pegawai" value="{{$data->kode_pegawai}}">
            </div>
            <div class="form-group">
              <label for="nama-pegawai" class="col-form-label">Nama Pegawai:</label>
              <input type="text" class="form-control" id="nama-pegawai" name="nama_pegawai" value="{{$data->nama_pegawai}}">
            </div>
          </div>

          <div class="tw-grid tw-grid-cols-2">
            <div class="form-group tw-mr-3">
              <label for="tipe" class="col-form-label">Gender:</label>
              <div class="dropdown tw-mb-4">
                <select class="custom-select" id="tipe">
                  <option selected>Jenis Kelamin</option>
                  <option value="L" @if($data->gender == "L") selected @endif>Laki-Laki</option>
                  <option value="P" @if($data->gender == "P") selected @endif>Perempuan</option>
                </select>
              </div>
            </div>
            <div class="form-group tw-mr-3">
              <label for="tel-pegawai" class="col-form-label">No.Telepon:</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">+62</span>
                </div>
                <input type="number" class="form-control" aria-label="Amount" id="tel-pegawai" name="telepon" value="{{$data->telepon}}">
              </div>
            </div>
          </div>


          <div class="tw-grid tw-grid-cols-1">
            <div class="form-group">
              <label for="email-pegawai" class="col-form-label">Alamat Email:</label>
              <input type="text" class="form-control" id="email-pegawai" name="email" value="{{$data->email}}">
            </div>
          </div>

          <div class="row">
            <div class="col-6"><button type="button" class="btn tw-bg-prim-red tw-text-prim-white" data-dismiss="modal">Batal</button></div>
            <div class="col-6"><button type="submit" class="btn tw-bg-prim-blue tw-text-prim-white float-right">Save</button></div>
          </div>

        </form>
