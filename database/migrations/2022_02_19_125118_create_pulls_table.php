<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePullsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pulls', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->integer('amount')->nullable()->unsigned();
            $table->integer('deposit_id')->unsigned();
            $table->timestamp('date');
            $table->string('type')->default('pulls');
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
        Schema::dropIfExists('pulls');
    }
}
