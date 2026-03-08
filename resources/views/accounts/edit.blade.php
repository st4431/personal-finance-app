<x-app-layout>
    <x-slot name="header">
        <h2>口座編集</h2>
    </x-slot>
    <form method="POST" action="{{ route('accounts.update', $account->id) }}">
      @csrf
      @method('PUT')
      <div>
        <label>名前</label>
        <input type="text" name="name" value="{{ $account->name }}">
      </div>
      <div>
        <label>種別</label>
        <select name="type">
          @foreach ($types as $type)
            <option value="{{ $type->value }}" @selected($account->type === $type)>{{ $type->label() }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label>資産/負債</label>
        <select name="category">
          @foreach ($categories as $category)
            <option value="{{ $category->value }}" @selected($account->category === $category)>{{ $category->label() }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit">更新</button>
    </form>
    <a href="{{ route('accounts.index') }}">戻る</a>
</x-app-layout>

