<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('place_birth');
            $table->date('date_birth');
            $table->integer('age');
            $table->string('type_identity');
            $table->string('no_identity');
            $table->string('no_npwp');
            $table->string('no_tlp');
            $table->string('religion');
            $table->string('status_marital');
            $table->text('address');
            $table->string('photo_profile');
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
        Schema::dropIfExists('user_details');
    }
}
