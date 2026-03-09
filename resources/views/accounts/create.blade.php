<x-app-layout>
    <x-slot name="header">
        <h2>新規口座登録</h2>
    </x-slot>
    @if ($errors->any())
      @foreach ($errors->all() as $error)
        <p style="color: red;">{{ $error }}</p>
      @endforeach
    @endif
    <form method="POST" action="{{ route('accounts.store') }}">
      @csrf
      <div>
        <label>名前</label>
        <input type="text" name="name">
      </div>
      <div>
        <label>種別</label>
        <select name="type">
          @foreach ($types as $type)
            <option value="{{ $type->value }}">{{ $type->label() }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label>資産/負債</label>
        <select name="category">
          @foreach ($categories as $category)
            <option value="{{ $category->value }}">{{ $category->label() }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit">登録</button>
    </form>
    <a href="{{ route('accounts.index') }}">戻る</a>
</x-app-layout>

