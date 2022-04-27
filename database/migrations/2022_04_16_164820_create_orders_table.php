<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id');
            $table->string('hash')->unique();
            $table->string('email');
            $table->string('phone')->nullable();

            $table->unsignedInteger('sale_id');
            $table->foreign('sale_id')
                ->references('id')
                ->on('sales')
                ->restrictOnDelete();

            $table->unsignedFloat('price');
            $table->string('external_id')->nullable();
            $table->timestamp('confirmed_at')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
