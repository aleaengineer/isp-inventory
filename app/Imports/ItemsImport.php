<?php
namespace App\Imports;

use App\Models\Item;
use App\Models\Category;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;

class ItemsImport
{
    public function import(string $filePath): array
    {
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        if (empty($rows) || count($rows) < 2) {
            return ['success' => false, 'message' => 'File kosong atau tidak memiliki data.'];
        }

        $header = array_shift($rows);
        $header = array_map('trim', $header);
        $expected = ['name', 'category', 'serial_number', 'mac_address', 'stock_quantity', 'unit', 'location'];

        $headerIndex = array_flip($header);
        foreach ($expected as $col) {
            if (!isset($headerIndex[$col])) {
                return ['success' => false, 'message' => "Kolom '{$col}' tidak ditemukan di file."];
            }
        }

        $imported = 0;
        $errors = [];

        foreach ($rows as $index => $row) {
            $rowIndex = $index + 2;
            $data = [
                'name'           => trim($row[$headerIndex['name']] ?? ''),
                'category'       => trim($row[$headerIndex['category']] ?? ''),
                'serial_number'  => trim($row[$headerIndex['serial_number']] ?? ''),
                'mac_address'    => trim($row[$headerIndex['mac_address']] ?? ''),
                'stock_quantity' => trim($row[$headerIndex['stock_quantity']] ?? '0'),
                'unit'           => trim($row[$headerIndex['unit']] ?? 'pcs'),
                'location'       => trim($row[$headerIndex['location']] ?? ''),
            ];

            if (empty($data['name']) && empty($data['serial_number'])) {
                continue;
            }

            $category = Category::where('name', $data['category'])->orWhere('slug', $data['category'])->first();
            if (!$category) {
                $errors[] = "Baris {$rowIndex}: Kategori '{$data['category']}' tidak ditemukan.";
                continue;
            }

            $validator = Validator::make($data, [
                'name'           => 'required|string|max:255',
                'serial_number'  => 'required|string|unique:items,serial_number',
                'mac_address'    => 'nullable|string|max:17',
                'stock_quantity' => 'required|integer|min:0',
                'unit'           => 'required|string|max:20',
                'location'       => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                $errors[] = "Baris {$rowIndex}: " . implode(', ', $validator->errors()->all());
                continue;
            }

            Item::create([
                'category_id'    => $category->id,
                'name'           => $data['name'],
                'serial_number'  => $data['serial_number'],
                'mac_address'    => $data['mac_address'] ?: null,
                'stock_quantity' => (int) $data['stock_quantity'],
                'unit'           => $data['unit'],
                'location'       => $data['location'] ?: null,
            ]);

            $imported++;
        }

        $message = "Berhasil mengimport {$imported} item.";
        if (!empty($errors)) {
            $message .= ' ' . count($errors) . ' baris gagal.';
        }

        return [
            'success' => true,
            'message' => $message,
            'imported' => $imported,
            'errors' => $errors,
        ];
    }
}
