@extends('layouts.admin.master')

@section('content')
    <div class="content-wrapper tw-py-6 tw-px-5">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/transaksi">Transaksi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Retur Pembelian</li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-lg-12">

                        <div
                            class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                            <div class="tw-w-full tw-col-span-2 md:tw-col-span-1">
                                <h1 class="tw-m-0 tw-text-2xl tw-font-bold">Daftar Retur Pembelian</h1>
                            </div>
                            <div
                                class="tw-text-right tw-grid tw-grid-cols-1 md:tw-flex tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">

                                <div class="dropdown tw-mb-4 tw-w-full md:tw-w-fit">
                                    <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit"
                                        type="button" id="addItemButton"
                                        onclick="location.href = `{{ route('tambah-retur-beli') }}`">
                                        + Tambah Retur Pembelian
                                    </button>
                                </div>
                            </div>

                            <div class="table_master_beli tw-mt-5 tw-col-span-2" data-current-page="1">
                                <table id="showtable" class="table table-bordered responsive nowrap" style="width:100%">
                                    <thead class="tw-bg-prim-blue">
                                        <tr>
                                            <th class="tw-text-prim-white">No</th>
                                            <th class="tw-text-prim-white">Tgl Retur</th>
                                            <th class="tw-text-prim-white">Supplier</th>
                                            <th class="tw-text-prim-white">No PO</th>
                                            <th class="tw-text-prim-white">Tgl PO</th>
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
        </section>



        <div class="modal fade" id="modalPop" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Retur</h5>
                        <button type="button" class="close tw-text-prim-red" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-body">
                        <!-- END:Modal -->
                        <!-- /.content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        //   table_barang();
        @if (Session::has('error'))
            Swal.fire({
                title: 'Gagal',
                text: "{{ Session::get('error') }}",
                icon: 'error',
            });
        @endif
        @if (Session::has('success'))
            Swal.fire({
                title: 'Berhasil',
                text: "{{ Session::get('success') }}",
                icon: 'success',
            });
        @endif

        var table_retur = $('#showtable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                'type': 'POST',
                'datatype': 'JSON',
                'url': '{{ route("data-retur-beli") }}',
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
                },
                {
                    data: 'tgl_retur',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'supplier',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'no_pembelian',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'tgl_pembelian',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'total',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'action',
                    className: 'nowrap-text align-center',
                }

            ]
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
                        url: '/transaksi/retur-beli/delete',
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

        $(document).on('click', '#btndetail', function(event) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "/transaksi/retur-beli/detail/" + id,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#modalPop').modal("show");
                    $('#modal-body').html(result).show();
                    detail_retur_table(id)
                },
            })
        });

        function detail_retur_table(id) {
            $('#returtable').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    'type': 'POST',
                    'datatype': 'JSON',
                    'url': '/transaksi/retur-beli/data/' + id,
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                    data: 'DT_RowIndex',
                    className: 'nowrap-text align-center',
                    orderable: false,
                    searchable: false
                }, {
                    data: 'produk',
                }, {
                    data: 'jumlah',
                }, {
                    data: 'harga',
                }, {
                    data: 'total',
                }]
            });
        }
    </script>
@stop
@endsection
