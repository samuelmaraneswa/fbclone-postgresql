<div id="notifMobile" class="inset-0 fixed bg-gray-100 shadow p-2 rounded-lg top-13 mx-2 notification-wrapper max-h-95 overflow-y-auto hidden" data-tab="notifications">
  <x-partials.title title="Notifikasi" />

  <div class="flex items-center mt-3 gap-2 text-base" data-filter="wrapper">
    <button class="btn-notif-header hover:bg-gray-200 rounded-full py-2 px-3 cursor-pointer" data-filter="all">Semua</button>
    <button class="btn-notif-header hover:bg-gray-200 rounded-full py-2 px-3 cursor-pointer" data-filter="unread">Belum Dibaca</button>
  </div>

  <div id="" class="notificationList mt-4 space-y-2" data-role="list"></div>

  <div id="" class="notificationEmpty" data-role="empty">
    <div  class=" flex flex-col items-center justify-center p-6">
      <i class="fa-solid fa-bell text-9xl text-gray-500"></i>
    </div>

    <div class="flex items-center justify-center">
      <h2 class="text-xl text-gray-500 font-bold">Anda tidak memiliki notifikasi</h2>
    </div>
  </div>
</div>