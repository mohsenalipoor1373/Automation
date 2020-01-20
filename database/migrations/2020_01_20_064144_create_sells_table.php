<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code');
            $table->timestamps();
        });

        Schema::create('sell_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sell_id');
            $table->string('code_calla');
            $table->string('name_calla');
            $table->string('tedad_calla');
            $table->string('f_calla');
            $table->string('price_calla');
            $table->string('t_calla');
            $table->string('mfinal_calla');
            $table->string('dec_calla');
            $table->timestamps();
            $table->foreign('sell_id')
                ->references('id')
                ->on('sells')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sells');
    }
}
