<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>NOTA BELI</title>

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
                <td colspan="6">
                    <table>
                        <tr>
                            <td class="title">
                                PT Maju Bersama Motor
                            </td>

                            <td>
                                No Transaksi: {{$beli->nomor_po}}<br>
                                Tgl Penjualan: {{$beli->tgl_trans_beli}}<br>
                                Tgl Garansi: {{$beli->tgl_max_garansi}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="6">
                    <table>
                        <tr>
                            <td>
                                <b>Supplier</b><br>
                                {{$beli->Supplier->nama_supplier}}<br>
                                {{$beli->Supplier->alamat}}<br>
                                {{$beli->Supplier->telepon}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td colspan="3">
                    Pembayaran
                </td>

                <td colspan="3">
                    Nomor Pembayaran
                </td>
            </tr>

            <tr class="details">
                <td colspan="3">
                    {{$beli->Pembayaran->nama_bayar}}
                </td>

                <td colspan="3">
                    {{$beli->no_giro != "" ? $beli->no_giro : '-'}}
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
                    Discount
                </td>

                <td>
                    Subtotal
                </td>
            </tr>
            <?php $count = 0; $subtotal = 0; ?>
            @foreach($beli->DTransBeli as $i)
            <?php $count = $count + 1;?>
            <tr class="item">
                <td>{{$count}}</td>
                <td>{{$i->Barang->nama_barang}}</td>
                <td>{{$i->jumlah}}</td>
                <td>{{number_format($i->harga,2)}}</td>
                <td>{{$i->disc}} %</td>
                <td>{{ number_format((($i->jumlah * $i->harga) - (($i->jumlah * $i->harga) * ($i->disc / 100))), 2)}}</td>
            <?php 
            $subtotal += ($i->jumlah * $i->harga) - (($i->jumlah * $i->harga) * ($i->disc / 100));
            ?>
            </tr>
            @endforeach
            <tr class="total">
                <td colspan="5">Total</td>
                <td>
                   {{number_format($subtotal, 2)}}
                </td>
            </tr>
            <tr class="total">
                <td colspan="5">Total Bayar</td>
                <td>
                   {{number_format($beli->total_bayar, 2)}}
                </td>
            </tr>
        </table>
    </div>
</body>
</html>