<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('full_name')->after('user_id');
            $table->string('city', 100)->after('shipping_address');
            $table->text('notes')->nullable()->after('phone');
            $table->string('order_number', 20)->unique()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['full_name', 'city', 'notes', 'order_number']);
        });
    }
};
