<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecificationsTable extends Migration
{
    public function up()
    {
        Schema::create('specifications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedSmallInteger('type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('specifications');
    }
}
