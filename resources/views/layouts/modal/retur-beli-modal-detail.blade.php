<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="tw-grid tw-grid-cols-2">
                    <div class="tw-bg-grey-dark tw-text-grey-light" role="alert">
                        <p class="font-bold"><b>No Penjualan</b></p>
                        <p class="text-sm">{{ $data->TransBeli->nomor_po }}</p>
                    </div>
                    <div class="tw-bg-green-100 tw-text-green-700" role="alert">
                        <p class="font-bold"><b>Tgl Penjualan</b></p>
                        <p class="text-sm">{{ $data->TransBeli->tgl_trans_beli }}</p>
                    </div>
                    <div class="tw-bg-grey-dark tw-text-grey-light" role="alert">
                        <p class="font-bold"><b>Nama Customer</b></p>
                        <p class="text-sm">{{ $data->TransBeli->Supplier->nama_supplier }}</p>
                    </div>
                    <div class="tw-bg-green-100 tw-text-green-700" role="alert">
                        <p class="font-bold"><b>Total Retur</b></p>
                        <p class="text-sm">
                            {{ number_format($data->total_retur_beli, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="returtable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
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
