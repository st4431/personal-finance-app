<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Balance;

class BalanceSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $year = (int) $request->input('year', now()->year);
        $month = (int) $request->input('month', now()->month);
        $balances = Balance::where('year', $year)
            ->where('month', $month)
            ->whereHas('account', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->get();

        return view('balance-sheets.index', [
            'balances' => $balances, 
            'year' => $year, 
            'month' => $month,
        ]);
    }
}
