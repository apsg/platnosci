<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {

            $table->increments('id');
            $table->string('hash')->unique();
            $table->string('name');
            $table->text('description');
            $table->string('rules_url')->nullable();
            $table->double('price', 6,2);
            $table->double('full_price', 6,2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
