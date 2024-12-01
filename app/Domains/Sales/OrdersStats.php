<?php
namespace App\Domains\Sales;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersStats
{
    const SQL_TOTAL = <<<SQL
select count(*) as c, SUM(o.price) as sum from orders o
left join sales s on o.sale_id = s.id
where o.confirmed_at >= ? and o.confirmed_at <= ?
and s.user_id = ?
SQL;

    const SQL_GROUPED = <<<SQL
select s.name, count(*) as c, SUM(o.price) as sum from orders o
left join sales s on o.sale_id = s.id
where o.confirmed_at >= ? and o.confirmed_at <= ?
and s.user_id = ?
group by o.sale_id
SQL;

    protected Carbon $from;
    protected Carbon $to;

    public function __construct(Carbon $from, Carbon $to)
    {

        $this->from = $from;
        $this->to = $to;
    }

    public static function today(): self
    {
        return new self(Carbon::now()->startOfDay(), Carbon::now()->endOfDay());
    }

    public static function thisWeek(): self
    {
        return new self(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek());
    }

    public static function thisMonth(): self
    {
        return new self(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
    }

    public static function lastNDays(int $days): self
    {
        return new self(Carbon::now()->subDays($days), Carbon::now()->endOfDay());
    }

    public static function forDay(Carbon $date): self
    {
        return new self($date->startOfDay(), $date->endOfDay());
    }

    public function generate()
    {
        $total = $this->getTotal();
        $grouped = $this->getGrouped();

        return compact('total', 'grouped');
    }

    public function getTotal()
    {
        return DB::select(DB::raw(self::SQL_TOTAL), [$this->from, $this->to, Auth::user()->id])[0];
    }

    public function getGrouped()
    {
        return DB::select(DB::raw(self::SQL_GROUPED), [$this->from, $this->to, Auth::user()->id]);
    }
}
