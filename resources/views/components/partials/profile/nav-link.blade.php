@props(['href', 'active' => false])

<a href="{{$href}}" class="profile-tab px-4 py-3 {{$active ? 'text-blue-600 border-b-2 border-blue-600 bg-blue-100' : 'hover:bg-gray-200'}}">
  {{$slot}}
</a>