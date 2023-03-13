<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\Exportable;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\DateFormatter;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;

class LaporanKartuStok implements FromView, ShouldAutoSize, WithStyles, WithEvents, WithTitle
{
    public function barang_id()
    {
        return $this->barang_id;
    }

    public function tgl_awal()
    {
        return $this->tgl_awal;
    }

    public function tgl_akhir()
    {
        return $this->tgl_akhir;
    }

    public function __construct(string $barang_id, string $tgl_awal, string $tgl_akhir)
    {
        $this->barang_id = $barang_id;
        $this->tgl_awal = $tgl_awal;
        $this->tgl_akhir = $tgl_akhir;
    }


    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_TEXT
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A2:G2')->getFont()->setBold(true);
        $sheet->getStyle('A:G')->getAlignment()
        ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        $sheet->getStyle('A:G')->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // $sheet->getColumnDimension('C')->setAutoSize(false)->setWidth(35);
        // $sheet->getStyle('C')->getAlignment()->setWrapText(true);
        // $sheet->getColumnDimension('D')->setAutoSize(false)->setWidth(35);
        // $sheet->getStyle('D')->getAlignment()->setWrapText(true);
        // $sheet->getColumnDimension('G')->setAutoSize(false)->setWidth(35);
        // $sheet->getStyle('G')->getAlignment()->setWrapText(true);
        // $sheet->getColumnDimension('H')->setAutoSize(false)->setWidth(30);
        // $sheet->getStyle('H')->getAlignment()->setWrapText(true);
        // $sheet->getColumnDimension('N')->setAutoSize(false)->setWidth(35);
        // $sheet->getStyle('N')->getAlignment()->setWrapText(true);
        // $sheet->getColumnDimension('J')->setAutoSize(false)->setWidth(35);
        // $sheet->getStyle('J')->getAlignment()->setWrapText(true);
        // $sheet->getColumnDimension('K')->setAutoSize(false)->setWidth(20);
        // $sheet->getStyle('K')->getAlignment()->setWrapText(true);
        // $sheet->getColumnDimension('O')->setAutoSize(false)->setWidth(50);
        // $sheet->getStyle('O')->getAlignment()->setWrapText(true);
        // $sheet->getColumnDimension('H')->setAutoSize(false)->setWidth(15);
        // $sheet->getStyle('H')->getAlignment()->setWrapText(true);
        // $sheet->getColumnDimension('I')->setAutoSize(false)->setWidth(15);
        // $sheet->getStyle('I')->getAlignment()->setWrapText(true);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event)  {
                $cellRange = 'A2:G'.$event->sheet->getHighestRow();
                $event->sheet->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ])->getAlignment()->setWrapText(true);
            },
        ];
    }


    public function view(): View
    {
        $from = date($this->tgl_awal);
        $to = date($this->tgl_akhir);
        $barang_id = $this->barang_id;
        $array = array();
        $count = 0;
        $data_jual = NULL;
        $data_beli = NULL;
        $data_koreksi = NULL;
        if($barang_id == "0"){
            $data_jual = DB::table('dtrans_jual')
            ->join('htrans_jual', 'htrans_jual.id', '=', 'dtrans_jual.htrans_jual_id')
            ->join('barang', 'barang.id', '=', 'dtrans_jual.barang_id')
            ->whereBetween('htrans_jual.tgl_trans_jual', [$from, $to])
            ->select('htrans_jual.id as id_trans_jual',
            'htrans_jual.no_trans_jual as no_trans_jual',
            'htrans_jual.tgl_trans_jual as tgl_trans_jual',
            'barang.nama_barang as barang',
            'dtrans_jual.jumlah as jumlah',
            )
            ->orderByRaw('dtrans_jual.barang_id ASC, htrans_jual.id ASC')
            ->get();
        }else{
            $data_jual = DB::table('dtrans_jual')
                    ->join('htrans_jual', 'htrans_jual.id', '=', 'dtrans_jual.htrans_jual_id')
                    ->join('barang', 'barang.id', '=', 'dtrans_jual.barang_id')
                    ->whereBetween('htrans_jual.tgl_trans_jual', [$from, $to])
                    ->where('barang.id', $barang_id)
                    ->select('htrans_jual.id as id_trans_jual',
                    'htrans_jual.no_trans_jual as no_trans_jual',
                    'htrans_jual.tgl_trans_jual as tgl_trans_jual',
                    'barang.nama_barang as barang',
                    'dtrans_jual.jumlah as jumlah',
                    )
                    ->orderByRaw('dtrans_jual.barang_id ASC, htrans_jual.id ASC')
                    ->get();
        }
        foreach($data_jual as $i){
            $array[$count] = array(
            'tgl_transaksi' => $i->tgl_trans_jual,
            'nomor' => $i->no_trans_jual,
            'barang' => $i->barang,
            'jenis' => 'Penjualan',
            'jumlah_masuk' => 0,
            'jumlah_keluar' => $i->jumlah);
            $count++;
        }

        if($barang_id == "0"){
            $data_beli = DB::table('dtrans_beli')
                ->join('htrans_beli', 'htrans_beli.id', '=', 'dtrans_beli.htrans_beli_id')
                ->join('barang', 'barang.id', '=', 'dtrans_beli.barang_id')
                ->whereBetween('htrans_beli.tgl_trans_beli', [$from, $to])
                ->select('htrans_beli.id as id_trans_beli',
                'htrans_beli.nomor_po as nomor_po',
                'htrans_beli.tgl_trans_beli as tgl_trans_beli',
                'barang.nama_barang as barang',
                'dtrans_beli.jumlah as jumlah',
                )
                ->orderByRaw('dtrans_beli.barang_id ASC, htrans_beli.id ASC')
                ->get();
        }
        else{
            $data_beli = DB::table('dtrans_beli')
                ->join('htrans_beli', 'htrans_beli.id', '=', 'dtrans_beli.htrans_beli_id')
                ->join('barang', 'barang.id', '=', 'dtrans_beli.barang_id')
                ->whereBetween('htrans_beli.tgl_trans_beli', [$from, $to])
                ->where('barang.id', $barang_id)
                ->select('htrans_beli.id as id_trans_beli',
                'htrans_beli.nomor_po as nomor_po',
                'htrans_beli.tgl_trans_beli as tgl_trans_beli',
                'barang.nama_barang as barang',
                'dtrans_beli.jumlah as jumlah',
                )
                ->orderByRaw('dtrans_beli.barang_id ASC, htrans_beli.id ASC')
                ->get();
        }
        foreach($data_beli as $i){
            $array[$count] = array(
                'tgl_transaksi' => $i->tgl_trans_beli,
                'nomor' => $i->nomor_po,
                'barang' => $i->barang,
                'jenis' => 'Pembelian',
                'jumlah_masuk' => $i->jumlah,
                'jumlah_keluar' => 0);
                $count++;
        }

        if($barang_id == "0")
        {
            $data_koreksi = DB::table('koreksi')
            ->join('barang', 'barang.id', '=', 'koreksi.barang_id')
            ->whereBetween('koreksi.tgl_koreksi', [$from, $to])
            ->select('koreksi.id as koreksi_id',
                    'koreksi.tgl_koreksi as tgl_koreksi',
                    'barang.nama_barang as barang',
                    'koreksi.jenis as jenis',
                    'koreksi.jumlah as jumlah',
                    )
            ->get();
        }else
        {
            $data_koreksi = DB::table('koreksi')
            ->join('barang', 'barang.id', '=', 'koreksi.barang_id')
            ->whereBetween('koreksi.tgl_koreksi', [$from, $to])
            ->where('barang.id', $barang_id)
            ->select('koreksi.id as koreksi_id',
                    'koreksi.tgl_koreksi as tgl_koreksi',
                    'barang.nama_barang as barang',
                    'koreksi.jenis as jenis',
                    'koreksi.jumlah as jumlah',
                    )
            ->get();
        }

        foreach($data_koreksi as $i){
            $array[$count] = array(
                'tgl_transaksi' => $i->tgl_koreksi,
                'nomor' => '',
                'barang' => $i->barang,
                'jenis' => 'Koreksi',
                'jumlah_masuk' => $i->jenis == 'in' ? $i->jumlah : 0,
                'jumlah_keluar' => $i->jenis != 'in' ? $i->jumlah : 0);
                $count++;
        }

        foreach ($array as $key => $row) {
            $tanggal[$key]  = $row['tgl_transaksi'];
        }

        $tanggal  = array_column($array, 'tgl_transaksi');

        array_multisort($tanggal, SORT_ASC, $array);

        $header = 'Laporan Kartu Stok '.\Carbon\Carbon::createFromFormat('Y-m-d', $from)->format('d/m/Y')." s/d ".\Carbon\Carbon::createFromFormat('Y-m-d', $to)->format('d/m/Y');;
        return view('layouts.laporan.data_kartu_stok', ['data' => $array, 'header' => $header]);
    }

    public function title(): string
    {
        return 'Laporan Kartu Stok';
    }
}
