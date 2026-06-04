<?php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;

class ExportController extends Controller
{
    public function itemsXlsx()
    {
        $items = Item::with('category', 'supplier')->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Items');

        $headers = ['No', 'Name', 'Category', 'Serial Number', 'MAC Address', 'Stock', 'Unit', 'Location', 'Supplier', 'Created At'];
        $colLetters = range('A', 'J');

        // Header style
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0E7490']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CCCCCC']]],
        ];

        foreach ($headers as $i => $header) {
            $col = $colLetters[$i];
            $sheet->setCellValue($col . '1', $header);
            $sheet->getStyle($col . '1')->applyFromArray($headerStyle);
        }

        // Data rows
        $rowNum = 2;
        foreach ($items as $index => $item) {
            $sheet->setCellValue('A' . $rowNum, $index + 1);
            $sheet->setCellValue('B' . $rowNum, $item->name);
            $sheet->setCellValue('C' . $rowNum, $item->category?->name ?? '');
            $sheet->setCellValue('D' . $rowNum, $item->serial_number);
            $sheet->setCellValue('E' . $rowNum, $item->mac_address ?? '');
            $sheet->setCellValue('F' . $rowNum, $item->stock_quantity);
            $sheet->setCellValue('G' . $rowNum, $item->unit);
            $sheet->setCellValue('H' . $rowNum, $item->location ?? '');
            $sheet->setCellValue('I' . $rowNum, $item->supplier?->name ?? '');
            $sheet->setCellValue('J' . $rowNum, $item->created_at->format('Y-m-d'));

            // Center alignment for No, Stock
            $sheet->getStyle('A' . $rowNum)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('F' . $rowNum)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            // Data borders
            foreach ($colLetters as $col) {
                $sheet->getStyle($col . $rowNum)->getBorders()->applyFromArray([
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'DDDDDD']],
                ]);
            }

            $rowNum++;
        }

        // Auto width columns
        $colWidths = [5, 35, 20, 22, 18, 8, 8, 18, 20, 14];
        foreach ($colLetters as $i => $col) {
            $sheet->getColumnDimension($col)->setWidth($colWidths[$i]);
        }

        // Freeze header
        $sheet->freezePane('A2');

        $filename = 'items-' . now()->format('Y-m-d-His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename={$filename}");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function transactionsXlsx()
    {
        $transactions = Transaction::with('item')->latest()->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Transactions');

        $headers = ['No', 'Item', 'Type', 'Quantity', 'Technician', 'Purpose', 'Date'];
        $colLetters = range('A', 'G');

        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0E7490']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CCCCCC']]],
        ];

        foreach ($headers as $i => $header) {
            $col = $colLetters[$i];
            $sheet->setCellValue($col . '1', $header);
            $sheet->getStyle($col . '1')->applyFromArray($headerStyle);
        }

        $rowNum = 2;
        foreach ($transactions as $index => $tx) {
            $sheet->setCellValue('A' . $rowNum, $index + 1);
            $sheet->setCellValue('B' . $rowNum, $tx->item?->name ?? '');
            $sheet->setCellValue('C' . $rowNum, ucfirst($tx->transaction_type));
            $sheet->setCellValue('D' . $rowNum, $tx->quantity);
            $sheet->setCellValue('E' . $rowNum, $tx->technician_name);
            $sheet->setCellValue('F' . $rowNum, $tx->purpose ?? '');
            $sheet->setCellValue('G' . $rowNum, $tx->transaction_date->format('Y-m-d H:i'));

            $sheet->getStyle('A' . $rowNum)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('D' . $rowNum)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            foreach ($colLetters as $col) {
                $sheet->getStyle($col . $rowNum)->getBorders()->applyFromArray([
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'DDDDDD']],
                ]);
            }

            $rowNum++;
        }

        $colWidths = [5, 35, 10, 10, 20, 30, 18];
        foreach ($colLetters as $i => $col) {
            $sheet->getColumnDimension($col)->setWidth($colWidths[$i]);
        }

        $sheet->freezePane('A2');

        $filename = 'transactions-' . now()->format('Y-m-d-His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename={$filename}");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
