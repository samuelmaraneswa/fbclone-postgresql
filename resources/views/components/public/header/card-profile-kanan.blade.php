@props(['user'])

<div class="w-full md:w-80">
  <div class="p-1 rounded-lg bg-white shadow-[0_0_15px_rgba(0,0,0,0.12)] mb-3">

    <a href="{{route('profile.index')}}" class="flex items-center rounded-lg p-2 gap-2 bg-white cursor-pointer hover:bg-gray-100">
      <img src="{{ $user?->avatar ? asset('storage/' . $user?->avatar) : asset('images/img-default.png')}}" alt="" class="rounded-full h-10 w-9.5 bg-gray-200 p-1 object-cover">
      <p class="font-semibold text-lg">{{$user?->first_name . ' ' . $user?->last_name}}</p>
    </a>

    <hr class="border border-gray-300">

    <div class="w-full px-2">
      <button class="py-2 px-2 bg-gray-200 hover:bg-gray-300 cursor-pointer font-semibold text-base rounded-lg mt-3 block mx-auto mb-2 w-full">Lihat semua profil</button>
    </div>
  </div>

  <x-partials.profile-header.li icon="fa-solid fa-gear" text="Setelan & privasi" />
  <x-partials.profile-header.li icon="fa-solid fa-circle-question" text="Bantuan & dukungan" />
  <x-partials.profile-header.li icon="fa-solid fa-moon" text="Tampilan & aksibilitas" />
  <x-partials.profile-header.li icon="fa-solid fa-info" text="Beri masukan" :arrow="false" />
  <x-partials.profile-header.li icon="fa-solid fa-arrow-right-from-bracket" text="Keluar" :arrow="false" type="button" :action="route('logout')" />
</div>