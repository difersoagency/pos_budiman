<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="tw-grid tw-grid-cols-3">
                    <div class="tw-rounded-lg tw-align-middle"  role="alert">
                        <p><b>No Penjualan</b></p>
                        <p class="text-sm">{{$data->no_trans_jual}}</p>
                    </div>
                    <div class="tw-bg-grey-dark tw-text-grey-light" role="alert">
                        <p><b>No Booking</b></p>
                        <p class="text-sm">{{$data->Booking->no_booking}}</p>
                    </div>
                    <div class="tw-bg-grey-dark tw-text-grey-light"  role="alert">
                        <p><b>Tgl Penjualan</b></p>
                        <p class="text-sm">{{$data->tgl_trans_jual}}</p>
                    </div>
                </div>
                <div class="tw-grid tw-grid-cols-4">
                    <div class="tw-bg-grey-dark tw-text-grey-light" role="alert">
                        <p><b>Nama Customer</b></p>
                        <p class="text-sm">{{$data->Booking->Customer->nama_customer}}</p>
                    </div>
                    <div class="tw-bg-grey-dark tw-text-grey-light" role="alert">
                        <p><b>Tgl Batas Garansi</b></p>
                        <p class="text-sm">{{$data->tgl_max_garansi}}</p>
                    </div>
                    <div class="tw-bg-grey-dark tw-text-grey-light" role="alert">
                        <p><b>Total Bayar</b></p>
                        <p class="text-sm">{{$data->bayar_jual}}</p>
                    </div>
                    <div class="tw-bg-grey-dark tw-text-grey-light" role="alert">
                        <p><b>Kembali</b></p>
                        <p class="text-sm">{{$data->kembali_jual}}</p>
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
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Promo</th>
                                <th>Disc</th>
                                
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