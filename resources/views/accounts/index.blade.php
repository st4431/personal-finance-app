<x-app-layout>
    <x-slot name="header">
        <h2>口座一覧</h2>
    </x-slot>

    <div>
        <a href="{{ route('accounts.create') }}">新規口座登録</a>
    </div>
    <div>
        <a href="{{ route('balance-sheets.index')}}">月別残高、バランスシート表示</a>
    </div>
    @foreach ($accounts as $account)
        <div>
            <span>{{ $account->name }}</span>
            <span>{{ $account->type->label() }}</span>
            <span>{{ $account->category->label() }}</span>
            <a href="{{ route('accounts.edit', $account->id) }}">編集</a>
            <form method="POST" action="{{ route('accounts.destroy', $account->id) }}" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
            <a href="{{ route('accounts.balances.create', $account->id) }}">月別残高登録</a>
            <a href="{{ route('accounts.balances.index', $account->id)}}">月別残高一覧表示</a>
        </div>
    @endforeach
</x-app-layout>

