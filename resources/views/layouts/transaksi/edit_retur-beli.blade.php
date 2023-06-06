@extends('layouts.admin.master')

@section('content')
    <div class="content-wrapper tw-py-6 tw-px-5">
        <section class="tambahBeli">
            <form id="editretur_beli" action="{{ route('update-retur-beli', ['id' => $data->id]) }}" method="POST">
                @csrf
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="\transaksi">Transaksi</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('retur-pembelian') }}">Retur Pembelian</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ubah Retur Pembelian</li>
                    </ol>
                </nav>
                <div class="tw-grid tw-grid-cols-2 tw-px-4">
                    <div class="mx-2 ">
                        <label for="htrans_jual_id">Nomor Pembelian</label>
                        <div class="dropdown" style="width:50%;">
                            <input type="text" class="form-control tgl_retur_beli tw-w-48" name="no_po"
                                value="{{ $data->TransBeli->nomor_po }}" readonly>
                        </div>
                    </div>
                    <div class="mx-2">
                        <label for="user_beli">Tgl Retur Beli</label>
                        <input type="date" placeholder="Tanggal Transaksi" class="form-control tgl_retur_beli tw-w-48"
                            name="tgl_retur_beli" value="{{ $data->tgl_retur_beli }}" id="tgl_retur_beli">
                    </div>
                    <div class="my-4">
                        <label for="user_beli" class="mx-2">Info Pembelian</label>
                        <dl class="mx-2">
                            <dd id="tgl_beli">Transaksi pada
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->TransBeli->tgl_trans_beli)->isoFormat('D MMMM Y') }}
                            </dd>
                            <dd id="tgl_garansi">Garansi hingga
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->TransBeli->tgl_max_garansi)->isoFormat('D MMMM Y') }}
                            </dd>
                        </dl>
                    </div>
                    <div class="my-4">
                        <label for="user_beli" class="mx-2">Supplier</label>
                        <dl class="mx-2">
                            <dd id="supplier">{{ $data->TransBeli->Supplier->nama_supplier }}</dd>
                            <dd id="alamat_supplier">{{ $data->TransBeli->Supplier->alamat }}</dd>
                            <dd id="telp_supplier">{{ $data->TransBeli->Supplier->telepon }}</dd>
                        </dl>
                    </div>

                </div>
                <div class="tw-grid pb-4">
                    <button
                        class="tw-w-48 tw-bg-prim-red tw-border-0  tw-text-center tw-text-white tw-py-2 tw-rounded-lg hover:tw-bg-red-700 tw-transition-all float-right"
                        onclick="addrows('retur')" type="button">
                        + Tambah Barang Retur
                    </button>
                </div>
                <div class="tw-bg-white tw-px-5 tw-py-3 ">
                    <div class="tw-overflow-x-hidden tw-overflow-y-auto tw-h-52">
                        <table id="retur" class="tw-w-full table table-striped">
                            <thead class="tw-border-b tw-border-b-black">
                                <tr class="tw-border-transparent ">
                                    <th scope="row" class="tw-text-left tw-border-t-0 d-none ">No</th>
                                    <th class="tw-text-center tw-border-t-0" style="width:35%">Jenis Barang / Jasa</th>
                                    <th class="tw-text-center tw-border-t-0" style="width:10%">Jumlah</th>
                                    <th class="tw-text-center tw-border-t-0" style="width:20%">Harga</th>
                                    <th class="tw-text-center tw-border-t-0" style="width:20%">Subtotal</th>
                                    <th class="tw-text-center tw-border-t-0" style="width:5%">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->DReturbeli as $d)
                                    <tr>
                                        <td scope="row" class="d-none" style="width:100%;">1</td>
                                        <td>
                                            <div class="dropdown ">
                                                <select class="custom-select  tw-text-prim-white barang"
                                                    id="{{ $loop->iteration - 1 }}" name="barang_id[]" width="100%">
                                                    <option value="{{ $d->barang->id }}" selected>
                                                        {{ $d->Barang->nama_barang }}</option>
                                                </select>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control jumlah" id="jumlah0"
                                                    name="jumlah[]" min="0" style="width:100%;"
                                                    value="{{ $d->jumlah }}">
                                            </div>
                                            <small class="text-danger" id="msg-alert"></small>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control harga" id="harga0"
                                                    name="harga[]" min="0" style="width:100%;"
                                                    value="{{ number_format($d->harga, 0, ',', '.') }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control subtotal" name="subtotal[]"
                                                    min="0" id="subtotal0" readonly style="width:100%;"
                                                    value="{{ number_format($d->harga * $d->jumlah, 0, ',', '.') }}">
                                            </div>
                                        </td>

                                        <td>
                                            <button type="button" id="removerow" class="tw-bg-transparent tw-border-none">
                                                <i class="fa fa-trash tw-text-prim-red"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- <tfoot>
                        <tr>
                        <td colspan="3">Total Harga</td>
                        <td colspan="2">Rp. 0</td>
                        </tr>
                    </tfoot> --}}
                        </table>
                    </div>
                    <div class="totalPrice tw-mt-9">
                        <table id="prices" class="table table-sm">
                            <tbody>
                                <tr>
                                    <td class="tw-border-none" colspan="4"></td>
                                    <td class="tw-border-none">Total</td>
                                    <td class="tw-border-none">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text tw-bg-transparent tw-border-transparent">Rp.</span>
                                            </div>
                                            <input type="text"
                                                class="form-control tw-w-1 tw-bg-transparent tw-border-transparent total"
                                                aria-label="Amount" id="total" name="total"
                                                value="{{ number_format($data->total_retur_beli, 0, ',', '.') }}">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class=" tw-mb-40 tw-mt-10">
                    <button type="button" onclick="location.href='/transaksi/retur-beli'"
                        class="tw-bg-white tw-border-2 tw-mr-5 tw-text-prim-blue  tw-border-prim-blue hover:tw-bg-prim-blue hover:tw-text-prim-white  tw-w-32 tw-text-center tw-py-2 tw-rounded-lg  tw-transition-all">
                        <p class="tw-m-0 tw-font-bold">Batal</p>
                    </button>
                    <button type="submit"
                        class="tw-bg-prim-black tw-border-0 tw-w-32 tw-text-center tw-py-2 tw-rounded-lg hover:tw-bg-gray-600 tw-transition-all float-right">
                        <p class="tw-m-0 tw-text-white">Simpan</p>
                    </button>
                </div>
            </form>
        </section>
    </div>
