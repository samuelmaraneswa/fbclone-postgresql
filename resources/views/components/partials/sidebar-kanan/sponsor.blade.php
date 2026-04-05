@props(['img' => 'images/default.png', 'text' => 'Tidak ada teks.'])

<div class="group relative flex items-center mb-1 p-2 gap-2 cursor-pointer hover:bg-gray-200 rounded-lg text-gray-500">
  <div class="flex items-center gap-2 absolute top-1 right-1">
    <button class="bg-white hover:bg-gray-100 px-2.5 py-2 rounded-full cursor-pointer hidden group-hover:block"><i class="fa-solid fa-ellipsis"></i></button>
    <button class="bg-white hover:bg-gray-100 px-2.5 py-2 rounded-full cursor-pointer hidden group-hover:block"><i class="fa-solid fa-x"></i></button>
  </div>

  <img src="{{asset($img)}}" alt="" class="w-38 h-28 rounded-lg object-cover">
  <p class="text-gray-500 text-sm">{{$text}}</p>
</div>