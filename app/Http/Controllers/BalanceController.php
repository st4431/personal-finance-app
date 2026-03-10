<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBalanceRequest;
use App\Http\Requests\UpdateBalanceRequest;
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
        $this->authorize('view', $account);

        return view('balances.index', ['balances' => $balances, 'account' =>$account]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $account)
    {
        // ユーザーが「どの口座の残高を入力しているか」画面上で見せるためにidを使ってaccountを持ってきている
        $account = Account::findOrFail($account);
        $this->authorize('view', $account);
        return view('balances.create',[
            'account' => $account,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // $request->route('account')でも受け取れるけど、分けたほうが明示的なのでこっちにする
    public function store(StoreBalanceRequest $request, string $account)
    {
        $account = Account::findOrFail($account);
        $this->authorize('view', $account);
        Balance::create([
            'account_id' => $account->id,
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
    public function edit(string $account_id, string $balance_id)
    {
        $balance = Balance::findOrFail($balance_id);
        $this->authorize('view', $balance);
        $account = Account::findOrFail($account_id);
        return view('balances.edit', [
            'account' => $account, 
            'balance' => $balance
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBalanceRequest $request, string $account_id, string $balance_id)
    {
        $balance = Balance::findOrFail($balance_id);
        $this->authorize('update', $balance);
        $balance ->update([
            'year' => $request->input('year'),
            'month' => $request->input('month'),
            'balance' => $request->input('balance'),
        ]);

        return redirect()->route('accounts.balances.index', ['account' => $account_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $account_id, string $balance_id)
    {
        $balance = Balance::findOrFail($balance_id);
        $this->authorize('delete', $balance);
        $balance->delete();

        return redirect()->route('accounts.balances.index', ['account' => $account_id]);
    }
}
