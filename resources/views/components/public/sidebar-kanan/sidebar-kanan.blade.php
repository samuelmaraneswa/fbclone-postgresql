<div class="hidden md:block sidebar fixed right-0 bottom-0 top-14 w-80 overflow-y-auto overscroll-contain">
  <p class="pl-2 text-lg font-semibold text-gray-500 my-2">Bersponsor</p>

  <x-partials.sidebar-kanan.sponsor img="images/sponsors/a3.webp" text="AI Work Balance" />
  <x-partials.sidebar-kanan.sponsor img="images/sponsors/a5.webp" text="Come to Australia" />

  <hr class="border border-gray-400 my-4 ml-2">

  <p class="pl-2 text-lg font-semibold text-gray-500 my-2">Obrolan Grup</p>

  <div class="gap-2 flex items-center cursor-pointer p-2 hover:bg-gray-200 rounded-lg">
    <button class="rounded-full bg-gray-300 py-1 px-1.5 cursor-pointer"><i class="fa-solid fa-plus"></i></button>
    <p class="font-semibold">Buat obrolan grup</p>
  </div>
  
  <div class="gap-2 p-2 rounded-lg space-y-2">
    <h3 class="pl-2 text-lg font-semibold text-gray-500 my-2">Teman</h3>

    @foreach ($friends->take(7) as $friend)
      <x-partials.sidebar-kanan.li-teman :friend="$friend" />
    @endforeach
  </div>
</div>