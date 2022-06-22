<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('invoice_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('nip');
            $table->string('name');
            $table->string('address');
            $table->dateTime('accepted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoice_requests');
    }
};
