<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="tw-grid tw-grid-cols-3">
                    <div class="tw-rounded-lg tw-align-middle">
                        <p class="font-bold">No Penjualan</p>
                        <p class="text-sm">{{$data->no_trans_jual}}</p>
                    </div>
                    <div class="tw-bg-grey-dark tw-text-grey-light">
                        <p class="font-bold">No Booking</p>
                        <p class="text-sm">{{$data->Booking->no_booking}}</p>
                    </div>
                    <div class="tw-bg-green-100 tw-text-green-700">
                        <p class="font-bold">Tgl Penjualan</p>
                        <p class="text-sm">{{$data->tgl_trans_jual}}</p>
                    </div>
                </div>
                <div class="tw-grid tw-grid-cols-2">
                    <div class="tw-bg-grey-dark tw-text-grey-light" role="alert">
                        <p class="font-bold">Nama Customer</p>
                        <p class="text-sm">{{$data->Booking->Customer->nama_customer}}</p>
                    </div>
                    <div class="tw-bg-green-100 tw-text-green-700" role="alert">
                        <p class="font-bold">Tgl Batas Garansi</p>
                        <p class="text-sm">{{$data->tgl_max_garansi}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover tw-align-middle" id="transjualdetail">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumah</th>
                                <th>Disc</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>