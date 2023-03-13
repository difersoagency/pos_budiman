@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/laporan">Laporan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Piutang</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-lg-12">

                    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-end tw-mb-4">

                    </div>
                    <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                        <div class="tw-w-full tw-col-span-2 md:tw-col-span-1">
                            <h1 class="tw-m-0 tw-text-2xl tw-font-bold">Laporan Piutang</h1>
                            
                        </div>
                        <div class="tw-w-full  tw-mt-5 tw-col-span-2">
                            <div class="tw-grid tw-grid-cols-3 tw-px-4">
                                <div class="mx-2">
                                    <label for="tgl_awal">Tgl Awal</label>
                                    <input type="date" placeholder="Tanggal Transaksi" class="form-control tgl_awal" name="tgl_awal" id="tgl_awal">
                                </div>
                                <div class="mx-2">
                                    <label for="tgl_akhir">Tgl Akhir</label>
                                    <input type="date" placeholder="Tanggal Transaksi" class="form-control tgl_akhir" name="tgl_akhir" id="tgl_akhir">
                                </div>
                                <div class="mx-2 mt-4">
                                    <button type="button" id="btnlaporan" class="tw-w-48 tw-bg-prim-red tw-border-0  tw-text-center tw-text-white tw-py-2 tw-rounded-lg hover:tw-bg-red-700 tw-transition-all float-bottom" >Cari</button>
                                </div>
                            </div>
                        </div>
                        <div class="viewtable tw-mt-5 tw-col-span-2" data-current-page="1" hidden="true">
                            <table id="showtable" class="table main-table table-bordered responsive nowrap" style="width:100%">
                                <thead class="tw-bg-prim-blue">
                                    <tr class="tw-bg-prim-white">
                                        <th colspan="7">
                                        <a href="" id="btncetak"><button type="button"  class="tw-w-48 tw-bg-prim-red tw-border-0  tw-text-center tw-text-white tw-py-2 tw-rounded-lg hover:tw-bg-red-700 tw-transition-all float-bottom" >Cetak Laporan</button></a>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="tw-text-prim-white">No Transaksi</th>
                                        <th class="tw-text-prim-white">Tgl Bayar</th>
                                        <th class="tw-text-prim-white">Pembayaran</th>
                                        <th class="tw-text-prim-white">No Pembayaran</th>
                                        <th class="tw-text-prim-white">Tgl Jatuh Tempo</th>
                                        <th class="tw-text-prim-white">Total</th>
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
        function table(tgl_awal, tgl_akhir){
            $('#showtable').empty();
            $('#showtable').DataTable({
                "columnDefs": [
                    { "visible": false, "targets": 0 }
                ],
                "order": [[ 0, 'asc']],
                "displayLength": 10,
                "drawCallback": function ( settings ) {
                    var api = this.api();
                    var rows = api.rows( {page:'current'} ).nodes();
                    var last=null;
                    api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                        if ( last !== group ) {
                            $(rows).eq( i ).before(
                                '<tr class="tw-bg-slate-500 tw-text-prim-white"><td colspan="5">'+group+'</td></tr>'
                            );
                            last = group;
                        }
                    });
                },
                destroy: true,
                processing: true,
                serverSide: false,
                ajax: {
                    'type': 'POST',
                    'datatype': 'JSON',
                    'url': '/laporan/table/piutang/'+tgl_awal+"/"+tgl_akhir,
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'no_trans_jual',
                        className: 'nowrap-text align-center',
                    },
                    {
                        data: 'tgl_bayar',
                        className: 'nowrap-text align-center',
                    },
                    {
                        data: 'pembayaran',
                        className: 'nowrap-text align-center',
                    },
                    {
                        data: 'no_giro',
                        className: 'nowrap-text align-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tgl_jatuh_tempo',
                        className: 'nowrap-text align-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'total_bayar',
                        className: 'nowrap-text align-center',
                        orderable: false,
                        searchable: false,
                        render: $.fn.dataTable.render.number(',', '.', 2),
                    },
                    
                ]
            });
        }
        $(document).on('click', '#btnlaporan', function(){
            var tgl_awal = $('#tgl_awal').val();
            var tgl_akhir = $('#tgl_akhir').val();
            table(tgl_awal, tgl_akhir)
            $('.viewtable').attr("hidden", false);
            $('#btncetak').attr("href","/laporan/data/piutang/"+tgl_awal+"/"+tgl_akhir);
        })
    })
</script>
@endsection