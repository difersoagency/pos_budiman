<?php

namespace App\Exports;
use App\Models\TransJual;
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

class LaporanPenjualan implements FromView, ShouldAutoSize, WithStyles, WithEvents, WithTitle
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
        $sheet->getStyle('A2:L2')->getFont()->setBold(true);
        $sheet->getStyle('A:L')->getAlignment()
        ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        $sheet->getStyle('A:L')->getAlignment()
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
                $cellRange = 'A2:L'.$event->sheet->getHighestRow();
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
        $data = TransJual::with('Booking.Customer', 'Piutang')->addSelect(['count_piutang' => function ($q) {
            $q->selectRaw('coalesce(SUM(total_bayar),0)')
            ->from('d_piutang')
            ->join('h_piutang', 'd_piutang.h_piutang_id', '=', 'h_piutang.id')
            ->whereColumn('h_piutang.htrans_jual_id', 'htrans_jual.id');
        }])->whereBetween('tgl_trans_jual', [$from, $to])
        ->get();
        
        foreach($data as $key => $i){
            $array[$key] = array(['tgl_trans_jual' => \Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_trans_jual)->format('d-m-Y'), 
            'no_trans_jual' => $i->no_trans_jual,
            'tgl_max_garansi' => \Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_max_garansi)->format('d-m-Y'), 
            'customer' => $i->Booking->Customer->nama_customer,
            'pembayaran' => $i->Pembayaran->nama_bayar,
            'no_giro' => $i->no_giro,
            'tgl_jatuh_tempo' => $i->tgl_jatuh_tempo != NULL ? \Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_jatuh_tempo)->format('d-m-Y') : '',
            'bayar_jual' => ($i->bayar_jual - $i->kembali_jual),
            'piutang_lunas' => $i->Piutang != NULL ? $i->count_piutang : "0",
            'sisa_piutang' => $i->Piutang != NULL ? ($i->total_jual -($i->count_piutang + $i->bayar_jual)) : "0",
            'total_jual' => $i->total_jual]);
        }
        $header = 'Laporan Penjualan '.\Carbon\Carbon::createFromFormat('Y-m-d', $from)->format('d/m/Y')." s/d ".\Carbon\Carbon::createFromFormat('Y-m-d', $to)->format('d/m/Y');;
        return view('layouts.laporan.data_penjualan', ['data' => $array, 'header' => $header]);
    }

    public function title(): string
    {
        return 'Laporan Penjualan';
    }
}
