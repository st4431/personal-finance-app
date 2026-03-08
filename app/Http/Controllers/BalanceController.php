<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Balance;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $account)
    {
        $balances = Balance::where('account_id', $account)->get();
        $account = Account::findOrFail($account);

        return view('balances.index', ['balances' => $balances, 'account' =>$account]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $account)
    {
        // ユーザーが「どの口座の残高を入力しているか」画面上で見せるためにidを使ってaccountを持ってきている
        $account = Account::findOrFail($account);
        return view('balances.create',[
            'account' => $account,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // $request->route('account')でも受け取れるけど、分けたほうが明示的なのでこっちにする
    public function store(Request $request, string $account)
    {
        Balance::create([
            'account_id' => $account,
            'year' => $request->input('year'),
            'month' => $request->input('month'),
            'balance' => $request->input('balance'),
        ]);

        return redirect()->route('accounts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
