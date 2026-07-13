<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->index('category_id');
            $table->index('status');
            $table->index('price');
            $table->index('stock');
            $table->index('created_at');
            $table->index(['category_id', 'status']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('status');
            $table->index(['user_id', 'status']);
            $table->index('created_at');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->index('order_id');
            $table->index('product_id');
            $table->index(['order_id', 'product_id']);
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->index('product_id');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['category_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['price']);
            $table->dropIndex(['stock']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['category_id', 'status']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['user_id', 'status']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropIndex(['order_id']);
            $table->dropIndex(['product_id']);
            $table->dropIndex(['order_id', 'product_id']);
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropIndex(['product_id']);
        });
    }
};
