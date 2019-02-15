<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubAdministratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_administrators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('user_name')->nullable();
            $table->text('email')->nullable();
            $table->text('password')->nullable();
            $table->text('profile_image')->nullable();
            $table->text('phone')->nullable();
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
        Schema::dropIfExists('sub_administrators');
    }
}
