<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediumUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medium_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign(['user_id'])
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->bigInteger('medium_id')->unsigned();
            $table->foreign(['medium_id'])
                ->references('id')->on('media')
                ->onDelete('cascade');
            $table->string('handle', 255);
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
        Schema::dropIfExists('medium_user');
    }
}
