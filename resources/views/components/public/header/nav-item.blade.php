@props(['icon', 'active' => false, 'href' => '#', 'tooltip'])

<a href="{{$href}}" class="p-1 {{$active ? 'border-b-[3px] border-blue-600' : ''}}">
  <div class="relative group px-8 py-1 {{$active ? '' : 'hover:bg-gray-100 rounded-lg'}}">
    <i class="fa-solid fa-{{$icon}} {{$active ? 'text-blue-600' : 'text-gray-500'}}"></i>

    <x-partials.tooltip-menu tooltip="{{$tooltip}}" />
  </div>
</a>