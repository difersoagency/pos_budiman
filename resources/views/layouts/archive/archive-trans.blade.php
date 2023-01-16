@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-8 tw-px-10">
    <!-- Main content -->
    <section class="tw-mb-20">
        <div class="tw-grid md:tw-grid-cols-2 tw-gap-20 tw-gap-y-12 md:tw-gap-y-20">
        @if (in_array(Auth::user()->LevelUser->nama_level, ['owner', 'admin']))
            <button class='two beli' onclick="location.href = '/transaksi/beli'">Pembelian</button>
        @endif
        @if (in_array(Auth::user()->LevelUser->nama_level, ['owner', 'admin', 'kasir']))
            <button class='two jual' onclick="location.href = `{{route('trans-jual')}}`">Penjualan</button>
        @endif
        @if (in_array(Auth::user()->LevelUser->nama_level, ['owner']))
            <button class='two hutang' onclick="location.href = '/transaksi/hutang'">Hutang</button>
            <button class='two piutang' onclick="location.href = '/transaksi/piutang'">Piutang</button>
            <button class='two retur-jual' onclick="location.href = `{{route('retur-penjualan')}}`">Retur Jual</button>
            <button class='two retur-beli' onclick="location.href = `{{route('retur-pembelian')}}`">Retur Beli</button>
            <button class='two book' onclick="location.href = `{{route('master_booking')}}`">Booking</button>
        @endif
    </section>
    <!-- /.content -->
</div>
@endsection
