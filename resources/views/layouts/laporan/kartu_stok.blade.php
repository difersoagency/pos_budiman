@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/laporan">Laporan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kartu Stok</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-lg-12">

                    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-end tw-mb-4">

                    </div>
                    <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                        <div class="tw-w-full tw-col-span-2 md:tw-col-span-1">
                            <h1 class="tw-m-0 tw-text-2xl tw-font-bold">Laporan Kartu Stok</h1>
                            
                        </div>
                        <div class="tw-w-full  tw-mt-5 tw-col-span-2">
                            <div class="tw-grid tw-grid-cols-4 tw-px-4">
                                <div class="mx-2">
                                    <label for="tgl_awal">Barang</label>
                                    <select name="barang_id" id="barang_id" class="custom-select  tw-text-prim-white barang_id" style="width: 100%">
                                    </select>
                                </div>
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
                                        <th colspan="6">
                                        <a href="" id="btncetak"><button type="button"  class="tw-w-48 tw-bg-prim-red tw-border-0  tw-text-center tw-text-white tw-py-2 tw-rounded-lg hover:tw-bg-red-700 tw-transition-all float-bottom">Cetak Laporan</button></a>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="tw-text-prim-white">Tgl Transaksi</th>
                                        <th class="tw-text-prim-white">No Transaksi</th>
                                        <th class="tw-text-prim-white">Barang</th>
                                        <th class="tw-text-prim-white">Jenis</th>
                                        <th class="tw-text-prim-white">Jumlah Masuk</th>
                                        <th class="tw-text-prim-white">Jumlah Keluar</th>
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
        function table(barang_id, tgl_awal, tgl_akhir){
            $('#showtable').empty();
            $('#showtable').DataTable({
                "columnDefs": [
                    { "visible": false, "targets": 2 }
                ],
                "order": [[ 2, 'asc']],
                "displayLength": 10,
                "drawCallback": function ( settings ) {
                    var api = this.api();
                    var rows = api.rows( {page:'current'} ).nodes();
                    var last=null;
                    api.column(2, {page:'current'} ).data().each( function ( group, i ) {
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
                    'url': '/laporan/table/kartu_stok/'+barang_id+"/"+tgl_awal+"/"+tgl_akhir,
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'tgl_transaksi',
                        className: 'nowrap-text align-center',
                    },
                    {
                        data: 'nomor',
                        className: 'nowrap-text align-center',
                    },
                    {
                        data: 'barang',
                        className: 'nowrap-text align-center',
                    },
                    {
                        data: 'jenis',
                        className: 'nowrap-text align-center',
                    },
                    {
                        data: 'jumlah_masuk',
                        className: 'nowrap-text align-center',
                    },
                    {
                        data: 'jumlah_keluar',
                        className: 'nowrap-text align-center',
                    }
                ]
            });
        }
        $(document).on('click', '#btnlaporan', function(){
            var barang_id = $('#barang_id').val();
            var tgl_awal = $('#tgl_awal').val();
            var tgl_akhir = $('#tgl_akhir').val();
            table(barang_id, tgl_awal, tgl_akhir)
            $('.viewtable').attr("hidden", false);
            $('#btncetak').attr("href","/laporan/data/kartu_stok/"+barang_id+'/'+tgl_awal+"/"+tgl_akhir);
        });
        $('.barang_id').prepend('<option value="0">Semua Barang</option>').select2({
            placeholder: "Pilih Barang",
            ajax: {
                minimumResultsForSearch: 20,
                dataType: 'json',
                theme: "bootstrap",
                delay: 250,
                type: 'GET',
                url: '{{route("barang.selectdata")}}',
                data: function(params) {
                    return {
                        term: params.term,
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.nama_barang
                            };
                        })
                    };
                },
            }
        })
    })
</script>
@endsection