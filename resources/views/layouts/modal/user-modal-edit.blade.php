<form action="{{ route('user.update', ['id' => $data->id]) }}" method="POST" id="formedit">
    @csrf
    <div class="tw-grid tw-grid-cols-2">
        <div class="form-group tw-mr-3">
            <label for="pegawai_id" class="col-form-label">Pegawai:</label>
            <input type="text" class="form-control" id="pegawai_id" name="pegawai_id" readonly="true" value="{{$data->Pegawai->nama_pegawai}}">
        </div>

        <div class="form-group">
            <label for="level_user_id" class="col-form-label">Role:</label>
            <div class="dropdown tw-mb-4">
                <select class="custom-select select2 input-select" id="level_user_id" name="level_user_id">
                    @foreach ($level_user as $l)
                    <option value="{{ $l->id }}" @if($data->level_user_id == $l->id) selected @endif>{{ Str::ucfirst($l->nama_level) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="form-group tw-mr-3">
        <label for="username" class="col-form-label">Username:</label>
        <input type="text" class="form-control" id="username" name="username_form" value="{{$data->username}}">
    </div>

    <div class="form-group tw-mr-3">
        <label for="email" class="col-form-label">Email:</label>
        <input type="text" class="form-control" id="email" name="email_form" value="{{$data->email}}">
    </div>

    <div class="tw-grid tw-grid-cols-2">
        <div class="form-group tw-mr-3">
            <label for="password" class="col-form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password_form">
        </div>

        <div class="form-group tw-mr-3">
            <label for="conf_pass" class="col-form-label">Konfirmasi Password:</label>
            <input type="password" class="form-control" id="conf_pass" name="conf_pass">
        </div>
    </div>

    <div class="row">
        <div class="col-6"><button type="button" class="btn tw-bg-prim-red tw-text-prim-white" data-dismiss="modal">Batal</button></div>
        <div class="col-6"><button type="submit" class="btn tw-bg-prim-blue tw-text-prim-white float-right">Save</button></div>
    </div>
</form>
