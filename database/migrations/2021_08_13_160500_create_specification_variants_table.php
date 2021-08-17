<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecificationVariantsTable extends Migration
{
    public function up()
    {
        Schema::create('specification_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('specification_id');
            $table->string('variant');

            $table->foreign('specification_id')
                ->references('id')
                ->on('specifications')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('specification_variants');
    }
}
