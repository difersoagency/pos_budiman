@extends('layouts.admin.master')

@section('content')

<div class="content-wrapper tw-py-6 tw-px-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/master">Master</a></li>
            <li class="breadcrumb-item active" aria-current="page">Koreksi</li>
        </ol>
    </nav>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                        <div class="tw-w-full tw-col-span-2 md:tw-col-span-1">
                            <h1 class="tw-m-0 tw-text-2xl tw-font-bold">Riwayat Transaksi</h1>
                        </div>
                        <div class="tw-text-right tw-items-center tw-grid tw-grid-cols-1 tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">
                            <div class="tw-w-full md:tw-w-fit md:tw-ml-auto">
                                <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" type="button" id="addItemButton">
                                    + Tambah Koreksi
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
                            <table id="table_koreksi" class="table main-table table-bordered responsive nowrap" style="width:100%">
                                <thead class="tw-bg-prim-blue">
                                    <tr>
                                        <th class="tw-text-prim-white">No</th>
                                        <th class="tw-text-prim-white">Tgl. Koreksi</th>
                                        <th class="tw-text-prim-white">Jenis</th>
                                        <th class="tw-text-prim-white tw-w-60">Nama</th>
                                        <th class="tw-text-prim-white">Jumlah</th>
                                        <th class="tw-text-prim-white">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <td>1</td>
                                    <td>12/12/12</td>
                                    <td>Lampu</td>
                                    <td>Lampu Depan Merah</td>
                                    <td>5</td>
                                    <td>Opname</td> --}}
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- /.col-md-6 -->
                </div>
            </div>
        </div>
    </section>

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
        function select_barang() {
        $('.barang').select2({
            placeholder: "Pilih Barang",
            ajax: {
                minimumResultsForSearch: 20,
                dataType: 'json',
                theme: "bootstrap",
                delay: 250,
                type: 'GET',
                url: '{{route("barang.selectdata")}}',
                data: function(params) {
                    return {
                        term: params.term,
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.nama_barang
                            };
                        })
                    };
                },
            }
        }).change(function() {
                var id = $(this).val();
                $.ajax({
                    url: '/barang/selectdata/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                            $('#stok_get').text("Stok sekarang : " +data.stok);
                    }
                });
                });

        
    }

        $(document).on('click', '#addItemButton', function(event) {
        event.preventDefault();
        $.ajax({
            url: "{{ route('koreksi.create') }}",
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
                select_barang();
             
            },

        })
    });

    $(document).ready(function() {
        var table_koreksi = $('#table_koreksi').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                'type': 'POST',
                'datatype': 'JSON',
                'url': '/master/koreksi/data/0',
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
                    data: 'tgl_koreksi',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'jenis',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'nama',
                    className: 'nowrap-text align-center',
                },
                {
                    data: 'jumlah',
                    className: 'nowrap-text align-center',
                }, 
                {
                    data: 'ket',
                    className: 'nowrap-text align-center',
                }
            ]
        });
        });
</script>
@stop
@endsection