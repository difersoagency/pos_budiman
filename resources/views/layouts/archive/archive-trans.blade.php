@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-8 tw-px-10">
    <!-- Main content -->
    <section class="tw-mb-20">
        <div class="tw-grid md:tw-grid-cols-2 tw-gap-20 tw-gap-y-12 md:tw-gap-y-20">
            <button class='two beli' onclick="location.href = 'beli'">Pembelian</button>
            <button class='two jual' onclick="location.href = 'jual'">Penjualan</button>
            <button class='two hutang' onclick="location.href = 'hutang'">Hutang</button>
            <button class='two piutang' onclick="location.href = 'piutang'">Piutang</button>
    </section>
    <!-- /.content -->
</div>
@endsection