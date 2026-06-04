<?php
namespace App\Exports;

use App\Models\Category;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ItemsTemplateExport
{
    public function download()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $headers = ['name', 'category', 'serial_number', 'mac_address', 'stock_quantity', 'unit', 'location'];
        $colLetters = range('A', 'G');

        foreach ($headers as $i => $header) {
            $col = $colLetters[$i];
            $sheet->setCellValue($col . '1', $header);
            $sheet->getStyle($col . '1')->applyFromArray([
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '0E7490'],
                ],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => [
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CCCCCC']],
                ],
            ]);
        }

        // Example row with actual category from DB
        $exampleCategory = Category::first();
        $exampleData = [
            'ONT Example 1G', $exampleCategory?->name ?? 'GPON ONT', 'ONT-IMP-001', 'AA:BB:CC:DD:EE:01', '50', 'pcs', 'Gudang Utama',
        ];
        foreach ($exampleData as $i => $val) {
            $sheet->setCellValue($colLetters[$i] . '2', $val);
        }

        // Empty row for user data
        for ($i = 0; $i < 7; $i++) {
            $sheet->getStyle($colLetters[$i] . '2')->applyFromArray([
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CCCCCC']]],
            ]);
            $sheet->getColumnDimension($colLetters[$i])->setAutoSize(true);
        }

        // Freeze header
        $sheet->freezePane('A2');

        // Category list for reference
        $categoryNames = Category::pluck('name')->toArray();

        // Notes
        $sheet->setCellValue('A10', 'CATATAN PENGISIAN:');
        $sheet->getStyle('A10')->getFont()->setBold(true);
        $sheet->setCellValue('A11', '- name, category, serial_number, stock_quantity, unit WAJIB diisi.');
        $sheet->setCellValue('A12', '- category: isi dengan salah satu kategori di bawah ini:');
        $row = 13;
        foreach ($categoryNames as $name) {
            $sheet->setCellValue("A{$row}", "  * {$name}");
            $row++;
        }
        $sheet->setCellValue("A{$row}", '  Bisa juga diisi dengan slug (contoh: gpon-ont, switch).');
        $row++;
        $sheet->setCellValue("A{$row}", '- unit: isi dengan Pcs, Roll, Meter, atau Set.');
        $row++;
        $sheet->setCellValue("A{$row}", '- mac_address dan location boleh dikosongkan.');
        $row++;
        $sheet->setCellValue("A{$row}", '- Hapus baris contoh (baris 2) sebelum import data anda.');

        $writer = new Xlsx($spreadsheet);
        $filename = 'items-import-template.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename={$filename}");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
