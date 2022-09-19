@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
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
                        <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" type="button" data-toggle="modal" data-target="#jasaModal" id="addItemButton">
                            + Tambah Jasa
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
                                <th class="tw-text-prim-white">Nama Jasa</th>
                                <th class="tw-text-prim-white">Harga</th>
                                <th class="tw-text-prim-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>KS0012</td>
                                <td>Pasang Lampu</td>
                                <td>Rp.250.000</td>
                                <td class="tw-px-3">
                                <div class="grid grid-cols-2 tw-contents">
                                        <button href="" class="mr-4 tw-bg-transparent tw-border-none" data-toggle="modal" data-target="#jasaModal">
                                            <i class="fa fa-pen tw-text-prim-blue"></i>
                                        </button>
                                        <button data-toggle="modal" data-target="#deleteModal" class="tw-bg-transparent tw-border-none">
                                            <i class="fa fa-trash tw-text-prim-red"></i>
                                        </button>
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
     <!-- Modal -->
     @include('layouts.modal.jasa-modal')
    
    <!-- END:Modal -->
    <!-- /.content -->
  </div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#showtable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                'url': '/jasa',
                'method': 'GET',
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
            }, {
                data: 'nama_jasa',

            }, {
                data: 'harga',
                render: $.fn.dataTable.render.number('.', ',', 2, ''),
            }, {
                data: 'action',
                orderable: false,
                searchable: false
            } ]
        });
    })
</script>
@endsection
