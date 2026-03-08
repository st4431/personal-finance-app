<x-app-layout>
    <x-slot name="header">
        <h2>（{{ $balance->year }}年{{ $balance->month }}月{{ $account->name }}）編集</h2>
    </x-slot>
    <form method="POST" action="{{ route('accounts.balances.update', [$account->id, $balance->id]) }}">
      @csrf
      @method('PUT')
      <div>
        <label>年</label>
        <input type="number" name="year" value="{{ $balance->year }}">
      </div>
      <div>
        <label>月</label>
        <select name="month">
          @for ($i = 1; $i <= 12; $i++)
            <option value="{{ $i }}" @selected($balance->month === $i)>{{ $i }}</option>
          @endfor
        </select>
      </div>
      <div>
        <label>残高</label>
        <input type="number" name="balance" value="{{ $balance->balance }}">
      </div>
      <button type="submit">更新</button>
    </form>
    <a href="{{route('accounts.balances.index', $account->id)}}">戻る</a>
</x-app-layout>

