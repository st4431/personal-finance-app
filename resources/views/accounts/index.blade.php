<x-app-layout>
    <x-slot name="header">
        <h2>口座一覧</h2>
    </x-slot>

    <a href="{{ route('accounts.create') }}">新規口座登録</a>

    @foreach ($accounts as $account)
        <div>
            <span>{{ $account->name }}</span>
            <span>{{ $account->type }}</span>
            <span>{{ $account->category }}</span>
            <a href="{{ route('accounts.edit', $account->id) }}">編集</a>
            <form method="POST" action="{{ route('accounts.destroy', $account->id) }}" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
        </div>
    @endforeach
</x-app-layout>