@section('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        select_data();
        select_barang({{ $data->TransBeli->id }});

        function total() {
            var totalharga = 0;
            $('#retur').find('tr .subtotal').each(function() {
                var subtotal = replaceAll($(this).val(), '.', '');
                totalharga = parseInt(totalharga) + parseInt(subtotal);
                $("#total").val(formatmoney(totalharga));
            })
        }

        $("#retur").on('keyup change', '.harga', function() {
            var result = $(this).val().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            $(this).val(result);
            var jumlah = $(this).closest('tr').find('.jumlah').val();
            var harga = replaceAll($(this).closest('tr').find('.harga').val(), '.', '');
            var subtotal = $(this).closest('tr').find('.subtotal');
            if (jumlah != "" && harga != "") {
                subtotal.val(formatmoney(jumlah * parseInt(harga)));
                total();
            } else {
                total();
                subtotal.val(0);
            }
        });

        $(document).on('keyup change', '#retur .jumlah', function() {
            var table = $(this).closest('tr');
            var jumlah = $(this).closest('tr').find('.jumlah').val();
            var barang = $(this).closest('tr').find('.barang').val();
            var harga = replaceAll($(this).closest('tr').find('.harga').val(), '.', '');
            var subtotal = $(this).closest('tr').find('.subtotal');
            if (jumlah != "" && harga != "") {
                subtotal.val(formatmoney(jumlah * parseInt(harga)));
                total();
                $.ajax({
                        url: "/api/cek_jumlah_beli/"+'{{$data->htrans_beli_id}}'+'/'+barang,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            alert(jumlah);
                            // if(jumlah > res){
                            //     table.find('#msg-alert').html('Jumlah barang dibeli hanya '+res);
                            //     console.log(table.find('#msg-alert').length);
                            // }else{
                            //     table.find('#msg-alert').html('');
                            // }
                        }
                    });
            } else {
                total();
                subtotal.val(0);
            }
        });


        function addrows(table) {
            $('#' + table + ' tr:last').after(`<tr>
        <td scope="row" class="d-none"   style="width:100%;">1</td>
                            <td>
                                <div class="dropdown ">
                                    <select class="custom-select  tw-text-prim-white barang" id="0" name="barang_id[]" width="100%">
                                    </select>
                                </div>

                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control jumlah" id="jumlah0"  name="jumlah[]" min="0"   style="width:100%;">
                                </div>
                                <small class="text-danger" id="msg-alert"></small>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control harga" id="harga0" name="harga[]" min="0"   style="width:100%;">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control subtotal" name="subtotal[]" min="0"  id="subtotal0" readonly   style="width:100%;">
                                </div>
                            </td>

                            <td>
                                <button type="button" id="removerow" class="tw-bg-transparent tw-border-none">
                                    <i class="fa fa-trash tw-text-prim-red"></i>
                                </button>
                            </td>
    </tr>`);
            // validasi();
            numberRows(table);
        }
        $('#retur').on('click', '#removerow', function(e) {
            if ($('#retur > tbody > tr').length > 1) {
                $(this).closest('tr').remove();
            } else {
                swal.fire(
                    'Gagal',
                    'Transaksi membutuhkan minimal 1 Item',
                    'warning'
                );
            }
            numberRows("retur");

            total();
        });

        function numberRows(table) {
            var poid = $('#no_po').val();
            var c = 0 - 2;
            $("#" + table + "").find("tr").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
                var j = c;
                $(el).find('.barang').attr('name', 'barang_id[' + j + ']');
                $(el).find('.barang').attr('id', j);
                $(el).find('.jumlah').attr('name', 'jumlah[' + j + ']');
                $(el).find('.jumlah').attr('id', 'jumlah' + j);
                $(el).find('.harga').attr('name', 'harga[' + j + ']');
                $(el).find('.harga').attr('id', 'harga' + j);
                $(el).find('.subtotal').attr('name', 'subtotal[' + j + ']');
                $(el).find('.subtotal').attr('id', 'subtotal' + j);

                select_barang({{ $data->TransBeli->id }});
                // $("#prices").find(".item").html('Total Item : '+(c+1)+' Item');
            });


        }

        function select_data() {
            $('#no_po').select2({
                placeholder: "Pilih Data",
                ajax: {
                    minimumResultsForSearch: 20,
                    dataType: 'json',
                    theme: "bootstrap",
                    delay: 250,
                    type: 'GET',
                    url: '/transaksi/beli/selectdata/0',
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
                                    text: obj.nomor_po
                                };
                            })
                        };
                    },
                }
            }).change(function() {
                var value = $(this).val();
                $.ajax({
                    url: '/transaksi/beli/selectdata/' + value,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('#tgl_beli').text('Transaksi pada ' + data.tgl_transaksi);
                        $('#tgl_garansi').text('Garansi hingga ' + data.tgl_max_garansi);
                        $('#supplier').text(data.supplier);
                        $('#alamat_supplier').text(data.alamat);
                        $('#telp_supplier').text(data.telp);

                    }
                });

            });
        }

        function select_barang(id) {
            $('.barang').select2({
                placeholder: "Pilih Barang",
                ajax: {
                    minimumResultsForSearch: 20,
                    dataType: 'json',
                    theme: "bootstrap",
                    delay: 250,
                    type: 'GET',
                    url: '/barang/selectdata/po/' + id,
                    data: function(params) {
                        return {
                            term: params.term,
                        }
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.nama_barang
                                };
                            })
                        };
                    },
                }
            })
        }

        $("#retur").on('keyup change', '.barang', function() {
            var index = $(this).attr('id');
            var id = $(this).val();
            $.ajax({
                url: '/barang/selectdata/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $('#harga' + index).val(formatmoney(res.harga_jual));
                    $('#jumlah' + index).val(1);
                    $('#subtotal' + index).val(formatmoney(res.harga_jual * 1));
                    total();
                }
            });
        });

        function replaceAll(string, search, replace) {
            return string.split(search).join(replace);
        }

        function formatmoney(bilangan) {
            var number_string = bilangan.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return rupiah;
        }
    </script>
@stop
@endsection
