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
        <div class="tw-grid tw-grid-cols-3 ">
            <div class="mx-2">
                <label for="booking_id">Pilih Supplier</label>
                <div class="dropdown">
                    <select class="custom-select select-user tw-text-prim-white" id="booking_id" name="booking_id">
                        <option value="0">Semua</option>
                    </select>
                </div>

            </div>
            <div class="mx-2">
                <label for="no_trans_jual">No Transaksi Pembelian</label>
                <input type="text" placeholder="No Transaksi" class="form-control no_trans_jual" name="no_trans_jual" id="no_trans_jual">
            </div>
            <div class="mx-2">
                <label for="tgl_trans_jual">Tgl Transaksi</label>
                <input type="date" placeholder="Tanggal Transaksi" class="form-control tgl_trans_jual" name="tgl_trans_jual" id="tgl_trans_jual">
            </div>
            <div class="my-4 mx-2 tw-row-span-2">
                <label for="user_beli">Supplier</label>
                <div>
                    <div>Prima Sakti Nugraha</div>
                    <div>Jl Ade Irma Suryani Nasution V No. 5, Tlogobendung Gresik</div>
                    <div>0838312222290</div>
                </div>
            </div>
            <div class="my-4 mx-2 tw-row-span-2">
                <label for="user_beli">Dibuat Oleh</label>
                <div>
                    <div>Suparjo</div>
                    <div>Marketing - M001</div>
                </div>
            </div>
            <div class="my-4 mx-2">
                <label for="user_beli">Batas Garansi</label>
                <input type="date" placeholder="Tanggal Transaksi" class="form-control tgl_max_garansi" name="tgl_max_garansi" id="tgl_max_garansi">
            </div>
            <div class="mb-4 mx-2 float-right">
                <label for="user_beli">Pembuat</label>
                <div class="dropdown">
                    <select class="custom-select select-user tw-text-prim-white" id="pembayaran_id" name="pembayaran_id">
                        <option value="0">Semua</option>
                    </select>
                </div>
            </div>
        </div>
        < <div class="tw-bg-white tw-px-5 tw-py-3 ">
            <div class="md:tw-overflow-x-hidden tw-overflow-y-auto tw-h-52">
                <table id="barang_beli" class="tw-w-full table table-striped ">
                    <thead class="tw-border-b tw-border-b-black">
                        <tr class="tw-border-transparent ">
                            <th scope="row" class="tw-text-left tw-border-t-0 ">Jenis Barang / Jasa</th>
                            <th scope="row" class="tw-text-left tw-border-t-0 tw-w-24">Jumlah</th>
                            <th scope="row" class="tw-text-left tw-border-t-0 tw-w-24">Satuan</th>
                            <th scope="row" class="tw-text-left tw-border-t-0 tw-w-36">Harga Satuan</th>
                            <th scope="row" class="tw-text-left tw-border-t-0 tw-w-24">Diskon</th>
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
                            <td data-label="diskon-beli">
                                <div class="form-group">
                                    <input type="number" class="form-control" name="diskon-beli" min="0">
                                </div>
                            </td>
                            <td data-label="Total">
                                <p>Rp.</p>
                            </td>
                            <td data-label="#">
                                <button class="tw-bg-transparent tw-border-none" onclick="deleteRow(this,'tbody2')">
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
                            <td class="tw-border-none">Diskon Transaksi %</td>
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