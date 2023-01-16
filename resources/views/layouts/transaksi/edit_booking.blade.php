@extends('layouts.admin.master')

@section('content')
    <div class="content-wrapper tw-py-6 tw-px-5">
        <section class="tambahBeli">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('transaksi') }}">Transaksi</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('master_booking') }}">Booking</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Booking</li>
                </ol>
            </nav>
            <form method="POST" action="{{ route('update_booking', ['id' => $id]) }}" id="formbooking">
                @method('PUT')
                @csrf
                <div class="tw-grid tw-grid-cols-3 tw-p-4">
                    <div class="mx-2 ">
                        <label for="htrans_jual_id">Customer</label>
                        <div class="dropdown">
                            <select class="custom-select cust_id tw-text-prim-white" id="customer_id"
                                name="customer_id">
                                <option value="{{$data->customer_id}}" selected="true">{{$data->customer->nama_customer}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="mx-2">
                        <label for="user_beli">No Booking</label>
                        <input type="text" placeholder="No Booking" class="form-control no_booking" name="no_booking" value="{{$data->no_booking}}"
                            id="no_booking">
                    </div>
                    <div class="mx-2">
                        <label for="user_beli">Tgl Booking</label>
                        <input type="date" placeholder="Tanggal Transaksi" class="form-control tgl_booking"
                            name="tgl_booking" id="tgl_booking" value="{{$data->tgl_booking}}">
                    </div>

                </div>
                <div class="tw-grid py-4">
                    <button id="tambahbarang" type="button"
                        class="tw-w-48 tw-bg-prim-red tw-border-0  tw-text-center tw-text-white tw-py-2 tw-rounded-lg hover:tw-bg-red-700 tw-transition-all float-right">
                        + Tambah Barang
                    </button>
                </div>
                <div class="tw-bg-white tw-px-5 tw-py-3 ">
                    <div class="tw-overflow-x-hidden tw-overflow-y-auto tw-h-52">
                        <table id="barang_booking" class="tw-w-full table table-striped">
                            <thead class="tw-border-b tw-border-b-black">
                                <tr class="tw-border-transparent ">
                                    <th class="tw-text-center tw-border-t-0" style="width:70%">Jenis Barang / Jasa</th>
                                    <th class="tw-text-center tw-border-t-0" style="width:20%">Jumlah</th>
                                    <th class="tw-text-center tw-border-t-0 d-none">jenis</th>
                                    <th class="tw-text-center tw-border-t-0" style="width:10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($dbooking as $key => $i)
                                <tr>
                                    <td>
                                        <!-- Dropdown -->
                                        <div class="dropdown ">
                                            <select class="custom-select barang_id tw-text-prim-white barang_id"
                                                name="barang_id[{{$key}}]">
                                                <option value="{{$i['id']}}" selected="true">{{$i['nama']}}</option>
                                            </select>
                                        </div>
                                        <!-- End Dropdown  -->
                                    </td>
                                    <td class="d-none">
                                        <div class="form-group">
                                            <input type="text" class="form-control jenis_brg" name="jenis_brg[]"
                                                id="jenis_brg" value="{{$i['jenis']}}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="number" class="form-control jumlah" name="jumlah[]" value="{{$i['jumlah']}}"
                                                min="0">
                                        </div>
                                        <small class="text-danger" id="msg-alert"></small>
                                    </td>

                                    <td>
                                        <button type="button" id="removerow" class="tw-bg-transparent tw-border-none">
                                            <i class="fa fa-trash tw-text-prim-red"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class=" tw-mb-40 tw-mt-10">
                        <a href="{{ route('master_booking') }}"><button type="button"
                            class="tw-bg-white tw-border-2 tw-mr-5 tw-text-prim-blue  tw-border-prim-blue hover:tw-bg-prim-blue hover:tw-text-prim-white  tw-w-32 tw-text-center tw-py-2 tw-rounded-lg  tw-transition-all">
                            <p class="tw-m-0 tw-font-bold">Batal</p>
                            </button>
                        </a>
                        <button type="submit"
                            class="tw-bg-prim-black tw-border-0 tw-w-32 tw-text-center tw-py-2 tw-rounded-lg hover:tw-bg-gray-600 tw-transition-all float-right">
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
            $(document).on('submit', '#formbooking', function(event) {
                event.preventDefault();
                var action = $(this).attr('action');
                $.ajax({
                    url: action,
                    type: 'POST',
                    data: $('#formbooking').serialize(),
                    success: function(result) {
                        if (result.data == "success") {
                            Swal.fire({
                                title: 'Berhasil',
                                text: result.msg,
                                icon: 'success',
                            });
                            window.location.href="{{route('master_booking')}}";
                        } else {
                            Swal.fire({
                                title: 'Gagal',
                                text: result.msg,
                                icon: 'error',
                            });
                        }
                    }
                });
            })
            $('.barang_id').select2({
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
                                    harga: obj.harga,
                                    stok: obj.stok
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

            $('.cust_id').select2({
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

        $(function() {
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

            function select_data() {
                $('.barang_id').select2({
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
                                        harga: obj.harga,
                                        stok: obj.stok
                                    };
                                })
                            };
                        },
                    }
                });
            }

            function numberRows($t) {
                var c = 0 - 1;
                $t.find("tr").each(function(ind, el) {
                    var j = c;
                    $(el).find('.barang_id').attr('name', 'barang_id[' + j + ']');
                    $(el).find('.jenis_brg').attr('name', 'jenis_brg[' + j + ']');
                    $(el).find('.jumlah').attr('name', 'jumlah[' + j + ']');
                    select_data();
                    c++;
                });
            }

            select_data();

            $(document).on('click', '#barang_booking #removerow', function(e) {
                if ($('#barang_booking > tbody > tr').length > 1) {
                    $(this).closest('tr').remove();
                    numberRows($("#barang_booking"));
                }
            });

            $(document).on('change keyup', '#barang_booking .jumlah', function(e) {
                var stok = $(this).closest('tr').find('.barang_id').select2('data')[0].stok;
                var jumlah = $(this).val();

                if (jumlah > stok) {
                    $(this).closest('tr').find('#msg-alert').html('Barang hanya tersedia ' + stok);
                }
                else{
                    $(this).closest('tr').find('#msg-alert').html('');
                }
            });

            $(document).on('click', '#tambahbarang', function() {
                $('#barang_booking tbody tr:last').after(`
        <tr>
                            <td>
                                <!-- Dropdown -->
                                <div class="dropdown ">
                                    <select class="custom-select barang_id tw-text-prim-white barang_id" name="barang_id[]">
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
                                <small class="text-danger" id="msg-alert"></small>
                            </td>

                            <td>
                                <button type="button" id="removerow" class="tw-bg-transparent tw-border-none">
                                    <i class="fa fa-trash tw-text-prim-red"></i>
                                </button>
                            </td>
                        </tr>`);

                numberRows($("#barang_booking"));
            })
            $(document).on('change', '#barang_booking .barang_id', function() {
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

        })
    </script>
@stop
