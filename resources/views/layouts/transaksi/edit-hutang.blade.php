@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper tw-py-6 tw-px-5">
    <section class="tambahBeli">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="\transaksi">Transaksi</a></li>
                <li class="breadcrumb-item"><a href="\transaksi\hutang">Daftar Hutang</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pembayaran Hutang</li>
            </ol>
        </nav>
        <form action="{{route('update_hutang',['id' => $data->id])}}" id="trans_hutang">
            @csrf
            <input type="number" class="form-control tw-w-1 tw-bg-transparent tw-border-transparent d-none" aria-label="Amount" id="hutang_id" name="hutang_id">
            <div class="tw-grid tw-grid-cols-2 tw-mb-7 tw-gap-7">
                <div>
                    <label for="user_beli">No Pengajuan</label>
                    <!-- Dropdown -->
                    <div class="dropdown tw-mb-7 md:tw-mb-0 md:tw-w-3/4">
                        <input type="text" class="form-control " id="desc_hutang" disabled value="{{$data->TransBeli->nomor_po}}">
                    </div>
                    <!-- End Dropdown  -->
                </div>
                <div>
                    <label for="tgl_beli">Tanggal Transaksi</label>
                    <div class="tw-items-center tw-mb-4">
                        <div class="input-group input-daterange tw-items-center">
                            <input type="date" class="form-control tw-mr-3" id="tgl_beli" disabled value="{{$data->TransBeli->tgl_trans_beli}}">
                        </div>
                        <!-- End Date Picker  -->
                    </div>
                </div>

            </div>
            <div class="tw-grid tw-grid-cols-2 md:tw-flex tw-gap-7 tw-mb-5">
                <div class="tw-col-span-2 md:tw-flex-auto">
                    <div class="form-group">
                        <label for="desc_beli" class="col-form-label tw-pt-0">Supplier</label>
                        <input type="text" class="form-control " id="desc_hutang" disabled value="Pembelian dari {{$data->TransBeli->Supplier->nama_supplier}}">
                    </div>
                </div>
            </div>

            <div class="tw-grid tw-grid-cols-2 tw-mb-7 tw-gap-7">
            <div>
              <label for="pembayaran_id" class="col-form-label">Pembayaran:</label>
              <select class="select2 pembayaran_id custom-select" id="pembayaran_id" name="pembayaran_id">
                @foreach($p as $pem)
                  <option value="{{$pem->id}}">{{$pem->nama_bayar}}</option>
                @endforeach
              </select>
            </div>

            <div id="input_giro" hidden="true">
              <label for="no_giro" class="col-form-label">No Giro:</label>
              <input type="text" class="form-control" id="no_giro" name="no_giro" value="">
            </div>
            </div>
            <div class="tw-bg-white tw-px-5 tw-py-3 ">
                <div class="md:tw-overflow-x-hidden tw-overflow-y-auto tw-h-52">
                    <table id="hutang" class="tw-w-full table table-striped ">
                        <thead class="tw-border-b tw-border-b-black">
                            <tr class="tw-border-transparent ">
                                <th scope="row" class="tw-text-left tw-border-t-0 d-none ">No</th>
                                <th scope="row" class="tw-text-left tw-border-t-0 tw-w-12">Tanggal Bayar</th>
                                {{-- <th scope="row" class="tw-text-left tw-border-t-0 tw-w-52">Jumlah</th>
                            <th scope="row" class="tw-text-left tw-border-t-0 tw-w-36">Diskon</th> --}}
                                <th scope="row" class="tw-text-left tw-border-t-0 tw-w-48">Pembayaran</th>
                                <th scope="row" class="tw-text-left tw-border-t-0 tw-w-20">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($data->DtransHutang)>0)
                            @foreach($data->DtransHutang as $d)
                            <tr>
                                <td scope="row" class="d-none ">1</td>
                                <td data-label="Tanggal Beli">
                                    <div class="form-group">
                                        <input type="date" class="form-control tgl_beli" id="tgl_beli0" name="tgl_beli[]" value="{{$d->tgl_bayar}}">
                                    </div>
                                </td>
                                <td data-label="Pembayaran Hutang">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control pembayaran_hutang" aria-label="Amount" id="pembayaran_hutang0" name="pembayaran_hutang[]" placeholder="0" value="{{ number_format($d->total_bayar, 0, ',', '.') }}">
                                    </div>
                                </td>
                                <td data-label="#">
                                    <button class="tw-bg-transparent tw-border-none" id="removerow" type="button">
                                        <i class="fa fa-trash tw-text-prim-red"></i>
                                    </button>
                                </td>
                                {{-- <td data-label="Jumlah Hutang">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Amount" id="jumlah_hutang" name="jumlah_hutang" disabled value="0">
                                </div>
                            </td>
                            <td data-label="Diskon Hutang">
                                <div class="input-group">
                                    <input type="text" class="form-control" aria-label="Amount" id="diskon_hutang" name="diskon_hutang" value="0">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td> --}}
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td scope="row" class="d-none ">1</td>
                                <td data-label="Tanggal Beli">
                                    <div class="form-group">
                                        <input type="date" class="form-control tgl_beli" id="tgl_beli0" name="tgl_beli[]">
                                    </div>
                                </td>
                                <td data-label="Pembayaran Hutang">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control pembayaran_hutang" aria-label="Amount" id="pembayaran_hutang0" name="pembayaran_hutang[]" placeholder="0">
                                    </div>
                                </td>
                                <td data-label="#">
                                    <button class="tw-bg-transparent tw-border-none" id="removerow" type="button">
                                        <i class="fa fa-trash tw-text-prim-red"></i>
                                    </button>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <button class="tw-bg-prim-red  tw-border-0 tw-w-full tw-text-center tw-py-2 tw-rounded-lg hover:tw-bg-red-700 tw-transition-all" onclick="addrow('hutang')" type="button">
                    <p class="tw-m-0 tw-text-white">+ Tambah Kolom</p>
                </button>
                <div class="totalPrice tw-mt-9">
                    <table id="prices" class="table table-sm">
                        <tbody>
                            <tr>
                                <td class="tw-border-none" colspan="3"></td>
                                <td class="tw-border-none">Total Pembelian</td>
                                <td class="tw-border-none">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text tw-bg-transparent tw-border-transparent">Rp.</span>
                                        </div>
                                        <input type="number" class="form-control tw-w-1 tw-bg-transparent tw-border-transparent" aria-label="Amount" id="total" value="{{ number_format($data->TransBeli->total, 0, ',', '.') }}" disabled>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="tw-border-none" colspan="3"></td>
                                <td class="tw-border-none">Total Dibayar</td>
                                <td class="tw-border-none">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text tw-bg-transparent tw-border-transparent">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control tw-w-1 tw-bg-transparent tw-border-transparent" aria-label="Amount" id="total_dibayar" name="total_dibayar" value="{{ number_format($data->bayar_hutang, 0, ',', '.') }}" readonly>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="tw-border-none" colspan="3"></td>
                                <td class="tw-border-none">Sisa Hutang</td>
                                <td class="tw-border-none">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text tw-bg-transparent tw-border-transparent">Rp.</span>
                                        </div>
                                        <input type="number" class="form-control tw-w-1 tw-bg-transparent tw-border-transparent d-none" aria-label="Amount" id="sisa_hutang" value="{{  number_format(($data->TransBeli->total - $data->TransBeli->total_bayar) - $data->bayar_hutang, 0, ',', '.') }}" name="sisa_hutang" readonly>
                                        <input type="number" class="form-control tw-w-1 tw-bg-transparent tw-border-transparent" aria-label="Amount" id="total_sisa_hutang" value="{{ number_format($data->total_hutang - $data->bayar_hutang, 0, ',', '.') }}" name="total_sisa_hutang" readonly>

                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tw-flex tw-mb-40 tw-mt-10">
                <button onclick="location.href='/transaksi/hutang'" class="tw-bg-white tw-border-2 tw-mr-5 tw-text-prim-blue  tw-border-prim-blue hover:tw-bg-prim-blue hover:tw-text-prim-white  tw-w-32 tw-text-center tw-py-2 tw-rounded-lg  tw-transition-all" type="button">
                    <p class="tw-m-0 tw-font-bold">Batal</p>
                </button>
                <button class="tw-bg-prim-black tw-border-0 tw-w-32 tw-text-center tw-py-2 tw-rounded-lg hover:tw-bg-gray-600 tw-transition-all" type="submit">
                    <p class="tw-m-0 tw-text-white">Simpan</p>
                </button>
            </div>
        </form>
    </section>
