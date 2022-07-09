<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('invoice_requests', function (Blueprint $table) {
            $table->string('external_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('invoice_requests', function (Blueprint $table) {
            $table->dropColumn('external_id');
        });
    }
};
