@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <section class="tambahBeli">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="transaksi">Transaksi</a></li>
                <li class="breadcrumb-item"><a href="beli">Pembelian</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengajuan Pembelian</li>
            </ol>
        </nav>
        <div class="tw-grid tw-grid-cols-2 tw-mb-7 tw-gap-7">
            <div>
                <label for="user_beli">Di Buat oleh</label>
                <!-- Dropdown -->
                <div class="dropdown tw-mb-7 md:tw-mb-0 md:tw-w-3/4">
                    <select class="custom-select select-user tw-text-prim-white" id="user_beli" name="state">
                        <option value="0">Semua</option>
                    </select>
                </div>
                <!-- End Dropdown  -->
            </div>
            <div>
                <label for="user_beli">Supplier</label>
                <!-- Dropdown -->
                <div class="dropdown tw-mb-7 md:tw-mb-0 md:tw-w-3/4">
                    <select class="custom-select select-user tw-text-prim-white" id="pembelian_beli" name="state">
                        <option value="0">Semua</option>
                    </select>
                </div>
                <!-- End Dropdown  -->
            </div>
        </div>
        <div class="tw-grid tw-grid-cols-2 md:tw-flex tw-gap-7 tw-mb-5">
            <div>
                <label for="tgl_beli">Tanggal Pembelian</label>
                <div class="tw-items-center tw-mb-4">
                    <div class="input-group input-daterange tw-items-center">
                        <input type="date" class="form-control tw-mr-3" id="tgl_beli" onclick="date()">
                    </div>
                    <!-- End Date Picker  -->
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="no_beli" class="col-form-label tw-pt-0">No. Pengajuan</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">#</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount" id="no_beli" name="no_beli">
                    </div>
                </div>
            </div>
            <div class="tw-col-span-2 md:tw-flex-auto">
                <div class="form-group">
                    <label for="desc_beli" class="col-form-label tw-pt-0">Deskripsi</label>
                    <input type="text" class="form-control " id="desc_beli" name="nama_barang">
                </div>
            </div>
        </div>
        <div class="tw-bg-white tw-px-5 tw-py-3 ">
            <div class="md:tw-overflow-x-hidden tw-overflow-y-auto tw-h-52">
                <table id="barang_beli" class="tw-w-full table table-striped ">
                    <thead class="tw-border-b tw-border-b-black">
                        <tr class="tw-border-transparent ">
                            <th scope="row" class="tw-text-left tw-border-t-0 ">Jenis Barang / Jasa</th>
                            <th scope="row" class="tw-text-left tw-border-t-0 tw-w-24">Jumlah</th>
                            <th scope="row" class="tw-text-left tw-border-t-0 tw-w-24">Satuan</th>
                            <th scope="row" class="tw-text-left tw-border-t-0 tw-w-36">Harga Satuan</th>
                            <th scope="row" class="tw-text-left tw-border-t-0 tw-w-36">Total</th>
                            <th scope="row" class="tw-text-left tw-border-t-0 tw-w-20">#</th>
                        </tr>
                    </thead>
                    <tbody id="tbody2">
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
                                    <input type="number" class="form-control" name="jumlah-beli" min="0">
                                </div>
                            </td>
                            <td data-label="Satuan">
                                <div class="dropdown tw-mb-7 md:tw-mb-0 ">
                                    <select class="custom-select select-trans tw-text-prim-white" name="state">
                                        <option value="0">Kg</option>
                                    </select>
                                </div>
                            </td>
                            <td data-label="Harga Satuan">
                                <div class="form-group">
                                    <input type="number" class="form-control" name="jumlah-beli" min="0">
                                </div>
                            </td>
                            <td data-label="Total">
                                <p>Rp.</p>
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
            <button class="tw-bg-prim-red  tw-border-0 tw-w-full tw-text-center tw-py-2 tw-rounded-lg hover:tw-bg-red-700 tw-transition-all" onclick="addRow('tbody2')">
                <p class="tw-m-0 tw-text-white">+ Tambah Barang</p>
            </button>
            <div class="totalPrice tw-mt-9">
                <table id="prices" class="table table-sm">
                    <tbody>
                        <tr>
                            <td colspan="3">Total Item : 5 Item</td>
                            <td>Biaya Lain</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" class="form-control tw-w-1" aria-label="Amount" id="harga-jual" name="harga_jual" placeholder="0">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="tw-border-none" colspan="3"></td>
                            <td class="tw-border-none">Diskon %</td>
                            <td class="tw-border-none">
                                <div class="input-group">
                                    <input type="number" class="form-control tw-w-1" aria-label="Amount" id="harga-jual" name="harga_jual" placeholder="0">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="tw-border-none" colspan="3"></td>
                            <td class="tw-border-none">Pajak (11%)</td>
                            <td class="tw-border-none">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text tw-bg-transparent tw-border-transparent">Rp.</span>
                                    </div>
                                    <input type="number" class="form-control tw-w-1 tw-bg-transparent tw-border-transparent" aria-label="Amount" id="harga-jual" name="harga_jual" value="0" disabled>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="tw-border-none"></td>
                        </tr>
                        <tr>
                            <td class="" colspan="3"></td>
                            <td class="">Subtotal</td>
                            <td class="">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text tw-bg-transparent tw-border-transparent">Rp.</span>
                                    </div>
                                    <input type="number" class="form-control tw-w-1 tw-bg-transparent tw-border-transparent" aria-label="Amount" id="harga-jual" name="harga_jual" value="0" disabled>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="tw-border-none" colspan="3"></td>
                            <td class="tw-border-none">Uang Muka</td>
                            <td class="tw-border-none">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" class="form-control tw-w-1" aria-label="Amount" id="harga-jual" name="harga_jual" value="0">
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
                                    <input type="number" class="form-control tw-w-1 tw-bg-transparent tw-border-transparent" aria-label="Amount" id="harga-jual" name="harga_jual" value="0" disabled>
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