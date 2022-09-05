@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center tw-mb-4">
                    <!-- Date Picker -->
                    <!-- <div class="tw-grid tw-grid-cols-2">
                        <input type="date" name="daterange" value="01/01/2015" class="daterange tw-w-40"/>
                        <input type="date" name="daterange" value="01/01/2015" class="daterange tw-w-40"/>
                    </div> -->

                    <div class="input-group input-daterange tw-items-center">
                        <input type="date" class="form-control tw-w-10 tw-mr-3" value="2012-04-05">
                        <div class="input-group-addon">-</div>
                        <input type="date" class="form-control tw-w-10 tw-ml-3" value="2012-04-05">
                    </div>
                    <!-- End Date Picker  -->
                    <!-- START : Search Bar -->
                    <div class="search-bar tw-text-right items">
                        <input type="text" name="" id="" placeholder="Cari Promo" class="tw-bg-transparent tw-w-[90%] md:tw-w-[60%] tw-border-x-0 tw-border-t-0 tw-border-b-prim-blue tw-outline-none focus:tw-border-b-prim-red tw-transition-all">  
                        <a href="" class="tw-w-fit">
                            <i class="fa fa-search tw-text-prim-red ml-2"></i>
                        </a>
                    </div>
                    <!-- END : Search Bar -->

                </div>
              <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                <div class="tw-w-full">
                    <h1 class="tw-m-0 tw-text-2xl tw-font-bold">List Promo</h1>
                </div>
                <div class="tw-text-right tw-grid tw-grid-cols-1 md:tw-flex tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">

                    <div class="dropdown tw-mb-4 tw-w-full md:tw-w-fit">
                        <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" type="button" id="addItemButton">
                            + Tambah Promo
                        </button>
                    </div>
                </div>

                <!-- START: Table -->
                <div class="table-barang-mobile tw-mt-5 tw-col-span-2">
                    <div class="list-barang tw-grid tw-grid-cols-1 lg:tw-grid-cols-2 tw-justify-between" data-current-page="1">
                        <table class="table item-table">
                            <tbody>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100">Kode Promo</th>
                                    <td>BUY1GET2</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100">Nama Promo</th>
                                    <td>Buy 1 Free 2 Items</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100">Tanggal Mulai</th>
                                    <td>04/05/2022</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100">Tanggal Selesai</th>
                                    <td>04/06/2022</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100">Min. Penjualan</th>
                                    <td>1 Barang</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100">Discount</th>
                                    <td>2 Barang</td>
                                </tr>
                                <tr class="tw-py-5">
                                    <td class="tw-border-none tw-py-5 tw-px-0 tw-col-span-2 tw-hidden md:tw-block">
                                        <a href="" class="tw-px-6 tw-py-2 tw-mr-5 tw-mt-10 tw-bg-prim-blue tw-rounded-sm tw-text-prim-white tw-w-full">
                                            Edit
                                        </a>
                                        <a href="" class="tw-px-6 tw-py-2 tw-bg-prim-red tw-rounded-sm tw-text-prim-white tw-w-full">
                                            Hapus
                                        </a>
                                    </td>
                                    <td class="tw-border-none tw-py-5 tw-px-0 tw-col-span-2 md:tw-hidden">
                                        <a href="" class="tw-px-6 tw-py-2 tw-mr-5 tw-mt-10 tw-bg-prim-blue tw-rounded-sm tw-text-prim-white tw-w-full">
                                            Edit
                                        </a>
                                    </td>
                                    <td class="tw-border-none tw-py-5 tw-px-0 tw-col-span-2 md:tw-hidden">
                                        <a href="" class="tw-px-6 tw-py-2 tw-bg-prim-red tw-rounded-sm tw-text-prim-white tw-w-full">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table item-table">
                            <tbody>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100">Kode Promo</th>
                                    <td>BUY1GET2</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100">Nama Promo</th>
                                    <td>Buy 1 Free 2 Items</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100">Tanggal Mulai</th>
                                    <td>04/05/2022</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100">Tanggal Selesai</th>
                                    <td>04/06/2022</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100">Min. Penjualan</th>
                                    <td>1 Barang</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100">Discount</th>
                                    <td>2 Barang</td>
                                </tr>
                                <tr class="tw-py-5">
                                    <td class="tw-border-none tw-py-5 tw-px-0 tw-col-span-2 tw-hidden md:tw-block">
                                        <a href="" class="tw-px-6 tw-py-2 tw-mr-5 tw-mt-10 tw-bg-prim-blue tw-rounded-sm tw-text-prim-white tw-w-full">
                                            Edit
                                        </a>
                                        <a href="" class="tw-px-6 tw-py-2 tw-bg-prim-red tw-rounded-sm tw-text-prim-white tw-w-full">
                                            Hapus
                                        </a>
                                    </td>
                                    <td class="tw-border-none tw-py-5 tw-px-0 tw-col-span-2 md:tw-hidden">
                                        <a href="" class="tw-px-6 tw-py-2 tw-mr-5 tw-mt-10 tw-bg-prim-blue tw-rounded-sm tw-text-prim-white tw-w-full">
                                            Edit
                                        </a>
                                    </td>
                                    <td class="tw-border-none tw-py-5 tw-px-0 tw-col-span-2 md:tw-hidden">
                                        <a href="" class="tw-px-6 tw-py-2 tw-bg-prim-red tw-rounded-sm tw-text-prim-white tw-w-full">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table item-table">
                            <tbody>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100">Kode Promo</th>
                                    <td>BUY1GET2</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100">Nama Promo</th>
                                    <td>Buy 1 Free 2 Items</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100">Tanggal Mulai</th>
                                    <td>04/05/2022</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100">Tanggal Selesai</th>
                                    <td>04/06/2022</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100">Min. Penjualan</th>
                                    <td>1 Barang</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100">Discount</th>
                                    <td>2 Barang</td>
                                </tr>
                                <tr class="tw-py-5">
                                    <td class="tw-border-none tw-py-5 tw-px-0 tw-col-span-2 tw-hidden md:tw-block">
                                        <a href="" class="tw-px-6 tw-py-2 tw-mr-5 tw-mt-10 tw-bg-prim-blue tw-rounded-sm tw-text-prim-white tw-w-full">
                                            Edit
                                        </a>
                                        <a href="" class="tw-px-6 tw-py-2 tw-bg-prim-red tw-rounded-sm tw-text-prim-white tw-w-full">
                                            Hapus
                                        </a>
                                    </td>
                                    <td class="tw-border-none tw-py-5 tw-px-0 tw-col-span-2 md:tw-hidden">
                                        <a href="" class="tw-px-6 tw-py-2 tw-mr-5 tw-mt-10 tw-bg-prim-blue tw-rounded-sm tw-text-prim-white tw-w-full">
                                            Edit
                                        </a>
                                    </td>
                                    <td class="tw-border-none tw-py-5 tw-px-0 tw-col-span-2 md:tw-hidden">
                                        <a href="" class="tw-px-6 tw-py-2 tw-bg-prim-red tw-rounded-sm tw-text-prim-white tw-w-full">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>

                    <!-- START : Pagination -->
                    <nav aria-label="..." class="pagination-container">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link pagination-button" href="#" tabindex="-1" id="prev-btn">Previous</a>
                            </li>
                            <ul class="pagination" id="pagination-numbers">
                            <!-- <li class="page-item">
                                <a class="page-link tw-text-prim-black" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link tw-text-prim-black" href="#">3</a>
                            </li>    -->
                            </ul>
                                                  
                            <li class="page-item ">
                                <a class="page-link tw-text-prim-white tw-bg-prim-blue pagination-button" href="#" id="next-btn">Next</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- END : Pagination -->
                </div>
                <!-- END: Table Mobile View -->

                <!-- START: Table Tablet + Desktop -->
                <!-- <div class="table-barang tw-mt-10 tw-col-span-2 tw-hidden md:tw-block">
                    <table class="table table-striped">
                        <thead class="tw-w-full tw-bg-prim-blue tw-table tw-table-fixed">
                            <tr class="">
                            <th class="tw-font-bold tw-px-3 tw-text-pri tw-border-b-prim-black tw-text-prim-white tw-border-t-0">Kode Promo</th>
                            <th class="tw-font-bold tw-px-3 tw-text-pri tw-border-b-prim-black tw-text-prim-white tw-border-t-0">Nama</th>
                            <th class="tw-font-bold tw-px-3 tw-text-pri tw-border-b-prim-black tw-text-prim-white tw-border-t-0">Deskripsi </th>
                            <th class="tw-font-bold tw-px-3 tw-text-pri tw-border-b-prim-black tw-text-prim-white tw-border-t-0">Tgl. Mulai</th>
                            <th class="tw-font-bold tw-px-3 tw-text-pri tw-border-b-prim-black tw-text-prim-white tw-border-t-0">Tgl. Selesai</th>
                            <th class="tw-font-bold tw-px-3 tw-text-pri tw-border-b-prim-black tw-text-prim-white tw-border-t-0">Diskon</th>
                            <th class="tw-font-bold tw-px-3 tw-text-pri tw-border-b-prim-black tw-text-prim-white tw-border-t-0 col-span-2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="tw-block tw-max-h-96 tw-w-full tw-overflow-y-scroll ">
                            <tr class=" tw-w-full tw-table tw-table-fixed">
                                <td class="tw-px-3 tw-font-normal ">FREE12</td>
                                <td class="tw-px-3">Free Buy 1 Get 2</td>
                                <td class="tw-px-3">Setiap Pembelian 1 Lampu Mobil Mendapatkan 2 Motor Beat</td>
                                <td class="tw-px-3">05/04/2021</td>
                                <td class="tw-px-3">05/06/2021</td>
                                <td class="tw-px-3">Barang</td>
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

                            <tr class=" tw-w-full tw-table tw-table-fixed">
                                <td class="tw-px-3 tw-font-normal ">FREE12</td>
                                <td class="tw-px-3">Free Buy 1 Get 2</td>
                                <td class="tw-px-3">Setiap Pembelian 1 Lampu Mobil Mendapatkan 2 Motor Beat</td>
                                <td class="tw-px-3">05/04/2021</td>
                                <td class="tw-px-3">05/06/2021</td>
                                <td class="tw-px-3">Barang</td>
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

                            <tr class=" tw-w-full tw-table tw-table-fixed">
                                <td class="tw-px-3 tw-font-normal ">FREE12</td>
                                <td class="tw-px-3">Free Buy 1 Get 2</td>
                                <td class="tw-px-3">Setiap Pembelian 1 Lampu Mobil Mendapatkan 2 Motor Beat</td>
                                <td class="tw-px-3">05/04/2021</td>
                                <td class="tw-px-3">05/06/2021</td>
                                <td class="tw-px-3">Barang</td>
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
                </div> -->
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
