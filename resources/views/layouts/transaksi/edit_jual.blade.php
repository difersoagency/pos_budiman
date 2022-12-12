@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <section class="tambahBeli">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="transaksi">Transaksi</a></li>
                <li class="breadcrumb-item"><a href="{{route('trans-jual')}}">Penjualan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Penjualan</li>
            </ol>
        </nav>
        <form action="{{route('update_jual', ['id' => $id])}}" method="POST">
        @method('PUT')
        @csrf
        <div class="tw-grid tw-grid-cols-3 tw-px-4">
            <div class="mx-2 tw-row-span-2">
                <label for="user_beli" class="mx-2">Customer</label>
                <dl class="mx-2">
                    <dl id="customer_id">{{$d->Booking->Customer->nama_customer}}</dl>
                    <dl id="customer_alamat">{{$d->Booking->Customer->alamat}}</dl>
                    <dl id="customer_telp">{{$d->Booking->Customer->telepon}}</dl>
                    <dl>No Booking: {{$d->Booking->no_booking}}</dl>
                </dl>
            </div>
            <div class="mx-2">
                <label for="no_trans_jual">No Transaksi Penjualan</label>
                <input type="text" placeholder="No Transaksi" class="form-control no_trans_jual" name="no_trans_jual" id="no_trans_jual" value="{{$d->no_trans_jual}}">
            </div>
            <div class="mx-2">
                <label for="tgl_trans_jual">Tgl Transaksi</label>
                <input type="date" placeholder="Tanggal Transaksi" class="form-control tgl_trans_jual" name="tgl_trans_jual" id="tgl_trans_jual" value="{{$d->tgl_trans_jual}}">
            </div>

            <div class="my-4 tw-row-span-2">
                <label for="user_beli" class="mx-2">Dibuat Oleh</label>
                <dl class="mx-2">
                    <dd>{{Auth::user()->pegawai->nama_pegawai}}</dd>
                    <dd>{{Auth::user()->LevelUSer->nama_level}} - {{Auth::user()->pegawai->kode_pegawai}}</dd>
                </dl>
            </div>
            <div class="my-4 mx-2">
                <label for="user_beli">Batas Garansi</label>
                <input type="date" placeholder="Tanggal Transaksi" class="form-control tgl_max_garansi" name="tgl_max_garansi" id="tgl_max_garansi" value="{{$d->tgl_max_garansi}}">
            </div>
            <div class="mb-4 mx-2 float-right">
                <label for="user_beli">Pembayaran</label>
                <div class="dropdown">
                    <select class="custom-select pembayaran_id tw-text-prim-white" id="pembayaran_id" name="pembayaran_id">
                        <option value="{{$d->Pembayaran->id}}" selected>{{$d->Pembayaran->nama_bayar}}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="tw-rounded-lg promobox mb-4 tw-py-2 tw-px-4">
            <h2 class="tw-text-md tw-text-prim-white">Promo</h2>
            <div class="tw-grid tw-grid-cols-4 tw-gap-7">
                @foreach($promo as $key => $promo)
                <div class="my-2 tw-text-white">
                    <label for="user_beli">{{$promo->kode_promo}}</label>
                    <div class="form-check tw-text-white">
                        <input class="form-check-input" type="radio" value="{{$promo->id}}" id="promo_id{{$key}}" name="promo_id[{{$key}}]" data-barang="{{$promo->barang_id}}" data-disc="{{$promo->disc}}" data-min="{{$promo->qty_sk}} " disabled="true">
                        <label class="tw-text-white tw-text-[12px]" for="promo_id{{$key}}">
                        {{$promo->nama_promo}}
                        </label>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
        <div class="tw-grid pb-4">
            <button type="button" class="tw-w-48 tw-bg-prim-red tw-border-0  tw-text-center tw-text-white tw-py-2 tw-rounded-lg hover:tw-bg-red-700 tw-transition-all float-right" id="btntambah">
                + Tambah Barang
            </button>
        </div>
        <div class="tw-bg-white tw-px-5 tw-py-3 ">
            <div class="tw-overflow-x-hidden tw-overflow-y-auto tw-h-52">
                <table id="barangtable" class="tw-w-full table table-striped">
                    <thead class="tw-border-b tw-border-b-black">
                        <tr class="tw-border-transparent ">
                            <th class="tw-text-center tw-border-t-0" style="width:35%">Jenis Barang / Jasa</th>
                            <th class="tw-text-center tw-border-t-0 d-none">Jenis</th>
                            <th class="tw-text-center tw-border-t-0" style="width:10%">Jumlah</th>
                            <th class="tw-text-center tw-border-t-0" style="width:20%">Harga</th>
                            <th class="tw-text-center tw-border-t-0" style="width:10%">Disc</th>
                            <th class="tw-text-center tw-border-t-0" style="width:20%">Subtotal</th>
                            <th class="tw-text-center tw-border-t-0" style="width:5%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0 ?>
                        @if($b != null)
                            <?php $count = count($b) ?>
                            @foreach ($b as $kb => $brg)
                            <tr>
                                <td>
                                    <div class="dropdown ">
                                        <select class="custom-select barang_id tw-text-prim-white" name="barang_id[{{$kb}}]">
                                            <option value="{{$brg->Barang->id}}" selected>{{$brg->Barang->nama_barang}}</option>
                                        </select>
                                    </div>
                                    <!-- End Dropdown  -->
                                </td>
                                <td class="d-none">
                                    <div class="form-group">
                                        <input type="text" class="form-control jenis_brg" name="jenis_brg[{{$kb}}]" value="barang">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" class="form-control jumlah" name="jumlah[]" min="0" value="{{$brg->jumlah}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control harga" name="harga[]" value="{{$brg->harga}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" class="form-control disc" name="disc[]" step="0.00" min="0" value="{{$brg->disc}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control subtotal" readonly="true" name="subtotal[]" value="{{$brg->jumlah * $brg->harga}}">
                                    </div>
                                </td>

                                <td>
                                    <button type="button" id="removerow" class="tw-bg-transparent tw-border-none">
                                        <i class="fa fa-trash tw-text-prim-red"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        @if($j != null)
                        @foreach ($j as $kj => $jasa)
                        <tr>
                            <td>
                                <div class="dropdown ">
                                    <select class="custom-select barang_id tw-text-prim-white" name="barang_id[{{$kj + $count}}]">
                                        <option value="{{$jasa->Jasa->id}}" selected>{{$jasa->Jasa->nama_jasa}}</option>
                                    </select>
                                </div>
                                <!-- End Dropdown  -->
                            </td>
                            <td class="d-none">
                                <div class="form-group">
                                    <input type="text" class="form-control jenis_brg" name="jenis_brg[]" value="jasa">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" class="form-control jumlah" name="jumlah[]" min="0" value="{{$jasa->jumlah}}">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control harga" name="harga[]" value="{{$jasa->harga}}">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" class="form-control disc" name="disc[]" step="0.00" min="0" value="{{$jasa->disc}}">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control subtotal" readonly="true" name="subtotal[]" value="{{$jasa->jumlah * $jasa->harga}}">
                                </div>
                            </td>

                            <td>
                                <button type="button" id="removerow" class="tw-bg-transparent tw-border-none">
                                    <i class="fa fa-trash tw-text-prim-red"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="tw-border-none" colspan="4">Total sebelum Diskon</td>
                            <td class="tw-border-none" colspan="2">
                                    <input type="text" class="form-control total_kotor" name="total_kotor" readonly="false" value="{{$d->total_jual}}">
                            </td>
                        </tr>
                        <tr>
                            <td class="tw-border-none" colspan="4">Diskon</td>
                            <td class="tw-border-none" colspan="2">
                                    <input type="text" class="form-control diskon_jual" name="diskon_jual" readonly="false">
                            </td>
                        </tr>
                        <tr>
                            <td class="tw-border-none" colspan="4">Total Harga</td>
                            <td class="tw-border-none" colspan="2">
                                    <input type="text" class="form-control total_jual" name="total_jual" readonly="true" value="{{$d->total_jual}}">
                            </td>
                        </tr>
                        <tr>
                            <td class="tw-border-none" colspan="4">Jumlah Bayar</td>
                            <td class="tw-border-none" colspan="2">
                                    <input type="text" class="form-control bayar_jual" name="bayar_jual" value="{{$d->bayar_jual}}">
                            </td>
                        </tr>
                        <tr>
                            <td class="tw-border-none" colspan="4">Kembali</td>
                            <td class="tw-border-none" colspan="2">
                                    <input type="text" class="form-control kembali_jual" name="kembali_jual" readonly="true" value="{{$d->kembali_jual}}">
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
        <div class=" tw-mb-40 tw-mt-10">
            <button class="tw-bg-white tw-border-2 tw-mr-5 tw-text-prim-blue  tw-border-prim-blue hover:tw-bg-prim-blue hover:tw-text-prim-white  tw-w-32 tw-text-center tw-py-2 tw-rounded-lg  tw-transition-all">
                <p class="tw-m-0 tw-font-bold">Batal</p>
            </button>
            <button class="tw-bg-prim-black tw-border-0 tw-w-32 tw-text-center tw-py-2 tw-rounded-lg hover:tw-bg-gray-600 tw-transition-all float-right" type="submit">
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
    @endif
$(function(){

    function replaceAll(string, search, replace) {
        return string.split(search).join(replace);
    }

    function number_format(angka) {
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }


    function number_unformat(angka){
        return parseFloat(replaceAll(angka, ',', ''));
    }

    function numberRows($t) {
                var c = 0 - 1;
                $t.find("tr").each(function(ind, el) {
                    var j = c;
                    $(el).find('.barang_id').attr('name', 'barang_id[' + j + ']');
                    $(el).find('.jenis_brg').attr('name', 'jenis_brg[' + j + ']');
                    $(el).find('.jumlah').attr('name', 'jumlah[' + j + ']');
                    $(el).find('.harga').attr('name', 'harga[' + j + ']');
                    $(el).find('.subtotal').attr('name', 'subtotal[' + j + ']');
                    $(el).find('.disc').attr('name', 'disc[' + j + ']');
                    select_barang();
                    c++;
                });
            }

    $(document).on('click', '#barangtable #removerow', function(e) {
                if ($('#barangtable > tbody > tr').length > 1) {
                    $(this).closest('tr').remove();
                    numberRows($("#barangtable"));
                    sum_total_harga();
                    sum_bayar_jual();
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
                            <td class="d-none">
                                <div class="form-group">
                                    <input type="text" class="form-control jenis_brg" name="jenis_brg[]">
                                </div>
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
                                    <input type="number" class="form-control disc" name="disc[]" step="0.00" min="0">
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

    $(document).on('keyup change', '.harga', function(){
        var tes = $(this).val().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        $(this).val(tes);
        sum_subtotal_harga($(this).closest('tr'));
    })

    $('.booking_id').select2({
        placeholder: "Pilih No Booking",
        delay: 250,
                ajax: {
                    dataType: 'json',
                    type: 'GET',
                    url: '/api/booking_select',
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
                                    text: obj.no_booking+' - '+obj.customer.nama_customer,
                                    cust: obj.customer.nama_customer,
                                    alamat: obj.customer.alamat,
                                    telp: obj.customer.telepon,
                                    detail: obj.d_booking
                                };
                            })
                        };
                    },
                }
    });

    function select_barang(){
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

    select_barang();



    function sum_subtotal_harga(table){
        var jumlah = table.find('.jumlah').val();
        var disc = table.find('.disc').val();
        if(jumlah == null){
            jumlah = 0;
        }
        if(disc == ""){
            disc = 0;
        }

        var harga = number_unformat(table.find('.harga').val());
        var subtotal = ((jumlah * harga) - ((jumlah * harga) * (disc/100)));
        table.find('.subtotal').val(subtotal);
        sum_total_harga();
        sum_bayar_jual();
    }

    function sum_total_harga(){
        var sum = 0;
        $("#barangtable .subtotal").each(function(){
            if($(this).val() != ""){
                sum += parseFloat(number_unformat($(this).val()));
            }
        });
        $('#barangtable .total_kotor').val(number_format(sum));

        var diskon = 0;
        if($('#barangtable .diskon_jual').val() != ""){
            diskon = parseFloat(number_unformat($('#barangtable .diskon_jual').val()));
        }
        var bayar = sum - diskon;
        $('#barangtable .total_jual').val(number_format(bayar));

        sum_bayar_jual();
    }
    function sum_bayar_jual(){
        if($('#barangtable .bayar_jual').val() != ""){
        var total_jual = parseFloat(number_unformat($('#barangtable .total_jual').val()));
        var bayar_jual = parseFloat(number_unformat($('#barangtable .bayar_jual').val()));
        console.log(bayar_jual);
        if(bayar_jual >= total_jual){
            $("#barangtable .kembali_jual").val(number_format(bayar_jual - total_jual));
        }
        else{
            $("#barangtable .kembali_jual").val("0");
        }
        }
    }

    $(document).on('change', '#barangtable .barang_id', function(){
        $(this).closest('tr').find('.jenis_brg').val($(this).select2('data')[0].jenis);
        $(this).closest('tr').find('.harga').val(number_format($(this).select2('data')[0].harga));
        sum_total_harga();
    });

    $(document).on('keyup change', '#barangtable .jumlah', function(){
        sum_subtotal_harga($(this).closest('tr'));
    });

    $(document).on('keyup change', '#barangtable .disc', function(){
            sum_subtotal_harga($(this).closest('tr'))
        });

    // $(document).on('change', '.booking_id', function(){
    //     $('#customer_id').html($(this).select2('data')[0].cust);
    //     $('#customer_alamat').html($(this).select2('data')[0].alamat);
    //     $('#customer_telp').html($(this).select2('data')[0].telp);
    //     var d_booking = $(this).select2('data')[0].detail;
    //     console.log(d_booking)
    //     if($(this).val() != ""){
    //         console.log(d_booking);
    //         $('#btntambah').removeAttr('disabled');
    //         $('.barang_id').removeAttr('disabled');
    //         for(var i = 0; i < d_booking.length; i++){
    //             if($('#barangtable .barang_id').val() == null){
    //                 $('#barangtable tbody').empty();
    //             }
    //             var ids = d_booking[i].barang_id != null ? d_booking[i].barang_id : d_booking[i].jasa_id;
    //             var namas = d_booking[i].barang_id != null ? d_booking[i].barang.nama_barang : d_booking[i].jasa.nama_jasa;
    //             var jumlah = d_booking[i].jumlah;
    //             var harga = d_booking[i].barang_id != null ? d_booking[i].barang.harga_jual : d_booking[i].jasa.harga;
    //             var jenis = d_booking[i].barang_id != null ? "barang" : "jenis";
    //             $('#barangtable tbody').append(`<tr>
    //             <td>
    //                             <!-- Dropdown -->
    //                             <div class="dropdown ">
    //                                 <select class="custom-select barang_id tw-text-prim-white" name="barang_id[`+i+`]">
    //                                     <option value="`+ids+`" selected>`+namas+`</option>
    //                                 </select>
    //                             </div>
    //                             <!-- End Dropdown  -->
    //                         </td>
    //                         <td class="d-none">
    //                             <div class="form-group">
    //                                 <input type="text" class="form-control jenis_brg" name="jenis_brg[`+i+`]" value="`+jenis+`">
    //                             </div>
    //                         </td>
    //                         <td>
    //                             <div class="form-group">
    //                                 <input type="number" class="form-control jumlah" name="jumlah[`+i+`]" min="0" value="`+jumlah+`">
    //                             </div>
    //                         </td>
    //                         <td>
    //                             <div class="form-group">
    //                                 <input type="text" class="form-control harga" name="harga[`+i+`]" min="0"  value="`+number_format(harga)+`">
    //                             </div>
    //                         </td>
    //                         <td>
    //                             <div class="form-group">
    //                                 <input type="number" class="form-control disc" name="disc[`+i+`]" step="0.00" min="0">
    //                             </div>
    //                         </td>
    //                         <td>
    //                             <div class="form-group">
    //                                 <input type="text" readonly="true" class="form-control subtotal" name="subtotal[`+i+`]" min="0" value="`+number_format(harga * jumlah)+`">
    //                             </div>
    //                         </td>

    //                         <td>
    //                             <button type="button" id="removerow" class="tw-bg-transparent tw-border-none">
    //                                 <i class="fa fa-trash tw-text-prim-red"></i>
    //                             </button>
    //                         </td>
    //             </tr>`);
    //             select_barang();
    //             // $('select[name="barang_id['+i+']').val($(".barang_id option:contains('"+namas+"')").val()).change();
    //         }
    //     }
    //     sum_total_harga();
    // });

    $('.pembayaran_id').select2({
        placeholder: "Pilih Pembayaran",
        delay: 250,
                ajax: {
                    dataType: 'json',
                    type: 'GET',
                    url: '/api/pembayaran_select',
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
                                    text: obj.nama_bayar
                                };
                            })
                        };
                    },
                }
    });

    $(document).on('keyup change', '#barangtable .bayar_jual', function(){
        var tes = $(this).val().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $(this).val(tes);
        sum_bayar_jual();
        // sum_total_harga();
    });


})
</script>
@stop