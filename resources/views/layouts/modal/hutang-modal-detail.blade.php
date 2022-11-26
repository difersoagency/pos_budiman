<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="tw-grid tw-grid-cols-2">
                    <div class="tw-bg-grey-dark tw-text-grey-light" role="alert">
                        <p class="font-bold"><b>No Penjualan</b></p>
                        <p class="text-sm">{{$data->TransBeli->nomor_po}}</p>
                    </div>
                    <div class="tw-bg-green-100 tw-text-green-700" role="alert">
                        <p class="font-bold"><b>Tgl Penjualan</b></p>
                        <p class="text-sm">{{$data->TransBeli->tgl_trans_beli}}</p>
                    </div>
                    <div class="tw-bg-grey-dark tw-text-grey-light" role="alert">
                        <p class="font-bold"><b>Nama Customer</b></p>
                        <p class="text-sm">{{$data->TransBeli->Supplier->nama_supplier}}</p>
                    </div>
                    <div class="tw-bg-green-100 tw-text-green-700" role="alert">
                        <p class="font-bold"><b>Total Hutang</b></p>
                        <p class="text-sm">{{  number_format(($data->TransBeli->total - $data->TransBeli->total_bayar), 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="hutangtable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl Bayar</th>
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