<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('purchase_transactions', function (Blueprint $table) {
            $table->date('transactions_date')->nullable()->after('total_price'); // Menambahkan kolom transactions_date
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchase_transactions', function (Blueprint $table) {
            $table->dropColumn('transactions_date'); // Menghapus kolom transactions_date
        });
    }
};

