<?php

namespace App\Imports;

use App\Models\PurchaseTransactions;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PurchaseTransactionsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new PurchaseTransactions([
            'product_id'        => $row['product_id'],
            'supplier_id'       => $row['supplier_id'],
            'quantity'          => $row['quantity'],
            'total_price'       => $row['total_price'],
            'transactions_date' => $row['transactions_date'],
        ]);
    }
}
