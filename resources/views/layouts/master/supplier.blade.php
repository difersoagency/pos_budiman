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
                    <div class="dropdown tw-mb-7 md:tw-mb-0">
                        <button class="btn tw-text-prim-white tw-bg-prim-black dropdown-toggle tw-text-sm md:tw-w-fit tw-w-full" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pilh Kota
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Surabaya</a>
                            <a class="dropdown-item" href="#">Bandung</a>
                            <a class="dropdown-item" href="#">Jakarta</a>
                        </div>
                    </div>
                    <!-- End Dropdown  -->

                </div>
              <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                <div class="tw-w-full tw-col-span-2 md:tw-col-span-1">
                    <h1 class="tw-m-0 tw-text-2xl tw-font-bold">List Supplier</h1>
                </div>
                <div class="tw-text-right tw-grid tw-grid-cols-1 md:tw-flex tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">
                    <div class="tw-mb-4 tw-w-full md:tw-w-fit">
                        <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" type="button" id="tambah_supplier">
                            + Tambah Supplier
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
                    <table id="showtable" class="table table-bordered responsive nowrap" style="width:100%">
                        <thead class="tw-bg-prim-blue">
                            <tr>
                                <th class="tw-text-prim-white">No</th>
                                <th class="tw-text-prim-white">Nama Supplier</th>
                                <th class="tw-text-prim-white">Kota</th>
                                <th class="tw-text-prim-white">Alamat</th>
                                <th class="tw-text-prim-white">Telepon</th>
                                <th class="tw-text-prim-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PT.Hasana Bakti</td>
                                <td>Mojokerto</td>
                                <td>Jl. Industri</td>
                                <td>081212413</td>
                                <td class="tw-px-3">
                                    <div class="grid grid-cols-2 tw-contents">
                                        <a href="" class="mr-4">
                                            <i class="fa fa-pen tw-text-prim-blue"></i>
                                        </a>
                                        <a href="">
                                            <i class="fa fa-trash tw-text-prim-red"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>PT.Hasana Bakti</td>
                                <td>Mojokerto</td>
                                <td>Jl. Industri</td>
                                <td>081212413</td>
                                <td class="tw-px-3">
                                    <div class="grid grid-cols-2 tw-contents">
                                        <a href="" class="mr-4">
                                            <i class="fa fa-pen tw-text-prim-blue"></i>
                                        </a>
                                        <a href="">
                                            <i class="fa fa-trash tw-text-prim-red"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>PT.Hasana Bakti</td>
                                <td>Mojokerto</td>
                                <td>Jl. Industri</td>
                                <td>081212413</td>
                                <td class="tw-px-3">
                                    <div class="grid grid-cols-2 tw-contents">
                                        <a href="" class="mr-4">
                                            <i class="fa fa-pen tw-text-prim-blue"></i>
                                        </a>
                                        <a href="">
                                            <i class="fa fa-trash tw-text-prim-red"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

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
    <!-- /.content -->
  </div>
  <div class="modal fade" id="suppliermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPop">Form Satuan</h5>
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
    $(document).ready(function(){
        $('#showtable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                'url': '/supplier/data',
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
            },{
                data: 'nama_supplier',

            },{
                data: 'kota_id',

            },{
                data: 'alamat',

            },
            {
                data: 'telepon',

            },{
                data: 'action',
                orderable: false,
                searchable: false
            } ]
        });

        $(document).on('click', '#tambah_supplier', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('supplier.create') }}",
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    
                    $('#suppliermodal').modal("show");
                    $('.modal-body').html(result).show();
                    $(".kota").select2({
                        dropdownParent: $("#suppliermodal")
                    });
                },
            })
        });

        $(document).on('click', '#btnedit', function(event) {
            event.preventDefault();
            var data_id = $(this).attr('data-id');
            $.ajax({
                url: "/supplier/edit/"+data_id,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#suppliermodal').modal("show");
                    $('.modal-body').html(result).show();
                    $(".kota").select2({
                        dropdownParent: $("#suppliermodal")
                    });
                },
            })
        });
    })
</script>
@endsection
