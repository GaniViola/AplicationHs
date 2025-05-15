<?php

namespace App\Exports;

use App\Models\Setoran;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class PendapatanExport implements FromCollection, WithHeadings, WithTitle, WithMapping, ShouldAutoSize, WithStyles, WithCustomStartCell, WithEvents
{
    protected $startDate;
    protected $endDate;
    protected $rowCount;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $setorans = Setoran::with(['order.customer', 'worker'])
            ->whereBetween('tanggal_setoran', [$this->startDate, $this->endDate])
            ->orderBy('tanggal_setoran', 'desc')
            ->get();
            
        $this->rowCount = $setorans->count() + 8; // Rows for data + header row + summary rows
        
        return $setorans;
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal Setoran',
            'Order ID',
            'Customer',
            'Pekerja',
            'Jumlah Setoran (Rp)',
            'Untuk Admin (Rp)',
        ];
    }

    public function map($setoran): array
    {
        static $no = 0;
        $no++;
        
        return [
            $no,
            Carbon::parse($setoran->tanggal_setoran)->format('d-m-Y'),
            $setoran->order_id,
            $setoran->order->customer->username ?? '-',
            $setoran->worker->username ?? '-',
            number_format($setoran->jumlah_setoran, 0, ',', '.'),
            number_format($setoran->jumlah_admin, 0, ',', '.'),
        ];
    }

    public function title(): string
    {
        return 'Laporan Pendapatan Admin';
    }

    public function startCell(): string
    {
        return 'A8';
    }

    public function styles(Worksheet $sheet)
    {
        // Get summary data for headers
        $pendapatan = DB::table('setorans')
            ->select(
                DB::raw('COUNT(*) as total_transaksi'),
                DB::raw('SUM(jumlah_admin) as total_pendapatan'),
                DB::raw('MAX(tanggal_setoran) as terakhir_setoran')
            )
            ->whereBetween('tanggal_setoran', [$this->startDate, $this->endDate])
            ->first();

        // Add title and date info
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'LAPORAN PENDAPATAN ADMIN');
        $sheet->mergeCells('A2:G2');
        $sheet->setCellValue('A2', 'Periode: ' . Carbon::parse($this->startDate)->format('d-m-Y') . ' sampai ' . Carbon::parse($this->endDate)->format('d-m-Y'));
        $sheet->mergeCells('A3:G3');
        $sheet->setCellValue('A3', 'Diekspor pada: ' . Carbon::now()->format('d-m-Y H:i:s'));

        // Add summary section
        $sheet->mergeCells('A5:C5');
        $sheet->setCellValue('A5', 'Total Pendapatan Admin:');
        $sheet->setCellValue('D5', 'Rp ' . number_format($pendapatan->total_pendapatan, 0, ',', '.'));
        
        $sheet->mergeCells('A6:C6');
        $sheet->setCellValue('A6', 'Total Transaksi:');
        $sheet->setCellValue('D6', $pendapatan->total_transaksi);
        
        $lastSetoranDate = $pendapatan->terakhir_setoran ? Carbon::parse($pendapatan->terakhir_setoran)->format('d-m-Y H:i') : '-';
        $sheet->mergeCells('A7:C7');
        $sheet->setCellValue('A7', 'Setoran Terakhir:');
        $sheet->setCellValue('D7', $lastSetoranDate);

        return [
            1 => ['font' => ['bold' => true, 'size' => 16], 'alignment' => ['horizontal' => 'center']],
            2 => ['alignment' => ['horizontal' => 'center']],
            3 => ['alignment' => ['horizontal' => 'center']],
            5 => ['font' => ['bold' => true]],
            6 => ['font' => ['bold' => true]],
            7 => ['font' => ['bold' => true]],
            8 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center'], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'E9ECEF']]],
            'A' => ['alignment' => ['horizontal' => 'center']],
            'B' => ['alignment' => ['horizontal' => 'center']],
            'C' => ['alignment' => ['horizontal' => 'center']],
            'F' => ['alignment' => ['horizontal' => 'right']],
            'G' => ['alignment' => ['horizontal' => 'right'], 'font' => ['color' => ['rgb' => '28A745']]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A8:G' . $this->rowCount)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                
                // Add bold formatting for summary footer row
                if ($this->rowCount > 9) { // Only if there's data
                    $lastRow = $this->rowCount;
                    $event->sheet->mergeCells('A' . $lastRow . ':E' . $lastRow);
                    $event->sheet->setCellValue('A' . $lastRow, 'TOTAL');
                    $event->sheet->getStyle('A' . $lastRow . ':G' . $lastRow)->getFont()->setBold(true);
                    $event->sheet->getStyle('A' . $lastRow . ':G' . $lastRow)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setRGB('F8F9FA');
                }
            },
        ];
    }
}