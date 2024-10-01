<?php

namespace App\Exports;

use App\Models\PurchaseTransactions;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Carbon\Carbon;

class PurchaseTransactionsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return PurchaseTransactions::with('product', 'supplier')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Product Name',
            'Supplier Name',
            'Quantity',
            'Total Price',
            'Transactions Date',
        ];
    }

    /**
     * @param mixed $purchaseTransaction
     *
     * @return array
     */
    public function map($purchaseTransaction): array
    {
        return [
            $purchaseTransaction->product->product_name,
            $purchaseTransaction->supplier->name,
            $purchaseTransaction->quantity,
            'Rp '. number_format($purchaseTransaction->total_price, 0, ',', '.'), // Format as Rupiah with no decimals
            Carbon::parse($purchaseTransaction->transactions_date)->format('d/m/Y'), // Parse and format the date
        ];
    }

    /**
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:E1')->getFont()->setBold(true); // Bold header row
        $sheet->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A1:E1')->getFill()->getStartColor()->setARGB('ff34eda0'); // Set green color
        $sheet->getStyle('D:D')->getNumberFormat()->setFormatCode('_(* #,##0_);_(* (#,##0);_(* "-"_);_(@_)'); // Format Total Price column as currency
        $sheet->getStyle('A1:E'. $sheet->getHighestRow())->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN); // Add borders to all cells
        $sheet->getColumnDimension('A')->setWidth(20); // Set column width for Product Name
        $sheet->getColumnDimension('B')->setWidth(25); // Set column width for Supplier Name
        $sheet->getColumnDimension('C')->setWidth(15); // Set column width for Quantity
        $sheet->getColumnDimension('D')->setWidth(20); // Set column width for Total Price
        $sheet->getColumnDimension('E')->setWidth(20); // Set column width for Transactions Date
    }
}
