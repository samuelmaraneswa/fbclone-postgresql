<div id="chatBox" class="hidden fixed bottom-0 right-25 h-110 w-85 overflow-y-auto bg-white px-4 py-2 rounded-lg shadow-[0_2px_8px_rgba(0,0,0,0.15),0_4px_16px_rgba(0,0,0,0.1)] hover:shadow-[0_4px_12px_rgba(0,0,0,0.2),0_8px_24px_rgba(0,0,0,0.15)] transition">
  
  <div class="relative">
    <button data-close="chatBox" class="absolute right-0 top-0 text-purple-500 cursor-pointer"><li class="fa-solid fa-x"></li></button>
    <p class="font-semibold">Pesan baru</p>
  </div>

  <div class="mt-3 w-full flex items-center gap-2">
    <p>Kepada:</p>
    <input type="text" class="w-full focus:outline-none">
  </div>

  <hr class="text-gray-300 my-3 -mx-4">

  <div class="overflow-y-auto max-h-80">
    @foreach ($friends->take(5) as $friend)
      <x-partials.sidebar-kanan.li-teman :friend="$friend" />
    @endforeach
  </div>
</div>