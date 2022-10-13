@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <section class="tambahBeli">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="transaksi">Transaksi</a></li>
                <li class="breadcrumb-item"><a href="beli">Penjualan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Penjualan</li>
            </ol>
        </nav>
        <div class="tw-grid tw-grid-cols-3 tw-px-4">
            <div class="mx-2">
                <label for="booking_id">No Booking</label>
                <div class="dropdown" style="width:100%;">
                    <select class="custom-select booking_id tw-text-prim-white" id="booking_id" name="booking_id">
                        <option value=""></option>
                    </select>
                </div>

            </div>
            <div class="mx-2">
                <label for="no_trans_jual">No Transaksi Penjualan</label>
                <input type="text" placeholder="No Transaksi" class="form-control no_trans_jual" name="no_trans_jual" id="no_trans_jual">
            </div>
            <div class="mx-2">
                <label for="tgl_trans_jual">Tgl Transaksi</label>
                <input type="date" placeholder="Tanggal Transaksi" class="form-control tgl_trans_jual" name="tgl_trans_jual" id="tgl_trans_jual">
            </div>
            <div class="my-4 tw-row-span-2">
                <label for="user_beli" class="mx-2">Customer</label>
                <dl class="mx-2">
                    <dl id="customer_id">-</dl>
                    <dl id="customer_alamat">-</dl>
                    <dl id="customer_telp">-</dl>
                </dl>
            </div>
            <div class="my-4 tw-row-span-2">
                <label for="user_beli" class="mx-2">Dibuat Oleh</label>
                <dl class="mx-2">
                    <dd>{{Auth::user()->pegawai->nama_pegawai}}</dd>
                    <dd>{{Auth::user()->LevelUSer->nama_level}} - {{Auth::user()->pegawai->kode_pegawai}}</dd>
                </dl>
            </div>
            <div class="my-4 mx-2">
                <label for="user_beli">Batas Garansi</label>
                <input type="date" placeholder="Tanggal Transaksi" class="form-control tgl_retur_beli" name="tgl_retur_beli" id="tgl_retur_beli">
            </div>
            <div class="mb-4 mx-2 float-right">
                <label for="user_beli">Pembayaran</label>
                <div class="dropdown">
                    <select class="custom-select pembayaran_id tw-text-prim-white" id="pembayaran_id" name="pembayaran_id">
                    </select>
                </div>
            </div>
        </div>
        <div class="tw-rounded-lg promobox mb-4 tw-py-2 tw-px-4">
            <h2 class="tw-text-md tw-text-prim-white">Promo</h2>
            <div class="tw-grid tw-grid-cols-4 tw-gap-7">
                <div class="my-2  tw-text-white">
                    <label for="user_beli">Nama Promo</label>
                    <div class="form-check tw-text-white">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" checked>
                        <label class="tw-text-white tw-text-[12px]" for="flexCheckCheckedDisabled">
                            Diskon 50% untuk Pembelian 2 Oli
                        </label>
                    </div>
                </div>
                <div class="my-2  tw-text-white">
                    <label for="user_beli">Nama Promo</label>
                    <div class="form-check tw-text-white">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" checked>
                        <label class="tw-text-white tw-text-[12px]" for="flexCheckCheckedDisabled">
                            Diskon 50% untuk Pembelian 2 Oli
                        </label>
                    </div>
                </div>
            </div>

        </div>
        <div class="tw-grid pb-4">
            <button class="tw-w-48 tw-bg-prim-red tw-border-0  tw-text-center tw-text-white tw-py-2 tw-rounded-lg hover:tw-bg-red-700 tw-transition-all float-right" onclick="addRow('tbody2')">
                + Tambah Barang
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
                                    <select class="custom-select barang_id tw-text-prim-white" name="barang_id[]">
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
@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function(){
    $('.barang_id').prepend('<option selected=""></option>').select2({
        placeholder: "Pilih Barang",
        delay: 250,
                ajax: {
                    dataType: 'json',
                    type: 'GET',
                    url: '/api/barang_select',
                    data: function(params) {
                        return {
                            term: params.term
                        }
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.kode_barang+' - '+obj.nama_barang
                                };
                            })
                        };
                    },
                }
    });

    $('.booking_id').prepend('<option selected=""></option>').select2({
        placeholder: "Pilih No Booking",
        delay: 250,
                ajax: {
                    dataType: 'json',
                    type: 'GET',
                    url: '/api/booking_select',
                    data: function(params) {
                        return {
                            term: params.term
                        }
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.no_booking+' - '+obj.customer.nama_customer
                                };
                            })
                        };
                    },
                }
    });

    $('.pembayaran_id').prepend('<option selected=""></option>').select2({
        placeholder: "Pilih Pembayaran",
        delay: 250,
                ajax: {
                    dataType: 'json',
                    type: 'GET',
                    url: '/api/pembayaran_select',
                    data: function(params) {
                        return {
                            term: params.term
                        }
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.nama_bayar
                                };
                            })
                        };
                    },
                }
    });
})
</script>
@stop