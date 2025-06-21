<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Product Name',
            'Description',
            'Price (Rp)',
            'Stock',
            'Created At',
            'Updated At'
        ];
    }

    /**
     * @param mixed $product
     * @return array
     */
    public function map($product): array
    {
        return [
            $product->id,
            $product->name_product,
            $product->desc_product,
            'Rp ' . number_format($product->harga_product, 2, ',', '.'),
            $product->stock_product,
            $product->created_at->format('d/m/Y H:i:s'),
            $product->updated_at->format('d/m/Y H:i:s')
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
        ];
    }
}
