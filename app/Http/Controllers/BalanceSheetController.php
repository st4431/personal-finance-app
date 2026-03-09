<?php

namespace App\Http\Controllers;

use App\Enums\AccountCategory;
use App\Http\Requests\BalanceSheetRequest;
use App\Models\Balance;

class BalanceSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BalanceSheetRequest $request)
    {
        $year = (int) $request->input('year', now()->year);
        $month = (int) $request->input('month', now()->month);
        $balances = Balance::where('year', $year)
            ->where('month', $month)
            ->whereHas('account', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->with('account')
            ->get();

        $totalAssets = $balances->filter(function ($balance) {
            return $balance->account->category === AccountCategory::Asset;
        })->sum('balance');

        $totalLiabilities = $balances->filter(function ($balance) {
            return $balance->account->category === AccountCategory::Liability;
        })->sum('balance');

        $netAssets = $totalAssets - $totalLiabilities;

        return view('balance-sheets.index', [
            'balances' => $balances, 
            'year' => $year, 
            'month' => $month,
            'totalAssets' => $totalAssets,
            'totalLiabilities' => $totalLiabilities,
            'netAssets' => $netAssets,
        ]);
    }
}
