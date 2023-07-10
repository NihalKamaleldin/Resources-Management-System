<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  
    public function up()
    {
        DB::statement('ALTER TABLE suppliers CHANGE COLUMN `store name` store_name VARCHAR(255)');
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE suppliers CHANGE COLUMN store_name `store name` VARCHAR(255)');
    }
};