</div>
@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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
    $('#hutang').on('click', '#removerow', function(e) {
        if ($('#hutang > tbody > tr').length > 1) {
            $(this).closest('tr').remove();
        } else {
            swal.fire(
                'Gagal',
                'Transaksi membutuhkan minimal 1 Item',
                'warning'
            );
        }
        numberRows("hutang");

        total();
    });
    $('.pembayaran_id').select2();
    $(document).on('change', '#pembayaran_id', function(e) {
            if($(this).val() != "4"){
                $('#input_giro').attr('hidden', true);
                $('#no_giro').val('');
            }
            else{
                $('#input_giro').attr('hidden', false);
            }
        })

    function numberRows(table) {
        var c = 0 - 2;
        $("#" + table + "").find("tr").each(function(ind, el) {
            $(el).find("td:eq(0)").html(++c);
            var j = c;
            $(el).find('.tgl_beli').attr('name', 'tgl_beli[' + j + ']');
            $(el).find('.tgl_beli').attr('id', 'tgl_beli' + j);
            $(el).find('.pembayaran_hutang').attr('name', 'pembayaran_hutang[' + j + ']');
            $(el).find('.pembayaran_hutang').attr('id', 'pembayaran_hutang' + j);

            //select_satuan();
            // $("#prices").find(".item").html('Total Item : '+(c+1)+' Item');
        });


    }

    function addrow(table) {
        $('#' + table + ' tr:last').after(`<tr>
        <td class="d-none"></td>
                            <td data-label="Tanggal Beli">
                                <div class="form-group">
                                    <input type="date" class="form-control tgl_beli" id="tgl_beli0" name="tgl_beli[]" >
                                </div>
                            </td>     
                            <td data-label="Pembayaran Hutang">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control pembayaran_hutang" aria-label="Amount" id="pembayaran_hutang0" name="pembayaran_hutang[]" placeholder="0">
                                </div>
                            </td>
                            <td data-label="#">
                                <button class="tw-bg-transparent tw-border-none" id="removerow">
                                    <i class="fa fa-trash tw-text-prim-red"></i>
                                </button>
                            </td>
    </tr>`);
        // validasi();
        numberRows(table);
    }

    function total() {
        var totalbayar = 0;
        $('#hutang').find('tr .pembayaran_hutang').each(function() {
            var subtotal = replaceAll($(this).val(), '.', '');
            var sisa_hutang = replaceAll($('#sisa_hutang').val(), '.', '');
            totalbayar = parseInt(totalbayar) + parseInt(subtotal);
            totalhutang = sisa_hutang - totalbayar;
            $("#total_dibayar").val(formatmoney(totalbayar));
            $("#total_sisa_hutang").val(formatmoney(totalhutang));
        })
    }

    $("#hutang").on('keyup change', '.pembayaran_hutang', function() {
        var result = $(this).val().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        $(this).val(result);

        total();
    });
</script>
@stop
@endsection