<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>NOTA JUAL</title>

    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
        text-align: center;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
        text-align: center;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="7">
                    <table>
                        <tr>
                            <td class="title">
                                PT Maju Bersama Motor
                            </td>

                            <td>
                                No Transaksi #: {{$jual->no_trans_jual}}<br>
                                Tgl Penjualan: {{$jual->tgl_trans_jual}}<br>
                                Tgl Garansi: {{$jual->tgl_max_garansi}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="7">
                    <table>
                        <tr>
                            <td>
                                <b>Customer</b><br>
                                {{$jual->Booking->Customer->nama_customer}}<br>
                                {{$jual->Booking->Customer->alamat}}<br>
                                {{$jual->Booking->Customer->telepon}}
                            </td>

                            @if($jual->user_id != "")
                            <td>
                                <b>Petugas</b><br>
                                {{$jual->User->Pegawai->kode_pegawai}}<br>
                                {{$jual->User->Pegawai->nama_pegawai}}<br>
                                {{$jual->User->LevelUser->nama_level}}<br>
                            </td>
                            @endif
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td colspan="4">
                    Pembayaran
                </td>

                <td colspan="3">
                    Nomor Pembayaran
                </td>
            </tr>

            <tr class="details">
                <td colspan="4">
                    {{$jual->Pembayaran->nama_bayar}}
                </td>

                <td colspan="3">
                    {{$jual->no_giro != "" ? $jual->no_giro : '-'}}
                </td>
            </tr>

            <tr class="heading" style="text-align:center;">
                <td>
                    No
                </td>

                <td>
                    Nama Item
                </td>

                <td>
                    Jumlah
                </td>

                <td>
                    Harga
                </td>

                <td>
                    Promo
                </td>

                <td>
                    Discount
                </td>

                <td>
                    Subtotal
                </td>
            </tr>
            <?php $count = 0; $subtotal = 0; ?>
            @foreach($jual->DTransJual as $i)
            <?php $count = $count + 1;?>
            <tr class="item">
                <td>{{$count}}</td>
                <td>{{$i->Barang->nama_barang}}</td>
                <td>{{$i->jumlah}}</td>
                <td>{{number_format($i->harga,2)}}</td>
                <td>@if($i->promo_id != "") {{$i->Promo->kode_promo}} - {{$i->Promo->nama_promo}} @endif</td>
                <td>{{$i->disc != "" ? $i->disc : 0}} %</td>
                <td>@if($i->promo_id != "") {{ number_format(((($i->jumlah * $i->harga) - (($i->jumlah * $i->harga) * ($i->Promo->disc / 100))) - ((($i->jumlah * $i->harga) - (($i->jumlah * $i->harga) * ($i->Promo->disc / 100))) * ($i->disc/100))),2) }} @else {{ number_format((($i->jumlah * $i->harga) - (($i->jumlah * $i->harga) * ($i->disc / 100))), 2)}} @endif</td>
            <?php 
            if($i->promo_id != "") { 
                $subtotal += (($i->jumlah * $i->harga) - (($i->jumlah * $i->harga) * ($i->Promo->disc / 100))) - ((($i->jumlah * $i->harga) - (($i->jumlah * $i->harga) * ($i->Promo->disc / 100))) * ($i->disc/100)); 
            } else {
                $subtotal += ($i->jumlah * $i->harga) - (($i->jumlah * $i->harga) * ($i->disc / 100)); 
            }
            ?>
            </tr>
            @endforeach
            @foreach($jual->DTransJualJasa as $i)
            <?php $count = $count + 1;?>
            <tr class="item">
                <td>{{$count}}</td>
                <td>{{$i->Jasa->nama_jasa}}</td>
                <td>1</td>
                <td>{{number_format($i->harga, 2)}}</td>
                <td>@if($i->promo_id != "") {{$i->Promo->kode_promo}} - {{$i->Promo->nama_promo}} @endif</td>
                <td>{{$i->disc != "" ? $i->disc : 0}} %</td>
                <td>@if($i->promo_id != "") {{ number_format((((1 * $i->harga) - ((1 * $i->harga) * ($i->Promo->disc / 100))) - (((1 * $i->harga) - ((1 * $i->harga) * ($i->Promo->disc / 100))) * ($i->disc/100))),2) }} @else {{ number_format(((1 * $i->harga) - ((1 * $i->harga) * ($i->disc / 100))),2)}} @endif</td>
            <?php 
            if($i->promo_id != "") { 
                $subtotal += ((1 * $i->harga) - ((1 * $i->harga) * ($i->Promo->disc / 100))) - (((1 * $i->harga) - ((1 * $i->harga) * ($i->Promo->disc / 100))) * ($i->disc/100)); 
            } else {
                $subtotal += (1 * $i->harga) - ((1 * $i->harga) * ($i->disc / 100)); 
            }
            ?>
            </tr>
            @endforeach
            <tr class="total">
                <td colspan="6">Total</td>
                <td>
                   {{number_format($subtotal, 2)}}
                </td>
            </tr>
            <tr class="total">
                <td colspan="6">Total Bayar</td>
                <td>
                   {{number_format($jual->bayar_jual, 2)}}
                </td>
            </tr>
            <tr class="total">
                <td colspan="6">Kembali</td>
                <td>
                   {{number_format($jual->kembali_jual, 2)}}
                </td>
            </tr>

            
        </table>
    </div>
</body>
</html>