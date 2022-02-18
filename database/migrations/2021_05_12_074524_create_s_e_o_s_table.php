<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSEOSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_e_o_s', function (Blueprint $table) {
            $table->id();
            $table->longText('site_name')->nullable();
            $table->longText('description')->nullable();
            $table->longText('type')->nullable();
            $table->longText('head')->nullable();
            $table->longText('iklan')->nullable();
            $table->longText('script')->nullable();
            $table->longText('css')->nullable();
            $table->longText('iklan_popup')->nullable();
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
        Schema::dropIfExists('s_e_o_s');
    }
}
