<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->string('url_asli')->unique();
            $table->string('url')->nullable();
            $table->string('title')->nullable();
            $table->string('head')->nullable();
            $table->string('css')->nullable();
            $table->string('script')->nullable();
            $table->string('iklan')->nullable();
            $table->string('crawel_status')->default(0);
            $table->string('status_generate')->default(0);
            $table->string('status')->default(1);
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
        Schema::dropIfExists('links');
    }
}
