<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpForGetSuggestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS getSuggestion');
        DB::unprepared("CREATE PROCEDURE getSuggestion(
            IN Keyword VARCHAR(50)
            )
        BEGIN
        SELECT DISTINCT id ,name from company_stock
        WHERE 1=1
            AND(keyword IS NULL OR (company_stock.name LIKE concat(keyword COLLATE utf8mb4_unicode_ci,'%')))  
            group by company_stock.id;
        END"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS getSuggestion');
    }
}
