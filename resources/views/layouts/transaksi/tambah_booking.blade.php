@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <section class="tambahBeli">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="transaksi">Transaksi</a></li>
                <li class="breadcrumb-item"><a href="{{route('master_booking')}}">Booking</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Booking</li>
            </ol>
        </nav>
        <form method="POST" action="{{route('store_booking')}}">
            @csrf
            <div class="tw-grid tw-grid-cols-3 tw-p-4">
                <div class="mx-2 ">
                    <label for="htrans_jual_id">Customer</label>
                    <div class="dropdown">
                        <select class="custom-select customer_id tw-text-prim-white" id="customer_id" name="customer_id">
                        </select>
                    </div>
                </div>
                <div class="mx-2">
                    <label for="user_beli">No Booking</label>
                    <input type="text" placeholder="No Booking" class="form-control no_booking" name="no_booking" id="no_booking">
                </div>
                <div class="mx-2">
                    <label for="user_beli">Tgl Booking</label>
                    <input type="date" placeholder="Tanggal Transaksi" class="form-control tgl_booking" name="tgl_booking" id="tgl_booking">
                </div>

            </div>
            <div class="tw-grid py-4">
                <button class="tw-w-48 tw-bg-prim-red tw-border-0  tw-text-center tw-text-white tw-py-2 tw-rounded-lg hover:tw-bg-red-700 tw-transition-all float-right" onclick="addRow('tbody2')">
                    + Tambah Barang Retur
                </button>
            </div>
            <div class="tw-bg-white tw-px-5 tw-py-3 ">
                <div class="tw-overflow-x-hidden tw-overflow-y-auto tw-h-52">
                    <table id="barang_beli" class="tw-w-full table table-striped">
                        <thead class="tw-border-b tw-border-b-black">
                            <tr class="tw-border-transparent ">
                                <th class="tw-text-center tw-border-t-0" style="width:70%">Jenis Barang / Jasa</th>
                                <th class="tw-text-center tw-border-t-0" style="width:20%">Jumlah</th>
                                <th class="tw-text-center tw-border-t-0 d-none">jenis</th>
                                <!-- <th class="tw-text-center tw-border-t-0" style="width:20%">Harga</th>
                            <th class="tw-text-center tw-border-t-0" style="width:10%">Disc</th>
                            <th class="tw-text-center tw-border-t-0" style="width:20%">Subtotal</th> -->
                                <th class="tw-text-center tw-border-t-0" style="width:10%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody2">
                            <tr>
                                <td>
                                    <!-- Dropdown -->
                                    <div class="dropdown ">
                                        <select class="custom-select barang_id tw-text-prim-white" name="barang_id[]">
                                        </select>
                                    </div>
                                    <!-- End Dropdown  -->
                                </td>
                                <td class="d-none">
                                    <div class="form-group">
                                        <input type="text" class="form-control jenis_brg" name="jenis_brg[]" id="jenis_brg">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" class="form-control jumlah" name="jumlah[]" min="0">
                                    </div>
                                </td>

                                <td>
                                    <button data-toggle="modal" data-target="#deleteModal" class="tw-bg-transparent tw-border-none">
                                        <i class="fa fa-trash tw-text-prim-red"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class=" tw-mb-40 tw-mt-10">
                <button class="tw-bg-white tw-border-2 tw-mr-5 tw-text-prim-blue  tw-border-prim-blue hover:tw-bg-prim-blue hover:tw-text-prim-white  tw-w-32 tw-text-center tw-py-2 tw-rounded-lg  tw-transition-all">
                    <p class="tw-m-0 tw-font-bold">Batal</p>
                </button>
                <button type="submit" class="tw-bg-prim-black tw-border-0 tw-w-32 tw-text-center tw-py-2 tw-rounded-lg hover:tw-bg-gray-600 tw-transition-all float-right">
                    <p class="tw-m-0 tw-text-white">Simpan</p>
                </button>
            </div>
        </form>
    </section>
</div>
@endsection
@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function() {
        @if(Session::has('error'))
        Swal.fire({
            title: 'Gagal',
            text: "{{ Session::get('error') }}",
            icon: 'error',
        });
        @endif
        @if(Session::has('success'))
        Swal.fire({
            title: 'Berhasil',
            text: "{{ Session::get('success') }}",
            icon: 'success',
        });
        @endif

        $('.barang_id').prepend('<option selected=""></option>').select2({
            placeholder: "Pilih Barang",
            delay: 250,
            ajax: {
                dataType: 'json',
                type: 'GET',
                url: '/api/barang_select',
                data: function(params) {
                    return {
                        term: params.term
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.nama,
                                jenis: obj.jenis,
                                harga: obj.harga
                            };
                        })
                    };
                },
            }
        });

        $(document).on('change', '#barang_beli .barang_id', function() {
            var val = $(this).select2('data')[0].jenis;
            $(this).closest('tr').find('#jenis_brg').val(val);
        })

        $('.customer_id').prepend('<option selected=""></option>').select2({
            placeholder: "Pilih Customer",
            delay: 250,
            ajax: {
                dataType: 'json',
                type: 'GET',
                url: '/api/customer_select',
                data: function(params) {
                    return {
                        term: params.term
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.nama_customer
                            };
                        })
                    };
                },
            }
        });

    });
</script>
@stop