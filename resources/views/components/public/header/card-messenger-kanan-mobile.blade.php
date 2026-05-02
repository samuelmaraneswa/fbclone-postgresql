<div id="messengerMobileCard" class="fixed inset-0 top-13 mx-2 bg-white p-2 rounded-lg shadow overflow-y-auto hidden">

  <div data-messenger-card>
    <div class="flex items-center justify-between mb-2">
      <x-partials.title title="Obrolan" />

      <div class="flex items-center text-base text-gray-500 gap-2">
        <button class="p-2 hover:bg-gray-100 rounded-full cursor-pointer"><i class="fas fa-ellipsis-h"></i></button>
        <button class="p-2 hover:bg-gray-100 rounded-full cursor-pointer"><i class="fa-solid fa-paste"></i></button>
      </div>
    </div>

    <x-partials.form-search id="searchMessengerHeaderMobile" placeholder="Cari..." />

    <div class="flex items-center text-base mt-3 justify-between">
      <button class="messenger-btn p-2 hover:bg-gray-100 rounded-full cursor-pointer">Semua</button>
      <button class="messenger-btn p-2 hover:bg-gray-100 rounded-full cursor-pointer">Belum Dibaca</button>
      <button class="messenger-btn p-2 hover:bg-gray-100 rounded-full cursor-pointer">Grup</button>
      <button class="messenger-btn p-2 hover:bg-gray-100 rounded-full cursor-pointer"><i class="fas fa-ellipsis-h"></i></button>
    </div>

    <div id="allMessagesMobile"></div>
    <div id="unreadMessagesMobile"></div>

    <div class="pesan-group text-base text-center text-gray-500 mt-8"></div>
  </div>

</div>