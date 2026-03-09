<x-app-layout>
    <x-slot name="header">
      <h2>月別残高一覧</h2>
    </x-slot>
    <form method="GET" action="{{ route('balance-sheets.index') }}">
      <div>
      <label>年</label>
      <input type="number" name="year" value="{{ $year }}">
      </div>
      <div>
        <label>月</label>
        <select name="month">
          @for ($i = 1; $i <= 12; $i++)
            <option value="{{ $i }}" @selected($month === $i)>{{ $i }}</option>
          @endfor
        </select>
      </div>

      @foreach ($balances as $balance)
        <div>
          <span>{{ $balance->account->name }}</span>
          <span>{{ number_format($balance->balance) }}</span>
          <span>{{ $balance->account->type->label() }}</span>
          <span>{{ $balance->account->category->label() }}</span>
        </div>
      @endforeach
      <button type="submit">更新</button>
    </form>
    <a href="{{ route('accounts.index') }}">戻る</a>
</x-app-layout>

