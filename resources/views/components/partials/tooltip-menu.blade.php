@props(['tooltip'])

<div class="absolute bg-black/70 rounded-lg text-sm p-2 top-12 pointer-events-none invisible text-white opacity-0 group-hover:opacity-100 group-hover:pointer-events-auto transition duration-200 group-hover:visible left-1/2 -translate-x-1/2">
  {{$tooltip}}
</div>