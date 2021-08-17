<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryViewsTable extends Migration
{
    public function up()
    {
        Schema::create('history_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('apartment_id');
            $table->date('date_start');
            $table->date('date_end');
            $table->timestamp('created_at');


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('apartment_id')->references('id')->on('apartments');
        });
    }

    public function down()
    {
        Schema::dropIfExists('history_views');
    }
}
