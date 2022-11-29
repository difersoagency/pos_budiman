@extends('layouts.admin.master')

@section('content')

<div class="content-wrapper tw-py-6 tw-px-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/master">Master</a></li>
            <li class="breadcrumb-item active" aria-current="page">Koreksi</li>
        </ol>
    </nav>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                        <div class="tw-w-full tw-col-span-2 ">
                            <h1 class="tw-m-0 tw-text-2xl tw-font-bold">Update Stock Barang</h1>
                        </div>

                        <div class="mx-2 mt-4">
                            <label for="koreksi_tanggal">Tgl Transaksi</label>
                            <input type="date" placeholder="Tanggal Transaksi" class="form-control koreksi_tanggal" name="koreks_tanggal" id="koreksi_tanggal">
                        </div>
                        <div class="mx-2 mt-4">
                            <label for="booking_id">Jenis Barang</label>
                            <div class="dropdown" style="width:100%;">
                                <select class="custom-select select-user tw-text-prim-white" id="koreksi_jenis" name="koreksi_jenis">
                                    <option value="1">Test</option>
                                </select>
                            </div>
                        </div>
                        <div class="mx-2 mt-4">
                            <label for="booking_id">Nama Barang</label>
                            <div class="dropdown" style="width:100%;">
                                <select class="custom-select select-user tw-text-prim-white" id="koreksi_barang" name="koreksi_barang">
                                    <option value="1">Test</option>
                                </select>
                            </div>
                        </div>
                        <div class="mx-2 mt-4">
                            <label for="no_trans_jual">Jumlah Stock</label>
                            <input type="number" placeholder="Jumlah" class="form-control koreksi_jumlah" name="koreksi_jumlah" id="koreksi_jumlah" min="0">
                        </div>
                        <div class="tw-w-full tw-col-span-2 mt-4 mx-2">
                            <label for="koreksi_keterangan">Keterangan</label>
                            <textarea name="koreksi_keterangan" id="koreksi_keterangan" cols="30" rows="5" class="form-control koreksi_keterangan"></textarea>
                        </div>
                        <div class="col-span-2 mt-4">
                            <div class="col-lg-12">
                                <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" type="button" id="tambah_jasa">
                                    Batal
                                </button>
                                <button class="btn tw-text-prim-white tw-bg-prim-blue tw-text-sm tw-w-full ml-3 md:tw-w-fit" type="button" id="tambah_jasa">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                        <div class="tw-w-full tw-col-span-2 md:tw-col-span-1">
                            <h1 class="tw-m-0 tw-text-2xl tw-font-bold">Riwayat Transaksi</h1>
                        </div>
                        <div class="tw-text-right tw-items-center tw-grid tw-grid-cols-1 tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">
                            <div class="tw-w-full md:tw-w-fit md:tw-ml-auto">
                                <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" type="button" id="tambah_jasa">
                                    + Tambah Jasa
                                </button>
                            </div>
                        </div>

                        <!-- START: Table Mobile View -->
                        <div class="table-barang-mobile tw-mt-5 md:tw-hidden">
                            <div class="list-barang" data-current-page="1">
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- START: Table Tablet + Desktop -->
                        <div class="table-koreksi tw-mt-5 tw-col-span-2" data-current-page="1">
                            <table id="showtable" class="table main-table table-bordered responsive nowrap" style="width:100%">
                                <thead class="tw-bg-prim-blue">
                                    <tr>
                                        <th class="tw-text-prim-white">No</th>
                                        <th class="tw-text-prim-white">Tgl. Koreksi</th>
                                        <th class="tw-text-prim-white">Jenis</th>
                                        <th class="tw-text-prim-white tw-w-60">Nama</th>
                                        <th class="tw-text-prim-white">Jumlah</th>
                                        <th class="tw-text-prim-white">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>1</td>
                                    <td>12/12/12</td>
                                    <td>Lampu</td>
                                    <td>Lampu Depan Merah</td>
                                    <td>5</td>
                                    <td>Opname</td>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- /.col-md-6 -->
                </div>
            </div>
        </div>
    </section>
</div>

<!-- END:Modal -->
<!-- /.content -->
</div>
@section('script')
<script></script>
@stop
@endsection