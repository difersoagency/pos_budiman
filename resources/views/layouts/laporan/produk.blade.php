@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/laporan">Laporan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Produk</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-lg-12">

                    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-end tw-mb-4">

                    </div>
                    <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                        <div class="tw-w-full tw-col-span-2 md:tw-col-span-1">
                            <h1 class="tw-m-0 tw-text-2xl tw-font-bold">Laporan Produk</h1>
                        </div>
                        <div class="tw-text-right tw-grid tw-grid-cols-1 md:tw-flex tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">


                        </div>

                        <div class="viewtable tw-mt-5 tw-col-span-2" data-current-page="1" >
                            <table id="showtable" class="table main-table table-bordered responsive nowrap" style="width:100%">
                                <thead class="tw-bg-prim-blue">
                                    <tr class="tw-bg-prim-white">
                                        <th colspan="7">
                                        <a href="/laporan/data/produk" id="btncetak"><button type="button"  class="tw-w-48 tw-bg-prim-red tw-border-0  tw-text-center tw-text-white tw-py-2 tw-rounded-lg hover:tw-bg-red-700 tw-transition-all float-bottom" >Cetak Laporan</button></a>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="tw-text-prim-white">Kode</th>
                                        <th class="tw-text-prim-white">Merek</th>
                                        <th class="tw-text-prim-white">Nama</th>
                                        <th class="tw-text-prim-white">Satuan</th>
                                        <th class="tw-text-prim-white">Stok</th>
                                        <th class="tw-text-prim-white">Harga Beli</th>
                                        <th class="tw-text-prim-white">Harga Jual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- END : Tabel Tablet + Desktop -->
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
    </section>
</div>
@endsection
@section('script')
<script>
    $(function(){
            $('#showtable').DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                ajax: {
                    'type': 'POST',
                    'datatype': 'JSON',
                    'url': '/laporan/table/produk',
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'kode',
                        className: 'nowrap-text align-center',
                    },
                    {
                        data: 'merek',
                        className: 'nowrap-text align-center',
                    },
                    {
                        data: 'nama',
                        className: 'nowrap-text align-center',
                    },
                    {
                        data: 'satuan',
                        className: 'nowrap-text align-center',
                    },
                    {
                        data: 'stok',
                        className: 'nowrap-text align-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'harga_beli',
                        className: 'nowrap-text align-center',
                        orderable: false,
                        searchable: false,
                        render: $.fn.dataTable.render.number(',', '.', 2),
                    },
                    {
                        data: 'harga_jual',
                        className: 'nowrap-text align-center',
                        orderable: false,
                        searchable: false,
                        render: $.fn.dataTable.render.number(',', '.', 2),
                    },
                    
                ]
            });
    })
</script>
@endsection