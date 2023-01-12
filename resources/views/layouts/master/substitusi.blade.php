@extends('layouts.admin.master')

@section('content')

<div class="content-wrapper tw-py-6 tw-px-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/master">Master</a></li>
            <li class="breadcrumb-item active" aria-current="page">Substitusi</li>
        </ol>
    </nav>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                        <div class="tw-w-full tw-col-span-2 md:tw-col-span-1">
                            <h1 class="tw-m-0 tw-text-2xl tw-font-bold">Daftar Substitusi</h1>
                        </div>
                        <div class="tw-text-right tw-items-center tw-grid tw-grid-cols-1 tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">
                            <div class="tw-w-full md:tw-w-fit md:tw-ml-auto">
                                <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" type="button" id="addItemButton">
                                    + Tambah Substitusi
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
                        <div class="table-koreksi tw-mt-5 tw-col-span-2" data-current-page="1">
                            <table id="showtable" class="table main-table table-bordered responsive nowrap" style="width:100%">
                                <thead class="tw-bg-prim-blue">
                                    <tr>
                                        <th class="tw-text-prim-white">No</th>
                                        <th class="tw-text-prim-white">Tgl. Pembuatan</th>
                                        <th class="tw-text-prim-white tw-w-60">Barang 1</th>
                                        <th class="tw-text-prim-white tw-w-60">Barang 2</th>
                                        <th class="tw-text-prim-white tw-w-20">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    

                                </tbody>
                            </table>
                        </div>
                    </div> <!-- /.col-md-6 -->
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modalPop" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Substitsui Barang</h5>
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
    $(function(){

        var showtable = $('#showtable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                'type': 'GET',
                'datatype': 'JSON',
                'url': '/master/substitusi/data',
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
                    data: 'tgl_subtitusi',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'barang_id_1',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'barang_id_2',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'button',
                    className: 'nowrap-text align-center',
                }
            ]
        });

        $(document).on('click', '#addItemButton', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('substitusi.create') }}",
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#modalPop').modal("show");
                    $('#modal-body').html(result).show();
                    $('.select2').prepend('<option selected=""></option>').select2({
                    placeholder: "Pilih Data",
                    dropdownParent: $("#modalPop")
                });
                    // select_barang();

                },

            })
        });

    $(document).on('click', '#editButton', function(event) {
        event.preventDefault();
        var rows = showtable.rows($(this).parents('tr')).data();
        var id = rows[0].id
        $.ajax({
            url: "/master/substitusi/edit/"+id,
            beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                $('#modalPop').modal("show");
                $('#modal-body').html(result).show();
                
                $(".selects").select2({
                    placeholder: "Pilih Data",
                    dropdownParent: $("#modalPop")
                });
                // select_barang();

            },

        })
    });

    $(document).on('submit', '#formtambah', function(event) {
            event.preventDefault();
            var action = $(this).attr('action');
            $.ajax({
                url: action,
                type: 'POST',
                data: $('#formtambah').serialize(),
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

        $(document).on('submit', '#formedit', function(event) {
            event.preventDefault();
            var action = $(this).attr('action');
            $.ajax({
                url: action,
                type: 'POST',
                data: $('#formedit').serialize(),
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
    $(document).on('click', '#deletebutton', function() {
        var rows = showtable.rows($(this).parents('tr')).data();
        var id = rows[0].id
        Swal.fire({
            title: 'Hapus',
            text: "Hapus Substitusi",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Iya',

        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("substitusi.delete") }}',
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
})
    
</script>
@stop
@endsection