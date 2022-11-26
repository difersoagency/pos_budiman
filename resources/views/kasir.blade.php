@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper">
    <section class="kasir-display">
        <div class="tw-flex">
            <div class="tw-flex-auto tw-w-96 tw-px-7 tw-py-6 tw-h-full">
                <div class="tw-grid tw-grid-cols-2 tw-justify-between">
                    <h2 class="tw-font-bold tw-text-lg tw-flex-auto">Pilih Kategori Barang</h2>

                    <!-- Dropdown -->
                    <div class="dropdown tw-mb-7 md:tw-mb-0 tw-w-full">
                        <select class="custom-select select-2 tw-bg-prim-blue tw-text-prim-white" id="merk_id" name="state">
                            <option value="0">Semua</option>
                        </select>
                    </div>
                    <!-- End Dropdown  -->
                </div>
                <div class="tw-grid tw-grid-cols-3 tw-mt-7 tw-gap-7">
                    <div class="item tw-px-3 tw-py-2 form-group">
                        <img src="https://picsum.photos/150" alt="" class="img-item">
                        <h3 class="tw-text-[16px] tw-font-bold tw-mt-4 nama-produk">Nama Produk 1</h3>
                        <p class="tw-text-prim-red tw-font-bold tw-text-[14px] tw-m-0 tw-mt-1">Rp.<span class="harga-produk">5000</span></p>
                        <p class="tw-text-prim-black tw-text-[12px] tw-m-0 tw-mt-1 merk-produk">Merk Produk</p>
                        <div class="mt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" onclick="minValueKasir('jumlah-kasir')" class="min-btn w-outline-none tw-border-transparent tw-px-2 tw-bg-prim-red tw-text-prim-white">-</button>
                                </div>
                                <input type="text" class="form-control tw-w-4 tw-text-center" aria-label="Amount" id="jumlah-kasir" value="0" name="stok">
                                <div class="input-group-prepend">
                                    <button type="button" onclick="addValueKasir('jumlah-kasir')" class="plus-btn tw-bg-prim-red tw-text-prim-white tw-outline-none tw-border-transparent
                                        tw-px-2">+</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" onclick="atcButton(this)" class="atc tw-mt-5 tw-border-transparent tw-px-3 tw-py-1 tw-w-full tw-bg-prim-blue hover:tw-bg-prim-black tw-transition-all">
                            <p class="tw-text-[12px] tw-m-0 tw-text-prim-white">Beli Barang</p>
                        </button>
                    </div>

                </div>
            </div>
            <div class="tw-flex-auto tw-w-1 tw-px-7 tw-py-6 tw-bg-prim-white tw-h-screen
            ">
                <div class="tw-h-[50%]">
                    <h2 class="tw-font-bold tw-text-lg">Keranjang Belanja </h2>
                    <hr>
                    <div class="cart">

                    </div>
                </div>
                <hr>
                <div class="total-belanja tw-mb-12">
                    <div class="tw-grid tw-grid-cols-2 subtotal">
                        <p class="tw-font-bold">Subtotal :</p>
                        <p>Rp.<span>000000</span></p>
                    </div>
                    <div class="tw-grid tw-grid-cols-2 tax">
                        <p class="tw-font-bold">Tax(11%) :</p>
                        <p>Rp.<span>000000</span></p>
                    </div>
                    <div class="tw-grid tw-grid-cols-2 diskon">
                        <p class="tw-font-bold">Diskon % :</p>
                        <input type="number" class="form-control tw-w-20" aria-label="" id="diskon-kasir" name="diskon-kasir" placeholder="0" min="0">
                    </div>
                    <hr class="tw-border-dotted">
                    <div class="tw-grid tw-grid-cols-2 total">
                        <p class="tw-font-bold">Total :</p>
                        <p>Rp.<span>000000</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection