<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogAbsensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_absens', function (Blueprint $table) {
            $table->id();
            $table->string('passing_id');
            $table->string('username');
            $table->string('category_activity');
            $table->text('title');
            $table->dateTime('start_date');
            $table->decimal('longitude', 10, 7);
            $table->decimal('latitude', 10, 7);
            $table->string('photonya');
            // $table->dateTime('end_date'); // with dummu prediction end (+8 jam dari start date)
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
        Schema::dropIfExists('log_absens');
    }
}
