@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <!-- Main content -->
    <section class="tw-mb-36">
        <div class="tw-grid md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-20 tw-gap-y-24 md:tw-gap-y-32">
            <a href="">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="tw-bg-prim-black  tw-px-4 tw-py-1 tw-h-16 tw-transition-all tw-flex tw-items-center flip-card-front">
                            <div class=" tw-flex-initial tw-w-8">
                                <i class="nav-icon fa fa-user tw-text-prim-white fa-2x tw-mr-5 tw-text-center"></i>
                            </div>
                            <div class="tw-flex-initial tw-w-36">
                                <p class="tw-font-bold tw-text-lg tw-text-prim-white tw-mb-0">Data Customer</p>
                            </div>
                        </div>
                        <div class="tw-bg-prim-blue  tw-px-4 tw-py-1 tw-h-16 tw-transition-all flip-card-back">
                            <p class="tw-text-[12px] ">Mengelola Data Customer yang melakukan transaksi di PT Maju Bersama Motor</p>
                        </div>
                    </div>
                </div>
            </a>

            <a href="">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="tw-bg-prim-black  tw-px-4 tw-py-1 tw-h-16 tw-transition-all tw-flex tw-items-center flip-card-front">
                            <div class=" tw-flex-initial tw-w-8">
                                <i class="nav-icon fa fa-wrench tw-text-prim-white fa-2x tw-mr-5 tw-text-center"></i>
                            </div>
                            <div class="tw-flex-initial tw-w-36">
                                <p class="tw-font-bold tw-text-lg tw-text-prim-white tw-mb-0">Daftar Jasa</p>
                            </div>
                        </div>
                        <div class="tw-bg-prim-blue  tw-px-4 tw-py-1 tw-h-16 tw-transition-all flip-card-back">
                            <p class="tw-text-[12px] ">Mengelola Daftar Jasa dan Harga untuk setiap jasa yang disediakan PT Maju Bersama Motor</p>
                        </div>
                    </div>
                </div>
            </a>

            <a href="">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="tw-bg-prim-black  tw-px-4 tw-py-1 tw-h-16 tw-transition-all tw-flex tw-items-center flip-card-front">
                            <div class=" tw-flex-initial tw-w-8">
                                <i class="nav-icon fa fa-qrcode tw-text-prim-white fa-2x tw-mr-5 tw-text-center"></i>
                            </div>
                            <div class="tw-flex-initial tw-w-36">
                                <p class="tw-font-bold tw-text-lg tw-text-prim-white tw-mb-0">Daftar Merk</p>
                            </div>
                        </div>
                        <div class="tw-bg-prim-blue  tw-px-4 tw-py-1 tw-h-16 tw-transition-all flip-card-back">
                            <p class="tw-text-[12px] ">Mengelola Seluruh Merk dari produk yang ada di PT Maju Bersama Motor</p>
                        </div>
                    </div>
                </div>
            </a>

            <a href="">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="tw-bg-prim-black  tw-px-4 tw-py-1 tw-h-16 tw-transition-all tw-flex tw-items-center flip-card-front">
                            <div class=" tw-flex-initial tw-w-8">
                                <i class="nav-icon fa fa-briefcase tw-text-prim-white fa-2x tw-mr-5 tw-text-center"></i>
                            </div>
                            <div class="tw-flex-initial tw-w-36">
                                <p class="tw-font-bold tw-text-lg tw-text-prim-white tw-mb-0">Data Pegawai</p>
                            </div>
                        </div>
                        <div class="tw-bg-prim-blue  tw-px-4 tw-py-1 tw-h-16 tw-transition-all flip-card-back">
                            <p class="tw-text-[12px] ">Mengelola Seluruh data pegawai yang ada di PT Maju Bersama Motor</p>
                        </div>
                    </div>
                </div>
            </a>

            <a href="">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="tw-bg-prim-black  tw-px-4 tw-py-1 tw-h-16 tw-transition-all tw-flex tw-items-center flip-card-front">
                            <div class=" tw-flex-initial tw-w-8">
                                <i class="nav-icon fa fa-percent tw-text-prim-white fa-2x tw-mr-5 tw-text-center"></i>
                            </div>
                            <div class="tw-flex-initial tw-w-36">
                                <p class="tw-font-bold tw-text-lg tw-text-prim-white tw-mb-0">Data Promo</p>
                            </div>
                        </div>
                        <div class="tw-bg-prim-blue  tw-px-4 tw-py-1 tw-h-16 tw-transition-all flip-card-back">
                            <p class="tw-text-[12px] ">Mengelola Promo / Discount yang sedang berjalan untuk setiap produk</p>
                        </div>
                    </div>
                </div>
            </a>

            <a href="">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="tw-bg-prim-black  tw-px-4 tw-py-1 tw-h-16 tw-transition-all tw-flex tw-items-center flip-card-front">
                            <div class=" tw-flex-initial tw-w-8">
                                <i class="nav-icon fa fa-balance-scale tw-text-prim-white fa-2x tw-mr-5 tw-text-center"></i>
                            </div>
                            <div class="tw-flex-initial tw-w-36">
                                <p class="tw-font-bold tw-text-lg tw-text-prim-white tw-mb-0">Daftar Satuan</p>
                            </div>
                        </div>
                        <div class="tw-bg-prim-blue  tw-px-4 tw-py-1 tw-h-16 tw-transition-all flip-card-back">
                            <p class="tw-text-[12px] ">Mengelola Daftar Satuan yang digunakan untuk setiap unit produk</p>
                        </div>
                    </div>
                </div>
            </a>

            <a href="">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="tw-bg-prim-black  tw-px-4 tw-py-1 tw-h-16 tw-transition-all tw-flex tw-items-center flip-card-front">
                            <div class=" tw-flex-initial tw-w-8">
                                <i class="nav-icon fa fa-truck tw-text-prim-white fa-2x tw-mr-5 tw-text-center"></i>
                            </div>
                            <div class="tw-flex-initial tw-w-36">
                                <p class="tw-font-bold tw-text-lg tw-text-prim-white tw-mb-0">Data Supplier</p>
                            </div>
                        </div>
                        <div class="tw-bg-prim-blue  tw-px-4 tw-py-1 tw-h-16 tw-transition-all flip-card-back">
                            <p class="tw-text-[12px] ">Mengelola Data Supplier / Pemasok barang dari PT Maju Bersama Motor</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="tw-bg-prim-black  tw-px-4 tw-py-1 tw-h-16 tw-transition-all tw-flex tw-items-center flip-card-front">
                            <div class=" tw-flex-initial tw-w-8">
                                <i class="nav-icon fa fa-archive tw-text-prim-white fa-2x tw-mr-5 tw-text-center"></i>
                            </div>
                            <div class="tw-flex-initial tw-w-36">
                                <p class="tw-font-bold tw-text-sm tw-text-prim-white tw-mb-0">Daftar Tipe Barang</p>
                            </div>
                        </div>
                        <div class="tw-bg-prim-blue  tw-px-4 tw-py-1 tw-h-16 tw-transition-all flip-card-back">
                            <p class="tw-text-[12px] ">Mengelola Kategori Barang yang ada di PT Maju Bersama Motor</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="tw-bg-prim-black  tw-px-4 tw-py-1 tw-h-16 tw-transition-all tw-flex tw-items-center flip-card-front">
                            <div class=" tw-flex-initial tw-w-8">
                                <i class="nav-icon fa fa-users tw-text-prim-white fa-2x tw-mr-5 tw-text-center"></i>
                            </div>
                            <div class="tw-flex-initial tw-w-36">
                                <p class="tw-font-bold tw-text-lg tw-text-prim-white tw-mb-0">Daftar User</p>
                            </div>
                        </div>
                        <div class="tw-bg-prim-blue  tw-px-4 tw-py-1 tw-h-16 tw-transition-all flip-card-back">
                            <p class="tw-text-[12px] ">Mengelola Data User beserta hak akses dalam menggunakan software</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection