@props(['friend'])

<div 
  class="flex items-center gap-2 p-2 rounded-lg font-semibold cursor-pointer hover:bg-gray-200"
  data-open-chat="user"
  data-user-id="{{ $friend->id }}"
  data-user-name="{{ $friend->first_name }} {{ $friend->last_name }}"
  data-user-avatar="{{ $friend->avatar ? asset('storage/' . $friend->avatar) : asset('images/img-default.png') }}"
>
  <img src="{{ $friend->avatar ? asset('storage/' . $friend->avatar) : asset('images/img-default.png') }}" class="h-8 w-8 rounded-full bg-gray-100 object-cover">
  <p>{{ $friend->first_name }} {{ $friend->last_name }}</p>
</div>