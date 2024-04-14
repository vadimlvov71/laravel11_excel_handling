<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\StockStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->string('name');
            $table->text('description');
            $table->string('model_code');
            $table->string('guarantee');
            $table->string('price');
            $table->set('status', [StockStatus::in_stock->name, StockStatus::out_of_stock->name])
                ->default(StockStatus::out_of_stock->name);
            $table->foreignId('manufacturer_id')->index();
            //$table->foreignId('rubrics_id')->index();
            $table->foreignId('sub_rubrics_id')->index();
            $table->foreignId('goods_categories_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods');
    }
};
