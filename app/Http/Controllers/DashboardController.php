<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $leads = auth()->user()->isAdmin()
            ? Lead::query()
            : Lead::where('user_id', auth()->id());

        $total = (clone $leads)->count();
        $new = (clone $leads)->where('status', 'new')->count();
        $contacted = (clone $leads)->where('status', 'contacted')->count();
        $converted = (clone $leads)->where('status', 'converted')->count();

        $monthExpression = DB::connection()->getDriverName() === 'sqlite'
            ? "CAST(strftime('%m', created_at) AS INTEGER)"
            : 'MONTH(created_at)';

        $data = (clone $leads)->select(
            DB::raw($monthExpression . ' as month'),
            DB::raw('count(*) as count')
        )
        ->groupBy('month')
        ->pluck('count','month');

        $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $counts = array_fill(1, 12, 0);

        foreach ($data as $month => $count) {
            $month = (int) $month;

            if ($month >= 1 && $month <= 12) {
                $counts[$month] = (int) $count;
            }
        }

        return view('dashboard', [
            'total' => $total,
            'new' => $new,
            'contacted' => $contacted,
            'converted' => $converted,
            'months' => $months,
            'counts' => array_values($counts),
            'recentLeads' => (clone $leads)->latest()->take(6)->get(),
        ]);
    }
}