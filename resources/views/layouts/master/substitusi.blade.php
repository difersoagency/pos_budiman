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
                            <table id="table_koreksi" class="table main-table table-bordered responsive nowrap" style="width:100%">
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
                                    <td>1</td>
                                    <td>12/12/12</td>
                                    <td>a</td>
                                    <td>b</td>
                                    <td class="tw-px-3">
                                        <div class="grid grid-cols-2 tw-contents">
                                            <button href="" class="mr-4 tw-bg-transparent tw-border-none" data-toggle="modal" id="editButton">
                                                <i class="fa fa-pen tw-text-prim-blue"></i>
                                            </button>
                                            <button data-toggle="modal" data-target="#deleteModal" class="tw-bg-transparent tw-border-none">
                                                <i class="fa fa-trash tw-text-prim-red"></i>
                                            </button>
                                        </div>
                                    </td>

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
<script>
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
                $(".selects").select2({
                    placeholder: "Pilih Data",
                    dropdownParent: $("#modalPop")
                });
                // select_barang();

            },

        })
    });

    $(document).on('click', '#editButton', function(event) {
        event.preventDefault();
        $.ajax({
            url: "{{ route('substitusi.edit') }}",
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
</script>
@stop
@endsection