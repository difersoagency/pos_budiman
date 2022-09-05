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
                    <!-- START : Search Bar -->
                    <div class="search-bar tw-text-right items">
                        <input type="text" name="" id="" placeholder="Cari Supplier" class="tw-bg-transparent tw-w-[90%] md:tw-w-[60%] tw-border-x-0 tw-border-t-0 tw-border-b-prim-blue tw-outline-none focus:tw-border-b-prim-red tw-transition-all">  
                        <a href="" class="tw-w-fit">
                            <i class="fa fa-search tw-text-prim-red ml-2"></i>
                        </a>
                    </div>
                    <!-- END : Search Bar -->

                </div>
              <div class="card tw-w-full tw-px-6 tw-py-5 tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-items-center">
                <div class="tw-w-full">
                    <h1 class="tw-m-0 tw-text-2xl tw-font-bold">List Supplier</h1>
                </div>
                <div class="tw-text-right tw-grid tw-grid-cols-1 md:tw-flex tw-mx-auto md:tw-mx-0 md:tw-ml-auto tw-w-full md:tw-w-fit tw-mt-4 md:tw-mt-0">
                    <div class="tw-mb-4 tw-w-full md:tw-w-fit">
                        <button class="btn tw-text-prim-white tw-bg-prim-red tw-text-sm tw-w-full md:tw-w-fit" type="button" id="addItemButton">
                            + Tambah Supplier
                        </button>
                    </div>
                </div>

                <!-- START: Table Mobile View -->
                <div class="table-barang-mobile tw-mt-5 md:tw-hidden">
                    <div class="list-barang" data-current-page="1">
                        <table class="table item-table">
                            <tbody>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100 tw-w-[50%]">Nama Supplier</th>
                                    <td>PT. Jaya Makmur Sentosa</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100 tw-w-[50%]">Alamat</th>
                                    <td>Jl. Padepokan 55</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100 tw-w-[50%]">Kota</th>
                                    <td>Surabaya</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100 tw-w-[50%]">No. Telepon</th>
                                    <td>099173978698</td>
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
                                    <th scope="row" class="tw-bg-gray-100 tw-w-[50%]">Nama Supplier</th>
                                    <td>PT. Laksana Jaya</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100 tw-w-[50%]">Alamat</th>
                                    <td>Puri Jaya Selatan Blok A 22</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100 tw-w-[50%]">Kota</th>
                                    <td>Surabaya</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100 tw-w-[50%]">No. Telepon</th>
                                    <td>099173978698</td>
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
                                    <th scope="row" class="tw-bg-gray-100 tw-w-[50%]">Nama Supplier</th>
                                    <td>PT. Angkasa Tunai Indon</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100 tw-w-[50%]">Alamat</th>
                                    <td>Jl. Padepokan 55</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100 tw-w-[50%]">Kota</th>
                                    <td>Surabaya</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="tw-bg-gray-100 tw-w-[50%]">No. Telepon</th>
                                    <td>099173978698</td>
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
                            <th class="tw-font-bold tw-px-3 tw-text-pri tw-border-b-prim-black tw-text-prim-white tw-border-t-0">Nama Supplier</th>
                            <th class="tw-font-bold tw-px-3 tw-text-pri tw-border-b-prim-black tw-text-prim-white tw-border-t-0">Alamat</th>
                            <th class="tw-font-bold tw-px-3 tw-text-pri tw-border-b-prim-black tw-text-prim-white tw-border-t-0">Kota</th>
                            <th class="tw-font-bold tw-px-3 tw-text-pri tw-border-b-prim-black tw-text-prim-white tw-border-t-0">No. Telepon</th>
                            <th class="tw-font-bold tw-px-3 tw-text-pri tw-border-b-prim-black tw-text-prim-white tw-border-t-0 col-span-2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="tw-block tw-max-h-96 tw-w-full tw-overflow-y-scroll">
                            <tr class=" tw-w-full tw-table tw-table-fixed">
                                <td class="tw-px-3 tw-font-normal ">PT. Jaya Makmur Sentosa</td>
                                <td class="tw-px-3">Jl.Padepokan 55</td>
                                <td class="tw-px-3">Surabaya</td>
                                <td class="tw-px-3">08992993123</td>
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
                                <td class="tw-px-3 tw-font-normal ">PT. Laksana Jaya</td>
                                <td class="tw-px-3">Jl.Palangka Gg.VII</td>
                                <td class="tw-px-3">Banyuwangi</td>
                                <td class="tw-px-3">08123424321</td>
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
                                <td class="tw-px-3 tw-font-normal ">PT. Angkasa Tunai Indon</td>
                                <td class="tw-px-3">Puri Indah Selatan Blok XX No. 12</td>
                                <td class="tw-px-3">Malang</td>
                                <td class="tw-px-3">012381723987</td>
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
                                <td class="tw-px-3 tw-font-normal ">CV. Asmara Jaya</td>
                                <td class="tw-px-3">Jl. Harapan Indah Semata 12</td>
                                <td class="tw-px-3">Jombang</td>
                                <td class="tw-px-3">02839163</td>
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
