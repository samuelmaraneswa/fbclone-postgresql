<div data-messenger-card>
  <div class="flex items-center justify-between w-90 mb-2">
    <x-partials.title title="Obrolan" />

    <div class="flex items-center text-base text-gray-500 ga-5">
      <button class="p-2 hover:bg-gray-100 rounded-full cursor-pointer"><i class="fas fa-ellipsis-h"></i></button>
      <button class="p-2 hover:bg-gray-100 rounded-full cursor-pointer"><i class="fa-solid fa-paste"></i></button>
    </div>
  </div>

  <x-partials.form-search id="searchMessengerHeader" placeholder="Cari..." />

  <div class="flex items-center text-base mt-3 justify-between">
    <button class="messenger-btn active p-2 hover:bg-gray-100 rounded-full cursor-pointer">Semua</button>
    <button class="messenger-btn p-2 hover:bg-gray-100 rounded-full cursor-pointer">Belum Dibaca</button>
    <button class="messenger-btn p-2 hover:bg-gray-100 rounded-full cursor-pointer">Grup</button>
    <button class="messenger-btn p-2 hover:bg-gray-100 rounded-full cursor-pointer"><i class="fas fa-ellipsis-h"></i></button>
  </div>

  <div id="allMessages" class="space-y-2">
  </div>

  <div id="unreadMessages" class="space-y-2">
  </div>

  <div class="pesan-group text-base text-center text-gray-500 mt-8">
  </div>
</div>