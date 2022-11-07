@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <section class="tambahBeli">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="\transaksi">Transaksi</a></li>
                <li class="breadcrumb-item"><a href="{{route('retur-pembelian')}}">Retur Pembelian</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Retur Pembelian</li>
            </ol>
        </nav>
        <div class="tw-grid tw-grid-cols-2 tw-px-4">
            <div class="mx-2 ">
                <label for="htrans_jual_id">Ref Nomor PO</label>
                <div class="dropdown" style="width:50%;">
                    <select class="custom-select select-user tw-text-prim-white" id="htrans_beli_id" name="htrans_beli_id">
                        <option value="0">Semua</option>
                    </select>
                </div>
            </div>
            <div class="mx-2">
                <label for="user_beli">Tgl Retur Beli</label>
                <input type="date" placeholder="Tanggal Transaksi" class="form-control tgl_retur_beli tw-w-48" name="tgl_retur_beli" id="tgl_retur_beli">
            </div>
            <div class="my-4">
            <label for="user_beli" class="mx-2">Info Pembelian</label>
            <dl class="mx-2">
                <dd>Nomor PO/2022/V/23/0008</dd>
                <dd>Transaksi Pada 23 Mei 2022</dd>
                <dd>Garansi Hingga 23 November 2022</dd>
            </dl>
            </div>
            <div class="my-4">
                <label for="user_beli" class="mx-2">Supplier</label>
                <dl class="mx-2">
                    <dd>Prima Sakti Nugraha</dd>
                    <dd>Jl Ade Irma Suryani Nasution V No. 5, Tlogobendung Gresik</dd>
                    <dd>0838312222290</dd>
                </dl>
            </div>

        </div>
        <div class="tw-grid pb-4">
        <button class="tw-w-48 tw-bg-prim-red tw-border-0  tw-text-center tw-text-white tw-py-2 tw-rounded-lg hover:tw-bg-red-700 tw-transition-all float-right" onclick="addRow('tbody2')">
            + Tambah Barang Retur
        </button>
        </div>
        <div class="tw-bg-white tw-px-5 tw-py-3 ">
            <div class="tw-overflow-x-hidden tw-overflow-y-auto tw-h-52">
                <table id="barang_beli" class="tw-w-full table table-striped">
                    <thead class="tw-border-b tw-border-b-black">
                        <tr class="tw-border-transparent ">
                            <th class="tw-text-center tw-border-t-0" style="width:35%">Jenis Barang / Jasa</th>
                            <th class="tw-text-center tw-border-t-0" style="width:10%">Jumlah</th>
                            <th class="tw-text-center tw-border-t-0" style="width:20%">Harga</th>
                            <th class="tw-text-center tw-border-t-0" style="width:10%">Disc</th>
                            <th class="tw-text-center tw-border-t-0" style="width:20%">Subtotal</th>
                            <th class="tw-text-center tw-border-t-0" style="width:5%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody2">
                        <tr>
                            <td>
                                <!-- Dropdown -->
                                <div class="dropdown ">
                                    <select class="custom-select select-trans tw-text-prim-white" name="barang_id[]">
                                        <option value="0">Semua</option>
                                    </select>
                                </div>
                                <!-- End Dropdown  -->
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" class="form-control jumlah" name="jumlah[]" min="0">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" class="form-control harga" name="harga[]" min="0">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="disc[]" step="0.00" min="0">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="subtotal[]" min="0">
                                </div>
                            </td>

                            <td>
                                <button data-toggle="modal" data-target="#deleteModal" class="tw-bg-transparent tw-border-none">
                                    <i class="fa fa-trash tw-text-prim-red"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                        <td colspan="4">Total Harga</td>
                        <td colspan="2">Rp. 0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
        <div class=" tw-mb-40 tw-mt-10">
            <button class="tw-bg-white tw-border-2 tw-mr-5 tw-text-prim-blue  tw-border-prim-blue hover:tw-bg-prim-blue hover:tw-text-prim-white  tw-w-32 tw-text-center tw-py-2 tw-rounded-lg  tw-transition-all">
                <p class="tw-m-0 tw-font-bold">Batal</p>
            </button>
            <button class="tw-bg-prim-black tw-border-0 tw-w-32 tw-text-center tw-py-2 tw-rounded-lg hover:tw-bg-gray-600 tw-transition-all float-right">
                <p class="tw-m-0 tw-text-white">Simpan</p>
            </button>
        </div>
    </section>
</div>
@endsection
