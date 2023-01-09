@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/transaksi">Transaksi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Penjualan</li>
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
                            <h1 class="tw-m-0 tw-text-2xl tw-font-bold">Daftar Penjualan</h1>
                        </div>
                        <div class="tw-text-right tw-grid tw-grid-cols-1 md:tw-flex tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">

                            <div class="dropdown tw-mb-4 tw-w-full md:tw-w-fit">
                                <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" type="button" id="addItemButton" onclick="location.href = `{{route('tambah-jual')}}`">
                                    + Tambah Penjualan
                                </button>
                            </div>
                        </div>

                        <div class="table_master_beli tw-mt-5 tw-col-span-2" data-current-page="1">
                            <table id="transjual" class="table table-bordered responsive nowrap" style="width:100%">
                                <thead class="tw-bg-prim-blue">
                                    <tr>
                                        <th class="tw-text-prim-white">Tanggal</th>
                                        <th class="tw-text-prim-white">No.Penjualan</th>
                                        <th class="tw-text-prim-white">Customer</th>
                                        <th class="tw-text-prim-white">Total Penjualan</th>
                                        <th class="tw-text-prim-white tw-w-28">Status Pembayaran</th>
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
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog tw-min-w-[60%]" role="document">
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
$(document).ready(function() {
    function data_detail(id){
            $('#transjualdetail').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                'url': '/transaksi/jual/data_detail/'+id,
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
                    data: 'nama',
                }, {
                    data: 'jumlah',
                }, {
                    data: 'disc',
                }, {
                    data: 'harga',
                    render: DataTable.render.number(',', '.', 2, '')
                }]
            });
        }

        $(document).on('click', '#btndetail', function(event) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "/transaksi/jual/detail/"+id,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#modal').modal("show");
                    $('.modal-title').html("Informasi Penjualan");
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
                        url: '/transaksi/jual/delete',
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
        $('#transjual').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                'url': '{{route("data_jual")}}',
                'method': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            },
            language: {
                processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
            },
            columns: [{
                data: 'tgl_trans_jual',
            }, {
                data: 'no_trans_jual',
            }, {
                data: 'booking.customer.nama_customer',
            },{
                data: 'total_jual',
                render: DataTable.render.number(',', '.', 2, '')
            }, {
                data: 'pembayaran',
            }, {
                data: 'action',
                orderable: false,
                searchable: false
            }]
        });
    });
</script>
@endsection
