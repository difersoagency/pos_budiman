@extends('layouts.admin.master')
@section('css')
<style>
  .select_item .select2-selection__rendered {
            word-wrap: break-word !important;
            text-overflow: inherit !important;
            white-space: normal !important;
        }
    </style>
@stop
@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <section class="tambahBeli">
        <form id="trans_beli" action="{{route('store-beli')}}" method="POST">
            @csrf
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="\transaksi\">Transaksi</a></li>
                    <li class="breadcrumb-item"><a href="\transaksi\beli">Pembelian</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pengajuan Pembelian</li>
                </ol>
            </nav>

            <div class="tw-grid tw-grid-cols-3 ">
                <div class="mx-2">
                    <label for="booking_id">Supplier</label>
                    <div class="dropdown" style="width:100%;">
                        <select class="custom-select select-user tw-text-prim-white" id="suuplier" name="supplier">
                            @foreach ($supplier as $s)
                            <option value="{{$s->id}}">{{$s->nama_supplier}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="mx-2">
                    <label for="no_trans_jual">No Transaksi Pembelian</label>
                    <input type="text" placeholder="No Transaksi" class="form-control no_trans_jual" name="no_beli" id="no_trans_jual">
                </div>
                <div class="mx-2">
                    <label for="tgl_trans_jual">Tgl Transaksi</label>
                    <input type="date" placeholder="Tanggal Transaksi" class="form-control tgl_trans_jual" name="tgl_beli" id="tgl_trans_jual">
                </div>
                <div class="my-4 mx-2 tw-row-span-2">
                    {{-- <label for="user_beli">Supplier</label>
                    <div>
                        <div>Prima Sakti Nugraha</div>
                        <div>Jl Ade Irma Suryani Nasution V No. 5, Tlogobendung Gresik</div>
                        <div>0838312222290</div>
                    </div> --}}
                    <label for="user_beli">Batas Garansi</label>
                    <input type="date" placeholder="Tanggal Transaksi" class="form-control tgl_garansi" name="tgl_beli_garansi" id="tgl_retur_beli">
           
                </div>
                <div class="my-4 mx-2 tw-row-span-2">
                    {{-- <label for="user_beli">Dibuat Oleh</label>
                    <div>
                        <div>Suparjo</div>
                        <div>Tim Marketing - M001</div>
                    </div> --}}
                    <label for="user_beli">Pembayaran</label>
                    <div class="dropdown">
                        <select class="custom-select select-user tw-text-prim-white tw-w-full" id="pembayaran_id" name="pembayaran_id">
                            @foreach ($bayar as $b)
                            <option value="{{$b->id}}">{{$b->nama_bayar}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- <div class="my-4 mx-2">
                    <label for="user_beli">Batas Garansi</label>
                    <input type="date" placeholder="Tanggal Transaksi" class="form-control tgl_garansi" name="tgl_beli_garansi" id="tgl_retur_beli">
                </div> --}}
                {{-- <div class="mb-4 mx-2 float-right">
                    <label for="user_beli">Dibuat Oleh</label>
                    <div class="dropdown">
                        <select class="custom-select select-user tw-text-prim-white tw-w-full" id="pembayaran_id" name="pembayaran_id">
                            <option value="0">Semua</option>
                        </select>
                    </div>
                </div> --}}
            </div>

            <div class="tw-bg-white tw-px-5 tw-py-3 ">
                <div class="md:tw-overflow-x-hidden tw-overflow-y-auto tw-h-52">
                    <table id="barang_beli" class="tw-w-full table table-striped ">
                        <thead class="tw-border-b tw-border-b-black">
                            <tr class="tw-border-transparent ">
                                <th scope="row" class="tw-text-left tw-border-t-0 d-none ">No</th>
                                <th scope="row" class="tw-text-left tw-border-t-0 ">Jenis Barang / Jasa</th>
                                <th scope="row" class="tw-text-left tw-border-t-0 tw-w-24">Jumlah</th>
                                {{-- <th scope="row" class="tw-text-left tw-border-t-0 tw-w-30">Satuan</th> --}}
                                <th scope="row" class="tw-text-left tw-border-t-0 tw-w-36">Harga Satuan</th>
                                <th scope="row" class="tw-text-left tw-border-t-0 tw-w-24">Diskon(%)</th>
                                <th scope="row" class="tw-text-left tw-border-t-0 tw-w-36">Total</th>
                                <th scope="row" class="tw-text-left tw-border-t-0 tw-w-20">#</th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr>
                                <td class="d-none">1</td>
                                <td data-label="Jenis Barang / Jasa" scope="row">
                                    <!-- Dropdown -->
                                    <div class="dropdown tw-mb-7 md:tw-mb-0 ">
                                        <select name="barang[]" id="0" class="custom-select  tw-text-prim-white barang" style="width: 100%">
                                        </select>
                                    </div>
                                    <!-- End Dropdown  -->
                                </td>
                                <td data-label="Jumlah">
                                    <div class="form-group">
                                        <input type="number" class="form-control jumlah_beli" name="jumlah_beli[]" id="jumlah_beli0" min="0">
                                    </div>
                                </td>
                                {{-- <td data-label="Satuan">
                                    <div class="dropdown tw-mb-7 md:tw-mb-0 ">
                                        <select name="satuan[]" id="satuan0" class="custom-select select-satuan tw-text-prim-white satuan"  style="width: 100%">
                                            @foreach ($satuan as $s)
                                            <option value="{{$s->id}}">{{$s->nama_satuan}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </td> --}}
                                <td data-label="Harga Satuan">
                                    <div class="form-group">
                                        <input type="text" class="form-control harga_satuan" name="harga_satuan[]" id="harga_satuan0" min="0">
                                    </div>
                                </td>
                                <td data-label="diskon-beli">
                                    <div class="form-group">
                                        <input type="number" class="form-control diskon_beli" name="diskon_beli[]" id="diskon_beli0" min="0" max="100">
                                    </div>
                                </td>
                                <td data-label="Total">
                                    <input type="text" readonly class="form-control subtotal" name="subtotal[]" id="subtotal0" min="0">
                                </td>
                                <td data-label="#">
                                    <button class="tw-bg-transparent tw-border-none">
                                        <button class="tw-bg-transparent tw-border-none" id="removerow" type="button">
                                            <i class="fa fa-trash tw-text-prim-red"></i>
                                        </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button class="tw-bg-prim-red  tw-border-0 tw-w-full tw-text-center tw-py-2 tw-rounded-lg hover:tw-bg-red-700 tw-transition-all" onclick="addrow('barang_beli')" type="button">
                    <p class="tw-m-0 tw-text-white">+ Tambah Barang</p>
                </button>
                <div class="totalPrice tw-mt-9">
                    <table id="prices" class="table table-sm">
                        <tbody>
                            {{-- <tr>
                                <td colspan="3" class="item">Total Item : 1 Item</td>
                                <td>Biaya Lain</td>
                                <td>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="number" class="form-control tw-w-1" aria-label="Amount" id="harga-jual" name="harga_jual" placeholder="0">
                                    </div>
                                </td>
                            </tr> --}}
                            <tr>
                                <td class="item" colspan="3">Total Item : 1 Item</td>
                                <td class="">Diskon Transaksi %</td>
                                <td class="">
                                    <div class="input-group">
                                        <input type="number" class="form-control tw-w-1 diskon_total" aria-label="Amount" id="diskon_total" name="diskon_total" placeholder="0">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            {{-- <tr>
                                <td class="tw-border-none" colspan="3"></td>
                                <td class="tw-border-none">Pajak (11%)</td>
                                <td class="tw-border-none">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text tw-bg-transparent tw-border-transparent">Rp.</span>
                                        </div>
                                        <input type="number" class="form-control tw-w-1 tw-bg-transparent tw-border-transparent" aria-label="Amount" id="harga-jual" name="harga_jual" value="0" disabled>
                                    </div>
                                </td>
                            </tr> --}}
                            {{-- <tr>
                                <td class="tw-border-none"></td>
                            </tr> --}}
                            {{-- <tr>
                                <td class="" colspan="3"></td>
                                <td class="">Subtotal</td>
                                <td class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text tw-bg-transparent tw-border-transparent">Rp.</span>
                                        </div>
                                        <input type="number" class="form-control tw-w-1 tw-bg-transparent tw-border-transparent" aria-label="Amount" id="harga-jual" name="harga_jual" value="0" disabled>
                                    </div>
                                </td>
                            </tr> --}}
                            <tr>
                                <td class="tw-border-none" colspan="3"></td>
                                <td class="tw-border-none">Total Bayar</td>
                                <td class="tw-border-none">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control tw-w-1 total_dibayar" aria-label="Amount" id="total_dibayar" name="total_dibayar" value=""  >
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="tw-border-none" colspan="3"></td>
                                <td class="tw-border-none">Total</td>
                                <td class="tw-border-none">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text tw-bg-transparent tw-border-transparent">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control tw-w-1 tw-bg-transparent tw-border-transparent total_bayar" aria-label="Amount" id="total_bayar" name="total_bayar" value="0" >
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tw-flex tw-mb-40 tw-mt-10">
                <button onclick="location.href='/transaksi/beli'" type="button" class="tw-bg-white tw-border-2 tw-mr-5 tw-text-prim-blue  tw-border-prim-blue hover:tw-bg-prim-blue hover:tw-text-prim-white  tw-w-32 tw-text-center tw-py-2 tw-rounded-lg  tw-transition-all">
                    <p class="tw-m-0 tw-font-bold">Batal</p>
                </button>
                <button class="tw-bg-prim-black tw-border-0 tw-w-32 tw-text-center tw-py-2 tw-rounded-lg hover:tw-bg-gray-600 tw-transition-all" type="submit">
                    <p class="tw-m-0 tw-text-white">Simpan</p>
                </button>
            </div>
    </section>
</div>

</form>
</section>

</div>
@endsection
@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   select_barang();
 //  select_satuan();
   function replaceAll(string, search, replace) {
                return string.split(search).join(replace);
            }

   function total() {
                var totalharga = 0;
                $('#barang_beli').find('tr .subtotal').each(function() {
                    var subtotal = replaceAll($(this).val(), '.', '');
                    var dis_tot =  $('#diskon_total').val();
                    totalharga = parseInt(totalharga) + parseInt(subtotal);
                    $("#total_bayar").val(formatmoney(totalharga - (totalharga * dis_tot/100)));
                })
            }

            $("#diskon_total").on('keyup', function() {
           total();
            });

            $("#total_dibayar").on('keyup change', function() {
                var result =  $(this).val().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                 $(this).val(result);
            });

             $("#barang_beli").on('keyup change', '.diskon_beli', function() {
               $(this).val();
                var diskon = $(this).closest('tr').find('.diskon_beli').val();
                var jumlah = $(this).closest('tr').find('.jumlah_beli').val();
                var harga = replaceAll($(this).closest('tr').find('.harga_satuan').val(), '.', '');

                var subtotal = $(this).closest('tr').find('.subtotal');
                if (jumlah != "" && harga != "") {
                    subtotal.val(formatmoney((jumlah * parseInt(harga)) - (harga * diskon/100)));
                    total();
                }else{
                    total();
                    subtotal.val(0);
                }
             });
             $("#barang_beli").on('keyup change', '.harga_satuan', function() {
                var result = $(this).val().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                $(this).val(result);
                var diskon = $(this).closest('tr').find('.diskon_beli').val();
                var jumlah = $(this).closest('tr').find('.jumlah_beli').val();
                 var harga = replaceAll($(this).closest('tr').find('.harga_satuan').val(), '.', '');
                var subtotal = $(this).closest('tr').find('.subtotal');
                if (jumlah != "" && harga != "") {
                    subtotal.val(formatmoney((jumlah * parseInt(harga)) - (harga * diskon/100)));
                    total();
                }else{
                    total();
                    subtotal.val(0);
                }
             });

             $("#barang_beli").on('keyup change', '.jumlah_beli', function() {
               $(this).val();
               var diskon = $(this).closest('tr').find('.diskon_beli').val();
                var jumlah = $(this).closest('tr').find('.jumlah_beli').val();
                var harga = replaceAll($(this).closest('tr').find('.harga_satuan').val(), '.', '');
                var subtotal = $(this).closest('tr').find('.subtotal');
                if (jumlah != "" && harga != "") {
                    subtotal.val(formatmoney((jumlah * parseInt(harga)) - (harga * diskon/100)));
                    total();
                }else{
                    total();
                    subtotal.val(0);
                }
             });
                      function numberRows(table) {
                var c = 0 - 2;
                $("#"+table+"").find("tr").each(function(ind, el) {
                    $(el).find("td:eq(0)").html(++c);
                    var j = c;
                    $(el).find('.barang').attr('name', 'barang[' + j + ']');
                    $(el).find('.barang').attr('id', j);
                    $(el).find('.jumlah_beli').attr('name', 'jumlah_beli[' + j + ']');
                    $(el).find('.jumlah_beli').attr('id', 'jumlah_beli' + j);
                    $(el).find('.satuan').attr('name', 'satuan[' + j + ']');
                    $(el).find('.satuan').attr('id', 'satuan' + j);
                    $(el).find('.harga_satuan').attr('name', 'harga_satuan[' + j + ']');
                    $(el).find('.harga_satuan').attr('id', 'harga_satuan' + j);
                    $(el).find('.diskon_beli').attr('name', 'diskon_beli[' + j + ']');
                    $(el).find('.diskon_beli').attr('id', 'diskon_beli' + j);
                    $(el).find('.subtotal').attr('name', 'subtotal[' + j + ']');
                    $(el).find('.subtotal').attr('id', 'subtotal' + j);
                  
                    select_barang();
                    //select_satuan();
                   $("#prices").find(".item").html('Total Item : '+(c+1)+' Item');
                });
              

                }

                $('#barang_beli').on('click', '#removerow', function(e) {
                if ($('#barang_beli > tbody > tr').length > 1) {
                    $(this).closest('tr').remove();
                }else{
                    swal.fire(
                    'Gagal',
                    'Transaksi membutuhkan minimal 1 Item',
                    'warning'
                );
                }
                numberRows("barang_beli");
               
            });
             
          
function addrow(table){
    $('#' + table + ' tr:last').after(`<tr>
        <td class="d-none"></td>
        <td data-label="Jenis Barang / Jasa" scope="row">
                                    <!-- Dropdown -->
                                    <div class="dropdown tw-mb-7 md:tw-mb-0 ">
                                        <select name="barang[]" id="0" class="custom-select  tw-text-prim-white barang" style="width: 100%">
                                            @foreach ($barang as $b)
                                            <option value="{{$b->id}}">{{$b->nama_barang}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <!-- End Dropdown  -->
                                </td>
                                <td data-label="Jumlah">
                                    <div class="form-group">
                                        <input type="number" class="form-control jumlah_beli" name="jumlah_beli[]" id="jumlah_beli0" min="0">
                                    </div>
                                </td>
                            
                                <td data-label="Harga Satuan">
                                    <div class="form-group">
                                        <input type="text" class="form-control harga_satuan" name="harga_satuan[]" id="harga_satuan0" min="0">
                                    </div>
                                </td>
                                <td data-label="diskon-beli">
                                    <div class="form-group">
                                        <input type="number" class="form-control diskon_beli" name="diskon_beli[]" id="diskon_beli0" min="0" max="100">
                                    </div>
                                </td>
                                <td data-label="Total">
                                    <input type="text" readonly class="form-control subtotal" name="subtotal[]" id="subtotal0" min="0">
                                </td>
                                <td data-label="#">
                                    <button class="tw-bg-transparent tw-border-none">
                                        <button class="tw-bg-transparent tw-border-none" id="removerow" type="button">
                                            <i class="fa fa-trash tw-text-prim-red"></i>
                                        </button>
                                </td>
    </tr>`);
    // validasi();
     numberRows(table);
}

// function select_satuan(){
//     $('.select-satuan').select2({placeholder: "Pilih Satuan"});
// }
function select_barang() {
                $('.barang').select2({
                    placeholder: "Pilih Barang",
                    ajax: {
                        minimumResultsForSearch: 20,
                        dataType: 'json',
                        theme: "bootstrap",
                        delay: 250,
                        type: 'GET',
                        url: '{{route('barang.selectdata')}}',
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

            
            $("#barang_beli").on('keyup change', '.barang', function() {
                var index = $(this).attr('id');
                var id = $(this).val();
                $.ajax({
                    url: '/barang/selectdata/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        $('#harga_satuan'+index).val(formatmoney(res.harga_jual));
                        $('#jumlah_beli'+index).val(1);
                        $('#diskon_beli'+index).val(0);
                        $('#subtotal'+index).val(formatmoney(res.harga_jual * 1));
                        total();
                    }
                });
            });

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