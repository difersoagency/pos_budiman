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

class LaporanReturBeli implements FromView, ShouldAutoSize, WithStyles, WithEvents, WithTitle
{
    public function tgl_awal()
    {
        return $this->tgl_awal;
    }
    public function tgl_akhir()
    {
        return $this->tgl_akhir;
    }

    public function __construct(string $tgl_awal, string $tgl_akhir)
    {
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
        $sheet->getStyle('A2:H2')->getFont()->setBold(true);
        $sheet->getStyle('A:H')->getAlignment()
        ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        $sheet->getStyle('A:H')->getAlignment()
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
                $cellRange = 'A2:H'.$event->sheet->getHighestRow();
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
        $array = array();
        $count = 0;
        $data = DB::table('dretur_beli')
                ->join('hretur_beli', 'hretur_beli.id', '=', 'dretur_beli.hretur_beli_id')
                ->join('htrans_beli', 'htrans_beli.id', '=', 'hretur_beli.htrans_beli_id')
                ->join('supplier', 'supplier.id', '=', 'htrans_beli.supplier_id')
                ->join('barang', 'barang.id', '=', 'dretur_beli.barang_id')
                ->whereBetween('hretur_beli.tgl_retur_beli', [$from, $to])
                ->select('htrans_beli.id as id_trans_beli',
                'hretur_beli.id as id_retur_beli',
                'htrans_beli.nomor_po as nomor_po',
                'supplier.nama_supplier as supplier',
                'hretur_beli.tgl_retur_beli as tgl_retur_beli',
                'barang.nama_barang as barang',
                'dretur_beli.jumlah as jumlah',
                'dretur_beli.harga as harga'
                )
                ->orderByRaw('hretur_beli.id ASC, htrans_beli.id ASC')
                ->get();
        $currid = "";
        $count = 0;
        $c = 0;
        $cdata = 0;
        foreach($data as $key => $i){
            if($currid != $i->id_retur_beli){
                $currid = $i->id_retur_beli;
                $c = $count;
                $cdata = 0;
                $count++;
                $array[$c] = array(
                    'no_po' => $i->nomor_po,
                    'supplier' => $i->supplier,
                    'tgl_retur_beli' => \Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_retur_beli)->format('d-m-Y'),
                    'detail' => array());
                
            }
            $array[$c]['detail'][$cdata] = array(
            'barang' => $i->barang,
            'jumlah' => $i->jumlah,
            'harga' => $i->harga,
            'total' => $i->jumlah * $i->harga);
            $cdata++;
        }
        $header = 'Laporan Retur Beli '.\Carbon\Carbon::createFromFormat('Y-m-d', $from)->format('d/m/Y')." s/d ".\Carbon\Carbon::createFromFormat('Y-m-d', $to)->format('d/m/Y');;
        return view('layouts.laporan.data_retur_beli', ['data' => $array, 'header' => $header]);
    }

    public function title(): string
    {
        return 'Laporan Retur Beli';
    }
}
