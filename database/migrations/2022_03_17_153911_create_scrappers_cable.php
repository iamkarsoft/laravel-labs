<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateScrappersCable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scrapers', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('reference');
            $table->string('country_of_origin')->nullable();
            $table->string('name');
            $table->string('price');
            $table->string('acv')->nullable();
            $table->string('market')->nullable();
            $table->string('source')->nullable();
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
        Schema::dropIfExists('scrapers');
    }
}
