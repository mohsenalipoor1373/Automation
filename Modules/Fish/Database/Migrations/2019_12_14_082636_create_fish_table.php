<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFishTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fish', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('number')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('mesh')->nullable();
            $table->string('yarn')->nullable();
            $table->string('lead')->nullable();
            $table->string('ropeone')->nullable();
            $table->string('ropetwo')->nullable();
            $table->string('booy')->nullable();
            $table->string('strands')->nullable();
            $table->string('ring')->nullable();
            $table->string('description')->nullable();
            $table->string('fina')->nullable();
            $table->string('off')->nullable();
            $table->string('final')->nullable();
            $table->string('date')->nullable();
            $table->string('buy')->nullable();
            $table->string('Archive')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('fish');
    }
}
