<x-app-layout>
    <x-slot name="header">
        <h2>新規口座登録</h2>
    </x-slot>
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



</x-app-layout>

