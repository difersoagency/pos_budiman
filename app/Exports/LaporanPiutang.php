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

class LaporanPiutang implements FromView, ShouldAutoSize, WithStyles, WithEvents, WithTitle
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
        $data = DB::table('d_piutang')
                ->join('h_piutang', 'h_piutang.id', '=', 'd_piutang.h_piutang_id')
                ->join('htrans_jual', 'htrans_jual.id', '=', 'h_piutang.htrans_jual_id')
                ->join('booking', 'booking.id', '=', 'htrans_jual.booking_id')
                ->join('customer', 'customer.id', '=', 'booking.customer_id')
                ->join('pembayaran', 'pembayaran.id', '=', 'd_piutang.pembayaran_id')
                ->whereBetween('d_piutang.tgl_piutang', [$from, $to])
                ->select('htrans_jual.id as id_trans_jual',
                'htrans_jual.no_trans_jual as no_trans_jual',
                'customer.nama_customer as customer',
                'd_piutang.tgl_piutang as tgl_piutang',
                'pembayaran.nama_bayar as pembayaran',
                'd_piutang.no_giro as no_giro',
                'd_piutang.tgl_jatuh_tempo as tgl_jatuh_tempo',
                'd_piutang.total_bayar as total_bayar'
                )
                ->orderByRaw('htrans_jual.id ASC, d_piutang.tgl_piutang ASC')
                ->get();
        $currid = "";
        $count = 0;
        $c = 0;
        $cdata = 0;
        foreach($data as $key => $i){
            if($currid != $i->id_trans_jual){
                $currid = $i->id_trans_jual;
                $c = $count;
                $cdata = 0;
                $count++;
                $array[$c] = array(
                    'no_trans_jual' => $i->no_trans_jual,
                    'customer' => $i->customer,
                    'detail' => array());
                
            }
            $array[$c]['detail'][$cdata] = array(
            'tgl_bayar' => \Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_piutang)->format('d-m-Y'), 
            'pembayaran' => $i->pembayaran,
            'no_giro' => $i->no_giro,
            'tgl_jatuh_tempo' => $i->tgl_jatuh_tempo != NULL ? \Carbon\Carbon::createFromFormat('Y-m-d', $i->tgl_jatuh_tempo)->format('d-m-Y') : '-',
            'total_bayar' => $i->total_bayar);
            $cdata++;
        }
        $header = 'Laporan Piutang '.\Carbon\Carbon::createFromFormat('Y-m-d', $from)->format('d/m/Y')." s/d ".\Carbon\Carbon::createFromFormat('Y-m-d', $to)->format('d/m/Y');;
        return view('layouts.laporan.data_piutang', ['data' => $array, 'header' => $header]);
    }

    public function title(): string
    {
        return 'Laporan Piutang';
    }
}
