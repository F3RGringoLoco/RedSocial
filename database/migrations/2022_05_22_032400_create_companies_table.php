<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('com_id');
            $table->string('com_name');
            $table->string('society');
            $table->string('sector');
            $table->string('property');
            $table->string('location');
            $table->string('description');
            $table->boolean('status')->default(false);
            $table->string('bg_image')->nullable();
            $table->string('com_image')->nullable();
            $table->unsignedBigInteger('owner_id');
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
        Schema::dropIfExists('companies');
    }
}
