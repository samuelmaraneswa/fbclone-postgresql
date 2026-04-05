<x-layouts.app title="Profile">
  <div class="flex flex-col items-center justify-center">
    <div class="w-225">
      {{-- sampul img --}}
      <div class="relative w-full bg-gray-200 h-90 border border-gray-300 rounded-lg -mt-3">
        <div class="absolute bottom-6 right-8">
          <label for="coverInput" class="cursor-pointer rounded-lg bg-white shadow p-2 font-semibold">
            <i class="fa-solid fa-camera"></i>
            Tambahkan foto sampul
          </label>
          <input type="file" id="coverInput" class="hidden">
        </div>
      </div>

      {{-- profile img section --}}
      <div class="flex items-center p-6 justify-between">
        {{-- kiri section --}}
        <div class="flex items-center gap-6">
          <div class="relative">
            <img src="{{asset('images/img-default.png')}}" alt="" class="w-42 h-42 rounded-full p-1 border border-gray-300 bg-gray-200 hover:bg-gray-300">
            <button class="rounded-full bg-gray-200 px-1.5 py-1 absolute text-lg right-2 bottom-2 cursor-pointer hover:bg-gray-300">
              <i class="fa-solid fa-camera"></i>
            </button>
          </div>
          <p class="text-4xl font-bold">Neswa Tob</p>
        </div>

        {{-- kanan section --}}
        <div class="flex items-center gap-2">
          <button class="py-1.5 px-3 bg-blue-600 hover:bg-blue-700 cursor-pointer rounded-lg text-white font-semibold">Posting sesuatu</button>
          <button class="py-1.5 px-3 bg-gray-300 hover:bg-gray-400 rounded-lg cursor-pointer font-semibold">
            <i class="fa-solid fa-pen"></i> Edit profil
          </button>
        </div>
      </div>

      {{-- profile section --}}
      <div id="profileTabs" role="tablist" class="border-t border-b border-gray-300 font-semibold flex items-center">
        <x-partials.profile.nav-link href="{{route('public.profile')}}" :active="$tab === 'semua'">Semua</x-partials.profile.nav-link>
        
        <x-partials.profile.nav-link href="{{route('public.profile', 'post')}}" :active="$tab === 'post'">Post</x-partials.profile.nav-link>

        <x-partials.profile.nav-link href="{{route('public.profile', 'tentang')}}" :active="$tab === 'tentang'">Tentang</x-partials.profile.nav-link>

        <x-partials.profile.nav-link href="{{route('public.profile', 'teman')}}" :active="$tab === 'teman'">Teman</x-partials.profile.nav-link>
        
        <x-partials.profile.nav-link href="{{route('public.profile', 'foto')}}" :active="$tab === 'foto'">Foto</x-partials.profile.nav-link>
        

        <div id="lainnyaProfile" class="relative group cursor-pointer">
          <button class="tab flex items-center gap-1 cursor-pointer">
            Lainnya <i class="fa-solid fa-caret-down cursor-pointer"></i>
          </button>

          <div id="lainnyaProfileMenu" class="absolute bg-white left-16 shadow-sm rounded-lg cursor-pointer text-left hidden">
            <a href="#" class="block pl-2 pr-8 py-2 hover:bg-gray-100">Video</a>
            <a href="#" class="block pl-2 pr-8 py-2 whitespace-nowrap text-left hover:bg-gray-100">Check-in</a>
          </div>
        </div>
      </div>
    </div>

    <div id="profileContent" class="w-225 items-center justify-center">
      @include('public.profile.tabs.' . $tab, ['user' => $user])
    </div>

  </div>
</x-layouts.app>