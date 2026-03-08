<x-app-layout>
    <x-slot name="header">
        <h2>（{{ $account->name }}）残高入力</h2>
    </x-slot>
    <form method="POST" action="{{ route('accounts.balances.store', $account->id) }}">
      @csrf
      {{-- 年については一旦optionは使わずに入力させる。バリデーションで不正な値は防ごう --}}
      <div>
        <label>年</label>
        <input type="number" name="year">
      </div>
      <div>
        <label>月</label>
        <select name="month">
          @for ($i = 1; $i <= 12; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
          @endfor
        </select>
      </div>
      <div>
        <label>残高</label>
        <input type="number" name="balance">
      </div>
      <button type="submit">登録</button>
    </form>
    <a href="{{ route('accounts.index') }}">戻る</a>
</x-app-layout>

