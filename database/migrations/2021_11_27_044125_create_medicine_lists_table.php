<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_lists', function (Blueprint $table) {
            $table->id();
            $table->string('manufacture_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('type_id')->nullable();
            $table->string('name');
            $table->string('quantity')->nullable();
            $table->text('price')->nullable();
            $table->text('expire_date')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('medicine_lists');
    }
}
