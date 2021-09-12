<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(0);
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('city_id');
            $table->string('name');
            $table->string('slug');
            $table->string('phone');
            $table->string('email');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('address');
            $table->unsignedSmallInteger('discount')->default(0);
            $table->string('main_image');

            $table->softDeletes();

            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->onDelete('cascade');

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotels');
    }
}
