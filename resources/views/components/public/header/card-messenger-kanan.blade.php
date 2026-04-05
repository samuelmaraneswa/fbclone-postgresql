<div class="flex items-center justify-between w-90 mb-2">
  <x-partials.title title="Obrolan" />

  <div class="flex items-center text-base text-gray-500 ga-5">
    <button class="p-2 hover:bg-gray-100 rounded-full cursor-pointer"><i class="fas fa-ellipsis-h"></i></button>
    <button class="p-2 hover:bg-gray-100 rounded-full cursor-pointer"><i class="fa-solid fa-paste"></i></button>
  </div>
</div>

<x-partials.form-search id="searchMessengerHeader" placeholder="Cari Messenger" />

<div class="flex items-center text-base mt-3 justify-between">
  <button class="messenger-btn active p-2 hover:bg-gray-100 rounded-full cursor-pointer">Semua</button>
  <button class="messenger-btn p-2 hover:bg-gray-100 rounded-full cursor-pointer">Belum Dibaca</button>
  <button class="messenger-btn p-2 hover:bg-gray-100 rounded-full cursor-pointer">Grup</button>
  <button class="messenger-btn p-2 hover:bg-gray-100 rounded-full cursor-pointer"><i class="fas fa-ellipsis-h"></i></button>
</div>

<div class="semua-pesan text-base text-center text-gray-500 mt-8">
  <h3 class="font-semibold mb-1">Tidak ada obrolan</h3>
  <p>Jika Anda memiliki obrolan, Anda akan melihatnya disini.</p>
</div>

<div class="pesan-belum-dibaca text-base text-center text-gray-500 mt-8">
  <h3 class="font-semibold mb-1">Tidak ada obrolan belum dibaca</h3>
  <p>Jika Anda memiliki obrolan yang belum dibaca, Anda akan melihatnya disini.</p>
</div>

<div class="pesan-group text-base text-center text-gray-500 mt-8">
  <h3 class="font-semibold mb-1">Tidak ada obrolan grup</h3>
  <p>Jika Anda memiliki obrolan grup, Anda akan melihatnya disini.</p>
</div>