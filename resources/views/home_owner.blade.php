@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
            <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                        <div class="tw-w-full tw-col-span-2 md:tw-col-span-1">
                            <h1 class="tw-m-0 tw-text-2xl tw-font-bold">Stok Barang</h1>
                        </div>

                        <div class="table_master_beli tw-mt-5 tw-col-span-2" data-current-page="1">
                            <table id="tb_brg" class="table table-bordered responsive nowrap" style="width:100%">
                                <thead class="tw-bg-prim-blue">
                                <tr>
                                    <th class="tw-text-prim-white">No</th>
                                            <th class="tw-text-prim-white">Kode </th>
                                            <th class="tw-text-prim-white">Nama Barang</th>
                                            <th class="tw-text-prim-white">Merk</th>
                                            <th class="tw-text-prim-white">Tipe</th>
                                            <th class="tw-text-prim-white">Harga Beli</th>
                                            <th class="tw-text-prim-white">Harga Jual</th>
                                            <th class="tw-text-prim-white">Stok</th>
                                        </tr>
                                </thead>
                                <tbody>
                                </tbody>

                            </table>
                        </div>
                        <!-- END : Tabel Tablet + Desktop -->
                    </div>
            </div>

            <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                        <div class="tw-w-full tw-col-span-2 md:tw-col-span-1">
                            <h1 class="tw-m-0 tw-text-2xl tw-font-bold">Penjualan Mendekati Jatuh Tempo</h1>
                        </div>

                        <div class="table_master_beli tw-mt-5 tw-col-span-2" data-current-page="1">
                            <table id="transjual" class="table table-bordered responsive nowrap" style="width:100%">
                                <thead class="tw-bg-prim-blue">
                                    <tr>
                                        <th class="tw-text-prim-white">Tanggal</th>
                                        <th class="tw-text-prim-white">No Penjualan</th>
                                        <th class="tw-text-prim-white">Customer</th>
                                        <th class="tw-text-prim-white">Total Penjualan</th>
                                        <th class="tw-text-prim-white">Status Pembayaran</th>
                                        <th class="tw-text-prim-white">Tgl Jatuh Tempo</th>
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
    <!-- /.content -->
  </div>
@endsection

@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {

        var table_barang = $('#tb_brg').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                'type': 'GET',
                'datatype': 'JSON',
                'url': '/api/barang_dashboard',
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [{
                data: 'DT_RowIndex'
            },{
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
                }
            ]
        });
        $('#transjual').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                'url': '/api/jual_dashboard',
                'method': 'GET',
                'headers': {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            },
            language: {
                processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
            },
            columns: [{
                data: 'tgl_trans_jual',
            }, {
                data: 'no_trans_jual',
            }, {
                data: 'booking.customer.nama_customer',
            },{
                data: 'total_jual',
                render: DataTable.render.number(',', '.', 2, '')
            }, {
                data: 'pembayaran',
            }, {
                data: 'tgl_jatuh_tempo'
            }]
        });
    });
</script>
@endsection
