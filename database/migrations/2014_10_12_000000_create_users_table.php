<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname',255);
            $table->string('lastname', 255);
            $table->string('middlename', 255)->nullable();
            $table->string('email',100)->unique();
            $table->text('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->date('birthday');
            $table->string('password');
            $table->boolean('is_admin');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
