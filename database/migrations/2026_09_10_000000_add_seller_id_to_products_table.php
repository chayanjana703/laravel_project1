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
        if (!Schema::hasColumn('products', 'seller_id')) {
            Schema::table('products', function (Blueprint $table) {
                $table->unsignedBigInteger('seller_id')->default(1)->after('id')->index();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('products', 'seller_id')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('seller_id');
            });
        }
    }
};
