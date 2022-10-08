@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <section class="tambahBeli">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="transaksi">Transaksi</a></li>
                <li class="breadcrumb-item"><a href="piutang">Daftar Piutang</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pembayaran Piutang</li>
            </ol>
        </nav>
        <div class="tw-grid tw-grid-cols-2 tw-mb-7 tw-gap-7">
            <div>
                <label for="user_beli">Pillih Pelanggan</label>
                <!-- Dropdown -->
                <div class="dropdown tw-mb-7 md:tw-mb-0 md:tw-w-3/4">
                    <select class="custom-select select-user tw-text-prim-white" id="cust_piutang" name="state">
                        <option value="0">Semua</option>
                    </select>
                </div>
                <!-- End Dropdown  -->
            </div>
            <div>
                <label for="user_beli">Metode Pembayaran</label>
                <!-- Dropdown -->
                <div class="dropdown tw-mb-7 md:tw-mb-0 md:tw-w-3/4">
                    <select class="custom-select select-user tw-text-prim-white" id="metode_pembayaran" name="state">
                        <option value="0">Semua</option>
                    </select>
                </div>
                <!-- End Dropdown  -->
            </div>
        </div>
        <div class="tw-grid tw-grid-cols-2 md:tw-flex tw-gap-7 tw-mb-5">
            <div>
                <label for="tgl_beli">Tanggal Pembayaran</label>
                <div class="tw-items-center tw-mb-4">
                    <div class="input-group input-daterange tw-items-center">
                        <input type="date" class="form-control tw-mr-3" id="tgl_beli" onclick="date()">
                    </div>
                    <!-- End Date Picker  -->
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="no_beli" class="col-form-label tw-pt-0">No. Pembayaran</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">#</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount" id="no_piu" name="no_piu">
                    </div>
                </div>
            </div>
            <div class="tw-col-span-2 md:tw-flex-auto">
                <div class="form-group">
                    <label for="desc_beli" class="col-form-label tw-pt-0">Deskripsi</label>
                    <input type="text" class="form-control " id="desc_piu" name="desc_piu">
                </div>
            </div>
        </div>
        <div class="tw-bg-white tw-px-5 tw-py-3 ">
            <div class="md:tw-overflow-x-hidden tw-overflow-y-auto tw-h-52">
                <table id="barang_beli" class="tw-w-full table table-striped ">
                    <thead class="tw-border-b tw-border-b-black">
                        <tr class="tw-border-transparent ">
                            <th scope="row" class="tw-text-left tw-border-t-0 tw-w-32">No. Nota</th>
                            <th scope="row" class="tw-text-left tw-border-t-0 tw-w-12">Tanggal</th>
                            <th scope="row" class="tw-text-left tw-border-t-0 tw-w-52">Jumlah</th>
                            <th scope="row" class="tw-text-left tw-border-t-0 tw-w-36">Diskon</th>
                            <th scope="row" class="tw-text-left tw-border-t-0 tw-w-48">Pembayaran</th>
                            <th scope="row" class="tw-text-left tw-border-t-0 tw-w-20">#</th>
                        </tr>
                    </thead>
                    <tbody id="piutang">
                        <tr>
                            <td data-label="Jenis Barang / Jasa" scope="row">
                                <!-- Dropdown -->
                                <div class="dropdown tw-mb-7 md:tw-mb-0 ">
                                    <select class="custom-select select-trans tw-text-prim-white" name="state">
                                        <option value="0">Semua</option>
                                    </select>
                                </div>
                                <!-- End Dropdown  -->
                            </td>
                            <td data-label="Jumlah">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="tanggal_bayar_piutang" disabled>
                                </div>
                            </td>
                            <td data-label="Satuan">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Amount" id="jumlah_piutang" name="jumlah_piutang" disabled value="0">
                                </div>
                            </td>
                            <td data-label="Harga Satuan">
                                <div class="input-group">
                                    <input type="text" class="form-control" aria-label="Amount" id="diskon_piutang" name="diskon_piutang" value="0">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Total">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Amount" id="bayar_piutang" name="bayar_piutang" value="0">
                                </div>
                            </td>
                            <td data-label="#">
                                <button class="tw-bg-transparent tw-border-none" onclick="deleteRow('tbody2')">
                                    <i class="fa fa-trash tw-text-prim-red"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button class="tw-bg-prim-red  tw-border-0 tw-w-full tw-text-center tw-py-2 tw-rounded-lg hover:tw-bg-red-700 tw-transition-all" onclick="addRow('piutang')">
                <p class="tw-m-0 tw-text-white">+ Tambah Kolom</p>
            </button>
            <div class="totalPrice tw-mt-9">
                <table id="prices" class="table table-sm">
                    <tbody>
                        <tr>
                            <td colspan="3"></td>
                            <td>Biaya Lain</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" class="form-control tw-w-1" aria-label="Amount" id="other_piutang" name="other_piutang" placeholder="0">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="tw-border-none" colspan="3"></td>
                            <td class="tw-border-none">Total</td>
                            <td class="tw-border-none">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text tw-bg-transparent tw-border-transparent">Rp.</span>
                                    </div>
                                    <input type="number" class="form-control tw-w-1 tw-bg-transparent tw-border-transparent" aria-label="Amount" id="total_bayar_piutang" name="total_bayar_piutang" value="0" disabled>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tw-flex tw-mb-40 tw-mt-10">
            <button class="tw-bg-white tw-border-2 tw-mr-5 tw-text-prim-blue  tw-border-prim-blue hover:tw-bg-prim-blue hover:tw-text-prim-white  tw-w-32 tw-text-center tw-py-2 tw-rounded-lg  tw-transition-all">
                <p class="tw-m-0 tw-font-bold">Batal</p>
            </button>
            <button class="tw-bg-prim-black tw-border-0 tw-w-32 tw-text-center tw-py-2 tw-rounded-lg hover:tw-bg-gray-600 tw-transition-all">
                <p class="tw-m-0 tw-text-white">Simpan</p>
            </button>
        </div>
    </section>
</div>
@endsection