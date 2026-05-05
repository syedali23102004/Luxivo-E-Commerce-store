<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_name')->after('user_id');
            $table->string('customer_email')->after('customer_name');
            $table->string('customer_phone')->after('customer_email');
            $table->string('city')->after('shipping_address');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['customer_name', 'customer_email', 'customer_phone', 'city']);
        });
    }
};