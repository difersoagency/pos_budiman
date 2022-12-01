@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/master">Master</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Jasa</li>
        </ol>
    </nav>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                        <div class="tw-w-full tw-col-span-2 md:tw-col-span-1">
                            <h1 class="tw-m-0 tw-text-2xl tw-font-bold">Daftar Jasa</h1>
                        </div>
                        <div class="tw-text-right tw-items-center tw-grid tw-grid-cols-1 tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">
                            <div class="tw-w-full md:tw-w-fit md:tw-ml-auto">
                                <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" type="button" id="tambah_jasa">
                                    + Tambah Jasa
                                </button>
                            </div>
                        </div>

                        <!-- START: Table Mobile View -->
                        <div class="table-barang-mobile tw-mt-5 md:tw-hidden">
                            <div class="list-barang" data-current-page="1">
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- START: Table Tablet + Desktop -->
                        <div class="table-jasa tw-mt-5 tw-col-span-2" data-current-page="1">
                            <table id="showtable" class="table main-table table-bordered responsive nowrap" style="width:100%">
                                <thead class="tw-bg-prim-blue">
                                    <tr>
                                        <th class="tw-text-prim-white">No</th>
                                        <th class="tw-text-prim-white">Nama Jasa</th>
                                        <th class="tw-text-prim-white">Harga</th>
                                        <th class="tw-text-prim-white">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>

                            </table>
                        </div>
                        <!-- /.col-md-6 -->

    </section>
</div>
<!-- Modal -->
<div class="modal fade" id="jasamodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Pelanggan</h5>
                <button type="button" class="close tw-text-prim-red" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
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
        $('#showtable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                'url': '/master/jasa/data',
                'method': 'POST',
                'datatype': 'JSON',
                'headers': {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            },
            // language: {
            //     processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
            // },
            columns: [{
                data: 'DT_RowIndex',
                className: 'nowrap-text align-center',
                orderable: false,
                searchable: false
            }, {
                data: 'nama_jasa',

            }, {
                data: 'harga',
                render: $.fn.dataTable.render.number('.', ',', 2, ''),
            }, {
                data: 'action',
                orderable: false,
                searchable: false
            }]
        });

        $(document).on('click', '#tambah_jasa', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('jasa.create') }}",
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {

                    $('#jasamodal').modal("show");
                    $('.modal-title').html("Tambah Jasa");
                    $('.modal-body').html(result).show();
                    $(".select-2").select2({
                        dropdownParent: $("#jasamodal")
                    });
                },
            })
        });

        $(document).on('click', '#btnedit', function(event) {
            event.preventDefault();
            var data_id = $(this).attr('data-id');
            Swal.fire({
                title: 'Ubah Data',
                text: "Apakah anda ingin merubah data ini?",
                icon: 'question',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',

                confirmButtonText: 'Ubah',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/master/jasa/edit/" + data_id,
                        beforeSend: function() {
                            $('#loader').show();
                        },
                        // return the result
                        success: function(result) {
                            $('#jasamodal').modal("show");
                            $('.modal-title').html("Ubah Jasa");
                            $('.modal-body').html(result).show();
                            $(".select-2").select2({
                                dropdownParent: $("#jasamodal")
                            });
                        },
                    })
                }
            })
        });

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
                        url: '{{ route("jasa.delete") }}',
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
        });
    })
</script>
@endsection