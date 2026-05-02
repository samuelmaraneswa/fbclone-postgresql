<div class="menu-kanan-item">
  
  <div class="group relative">
    <button class="menu-kanan-btn-header relative px-1.5 py-1 rounded-full bg-gray-200 hover:bg-gray-300 cursor-pointer">
      {{$trigger}}
    </button>

    <x-partials.tooltip-menu tooltip="{{$tooltip}}" />
  </div>

  <div class="menu-kanan-btn-header-content absolute right-0 top-full mt-1 bg-white rounded-lg shadow-[0_-2px_10px_rgba(0,0,0,0.08)] p-4 overflow-y-auto hidden">
    {{$slot}}
  </div>
</div>