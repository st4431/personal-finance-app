<x-app-layout>
    <x-slot name="header">
        <h2>（{{ $account->name }}）残高一覧</h2>
    </x-slot>

    @foreach ($balances as $balance)
        <div>
            <span>{{ $balance->year }}年</span>
            <span>{{ $balance->month }}月</span>
            <span>{{ number_format($balance->balance) }}</span>
            <a href="{{ route('accounts.balances.edit', [$balance->account_id, $balance->id]) }}">編集</a>
            <form method="POST" action="{{ route('accounts.balances.destroy', [$balance->account_id, $balance->id]) }}" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
            </div>
    @endforeach
    <a href="{{ route('accounts.index') }}">戻る</a>
</x-app-layout>

