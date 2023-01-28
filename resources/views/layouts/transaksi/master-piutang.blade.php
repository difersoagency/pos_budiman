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
                        <!-- <div class="tw-text-right tw-grid tw-grid-cols-1 md:tw-flex tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">

                            <div class="dropdown tw-mb-4 tw-w-full md:tw-w-fit">
                                <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" type="button" id="addItemButton" onclick="location.href =  `{{route('bayar_piutang')}}`">
                                    + Pembayaran Piutang
                                </button>
                            </div>
                        </div> -->

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
        <div class="modal fade" id="modalPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog tw-min-w-[60%]" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title"></h5>
                        <button type="button" class="close tw-text-prim-red" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-body">
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
    
$(document).ready(function() {
    $(document).on('submit', '#formpiutang', function(event) {
        event.preventDefault();
        var action = $(this).attr('action');
        $.ajax({
            url: action,
            type: 'POST',
            data: $('#formpiutang').serialize(),
            success: function(result) {
                if (result.data == "success") {
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Data Berhasil disimpan',
                        icon: 'success',
                    });
                    window.location.reload();
                } else {
                    Swal.fire({
                        title: 'Gagal',
                        text: 'Data Gagal disimpan',
                        icon: 'error',
                    });
                }
            }
        });
    });
        function select_pembayaran(){
            $('.pembayaran_id').select2({
                placeholder: "Pilih Pembayaran",
                dropdownParent: $("#modal"),
                delay: 250,
                ajax: {
                    dataType: 'json',
                    type: 'GET',
                    url: '/api/pembayaran_select',
                    data: function(params) {
                        return {
                            term: params.term
                        }
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.nama_bayar
                                };
                            })
                        };
                    },
                }
            });
        }
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
                },{
                    data: 'pembayaran',
                }, {
                    data: 'total_bayar',
                    render: DataTable.render.number(',', '.', 2, '')
                },{
                    data: 'action',
                }]
            });
        }
        $(document).on('change', '#pembayaran_id', function(e) {
            if($(this).val() == "1"){
                $('#input_giro').attr('hidden', true);
                $('#no_giro').val('');
            }
            else{
                $('#input_giro').attr('hidden', false);
            }
        })
        $(document).on('keyup change', '#total_bayar', function(){
            var tes = $(this).val().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $(this).val(tes);
        });
        $(document).on('click', '#btndetail', function(event) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "/transaksi/piutang/detail/"+id,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#modalPop').modal("show");
                    $('.modal-title').html("Detail Pembayaran Piutang");
                    $('.modal-body').html(result).show();

                    data_detail(id);
                },
            })
        });

        $(document).on('click', '#btndelete', function() {
            var id = $(this).attr('data-id');
            var nama = $(this).attr('data-nama');
            Swal.fire({
                title: 'Hapus',
                text: "Hapus " + nama,
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: 'Tidak',
                confirmButtonText: 'Iya',

            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/transaksi/piutang/delete',
                        type: 'DELETE',
                        dataType: 'json',
                        data: {
                            "id": id,
                            "_method": "DELETE",
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(result) {
                            if (result.info == "success") {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Data berhasil di hapus',
                                    icon: 'success',
                                });
                                window.location.reload();
                            } else {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: 'Data gagal di hapus',
                                    icon: 'error',
                                });
                            }
                        }
                    });
                }
            })

        })

        $(document).on('click', '#btnbayar', function(event) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "/transaksi/piutang/tambah_detail/"+id,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#modalPop').modal("show");
                    $('.modal-title').html("Pembayaran Piutang");
                    $('#modal-body').html(result).show();
                    $('.pembayaran_id').select2({dropdownParent: $("#modalPop")});
                    
                    
                },
            })
        });

        $(document).on('click', '#btnedit', function(event) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "/transaksi/piutang/edit_detail/"+id,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#modalPop').modal("show");
                    $('.modal-title').html("Edit Pembayaran Piutang");
                    $('#modal-body').html(result).show();
                    $('.pembayaran_id').select2({dropdownParent: $("#modalPop")});
                    
                    
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
                render: DataTable.render.number(',', '.', 2, '')
            }, {
                data: 'sum_total',
                render: DataTable.render.number(',', '.', 2, '')
            },{
                data: 'sisa_hutang',
                render: DataTable.render.number(',', '.', 2, '')
            }, {
                data: 'action',
                orderable: false,
                searchable: false
            }]
        });
    });
</script>
@endsection
