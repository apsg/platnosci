<?php

use App\Domains\Payments\Models\InvoiceRequest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('invoice_requests', function (Blueprint $table) {
            $table->date('date')->nullable();
        });

        foreach (InvoiceRequest::all() as $invoiceRequest) {
            $invoiceRequest->update(['date' => $invoiceRequest->order->created_at]);
        }
    }

    public function down()
    {
        Schema::table('invoice_requests', function (Blueprint $table) {
            $table->dropColumn('date');
        });
    }
};
