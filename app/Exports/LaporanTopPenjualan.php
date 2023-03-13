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

class LaporanTopPenjualan implements FromView, ShouldAutoSize, WithStyles, WithEvents, WithTitle
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
        $sheet->getStyle('A2:D2')->getFont()->setBold(true);
        $sheet->getStyle('A:D')->getAlignment()
        ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        $sheet->getStyle('A:D')->getAlignment()
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
                $cellRange = 'A2:D'.$event->sheet->getHighestRow();
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
        $data = DB::table('dtrans_jual')
                ->join('htrans_jual', 'htrans_jual.id', '=', 'dtrans_jual.htrans_jual_id')
                ->join('barang', 'barang.id', '=', 'dtrans_jual.barang_id')
                ->join('merek', 'merek.id', '=', 'barang.merek_id')
                ->join('satuan', 'satuan.id', '=', 'barang.satuan_id')
                ->whereBetween('htrans_jual.tgl_trans_jual', [$from, $to])
                ->selectRaw('barang.id as barang_id,
                barang.kode_barang as kode_barang,
                barang.nama_barang as nama_barang,
                SUM(dtrans_jual.jumlah) as jumlah'
                )
                ->orderByRaw('SUM(dtrans_jual.jumlah) DESC')
                ->groupByRaw('barang.id, barang.kode_barang, barang.nama_barang')
                ->get();
        foreach($data as $key => $i){
            $array[$key] = array(
            'kode' => $i->kode_barang,
            'nama' => $i->nama_barang,
            'jumlah' => $i->jumlah);
        }
        $header = 'Laporan Top Penjualan '.\Carbon\Carbon::createFromFormat('Y-m-d', $from)->format('d/m/Y')." s/d ".\Carbon\Carbon::createFromFormat('Y-m-d', $to)->format('d/m/Y');;
        return view('layouts.laporan.data_top_penjualan', ['data' => $array, 'header' => $header]);
    }

    public function title(): string
    {
        return 'Laporan Top Penjualan';
    }
}
