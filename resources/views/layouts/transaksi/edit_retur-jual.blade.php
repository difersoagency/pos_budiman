@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <section class="tambahBeli">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="\transaksi">Transaksi</a></li>
                <li class="breadcrumb-item"><a href="{{route('retur-penjualan')}}">Retur Penjualan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Retur Penjualan</li>
            </ol>
        </nav>
        <form action="{{route('update_retur_jual', ['id' => $id])}}" method="POST">
        @method('PUT')
        @csrf
        <div class="tw-grid tw-grid-cols-3 tw-px-4">
            <div class="mx-2">
                <label for="no_retur_jual">No Retur Jual</label>
                <input type="text" placeholder="Masukkan No Retur" class="form-control no_retur_jual" name="no_retur_jual" id="no_retur_jual" value="{{$r->no_retur_jual}}">
            </div>
            <div class="mx-2 tw-col-span-2">
                <label for="htrans_jual_id">Ref Transaksi Penjualan</label>
                <p>{{$r->TransJual->no_trans_jual}}</p>
            </div>
            <div class="my-4 mx-2">
                <label for="user_beli">Tgl Retur Jual</label>
                <input type="date" placeholder="Tanggal Transaksi" class="form-control tgl_retur_jual" name="tgl_retur_jual" id="tgl_retur_jual" value="{{$r->tgl_retur_jual}}">
            </div>
            <div class="my-4">
            <label for="user_beli" class="mx-2">Info Penjualan</label>
            <dl class="mx-2">
                <dd>Transaksi Pada <span id="tgl_trans_jual">{{$r->TransJual->tgl_trans_jual}}</span></dd>
                <dd>Garansi Hingga <span id="tgl_max_garansi">{{$r->TransJual->tgl_max_garansi}}</span></dd>
            </dl>
            </div>
            <div class="my-4">
                <label for="user_beli" class="mx-2">Customer</label>
                <dl class="mx-2">
                    <dd id="customer">{{$r->TransJual->Booking->Customer->nama_customer}}</dd>
                    <dd id="alamat">{{$r->TransJual->Booking->Customer->alamat}}</dd>
                    <dd id="telepon">{{$r->TransJual->Booking->Customer->telepon}}</dd>
                </dl>
            </div>

        </div>
        <div class="tw-grid pb-4">
        <button type="button" id="btntambah" class="tw-w-48 tw-bg-prim-red tw-border-0  tw-text-center tw-text-white tw-py-2 tw-rounded-lg hover:tw-bg-red-700 tw-transition-all float-right">
            + Tambah Barang Retur
        </button>
        </div>
        <div class="tw-bg-white tw-px-5 tw-py-3 ">
            <div class="tw-overflow-x-hidden tw-overflow-y-auto tw-h-52">
                <table id="barangtable" class="tw-w-full table table-striped">
                    <thead class="tw-border-b tw-border-b-black">
                        <tr class="tw-border-transparent ">
                            <th class="tw-text-center tw-border-t-0" style="width:35%">Jenis Barang / Jasa</th>
                            <th class="tw-text-center tw-border-t-0" style="width:10%">Jumlah</th>
                            <th class="tw-text-center tw-border-t-0" style="width:20%">Harga</th>
                            <!-- <th class="tw-text-center tw-border-t-0" style="width:10%">Disc</th> -->
                            <th class="tw-text-center tw-border-t-0" style="width:20%">Subtotal</th>
                            <th class="tw-text-center tw-border-t-0" style="width:5%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($d as $k => $data)
                    <tr>
                            <td>
                                <select class="custom-select barang_id tw-text-prim-white" name="barang_id[{{$k}}]">
                                    <option value="{{$data->Barang->id}}" selected>{{$data->Barang->nama_barang}}</option>
                                </select>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control jumlah" name="jumlah[{{$k}}]" min="0" value="{{$data->jumlah}}">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control harga" name="harga[{{$k}}]" min="0"  value="{{$data->harga}}">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" readonly="true" class="form-control subtotal" name="subtotal[{{$k}}]" min="0" value="{{$data->jumlah * $data->harga}}">
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
                    <tfoot>
                        <!-- <tr>
                            <td class="tw-border-none" colspan="3">Total sebelum Diskon</td>
                            <td class="tw-border-none" colspan="2">
                                    <input type="text" class="form-control total_kotor" name="total_kotor" readonly="false">
                            </td>
                        </tr> -->
                        <!-- <tr>
                            <td class="tw-border-none" colspan="4">Diskon</td>
                            <td class="tw-border-none" colspan="2">
                                    <input type="text" class="form-control diskon_jual" name="diskon_jual" readonly="false">
                            </td>
                        </tr> -->
                        <tr>
                            <td class="tw-border-none" colspan="3">Total Harga</td>
                            <td class="tw-border-none" colspan="2">
                                <input type="text" class="form-control total_retur_jual" name="total_retur_jual" readonly="true" value="{{$r->total_retur_jual}}">
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
        <div class=" tw-mb-40 tw-mt-10">
            <a href="{{route('retur-penjualan')}}"><button type="button" class="tw-bg-white tw-border-2 tw-mr-5 tw-text-prim-blue  tw-border-prim-blue hover:tw-bg-prim-blue hover:tw-text-prim-white  tw-w-32 tw-text-center tw-py-2 tw-rounded-lg  tw-transition-all">
                <p class="tw-m-0 tw-font-bold">Batal</p>
            </button></a>
            <button class="tw-bg-prim-black tw-border-0 tw-w-32 tw-text-center tw-py-2 tw-rounded-lg hover:tw-bg-gray-600 tw-transition-all float-right">
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
    window.location.href = "{{route('retur-penjualan')}}";
    @endif
    $(function(){
    var brg_arr = [];
    function replaceAll(string, search, replace) {
        return string.split(search).join(replace);
    }

    function number_format(angka) {
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }


    function number_unformat(angka){
        return parseFloat(replaceAll(angka, ',', ''));
    }

    function sum_total_harga(){
        var sum = 0;
        $("#barangtable .subtotal").each(function(){
            if($(this).val() != ""){
                sum += parseFloat(number_unformat($(this).val()));
            }
        });
        // $('#barangtable .total_kotor').val(number_format(sum));

        // var diskon = 0;
        // if($('#barangtable .diskon_jual').val() != ""){
        //     diskon = parseFloat(number_unformat($('#barangtable .diskon_jual').val()));
        // }
        // var bayar = sum - diskon;
        $('#barangtable .total_retur_jual').val(number_format(sum));

    }

    function sum_subtotal_harga(table){
        var jumlah = table.find('.jumlah').val();
        // var disc = table.find('.disc').val();
        if(jumlah == null){
            jumlah = 0;
        }
        // if(disc == ""){
        //     disc = 0;
        // }

        var harga = number_unformat(table.find('.harga').val());
        // var subtotal = number_format ((jumlah * harga) - ((jumlah * harga) * (disc/100)));
        var subtotal = number_format(jumlah * harga);
        table.find('.subtotal').val(subtotal);
        sum_total_harga();
    }

        $('.htrans_jual_id').select2({
        placeholder: "Pilih No Transaksi",

                ajax: {
                    dataType: 'json',
                    type: 'GET',
                    url: '/api/garansi_transjual_select',
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
                                    text: obj.no_trans_jual,
                                    tgl_trans_jual: obj.tgl_trans_jual,
                                    tgl_max_garansi: obj.tgl_max_garansi,
                                    cust: obj.customer,
                                    alamat: obj.alamat,
                                    telp: obj.telepon,
                                    detail: obj.detail
                                };
                            })
                        };
                    },
                }
        });
        select_barang();
        function select_barang(){
            $('.barang_id').select2({
                placeholder: "Pilih Barang",
                ajax: {
                    dataType: 'json',
                    type: 'GET',
                    url: '/api/get_d_trans_jual/'+'{{$r->htrans_jual_id}}',
                    processResults: function(data) {
                        console.log(data);
                        return {
                            results: $.map(data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.text,
                                    jumlah: obj.jumlah,
                                    harga: obj.harga,
                                    disc: obj.disc
                                };
                            })
                        };
                    },
                }
            });
        }

        $(document).on('keyup change', '#barangtable .harga', function(){
            var tes = $(this).val().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $(this).val(tes);
            var table = $(this).closest('tr');
            sum_subtotal_harga(table)
        });

        $(document).on('keyup change', '#barangtable .jumlah', function(){
            var table = $(this).closest('tr');
            sum_subtotal_harga(table)
        });

        // $(document).on('keyup change', '#barangtable .disc', function(){
        //     var table = $(this).closest('tr');
        //     sum_subtotal_harga(table)
        // });

        $(document).on('click', '#barangtable #removerow', function(e) {
                if ($('#barangtable > tbody > tr').length > 1) {
                    $(this).closest('tr').remove();
                    numberRows($("#barangtable"));
                    sum_total_harga();
                }
            });


    $('#btntambah').on('click', function(){
        $('#barangtable > tbody > tr:last').after(`<tr>
                            <td>
                                <!-- Dropdown -->
                                <div class="dropdown ">
                                    <select class="custom-select barang_id tw-text-prim-white" name="barang_id[]">
                                    </select>
                                </div>
                                <!-- End Dropdown  -->
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" class="form-control jumlah" name="jumlah[]" min="0">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control harga" name="harga[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control subtotal" readonly="true" name="subtotal[]">
                                </div>
                            </td>

                            <td>
                                <button type="button" id="removerow" class="tw-bg-transparent tw-border-none">
                                    <i class="fa fa-trash tw-text-prim-red"></i>
                                </button>
                            </td></tr>`);
        numberRows($('#barangtable'));
    })

        function numberRows($t) {
                var c = 0 - 1;
                $t.find("tr").each(function(ind, el) {
                    var j = c;
                    $(el).find('.barang_id').attr('name', 'barang_id[' + j + ']');
                    $(el).find('.jumlah').attr('name', 'jumlah[' + j + ']');
                    $(el).find('.harga').attr('name', 'harga[' + j + ']');
                    $(el).find('.subtotal').attr('name', 'subtotal[' + j + ']');
                    select_barang();
                    c++;
                });
            }

    })
</script>
@stop
