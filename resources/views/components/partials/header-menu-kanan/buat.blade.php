@props(['icon', 'text'])

<a href="">
  <div class="flex items-center hover:bg-gray-100 p-2 rounded-lg gap-2">
    <button class="bg-gray-200 px-2 py-1.5 text-[19px] cursor-pointer rounded-full"><i class="{{$icon}}"></i></button>
    <p class="font-semibold font-lg">{{$text}}</p>
  </div>
</a>