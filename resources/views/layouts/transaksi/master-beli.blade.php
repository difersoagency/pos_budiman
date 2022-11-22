@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/transaksi">Transaksi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pembelian</li>
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
                            <h1 class="tw-m-0 tw-text-2xl tw-font-bold">Daftar Pengajuan Pembelian</h1>
                        </div>
                        <div class="tw-text-right tw-grid tw-grid-cols-1 md:tw-flex tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">

                            <div class="dropdown tw-mb-4 tw-w-full md:tw-w-fit">
                                <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" type="button" id="addItemButton" onclick="location.href = `{{route('tambah-beli')}}`">
                                    + Buat Pengajuan
                                </button>
                            </div>
                        </div>

                        <div class="table_master_beli tw-mt-5 tw-col-span-2" data-current-page="1">
                            <table id="trans_beli" class="table table-bordered responsive nowrap" style="width:100%">
                                <thead class="tw-bg-prim-blue">
                                    <tr>
                                        <th class="tw-text-prim-white">No.Pembelian</th>
                                        <th class="tw-text-prim-white">Supplier</th>
                                        <th class="tw-text-prim-white">Tgl Pembelian</th>
                                        <th class="tw-text-prim-white tw-w-48">Pembayaran</th>
                                        <th class="tw-text-prim-white tw-w-28">Total Harga</th>
                                        <th class="tw-text-prim-white">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr>
                                        <td>LM001</td>
                                        <td>Lampu Motor</td>
                                        <td>Asep</td>
                                        <td>Lampu</td>
                                        <td>
                                            <p class="tw-mb-0">Rp. 000000</p>
                                        </td>
                                        <td>
                                            <div class="grid grid-cols-3 tw-contents">
                                                <button href="" class="mr-4 tw-bg-transparent tw-border-none" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-pen tw-text-prim-blue"></i>
                                                </button>
                                                <button data-toggle="tooltip" title="Detail" class="tw-mr-4 tw-bg-transparent tw-border-none">
                                                    <i class="fa fa-info tw-text-prim-black"></i>
                                                </button>
                                                <button data-toggle="tooltip" title="Hapus" class="tw-bg-transparent tw-border-none">
                                                    <i class="fa fa-trash tw-text-prim-red"></i>
                                                </button>
                                            </div>
                                        </td>

                                    </tr> --}}


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
@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     $(document).ready(function() {

        $(document).on('click', '#btndelete', function(event) {
            event.preventDefault();
            var data_id = $(this).attr('data-id');
            var data_nama = $(this).attr('data-nama');
            Swal.fire({
                title: 'Hapus Data',
                text: "Apakah anda ingin menghapus data " + data_nama + "?",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'grey',
                confirmButtonColor: '#d33',

                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("delete-beli") }}',
                        type: 'DELETE',
                        dataType: 'json',
                        data: {
                            "id": data_id,
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
                               
                                $('#trans_beli').DataTable().ajax.reload();
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
        });

        var table_promo = $('#trans_beli').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                'type': 'POST',
                'datatype': 'JSON',
                'url': '{{route("pembelian.data")}}',
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [{
                    data: 'nomor_po',
                    className: 'nowrap-text align-center',
                },{
                    data: 'supplier',
                    className: 'nowrap-text align-center',
                },
                
                {
                    data: 'tgl_trans_beli',
                    className: 'nowrap-text align-center',
                }, {
                    data: 'pembayaran',
                    className: 'nowrap-text align-center',
                }
                , {
                    data: 'total_bayar',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'action',
                    className: 'nowrap-text align-center',
                },
                
              
            ]
        });
    });
    </script>
@stop
@endsection