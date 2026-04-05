@props(['img' => null, 'icon' => null, 'text', 'color'])

<a class="flex items-center px-3 py-1 mt-1 rounded-lg hover:bg-gray-200 cursor-pointer gap-2 font-semibold">
  @if ($img)
    <img src="{{asset ($img)}}" alt="" class="rounded-full w.10.5 h-10 bg-gray-200 p-1">
  @elseif($icon)
    <button class="rounded-full cursor-pointer px-0.5 text-[28px]"><i class="{{$icon}} {{$color}}"></i></button>
  @endif

  <p>{{$text}}</p>
</a>