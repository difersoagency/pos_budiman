@extends('layouts.admin.master')

@section('content')

<div class="content-wrapper tw-py-6 tw-px-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/master">Master</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Customer</li>
        </ol>
    </nav>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-end tw-mb-4">
                        <!-- Dropdown -->
                        <div class="dropdown tw-mb-7 md:tw-mb-0 tw-w-2/4">
                            <select class="custom-select select-2 tw-bg-prim-blue tw-text-prim-white" id="kota_id" name="state">
                                <option value="0">Semua</option>
                                @foreach ($kota as $kota)
                                <option value="{{ $kota->id }}">{{ Str::ucfirst($kota->nama_kota) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- End Dropdown  -->

                    </div>
                    <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                        <div class="tw-w-full tw-col-span-2 md:tw-col-span-1">
                            <h1 class="tw-m-0 tw-text-2xl tw-font-bold">List Pelanggan</h1>
                        </div>
                        <div class="tw-text-right tw-grid tw-grid-cols-1 md:tw-flex tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">
                            <div class="tw-mb-4 tw-w-full md:tw-w-fit">
                                <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" type="button" id="addItemButton">
                                    + Tambah Pelanggan
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
                        <div class="table-customer tw-mt-5 tw-col-span-2" data-current-page="1">
                            <table id="showtable" class="table main-table table-bordered responsive nowrap" style="width:100%">
                                <thead class="tw-bg-prim-blue">
                                    <tr>
                                        <th class="tw-text-prim-white">Nama Pelanggan</th>
                                        <th class="tw-text-prim-white">Kota Asal</th>
                                        <th class="tw-text-prim-white">Alamat</th>
                                        <th class="tw-text-prim-white">Telepon</th>
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
    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="modalPop" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Customer </h5>
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

    function edit(id) {
        event.preventDefault();
        $.ajax({
            url: "/master/customer/edit/" + id,
            beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                $('#modalPop').modal("show");
                $('#modal-body').html(result).show();
                $(".select2").select2({
                    dropdownParent: $("#modalPop")
                });
            },

        })
    }


    $(document).on('click', '#addItemButton', function(event) {
        event.preventDefault();
        $.ajax({
            url: "{{ route('customer.create') }}",
            beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                $('#modalPop').modal("show");
                $('#modal-body').html(result).show();
                $('.select2').prepend('<option selected=""></option>').select2({
                    placeholder: "Pilih Data"
                });
            },
        })
    });

    $(document).ready(function() {
        var table_customer = $('#showtable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                'type': 'POST',
                'datatype': 'JSON',
                'url': '/master/customer/data/0',
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [{
                    data: 'nama',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'alamat',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'kota',
                    className: 'nowrap-text align-center',
                }, 
                {
                    data: 'telepon',
                    className: 'nowrap-text align-center',
                }, 
                {
                    data: 'button',
                    className: 'tw-px-3',
                    orderable: false,
                    searchable: false
                }
            ]
        })
    });


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

    });


    $(document).on('submit', '#formtambah_customer', function(event) {
            event.preventDefault();
            var action = $(this).attr('action');
            $.ajax({
                url: action,
                type: 'POST',
                data: $('#formtambah_customer').serialize(),
                success: function(result) {
                    if (result.data == "success") {
                        Swal.fire({
                            title: 'Berhasil',
                            text: result.msg,
                            icon: 'success',
                        });
                        window.location.reload();
                    } else {
                        Swal.fire({
                            title: 'Gagal',
                            text: result.msg,
                            icon: 'error',
                        });
                    }
                }
            });
        })

        $(document).on('submit', '#formedit_customer', function(event) {
            event.preventDefault();
            var action = $(this).attr('action');
            $.ajax({
                url: action,
                type: 'POST',
                data: $('#formedit_customer').serialize(),
                success: function(result) {
                    if (result.data == "success") {
                        Swal.fire({
                            title: 'Berhasil',
                            text: result.msg,
                            icon: 'success',
                        });
                        window.location.reload();
                    } else {
                        Swal.fire({
                            title: 'Gagal',
                            text: result.msg,
                            icon: 'error',
                        });
                    }
                }
            });
        })
        
    $('#kota_id').change(function() {
        var merek_id = $(this).val();
        $('#showtable').DataTable().ajax.url('/master/customer/data/' + merek_id).load();
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
                    url: '{{ route("customer.delete") }}',
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