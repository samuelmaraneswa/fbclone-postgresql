<div class="block md:hidden fixed top-0 left-0 w-full z-50 bg-white">
  <div class="flex items-center justify-between px-3 py-2 bg-white">
    {{-- kiri --}}
    <a href="{{route('home')}}"><i class="fa-brands fa-facebook text-blue-600 text-[32px]"></i></a>
    
    {{-- kanan --}}
    <div class="flex items-center gap-2 text-[18px]">
      <button class="bg-gray-200 rounded-full w-9 h-9 flex items-center justify-center">
        <i class="fa-solid fa-plus"></i>
      </button>

      <button id="mobileSearch" class="bg-gray-200 rounded-full w-9 h-9 flex items-center justify-center">
        <i class="fa-solid fa-magnifying-glass"></i>
      </button>

      {{-- mobile search content --}}
      <div id="mobileSearchContent" class="fixed top-0 left-0 w-full h-full bg-black/30 hidden z-60">
        <div class="absolute top-0 left-0 w-full h-full bg-white p-4">
          <!-- isi search -->
          <x-partials.mobile.header.search-card />
        </div>
      </div>

      <button class="bg-gray-200 rounded-full w-9 h-9 flex items-center justify-center">
        <i class="fa-brands fa-facebook-messenger"></i>
      </button>
    </div>

  </div>

  <div class="flex items-center justify-around border-t border-gray-200 text-gray-500 text-[20px] py-1">
    <x-public.header.nav-item-mobile href="/" id="" icon="fa-house" :active="request()->routeIs('home')" />
    <x-public.header.nav-item-mobile id="" icon="fa-user-group" />
    <x-public.header.nav-item-mobile id="" icon="fa-shop" />
    <x-public.header.nav-item-mobile id="" icon="fa-people-group" />
    <x-public.header.nav-item-mobile id="btnHamburger" icon="fa-bars" :active="request()->routeIs('public.profile')" />

    <div id="menuHamburgerContent" class="fixed top-22 left-0 w-full h-[calc(100vh-5.5rem)] bg-black/30 hidden z-50">
      <div class="absolute top-0 w-full h-full bg-white p-4">
        <x-public.header.card-profile-kanan />
      </div>
    </div>
  </div>
</div>

<div class="hidden md:flex">
  <div class="fixed top-0 left-0 w-full bg-white flex items-center px-3 z-50">
  {{-- kiri start --}}
  <div class="relative flex items-center w-82.5 gap-2">
    <a id="fbLogo" href=""><i class="fa-brands fa-facebook text-blue-600 text-[40px]"></i></a>
    
    <button id="arrowLeftHeader" class="hover:bg-gray-200 rounded-full px-2 py-1.5 cursor-pointer hidden"><i class="fa-solid fa-arrow-left"></i></button>
    
    <div id="inputSearchHeaderWrapper" class="relative flex-1">
      <input id="inputSearchHeader" type="text" class="border border-black rounded-full px-2 py-1.5 pl-8 focus:outline-none bg-gray-100 w-full" placeholder="Cari di facebook" autocomplete="off">
      
      <i id="iconSearchHeader" class="fa-solid fa-magnifying-glass absolute top-1/2 -translate-y-1/2 left-2 text-gray-500"></i>

    </div>

    <x-public.header.card-search-header />
  </div>
  {{-- kiri end --}}

  {{-- tengah start --}}
  <div class="flex flex-1 items-center justify-center text-[25px] gap-6 text-gray-500 px-2 -ml-10">
    <x-public.header.nav-item icon="house" href="/" :active="request()->routeIs('home')" tooltip="Beranda" />
    <x-public.header.nav-item icon="user-group" href="{{route('public.teman')}}" :active="request()->routeIs('public.teman')" tooltip="Teman" />
    <x-public.header.nav-item icon="film" href="{{route('public.reels')}}" :active="request()->routeIs('public.reels')" tooltip="Reels" />
    <x-public.header.nav-item icon="shop" href="{{route('public.marketplace')}}" :active="request()->routeIs('public.marketplace')" tooltip="Marketplace" />
    <x-public.header.nav-item icon="people-group" href="{{route('public.group')}}" :active="request()->routeIs('public.group')" tooltip="Grup" />
  </div>
  {{-- tengah end --}}

  {{-- kanan start --}}
  <div class="relative flex items-center justify-end text-[20px] gap-2">
    {{-- icon menu header kanan start --}}
    <x-public.header.menu-kanan tooltip="Menu">
      <x-slot:trigger>
        <i class="fa-solid fa-bars"></i>
      </x-slot:trigger>

      <x-public.header.card-menu-kanan />
    </x-public.header.menu-kanan>

    <x-public.header.menu-kanan tooltip="Messenger">
      <x-slot:trigger>
        <i class="fa-brands fa-facebook-messenger"></i>
      </x-slot:trigger>

      <x-public.header.card-messenger-kanan />
    </x-public.header.menu-kanan>

    <x-public.header.menu-kanan tooltip="Notifikasi">
      <x-slot:trigger>
        <i class="fa-solid fa-bell"></i>
      </x-slot:trigger>

      <x-public.header.card-notif-kanan />
    </x-public.header.menu-kanan>

    <x-public.header.menu-kanan tooltip="Akun">
      <x-slot:trigger>
        <img src="{{asset('images/img-default.png')}}" alt="" class="rounded-full h-7.5 w-7">
        <i class="fa-solid fa-chevron-down absolute text-xs rounded-full bottom-0 right-0 bg-gray-200 outline-white border-2 border-white"></i>
      </x-slot:trigger>

      <x-public.header.card-profile-kanan />
    </x-public.header.menu-kanan>
    {{-- icon menu header kanan end --}}

  </div>
  {{-- kanan end --}}
  </div>
</div>