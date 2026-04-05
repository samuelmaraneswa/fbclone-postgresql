@props(['id', 'placeholder'])

<div class="relative flex items-center w-full">
  <input id="{{$id}}" type="text" class="focus:outline-none rounded-full w-full bg-gray-100 pl-8 px-1 py-1.5 text-base" placeholder="{{$placeholder}}" autocomplete="off">
  <i class="fa-solid fa-magnifying-glass absolute top-1/2 -translate-y-1/2 text-gray-500 left-2 text-base"></i>
</div>