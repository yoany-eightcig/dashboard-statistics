<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name")->nullable();
            $table->date('day');

            $table->integer('picks')->nullable();
            $table->integer('pick_lines')->nullable();
            $table->integer('pick_lines_qty')->nullable();

            $table->integer('packs')->nullable();
            $table->integer('pack_lines')->nullable();
            $table->integer('pack_lines_qty')->nullable();

            $table->enum('group', ['retail', 'wholesale']);

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
        Schema::dropIfExists('employees');
    }
}
