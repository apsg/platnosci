<?php
namespace App\Domains\Payments\Controllers\Admin;

use App\Domains\Payments\Events\ResendOrderMailingEvent;
use App\Domains\Payments\Models\Order;
use App\Http\Controllers\Controller;
use Barryvdh\Debugbar\Facades\Debugbar;
use Carbon\Carbon;

class OrdersController extends Controller
{
    public function index()
    {
        return view('admin.orders.index');
    }

    public function resend(Order $order)
    {
        event(new ResendOrderMailingEvent($order));

        return back();
    }

    public function pending()
    {
        return view('admin.orders.pending');
    }

    public function export(ExportRequest $request)
    {
        $orders = Order::forUser(auth()->user())
            ->whereNotNull('pesel')
            ->where('created_at', '>=', $request->input('date', Carbon::now()->subMonth()))
            ->with(['sale'])
            ->get();

        Debugbar::disable();

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="export.csv";');

        // open the "output" stream
        // see http://www.php.net/manual/en/wrappers.php.php#refsect2-wrappers.php-unknown-unknown-unknown-descriptioq
        $f = fopen('php://output', 'w');

        fputcsv($f, [
            'ID',
            'ID sprzedaży',
            'Nazwa sprzedaży',
            'Kwota',
            'Data zamówienia',
            'Data płatności',
            'Email',
            'Telefon',
            'Imię',
            'Nazwisko',
            'PESEL',
        ]);

        /** @var Order $order */
        foreach ($orders as $order) {
            fputcsv($f, [
                $order->id,
                $order->sale->id,
                $order->sale->name,
                $order->price,
                $order->created_at,
                $order->confirmed_at,
                $order->email,
                $order->phone,
                $order->firstname,
                $order->lastname,
                $order->pesel,
            ]);
        }
    }
}
