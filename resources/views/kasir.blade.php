@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper">
    <section class="kasir-display">
        <div class="tw-flex">
            <div class="tw-flex-auto tw-w-96 tw-px-7 tw-py-6">
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
                        <img src="https://picsum.photos/150" alt="">
                        <h3 class="tw-text-[16px] tw-font-bold tw-mt-4">Nama Produk 1</h3>
                        <p class="tw-text-prim-red tw-font-bold tw-text-[14px] tw-m-0 tw-mt-1">Rp.000.000</p>
                        <p class="tw-text-prim-black tw-text-[12px] tw-m-0 tw-mt-1">Merk Produk</p>
                        <div class="mt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="min-btn w-outline-none tw-border-transparent tw-px-2 tw-bg-prim-red" disabled>-</button>
                                </div>
                                <input type="text" class="form-control tw-w-4 tw-text-center" aria-label="Amount" id="jumlah-kasir" value="0" name="stok">
                                <div class="input-group-prepend">
                                    <button type="button" class="plus-btn tw-bg-prim-red tw-text-prim-white tw-outline-none tw-border-transparent
                                        tw-px-2">+</button>
                                </div>
                            </div>
                        </div>
                        <button class="tw-mt-5 tw-border-transparent tw-px-3 tw-py-1 tw-w-full tw-bg-prim-blue hover:tw-bg-prim-black tw-transition-all">
                            <p class="tw-text-[12px] tw-m-0 tw-text-prim-white">Beli Barang</p>
                        </button>
                    </div>

                    <div class="item tw-px-3 tw-py-2 form-group">
                        <img src="https://picsum.photos/150" alt="">
                        <h3 class="tw-text-[16px] tw-font-bold tw-mt-4">Nama Produk 1</h3>
                        <p class="tw-text-prim-red tw-font-bold tw-text-[14px] tw-m-0 tw-mt-1">Rp.000.000</p>
                        <p class="tw-text-prim-black tw-text-[12px] tw-m-0 tw-mt-1">Merk Produk</p>
                        <div class="mt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="min-btn w-outline-none tw-border-transparent tw-px-2 tw-bg-prim-red" disabled>-</button>
                                </div>
                                <input type="text" class="form-control tw-w-4 tw-text-center" aria-label="Amount" id="jumlah-kasir" value="0" name="stok">
                                <div class="input-group-prepend">
                                    <button type="button" class="plus-btn tw-bg-prim-red tw-text-prim-white tw-outline-none tw-border-transparent
                                        tw-px-2">+</button>
                                </div>
                            </div>
                        </div>
                        <button class="tw-mt-5 tw-border-transparent tw-px-3 tw-py-1 tw-w-full tw-bg-prim-blue hover:tw-bg-prim-black tw-transition-all">
                            <p class="tw-text-[12px] tw-m-0 tw-text-prim-white">Beli Barang</p>
                        </button>
                    </div>


                </div>
            </div>
            <div class="tw-flex-auto tw-w-1 tw-px-7 tw-py-6 tw-bg-prim-white tw-h-screen">
                <h2 class="tw-font-bold tw-text-lg">Keranjang Belanja </h2>
                <hr>
                <div class="cart">
                    <div class="item-cart">
                        <div class="tw-grid tw-grid-cols-3 tw-items-center">
                            <div class="img-cart">
                                <img src="https://picsum.photos/80" alt="">
                            </div>
                            <div class="tw-col-span-2">
                                <h3 class="tw-text-[16px] tw-font-bold tw-mt-4">Nama Produk 1</h3>
                                <p class="tw-text-prim-red tw-font-bold tw-text-[14px] tw-m-0 tw-mt-1">Rp.000.000</p>
                                <p class="tw-text-prim-black tw-text-[12px] tw-m-0 tw-mt-1">Merk Produk</p>
                            </div>
                        </div>
                        <div class="deleteInput tw-mt-5 tw-grid tw-grid-cols-2 tw-justify-between tw-gap-5">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="min-btn w-outline-none tw-border-transparent tw-px-2 tw-bg-prim-red" disabled>-</button>
                                </div>
                                <input type="text" class="form-control tw-w-4 tw-text-center" aria-label="Amount" id="jumlah-kasir" value="0" name="stok">
                                <div class="input-group-prepend">
                                    <button type="button" class="plus-btn tw-bg-prim-red tw-text-prim-white tw-outline-none tw-border-transparent
                                        tw-px-2">+</button>
                                </div>
                            </div>
                            <div>
                                <button>
                                    <p class="tw-m-0">Delete</p>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection