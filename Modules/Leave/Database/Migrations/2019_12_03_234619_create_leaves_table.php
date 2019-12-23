<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('from')->nullable();
            $table->string('todate')->nullable();
            $table->string('FromHour')->nullable();
            $table->string('until')->nullable();
            $table->string('Type');
            $table->string('history')->nullable();
            $table->string('Priority');
            $table->text('description')->nullable();
            $table->string('Archive')->nullable();
            $table->string('Supervisor')->nullable();
            $table->string('Admin')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')
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
        Schema::dropIfExists('leaves');
    }
}
