@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-8 tw-px-10">
    <!-- Main content -->
    <section class="tw-mb-20">
        <div class="tw-grid md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-20 tw-gap-y-12 md:tw-gap-y-20">
            <button class='one customer' onclick="location.href = '/customer'">Data Customer</button>
            <button class='one jasa' onclick="location.href = '/jasa'">Daftar Jasa</button>
            <button class='one merk' onclick="location.href = '/merek'">Daftar Merk</button>
            <button class='one pegawai' onclick="location.href = '/pegawai'">Data Pegawai</button>
            <button class='one promo' onclick="location.href = '/promo'">Daftar Promo</button>
            <button class='one satuan' onclick="location.href = '/satuan'">Daftar Satuan</button>
            <button class='one supplier' onclick="location.href = '/supplier'">Daftar Supplier</button>
            <button class='one tipe' onclick="location.href = '/tipe'">Daftar Tipe Barang</button>
            <button class='one user' onclick="location.href = '/user'">Daftar User</button>
    </section>
    <!-- /.content -->
</div>
@endsection