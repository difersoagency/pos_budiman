@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="\transaksi">Transaksi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Retur Penjualan</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-lg-12">

                    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-end tw-mb-4">
                        <!-- Dropdown -->
                        <div class="dropdown tw-mb-7 md:tw-mb-0 tw-w-2/4">

                            <select class="custom-select select-2 tw-bg-prim-blue tw-text-prim-white" id="merk_id" name="state">
                                <option value="0">Semua</option>
                            </select>
                        </div>
                        <!-- End Dropdown  -->

                    </div>
                    <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                        <div class="tw-w-full tw-col-span-2 md:tw-col-span-1">
                            <h1 class="tw-m-0 tw-text-2xl tw-font-bold">Daftar Retur Penjualan</h1>
                        </div>
                        <div class="tw-text-right tw-grid tw-grid-cols-1 md:tw-flex tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">

                            <div class="dropdown tw-mb-4 tw-w-full md:tw-w-fit">
                                <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" type="button" id="addItemButton" onclick="location.href = `{{route('tambah-retur-jual')}}`">
                                    + Tambah Retur Penjualan
                                </button>
                            </div>
                        </div>

                        <div class="table_master_beli tw-mt-5 tw-col-span-2" data-current-page="1">
                            <table id="returjualtable" class="table table-bordered responsive nowrap" style="width:100%">
                                <thead class="tw-bg-prim-blue">
                                    <tr>
                                        <th class="tw-text-prim-white">No</th>
                                        <th class="tw-text-prim-white">No Retur</th>
                                        <th class="tw-text-prim-white">Tgl Retur</th>
                                        <th class="tw-text-prim-white">No Penjualan</th>
                                        <th class="tw-text-prim-white">Customer</th>
                                        <th class="tw-text-prim-white">Total</th>
                                        <th class="tw-text-prim-white">Action</th>
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
<script>
    $(function(){
        $('#returjualtable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                'url': '/transaksi/retur-jual/data',
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
                    data: 'no_retur_jual',
                }, {
                    data: 'tgl_retur_jual',
                }, {
                    data: 'no_trans_jual',
                }, {
                    data: 'customer',
                }, {
                    data: 'total_retur_jual',
                }, {
                    data: 'action',
                }]
        })
        function data_detail(id){
            $('#dreturjualtable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                'url': '/transaksi/retur-jual/data_detail/'+id,
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
                    data: 'barang_id',
                }, 
                {
                    data: 'jumlah',
                }, {
                    data: 'harga',
                },
                {
                    data: 'subtotal',
                }]
            });
        }

        $(document).on('click', '#btndetail', function(event) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "/transaksi/retur-jual/detail/"+id,
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
    })
</script>
@stop
