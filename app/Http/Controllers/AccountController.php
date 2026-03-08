<?php

namespace App\Http\Controllers;

use App\Enums\AccountType;
use App\Enums\AccountCategory;
use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Request $requestでHTTPリクエストの情報を引数として受け取っている
    public function index(Request $request)
    {
        // auth() は認証情報（全ユーザーのidやパスワードなど）にアクセスする
        // id() 今ログインしているユーザーのidを取得する
        $query = Account::where('user_id', auth()->id());

        // 口座情報は多くても10個ぐらいが想定されるのでページネーションは不要と判断
        $accounts = $query->get();

        return view('accounts.index', ['accounts' => $accounts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // cases()はenumが持つ全ての値を配列で返すメソッド
        return view('accounts.create', [
            'types' => AccountType::cases(),
            'categories' => AccountCategory::cases(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Account::create([
            'user_id' => auth()->id(),
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'category' => $request->input('category'),
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
        $account = Account::findOrFail($id);
        return view('accounts.edit', [
            'account' => $account,
            'types' => AccountType::cases(),
            'categories' => AccountCategory::cases(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $account = Account::findOrFail($id);
        $account ->update([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'category' => $request->input('category'),
        ]);

        return redirect()->route('accounts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

        return redirect()->route('accounts.index');
    }
}
