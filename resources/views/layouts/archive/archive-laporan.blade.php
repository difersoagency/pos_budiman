@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-8 tw-px-10">
    <!-- Main content -->
    <section class="tw-mb-20">
        <div class="tw-grid md:tw-grid-cols-2 tw-gap-20 tw-gap-y-12 md:tw-gap-y-20">
            <button class='three lap' onclick="location.href = '/laporan/keuangan'">Laporan Keuangan</button>
            <button class='three lapjual' onclick="location.href = '/laporan/penjualan'">Laporan Penjualan & Piutang</button>
            <button class='three lapbeli' onclick="location.href = '/laporan/pembelian'">Laporan Pembelian & Utang</button>
            <button class='three lapbarang' onclick="location.href = '/laporan/produk'">Laporan Produk</button>
    </section>
    <!-- /.content -->
</div>
@endsection