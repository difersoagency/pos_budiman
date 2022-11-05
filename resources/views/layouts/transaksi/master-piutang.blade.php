@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/transaksi">Transaksi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar Piutang</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                        <div class="tw-w-full tw-col-span-2 md:tw-col-span-1">
                            <h1 class="tw-m-0 tw-text-2xl tw-font-bold">Daftar Piutang Usaha</h1>
                        </div>
                        <div class="tw-text-right tw-grid tw-grid-cols-1 md:tw-flex tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">

                            <div class="dropdown tw-mb-4 tw-w-full md:tw-w-fit">
                                <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" type="button" id="addItemButton" onclick="location.href =  `{{route('bayar_piutang')}}`">
                                    + Pembayaran Piutang
                                </button>
                            </div>
                        </div>

                        <div class="table_master_beli tw-mt-5 tw-col-span-2" data-current-page="1">
                            <table id="piutang" class="table table-bordered responsive nowrap" style="width:100%">
                                <thead class="tw-bg-prim-blue">
                                    <tr>
                                        <th class="tw-text-prim-white tw-w-24">No</th>
                                        <th class="tw-text-prim-white tw-w-24">Nama Pelanggan</th>
                                        <th class="tw-text-prim-white tw-w-48">Total Piutang Usaha</th>
                                        <th class="tw-text-prim-white tw-w-48">Lunas</th>
                                        <th class="tw-text-prim-white tw-w-48">Sisa Hutang</th>
                                        <th class="tw-text-prim-white">#</th>
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
        <div class="modal fade w-full" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title"></h5>
                        <button type="button" class="close tw-text-prim-red" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(Session::has('error'))
    Swal.fire({
        title: 'Gagal',
        text: "{{ Session::get('error') }}",
        icon: 'error',
    });
    @endif
    @if(Session::has('success'))
    Swal.fire({
        title: 'Berhasil',
        text: "{{ Session::get('success') }}",
        icon: 'success',
    });
    @endif
$(document).ready(function() {
        function data_detail(id){
            $('#piutangtable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                'url': '/transaksi/piutang/data_detail/'+id,
                'method': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            },
            language: {
                processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    className: 'nowrap-text align-center',
                    orderable: false,
                    searchable: false
                }, {
                    data: 'tgl_piutang',
                }, {
                    data: 'total_bayar',
                }]
            });
        }

        $(document).on('click', '#btndetail', function(event) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "/transaksi/piutang/detail/"+id,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#modal').modal("show");
                    $('.modal-title').html("Detail Pembayaran Piutang");
                    $('.modal-body').html(result).show();

                    data_detail(id);
                },
            })
        });

        $(document).on('click', '#btnbayar', function(event) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "/transaksi/piutang/tambah_detail/"+id,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#modal').modal("show");
                    $('.modal-title').html("Detail Pembayaran Piutang");
                    $('.modal-body').html(result).show();

                    data_detail(id);
                },
            })
        });

        $('#piutang').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                'url': '{{route("data_piutang")}}',
                'method': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            },
            language: {
                processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
            },
            columns: [{
                data: 'DT_RowIndex',
                className: 'nowrap-text align-center',
                orderable: false,
                searchable: false
            }, {
                data: 'no_trans_jual',
            }, {
                data: 'total_piutang',
            }, {
                data: 'sum_total',
            },{
                data: 'sisa_hutang',
            }, {
                data: 'action',
                orderable: false,
                searchable: false
            }]
        });
    });
</script>
@endsection