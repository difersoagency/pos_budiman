@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-end tw-mb-4">
                        <!-- Dropdown -->
                        <div class="dropdown tw-mb-7 md:tw-mb-0 tw-w-2/4">
                            <!-- <button class="btn tw-text-prim-white tw-bg-prim-black dropdown-toggle tw-text-sm md:tw-w-fit tw-w-full" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                Lihat Tipe Produk
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a class="dropdown-item" href="#">Ban</a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a class="dropdown-item" href="#">Lampu</a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a class="dropdown-item" href="#">Rem</a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div> -->
                            <select class="custom-select select-2 tw-bg-prim-blue tw-text-prim-white" id="merk_id" name="state">
                                <option value="0">Semua</option>
                                @foreach ($merek as $m)
                                <option value="{{ $m->id }}">{{ Str::ucfirst($m->nama_merek) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- End Dropdown  -->

                    </div>
                    <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1  tw-items-center">
                        <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1  tw-items-center">
                            <div class="tw-w-full tw-col-span-2 md:tw-col-span-1">
                                <h1 class="tw-m-0 tw-text-2xl tw-font-bold">List Barang</h1>
                            </div>
                            <div class="tw-text-right tw-grid tw-grid-cols-1 md:tw-flex tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">
                                <!-- <div class="dropdown tw-mb-4 md:tw-mr-3">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <button class="btn tw-text-prim-black tw-w-full tw-bg-prim-white dropdown-toggle tw-text-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                Pilih Merk
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a class="dropdown-item" href="#">Honda</a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a class="dropdown-item" href="#">Suzuki</a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a class="dropdown-item" href="#">Yamaha</a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div> -->
                                {{-- <div class="dropdown tw-mb-4 md:tw-mr-3">
                                    <select class="custom-select input-select-2" id="merk">
                                        <option selected>Pilih Merk</option>
                                        <option value="1">Honda</option>
                                        <option value="2">Yamaha</option>
                                        <option value="3">Suzuki</option>
                                    </select>
                                </div> --}}
                                <div class="dropdown tw-mb-4 tw-w-full md:tw-w-fit">
                                    <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" type="button" id="addItemButton">
                                        + Tambah Barang
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
                                <table id="table_barang" class="table main-table table-bordered responsive nowrap" style="width:100%">
                                    <thead class="tw-bg-prim-blue">
                                        <tr>
                                            <th class="tw-text-prim-white">Kode </th>
                                            <th class="tw-text-prim-white">Nama Barang</th>
                                            <th class="tw-text-prim-white">Merk</th>
                                            <th class="tw-text-prim-white">Tipe</th>
                                            <th class="tw-text-prim-white">Harga Beli</th>
                                            <th class="tw-text-prim-white">Harga Jual</th>
                                            <th class="tw-text-prim-white">Stok</th>
                                            <th class="tw-text-prim-white">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <tr>
                                            <td>LM001</td>
                                            <td>Lampu Motor</td>
                                            <td>Yamaha</td>
                                            <td>Lampu</td>
                                            <td>Rp 25.000</td>
                                            <td>Rp 60.000</td>
                                            <td>12 Pcs</td>
                                            <td class="tw-px-3">
                                                <div class="grid grid-cols-2 tw-contents">
                                                    <button href="" class="mr-4 tw-bg-transparent tw-border-none"
                                                        data-toggle="modal" data-target="#modalPop">
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
                    <h5 class="modal-title" id="exampleModalLabel">Form Barang </h5>
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
            url: "{{ route('barang.create') }}",
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
                stok_button();

            },

        })
    });

    $(document).on('submit', '#formtambah_barang', function(event) {
            event.preventDefault();
            var action = $(this).attr('action');
            $.ajax({
                url: action,
                type: 'POST',
                data: $('#formtambah_barang').serialize(),
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

        $(document).on('submit', '#formedit_barang', function(event) {
            alert("tes");
            event.preventDefault();
            var action = $(this).attr('action');
            $.ajax({
                url: action,
                type: 'POST',
                data: $('#formedit_barang').serialize(),
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

    function edit(id) {
        event.preventDefault();
        $.ajax({
            url: "/barang/edit/" + id,
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
                stok_button();
            },

        })
    }

    function stok_button() {
        const buttonPlus = document.querySelector('.plus-btn');
        const buttonMin = document.querySelector('.min-btn');
        let stok = document.querySelector('#stok-barang');

        buttonPlus.addEventListener('click', function() {
            if (stok.value >= 0) {
                buttonMin.disabled = false;
            }
            stok.value++;
        })

        buttonMin.addEventListener('click', function() {
            if (stok.value < 2) {
                buttonMin.disabled = true;
            }
            stok.value--;
        })
    }


    $(document).ready(function() {
        var table_barang = $('#table_barang').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                'type': 'POST',
                'datatype': 'JSON',
                'url': '/barang/data/0',
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [{
                    data: 'kode',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'nama',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'merk',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'tipe',
                    className: 'nowrap-text align-center',
                }, {
                    data: 'harga_beli',
                    className: 'nowrap-text align-center',
                    orderable: false,
                    searchable: false,
                    render: $.fn.dataTable.render.number(',', '.', 2),
                },
                {
                    data: 'harga_jual',
                    className: 'nowrap-text align-center',
                    orderable: false,
                    searchable: false,
                    render: $.fn.dataTable.render.number(',', '.', 2),
                },
                {
                    data: 'stok',
                    className: 'nowrap-text align-center',
                    orderable: false,
                    searchable: false
                }, {

                    data: 'button',
                    className: 'tw-px-3',
                    orderable: false,
                    searchable: false
                }
            ]
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
                        url: '{{ route("barang.delete") }}',
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


        $('#merk_id').change(function() {
            var merek_id = $(this).val();
            $('#table_barang').DataTable().ajax.url('/barang/data/' + merek_id).load();
        });

        $(document).on('keyup change', '#harga-jual', function(){
            var tes = $(this).val().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $(this).val(tes);
        });

        $(document).on('keyup change', '#harga-beli', function(){
            var tes = $(this).val().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $(this).val(tes);
        });
    });
</script>
@stop
@endsection