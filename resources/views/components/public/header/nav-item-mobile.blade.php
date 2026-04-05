@props(['id' => null, 'icon', 'active' => false, 'href' => '#'])

<a href="{{$href}}">
  <button id="{{$id}}">
    <i class="fa-solid {{$icon}} {{$active ? 'text-blue-600' : 'text-gray-500'}}"></i>
  </button>
</a>