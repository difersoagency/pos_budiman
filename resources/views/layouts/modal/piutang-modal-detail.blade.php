<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="tw-grid tw-grid-cols-2">
                    <div class="tw-bg-grey-dark tw-text-grey-light" role="alert">
                        <p class="font-bold">No Penjualan</p>
                        <p class="text-sm">{{$data->TransJual->no_trans_jual}}</p>
                    </div>
                    <div class="tw-bg-green-100 tw-text-green-700" role="alert">
                        <p class="font-bold">Tgl Penjualan</p>
                        <p class="text-sm">{{$data->TransJual->tgl_trans_jual}}</p>
                    </div>
                    <div class="tw-bg-grey-dark tw-text-grey-light" role="alert">
                        <p class="font-bold">Nama Customer</p>
                        <p class="text-sm">{{$data->TransJual->Booking->Customer->nama_customer}}</p>
                    </div>
                    <div class="tw-bg-green-100 tw-text-green-700" role="alert">
                        <p class="font-bold">Total Piutang</p>
                        <p class="text-sm">{{$data->total_piutang}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="piutangtable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl Bayar</th>
                                <th>Pembayaran</th>
                                <th>Total Bayar</th>
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