<div class="hidden sm:flex items-center bg-white rounded-lg border border-gray-200 shadow-[0_1px_6px_rgba(0,0,0,0.12)] p-3 gap-3">
  <img src="{{asset('images/img-default.png')}}" alt="" class="w-11 h-11 rounded-full p-1 bg-gray-100">

  <div class="flex-1">
    <input id="" type="text" class="inputCreatePost bg-gray-100 rounded-full px-4 py-2 w-full focus:outline-none" placeholder="Apa yang Anda pikirkan, Neswa?">
  </div>

  <div class="flex items-center text-2xl">
    <button class="p-1 hover:bg-gray-100 rounded-lg cursor-pointer"><i class="fa-solid fa-video text-red-400"></i></button>
    <button class="p-1 hover:bg-gray-100 rounded-lg cursor-pointer"><i class="fa-solid fa-file-image text-green-400"></i></button>
    <button class="p-1 hover:bg-gray-100 rounded-lg cursor-pointer"><i class="fa-solid fa-face-grin text-yellow-400"></i></button>
  </div>
</div>

{{-- modal create post --}}
<x-partials.tengah.post.create-post />