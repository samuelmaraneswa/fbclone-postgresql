@props(['title', 'text', 'iconColor', 'icon'])

<a href="#" class="flex items-center hover:bg-gray-100 cursor-pointer gap-4 mt-1 rounded-lg p-2">
  <i class="{{$icon}} text-2xl {{$iconColor}}"></i>
  <div class="">
    <h4 class="font-semibold">{{$title}}</h4>
    <p class="text-sm">{{$text}}</p>
  </div>
</a>