@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                <div class="tw-w-full">
                    <h1 class="tw-m-0 tw-text-2xl tw-font-bold">Daftar Merk Produk</h1>
                </div>
                <div class="tw-text-right tw-items-center tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">
                    <!-- START : Search Bar -->
                    <div class="search-bar tw-text-right items">
                        <input type="text" name="" id="" placeholder="Cari Merk" class="tw-bg-transparent tw-w-[90%] md:tw-w-[80%] tw-mb-4 md:tw-mb-0 tw-border-x-0 tw-border-t-0 tw-border-b-prim-blue tw-outline-none focus:tw-border-b-prim-red tw-transition-all">  
                        <a href="" class="tw-w-fit">
                            <i class="fa fa-search tw-text-prim-red ml-2"></i>
                        </a>
                    </div>
                    <!-- END : Search Bar -->
                    <div class="tw-w-full md:tw-w-fit md:tw-ml-auto">
                        <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" type="button" id="addItemButton">
                            + Tambah Merk
                        </button>
                    </div>
                </div>

                <!-- START: Table Mobile View -->
                <div class="table-barang-mobile tw-mt-5 md:tw-hidden">
                    <div class="list-barang" data-current-page="1">
                        <table class="table item-table">
                            <tbody>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100 tw-w-[50%]">Merk</th>
                                    <td>Honda</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100 tw-w-[50%]">Jumlah Produk</th>
                                    <td>20</td>
                                </tr>
                                <tr class="tw-py-5">
                                    <td class="tw-border-none tw-py-5">
                                        <a href="" class="tw-px-6 tw-py-2 tw-mt-10 tw-bg-prim-blue tw-rounded-sm tw-text-prim-white tw-w-full">
                                            Edit
                                        </a>
                                    </td>
                                    <td class="tw-border-none tw-py-5">
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
                                    <th scope="row" class="tw-bg-gray-100 tw-w-[50%]">Merk</th>
                                    <td>Silver Queen</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100 tw-w-[50%]">Jumlah Produk</th>
                                    <td>20</td>
                                </tr>
                                <tr class="tw-py-5">
                                    <td class="tw-border-none tw-py-5">
                                        <a href="" class="tw-px-6 tw-py-2 tw-mt-10 tw-bg-prim-blue tw-rounded-sm tw-text-prim-white tw-w-full">
                                            Edit
                                        </a>
                                    </td>
                                    <td class="tw-border-none tw-py-5">
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
                                    <th scope="row" class="tw-bg-gray-100 tw-w-[50%]">Merk</th>
                                    <td>Ultra Milk</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100 tw-w-[50%]">Role</th>
                                    <td>15</td>
                                </tr>
                                <tr class="tw-py-5">
                                    <td class="tw-border-none tw-py-5">
                                        <a href="" class="tw-px-6 tw-py-2 tw-mt-10 tw-bg-prim-blue tw-rounded-sm tw-text-prim-white tw-w-full">
                                            Edit
                                        </a>
                                    </td>
                                    <td class="tw-border-none tw-py-5">
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
                <div class="table-barang tw-mt-10 tw-col-span-2 tw-hidden md:tw-block">
                    <table class="table table-striped">
                        <thead class="tw-w-full tw-bg-prim-blue tw-table tw-table-fixed">
                            <tr class="">
                            <th class="tw-font-bold tw-px-3 tw-text-pri tw-border-b-prim-black tw-text-prim-white tw-border-t-0">Merk</th>
                            <th class="tw-font-bold tw-px-3 tw-text-pri tw-border-b-prim-black tw-text-prim-white tw-border-t-0">Jumlah Produk</th>
                            <th class="tw-font-bold tw-px-3 tw-text-pri tw-border-b-prim-black tw-text-prim-white tw-border-t-0 col-span-2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="tw-block tw-max-h-96 tw-w-full tw-overflow-y-scroll">
                            <tr class=" tw-w-full tw-table tw-table-fixed">
                                <td class="tw-px-3 tw-font-normal ">Honda</td>
                                <td class="tw-px-3">10</td>
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
                                <td class="tw-px-3 tw-font-normal ">Silver Queen</td>
                                <td class="tw-px-3">20</td>
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
                                <td class="tw-px-3 tw-font-normal ">Ultra Milk</td>
                                <td class="tw-px-3">15</td>
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
