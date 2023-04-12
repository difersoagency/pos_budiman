@extends('layouts.admin.master')
@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/laporan">Laporan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Hutang</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-lg-12">

                    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-end tw-mb-4">

                    </div>
                    <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                        <div class="tw-w-full tw-col-span-2 md:tw-col-span-1">
                            <h1 class="tw-m-0 tw-text-2xl tw-font-bold">Laporan Hutang</h1>
                            
                        </div>
                        <div class="tw-w-full  tw-mt-5 tw-col-span-2">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Laporan</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Grafik</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
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
                                                    <a href="" id="btncetak"><button type="button"  class="tw-w-48 tw-bg-prim-red tw-border-0  tw-text-center tw-text-white tw-py-2 tw-rounded-lg hover:tw-bg-red-700 tw-transition-all float-bottom">Cetak Laporan</button></a>
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
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="tw-w-full  tw-mt-5 tw-col-span-2">
                                        <div class="tw-grid tw-grid-cols-3 tw-px-4">
                                            <div class="mx-2">
                                                <label for="bulan">Bulan</label>
                                                <select name="bulan" id="bulan" class="custom-select  tw-text-prim-white bulan" style="width: 100%">
                                                </select>
                                            </div>
                                            <div class="mx-2">
                                                <label for="tahun">Tahun</label>
                                                <select name="tahun" id="tahun" class="custom-select  tw-text-prim-white tahun" style="width: 100%">
                                                </select>
                                            </div>
                                            <div class="mx-2 mt-4">
                                                <button type="button" id="btngrafik" class="tw-w-48 tw-bg-prim-red tw-border-0  tw-text-center tw-text-white tw-py-2 tw-rounded-lg hover:tw-bg-red-700 tw-transition-all float-bottom" >Cari</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="viewgrafik tw-mt-5 tw-col-span-2" data-current-page="1" hidden="true">
                                        <div class="overflow-hidden rounded-lg shadow-lg">
                                            <div class="bg-neutral-50 py-3 px-5 dark:bg-neutral-700 dark:text-neutral-200">
                                                Hutang
                                            </div>
                                            <canvas class="p-10" id="chartBar"></canvas>
                                        </div>
                                    </div>
                                </div>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(function(){
        const bulan = [
                {
                    id: '01',
                    text: 'Januari'
                },
                {
                    id: '02',
                    text: 'Februari'
                },
                {
                    id: '03',
                    text: 'Maret'
                },
                {
                    id: '04',
                    text: 'April'
                },
                {
                    id: '05',
                    text: 'Mei'
                },
                {
                    id: '06',
                    text: 'Juni'
                },
                {
                    id: '07',
                    text: 'Juli'
                },
                {
                    id: '08',
                    text: 'Agustus'
                },
                {
                    id: '09',
                    text: 'September'
                },
                {
                    id: '10',
                    text: 'Oktober'
                },
                {
                    id: '11',
                    text: 'November'
                },
                {
                    id: '12',
                    text: 'Desember'
                }
            ];
        const tahun = [
                {
                    id: '2019',
                    text: '2019'
                },
                {
                    id: '2020',
                    text: '2020'
                },
                {
                    id: '2021',
                    text: '2021'
                },
                {
                    id: '2022',
                    text: '2022'
                },
                {
                    id: '2023',
                    text: '2023'
                }
            ];
        $('.bulan').select2({
            placeholder: "Pilih Bulan",
            data: bulan
        });

        $('.tahun').select2({
            placeholder: "Pilih Tahun",
            data: tahun
        });

            var chartBar = new Chart(
                document.getElementById("chartBar"),
                {
                    type: "bar",
                    data: {
                        labels: [],
                        datasets: [
                            {
                                label: "Hutang",
                                backgroundColor: "hsl(217, 57%, 51%)",
                                borderColor: "hsl(217, 57%, 51%)",
                                data: [],
                            },
                        ],
                    },
                    options: {},
                }
            );

        function table(tgl_awal, tgl_akhir){
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
                    'url': '/laporan/table/hutang/'+tgl_awal+"/"+tgl_akhir,
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: "no_po",
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
            $('#btncetak').attr("href","/laporan/data/hutang/"+tgl_awal+"/"+tgl_akhir);
        })

        $(document).on('click', '#btngrafik', function(){
            var bulan = $('#bulan').val();
            var tahun = $('#tahun').val();
            $('.viewgrafik').attr("hidden", false);
            $.ajax({
                url: "/laporan/grafik/hutang",
                type: 'GET',
                data: {"bulan": bulan, "tahun": tahun},
                success: function(result) {
                    chartBar.data.labels = result.data.nama;
                    chartBar.data.datasets[0].data = result.data.jumlah; 
                    chartBar.update();
                }
            });
        })
    })
</script>
@endsection