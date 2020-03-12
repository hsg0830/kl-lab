<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('references', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category');
            $table->string('title');
            $table->text('explanation');
            $table->integer('user_id')->unsigned()->index();
            $table->string('type_of_file');
            $table->string('name_of_file');
            $table->string('file_path');
            $table->integer('download_pounds')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('references');
    }
}
