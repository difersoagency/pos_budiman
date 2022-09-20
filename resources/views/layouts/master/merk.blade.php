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
                    <h1 class="tw-m-0 tw-text-2xl tw-font-bold">Daftar Merk Produk</h1>
                </div>
                <div class="tw-text-right tw-items-center tw-grid tw-grid-cols-1 tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">
                    <div class="tw-w-full md:tw-w-fit md:tw-ml-auto">
                        <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" type="button" id="tambah_merk" data-toggle="modal" data-target="#merkModal">
                            + Tambah Merk
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
                                <th class="tw-text-prim-white">Nama Merk</th>
                                <!-- <th class="tw-text-prim-white">Jumlah Barang</th> -->
                                <th class="tw-text-prim-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td>HN1223</td>
                                <td>Honda</td>
                                <td>20</td>
                                <td class="tw-px-3">
                                    <div class="grid grid-cols-2 tw-contents">
                                        <button class="mr-4 tw-bg-transparent tw-border-none" data-toggle="modal" data-target="#merkModal">
                                            <i class="fa fa-pen tw-text-prim-blue"></i>
                                        </button>
                                        <button data-toggle="modal" data-target="#deleteModal" class="tw-bg-transparent tw-border-none">
                                            <i class="fa fa-trash tw-text-prim-red"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>                         -->

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
                <h5 class="modal-title" id="exampleModalLabel">Form Merk</h5>
                <button type="button" class="close tw-text-prim-red" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            </div>
        </div>
     </div>
    
    <!-- END:Modal -->
    <!-- /.content -->
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
            processing: true,
            serverSide: true,
            ajax: {
                'url': '/merek/data',
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
                data: 'nama_merek',

            }, 
            {
                data: 'action',
                orderable: false,
                searchable: false
            } ]
        });

        $(document).on('click', '#tambah_merk', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('merek.create') }}",
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#modalPop').modal("show");
                    $('.modal-body').html(result).show();
                },
            })
        });

        $(document).on('click', '#btnedit', function(event) {
            event.preventDefault();
            var data_id = $(this).attr('data-id');
            $.ajax({
                url: "/merek/edit/"+data_id,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    alert(result);
                    $('#modalPop').modal("show");
                    $('.modal-body').html(result).show();
                },
            })
        });

    })
</script>
@endsection