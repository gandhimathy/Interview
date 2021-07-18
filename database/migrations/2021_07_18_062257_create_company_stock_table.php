<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_stock', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->double('currentMarketPrice');
            $table->float('marketCap');
            $table->float('stockPE');
            $table->float('DividentYield');
            $table->float('ROCE');
            $table->float('ROEpreviousAnnual');
            $table->float('DebtToEquity');
            $table->float('EPS');
            $table->float('reserves');
            $table->float('Debt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_stock');
    }
}
