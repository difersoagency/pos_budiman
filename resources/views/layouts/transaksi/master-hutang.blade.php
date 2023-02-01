@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/transaksi">Transaksi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar Hutang</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                        <div class="tw-w-full tw-col-span-2 md:tw-col-span-1">
                            <h1 class="tw-m-0 tw-text-2xl tw-font-bold">Daftar Hutang Usaha</h1>
                        </div>
                        {{-- <div class="tw-text-right tw-grid tw-grid-cols-1 md:tw-flex tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">

                            <div class="dropdown tw-mb-4 tw-w-full md:tw-w-fit">
                                <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" type="button" id="addItemButton" onclick="location.href = `{{route('bayar_hutang')}}`">
                                    + Pembayaran Hutang
                                </button>
                            </div>
                        </div> --}}

                        <div class="table_master_beli tw-mt-5 tw-col-span-2" data-current-page="1">
                            <table id="example" class="table table-bordered responsive nowrap" style="width:100%">
                                <thead class="tw-bg-prim-blue">
                                    <tr>
                                        <th class="tw-text-prim-white tw-w-48">No Pembelian</th>
                                        <th class="tw-text-prim-white tw-w-24">Nama Supplier</th>
                                     
                                        <th class="tw-text-prim-white tw-w-48">Total Hutang</th>
                                        <th class="tw-text-prim-white tw-w-48">Lunas</th>
                                        <th class="tw-text-prim-white tw-w-48">Sisa Hutang</th>
                                        <th class="tw-text-prim-white">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr>
                                        <td>PT Maju Bersama Jaya</td>
                                        <td>
                                            <p class="tw-mb-0">Rp. 000000</p>
                                        </td>
                                        <td>
                                            <p class="tw-mb-0">Rp. 0</p>
                                        </td>
                                        <td>
                                            <p class="tw-mb-0">Rp. 000000</p>
                                        </td>
                                        <td>
                                            <div class="tw-text-center">
                                                <button data-toggle="tooltip" title="Detail" class="tw-mr-4 tw-bg-transparent tw-border-none">
                                                    <i class="fa fa-info tw-text-prim-black"></i>
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




    <div class="modal fade" id="modalPop" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Hutang</h5>
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
    var hutangtable = '';
    function detail_hutang_table(id){
    hutangtable = $('#hutangtable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                'type': 'POST',
                'datatype': 'JSON',
                'url': '/transaksi/hutang/data/'+id,
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
                    data: 'tgl_bayar',
                }, {
                    data: 'pembayaran',
                }, {
                    data: 'total_bayar',
                    render: DataTable.render.number(',', '.', 2, '')
                },{
                    data: 'action',
                }]
        });
}
    var hutangs = $('#example').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                'type': 'POST',
                'datatype': 'JSON',
                'url': '{{route("data.hutang")}}',
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [
                {
                    data: 'no_pembelian',
                    className: 'nowrap-text align-center',
                }
              ,
                {
                    data: 'supplier',
                    className: 'nowrap-text align-center',
                }
              ,
                {
                    data: 'total_hutang',
                    className: 'nowrap-text align-center',
                }
              ,
                {
                    data: 'lunas',
                    className: 'nowrap-text align-center',
                }
              ,
                {
                    data: 'sisa_hutang',
                    className: 'nowrap-text align-center',
                    render: DataTable.render.number(',', '.', 2, '')
                }
              ,
                {
                    data: 'action',
                    className: 'nowrap-text align-center',
                }
              
            ]
        });
    $(document).on('submit', '#formhutang', function(event) {
        event.preventDefault();
        var action = $(this).attr('action');
        $.ajax({
            url: action,
            type: 'POST',
            data: $('#formhutang').serialize(),
            success: function(result) {
                if (result.data == "success") {
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Data Berhasil disimpan',
                        icon: 'success',
                    });
                    window.location.reload();
                } else {
                    Swal.fire({
                        title: 'Gagal',
                        text: 'Data Gagal disimpan',
                        icon: 'error',
                    });
                }
            }
        });
    });

$(document).on('click', '#btndetail', function(event) {
    
             var id = $(this).attr('data-id');
             var rows = hutangs.rows($(this).parents('tr')).data();
            var sisa = rows[0]['sisa_hutang'];
            // var nama = $(this).attr('data-nama');
        $.ajax({
            url: "/transaksi/hutang/detail/" + id,
            beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                $('#modalPop').modal("show");
                $('#modal-body').html(result).show();
                $('#modal-body').find('#sisa_htg').html(sisa);
                detail_hutang_table(id)
            },
        })
    });
    $(document).on('click', '#btndelete', function() {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Hapus',
                text: "Anda yakin ingin menghapus data ini",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: 'Tidak',
                confirmButtonText: 'Iya',

            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/transaksi/hutang/delete_detail',
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

        $(document).on('click', '#btnbayar', function(event) {
            var id = $(this).attr('data-id');
            var rows = hutangs.rows($(this).parents('tr')).data();
            var sisa = rows[0]['sisa_hutang'];
            $.ajax({
                url: "/transaksi/hutang/tambah_detail/"+id,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#modalPop').modal("show");
                    $('.modal-title').html("Pembayaran Hutang");
                    $('#modal-body').html(result).show();
                    $('#modal-body').find('#sisa').val(sisa);
                    $('.pembayaran_id').select2({dropdownParent: $("#modalPop")});
                    
                    
                },
            })
        });

        $(document).on('click', '#btnedit', function(event) {
            var id = $(this).attr('data-id');
            var sisahtg = $('#sisa_htg').html();
            var rows = hutangtable.rows($(this).parents('tr')).data();
            var sisa = rows[0]['total_bayar'];
            $.ajax({
                url: "/transaksi/hutang/edit_detail/"+id,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#modalPop').modal("show");
                    $('.modal-title').html("Edit Pembayaran Hutang");
                    $('#modal-body').html(result).show();
                    $('#modal-body').find('#sisa').val(sisahtg - sisa);
                    $('.pembayaran_id').select2({dropdownParent: $("#modalPop")});
                    
                    
                },
            })
        });

        $(document).on('change', '#pembayaran_id', function(e) {
            if($(this).val() == "1"){
                $('#input_giro').attr('hidden', true);
                $('#no_giro').val('');
            }
            else{
                $('#input_giro').attr('hidden', false);
            }
        })
        $(document).on('keyup change', '#total_bayar', function(){
            var value = parseInt($(this).val().replace(/\D/g, ""));
            var sisa = parseInt($('#sisa').val());
            if(value > sisa){
                $('#msg-alert').html('Pembayaran yang anda input melebihi Total Hutang');
            }
            else{
                $('#msg-alert').html('');
            }
            var tes = $(this).val().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $(this).val(tes);
        });
</script>
@stop
@endsection