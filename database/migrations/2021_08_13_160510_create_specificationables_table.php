<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecificationablesTable extends Migration
{
    public function up()
    {
        Schema::create('specificationables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('specification_id');
            $table->unsignedBigInteger('specificationable_id');
            $table->string('specificationable_type');
            $table->string('value');
        });
    }

    public function down()
    {
        Schema::dropIfExists('specificationables');
    }
}
