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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->date('date');
            $table->integer('qty');
            $table->decimal('cost', 10, 2);
            $table->decimal('price', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->integer('qty_balance');
            $table->decimal('value_balance', 10, 2);
            $table->decimal('hpp', 10, 4);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
