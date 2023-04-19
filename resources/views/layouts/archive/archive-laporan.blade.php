@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-8 tw-px-10">
    <!-- Main content -->
    <section class="tw-mb-20">
        <div class="tw-grid md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-20 tw-gap-y-12 md:tw-gap-y-20">
            @if (in_array(Auth::user()->LevelUser->nama_level, ['owner', 'admin']))
            <button class='three jual' onclick="location.href = '/laporan/penjualan'">Laporan Penjualan</button>
            <button class='three beli' onclick="location.href = '/laporan/pembelian'">Laporan Pembelian</button>
            <button class='three retur-jual' onclick="location.href = '/laporan/retur_jual'">Laporan Retur Jual</button>
            <button class='three retur-beli' onclick="location.href = '/laporan/retur_beli'">Laporan Retur Beli</button>
            <button class='three book' onclick="location.href = '/laporan/laba_rugi'">Laporan Laba Rugi</button>
            <button class='three piutang' onclick="location.href = '/laporan/piutang'">Laporan Piutang</button>
            <button class='three hutang' onclick="location.href = '/laporan/hutang'">Laporan Hutang</button>
            <button class='three satuan' onclick="location.href = '/laporan/top_penjualan'">Laporan Top Penjualan</button>
            @endif
            @if (in_array(Auth::user()->LevelUser->nama_level, ['owner', 'admin', 'kasir']))
            <button class='three lap' onclick="location.href = '/laporan/kartu_stok'">Laporan Kartu Stok</button>
            <button class='three tipe' onclick="location.href = '/laporan/produk'">Laporan Produk</button>
            @endif
    </section>
    <!-- /.content -->
</div>
@endsection