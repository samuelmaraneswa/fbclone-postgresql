<x-partials.title title="Menu" />

<x-partials.container-flex-row class="h-116 overflow-y-auto overscroll-contain">
  <x-partials.card class="w-100">
    <x-partials.form-search id="searchMenuHeader" placeholder="Cari Menu" />

    <div class="mt-4">
      {{-- sosial start --}}
      <h3 class="text-lg font-semibold">Sosial</h3>

      <x-partials.header-menu-kanan.sosial icon="fa-solid fa-calendar" title="Acara" text="Kelola atau temukan acara dan hal lain untuk di lakukan secara online di sekitar." iconColor="text-amber-300" />

      <x-partials.header-menu-kanan.sosial icon="fa-solid fa-user-group" title="Teman" text="Cari teman atau orang yang mungkin Anda kenal." iconColor="text-blue-300" />
      
      <x-partials.header-menu-kanan.sosial icon="fa-solid fa-people-group" title="Group" text="Berinteraksi dengan orang yang memiliki minat yang sama." iconColor="text-blue-300" />
      
      <x-partials.header-menu-kanan.sosial icon="fa-regular fa-calendar" title="Kabar Beranda" text="Lihat postingan relevan dari orang lain dan Halaman yang Anda ikuti." iconColor="text-gray-500" />
      
      <x-partials.header-menu-kanan.sosial icon="fa-solid fa-newspaper" title="Kabar" text="Lihat postingan terbaru dari teman, group, Halaman dan lainnya." iconColor="text-blue-300" />
      
      <x-partials.header-menu-kanan.sosial icon="fa-solid fa-flag" title="Halaman" text="Temukan dan terhubung dengan bisnis di Facebook" iconColor="text-red-300" />
      {{-- sosial end --}}

      <hr class="mt-2 mb-2 border-gray-300">

      {{-- Belanja start --}}
      <h3 class="text-lg font-semibold">Belanja</h3>
      
      <x-partials.header-menu-kanan.sosial icon="fa-solid fa-credit-card" title="Pesanan dan Pembayaran" text="Cara aman dan lancar untuk membayar di aplikasi yang sudah Anda gunakan." iconColor="text-black/80" />
      
      <x-partials.header-menu-kanan.sosial icon="fa-solid fa-shop" title="Marketplace" text="Jual beli di komunitas Anda." iconColor="text-blue-400" />
      {{-- Belanja end --}}

      <hr class="mt-2 mb-2 border-gray-300">

      {{-- Pribadi start --}}
      <h3 class="text-lg font-semibold">Pribadi</h3>
      
      <x-partials.header-menu-kanan.sosial icon="fa-solid fa-address-card" title="Aktivitas Iklan Terkini" text="Lihat semua iklan yang berinteraksi dengan Anda di Facebook." iconColor="text-red-400" />
      
      <x-partials.header-menu-kanan.sosial icon="fa-solid fa-clock" title="Kenangan" text="Telusuri foto, video, dan postingan lama di Facebook." iconColor="text-blue-400" />
      
      <x-partials.header-menu-kanan.sosial icon="fa-solid fa-bookmark" title="Tersimpan" text="Temukan postingan, foto, dan video yang Anda simpan untuk nanti." iconColor="text-purple-400" />
      {{-- Pribadi end --}}      
      
      <hr class="mt-2 mb-2 border-gray-300">

      {{-- Professional start --}}
      <h3 class="text-lg font-semibold">Professional</h3>
      
      <x-partials.header-menu-kanan.sosial icon="fa-solid fa-arrow-up-right-dots" title="Pengelola Iklan" text="Buat, kelola dan pantau kinerja Iklan Anda." iconColor="text-blue-400" />
      {{-- Professional end --}}      

      <hr class="mt-2 mb-2 border-gray-300">
      
      {{-- Lainnya Dari Meta start --}}
      <h3 class="text-lg font-semibold">Lainnya Dari Meta</h3>
      
      <x-partials.header-menu-kanan.sosial icon="fa-regular fa-circle" title="Meta AI" text="Ajukan pertanyaan, lakukan curah pendapat, buat gambar yang bisa Anda kreasikan, dan banyak lagi." iconColor="text-purple-400" />
      
      <x-partials.header-menu-kanan.sosial icon="fa-brands fa-facebook-messenger" title="Messenger Anak" text="Mungkin anak-anak berkirim pesan dengan teman dekat dan keluarga." iconColor="text-blue-400" />

      <x-partials.header-menu-kanan.sosial icon="fa-brands fa-whatsapp" title="WhatsApp" text="Kirim pesan dan telepon orang secara privat di komputer Anda." iconColor="text-green-400" />

      <x-partials.header-menu-kanan.sosial icon="fa-brands fa-instagram" title="Instagram" text="Lihat momen sehari-hari dari orang yang Anda cintai." iconColor="text-purple-400" />
      {{-- Lainnya Dari Meta end --}}      
    </div>
  </x-partials.card>

  <x-partials.card class="sticky top-0 w-45 self-start">
    <h3 class="font-bold text-lg">Buat</h3>

    <x-partials.header-menu-kanan.buat icon="fa-solid fa-paste" text="Posting" />
    <x-partials.header-menu-kanan.buat icon="fa-solid fa-book-open" text="Cerita" />
    <x-partials.header-menu-kanan.buat icon="fa-solid fa-video" text="Reel" />
    <x-partials.header-menu-kanan.buat icon="fa-solid fa-star" text="Momen Spesial" />
    
    <hr class="mt-2 mb-2 border-gray-300">

    <x-partials.header-menu-kanan.buat icon="fa-solid fa-flag" text="Halaman" />
    <x-partials.header-menu-kanan.buat icon="fa-solid fa-address-card" text="Iklan" />
    <x-partials.header-menu-kanan.buat icon="fa-solid fa-people-group" text="Group" />
    <x-partials.header-menu-kanan.buat icon="fa-solid fa-calendar-plus" text="Acara" />
    <x-partials.header-menu-kanan.buat icon="fa-solid fa-bag-shopping" text="Penawaran di Marketplace" />
  </x-partials.card>
</x-partials.container-flex-row>