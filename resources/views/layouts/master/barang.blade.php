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
                            Lihat Tipe Produk
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Ban</a>
                            <a class="dropdown-item" href="#">Lampu</a>
                            <a class="dropdown-item" href="#">Rem</a>
                        </div>
                    </div>
                    <!-- End Dropdown  -->

                </div>
              <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                <div class="tw-w-full tw-col-span-2 md:tw-col-span-1">
                    <h1 class="tw-m-0 tw-text-2xl tw-font-bold">List Barang</h1>
                </div>
                <div class="tw-text-right tw-grid tw-grid-cols-1 md:tw-flex tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">
                    <div class="dropdown tw-mb-4 md:tw-mr-3">
                        <button class="btn tw-text-prim-black tw-w-full tw-bg-prim-white dropdown-toggle tw-text-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pilih Merk
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Honda</a>
                            <a class="dropdown-item" href="#">Suzuki</a>
                            <a class="dropdown-item" href="#">Yamaha</a>
                        </div>
                    </div>
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
                    <table id="example" class="table table-bordered responsive nowrap" style="width:100%">
                        <thead class="tw-bg-prim-blue">
                            <tr>
                                <th class="tw-text-prim-white">Kode Barang</th>
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
                            <tr>
                                <td>LM001</td>
                                <td>Lampu Motor</td>
                                <td>Yamaha</td>
                                <td>Lampu</td>
                                <td>Rp 25.000</td>
                                <td>Rp 60.000</td>
                                <td>12 Pcs</td>
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
                                <td>LM002</td>
                                <td>Lampu Mobil</td>
                                <td>Honda</td>
                                <td>Lampu</td>
                                <td>Rp 15.000</td>
                                <td>Rp 50.000</td>
                                <td>15 Pcs</td>
                                <td class="tw-px-3">
                                    <div class="grid grid-cols-2">
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
                                <td>LM002</td>
                                <td>Lampu Mobil</td>
                                <td>Honda</td>
                                <td>Lampu</td>
                                <td>Rp 15.000</td>
                                <td>Rp 50.000</td>
                                <td>15 Pcs</td>
                                <td class="tw-px-3">
                                    <div class="grid grid-cols-2">
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
@endsection
