@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center tw-mb-4">
                        <div class="input-group input-daterange tw-items-center">
                            <input type="date" class="form-control tw-w-10 tw-mr-3" id="tanggal_mulai" onclick="date()">
                            <div class="input-group-addon">-</div>
                            <input type="date" class="form-control tw-w-10 tw-ml-3" id="tanggal_akhir" onclick="date()">
                        </div>
                        <!-- End Date Picker  -->

                    </div>
                    <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                        <div class="tw-w-full tw-col-span-2 md:tw-col-span-1">
                            <h1 class="tw-m-0 tw-text-2xl tw-font-bold">List Promo</h1>
                        </div>
                        <div class="tw-text-right tw-grid tw-grid-cols-1 md:tw-flex tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">

                            <div class="dropdown tw-mb-4 tw-w-full md:tw-w-fit">
                                <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" data-toggle="modal" data-target="#promoModal" type="button" id="addItemButton">
                                    + Tambah Promo
                                </button>
                            </div>
                        </div>

                        <!-- START: Table Mobile View -->
                        <div class="table-barang-mobile tw-mt-5 md:tw-hidden">
                            <div class="list-barang" data-current-page="1">

                            </div>
                        </div>
                        <!-- END: Table Mobile View -->

                        <!-- START: Table Tablet + Desktop -->
                        <div class="table-barang tw-mt-5 tw-col-span-2" data-current-page="1">
                            <table id="table_promo" class="table table-bordered responsive nowrap" style="width:100%">
                                <thead class="tw-bg-prim-blue">
                                    <tr>
                                        <th class="tw-text-prim-white">Kode Promo</th>
                                        <th class="tw-text-prim-white">Nama Promo</th>
                                        <th class="tw-text-prim-white">Discount</th>
                                        <th class="tw-text-prim-white">Barang</th>
                                        <th class="tw-text-prim-white">Tgl. Mulai</th>
                                        <th class="tw-text-prim-white">Tgl. Berakhir</th>
                                        <th class="tw-text-prim-white">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr>
                                            <td>FREE99</td>
                                            <td>Gratis Spesial 9.9</td>
                                            <td>100%</td>
                                            <td>Rp. 200.0000</td>
                                            <td>04/05/2022</td>
                                            <td>04/07/2022</td>
                                            <td class="tw-px-3">
                                                <div class="grid grid-cols-2 tw-contents">
                                                    <button class="mr-4 tw-bg-transparent tw-border-none"
                                                        data-toggle="modal" data-target="#promoModal">
                                                        <i class="fa fa-pen tw-text-prim-blue"></i>
                                                    </button>
                                                    <button data-toggle="modal" data-target="#deleteModal"
                                                        class="tw-bg-transparent tw-border-none">
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
    <!-- Modal -->
    <div class="modal fade" id="modalPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Promo </h5>
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
    <!-- END:Modal -->
    <!-- /.content -->
</div>
@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function date() {
        $("#tanggal_akhir").val('');
        var max = $("#tanggal_mulai").val();
        console.log(max);
        $("#tanggal_akhir").attr("min", max);
    }

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

    $(document).on('click', '#addItemButton', function(event) {
        event.preventDefault();
        $.ajax({
            url: "{{ route('promo.create') }}",
            beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                $('#modalPop').modal("show");
                $('#modal-body').html(result).show();
                $(".input-select2").select2({
                    dropdownParent: $("#modalPop")
                });
            },
        })
    });

    $(document).ready(function() {
        var table_promo = $('#table_promo').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                'type': 'POST',
                'datatype': 'JSON',
                'url': '/promo/data',
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [{
                    data: 'kode_promo',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'nama_promo',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'disc',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'barang',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'tgl_mulai',
                    className: 'nowrap-text align-center',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'tgl_selesai',
                    className: 'nowrap-text align-center',
                    orderable: false,
                    searchable: false
                },
                {

                    data: 'button',
                    className: 'tw-px-3',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });

    function edit(id) {
        event.preventDefault();
        $.ajax({
            url: "/promo/edit/" + id,
            beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                $('#modalPop').modal("show");
                $('#modal-body').html(result).show();
                $(".input-select2").select2({
                    dropdownParent: $("#modalPop")
                });

            },

        })
    }

    $(document).on('click', '#btnedit', function() {
        var id = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');
        Swal.fire({
            title: 'Edit',
            text: "Edit " + nama,
            icon: "question",
            showCancelButton: true,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Iya',

        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                edit(id);
            }
        })

    })

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
                    url: '{{ route('
                    promo.delete ') }}',
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
</script>
@stop
@endsection