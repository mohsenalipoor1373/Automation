<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->string('location');
            $table->string('from');
            $table->string('to');
            $table->string('fromtime')->nullable();
            $table->string('totime')->nullable();
            $table->longText('summary')->nullable();
            $table->longText('description')->nullable();
            $table->string('Admin')->nullable();
            $table->string('Supervisor')->nullable();
            $table->string('Archive')->nullable();
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('user_id')->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions');
    }
}
