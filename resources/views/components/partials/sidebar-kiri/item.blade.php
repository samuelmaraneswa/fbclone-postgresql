@props(['img' => null, 'icon' => null, 'text', 'color', 'href' => '#'])

<a href="{{$href}}" class="flex items-center px-3 py-1 mt-1 rounded-lg hover:bg-gray-200 cursor-pointer gap-2 font-semibold">
  @if ($icon)
    <button class="rounded-full cursor-pointer px-0.5 text-[28px]"><i class="{{$icon}} {{$color}}"></i></button>
  @else
    <img src="{{$img ? asset ('storage/' . $img) : asset('images/img-default.png')}}" alt="" class="rounded-full w-10 object-cover h-10 bg-gray-200 p-1">
  @endif

  <p>{{$text}}</p>
</a>