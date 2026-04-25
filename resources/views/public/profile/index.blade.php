<x-layouts.app title="Profile">
  <div class="flex flex-col items-center justify-center">

    @if ($errors->any())
      <div class="p-6 w-full bg-black/70 rounded-lg mb-6 text-center italic text-base md:text-lg">
        @foreach ($errors->all() as $error)
          <p class="text-red-600">*{{$error}}*</p>
        @endforeach
      </div>
    @endif

    <div class="w-full md:w-225">
      {{-- sampul img --}}
      <x-partials.profile.sampul :user="$user" />

      {{-- profile img section --}}
      <div class="flex flex-col md:flex-row items-center p-6 justify-center md:justify-between mx-auto -mt-25 md:mt-0 space-y-2">
        {{-- kiri section --}}
        <div class="flex flex-col md:flex-row items-center md:gap-6">
          <x-partials.profile.foto-profile :user="$user" />

          <p class="text-3xl md:text-4xl font-bold">{{$user->first_name . ' ' . $user->last_name}}</p>
        </div>

        {{-- kanan section --}}
        @if ($user->id === auth()->id())
          <div class="flex items-center gap-2">
            <button class="py-1.5 px-3 bg-blue-600 hover:bg-blue-700 cursor-pointer rounded-lg text-white font-semibold">Posting sesuatu</button>
            
            <a href="{{route('profile.edit')}}">
              <button class="py-1.5 px-3 bg-gray-300 hover:bg-gray-400 rounded-lg cursor-pointer font-semibold">
                <i class="fa-solid fa-pen"></i> Edit profil
              </button>
            </a>
          </div>
        @else
          <div class="flex items-center gap-2">
            <div class="friend-wrapper relative" data-id="{{$user->id}}">
              <button 
                class="btn-action btn-friend relative py-1.5 px-3 rounded-lg font-semibold cursor-pointer {{$isFriend ? 'pr-6 bg-blue-600 text-white' : ($isRequestReceived || $isFriendRequest ? 'bg-gray-300 text-black' : 'bg-blue-600 text-white')}}"
                
                data-status="{{$isFriend ? 'friends' : ($isRequestReceived ? 'received' : ($isFriendRequest ? 'requested' : 'none'))}}">

                <span class="btn-text">
                  {{$isFriend ? 'Berteman' : ($isRequestReceived ? 'Terima pertemanan' : ($isFriendRequest ? 'Permintaan terkirim' : 'Tambah teman'))}}
                </span>

                @if($isFriend)
                  <i class="fa-solid fa-ellipsis-vertical absolute right-0 top-1/2 -translate-y-1/2"></i>
                @endif
              </button>

              <div class="btn-teman-dropdown hidden absolute mt-0.5 space-y-1 w-max flex flex-col items-start p-2 rounded-lg shadow bg-white">
                
                <button class="btn-action bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg py-1 px-2" data-action="unfriend">Hapus pertemanan</button>
                <button class="btn-action bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg py-1 px-2" data-action="block">Blokir</button>

              </div>
            </div>
            
            <a href="{{route('profile.edit')}}">
              <button class="py-1.5 px-3 bg-gray-300 hover:bg-gray-400 rounded-lg cursor-pointer font-semibold">
                <i class="fa-solid fa-pen"></i> Kirim Pesan
              </button>
            </a>
          </div>
        @endif

      </div>

      {{-- profile section --}}
      <div id="profileTabs" role="tablist" class="border-t border-b border-gray-300 font-semibold flex items-center overflow-x-auto">
        <x-partials.profile.nav-link href="{{ $user->id == auth()->id() ? route('profile.index') : route('profile.show', $user->id)}}" :active="$tab === 'semua'">Semua</x-partials.profile.nav-link>
        
        <x-partials.profile.nav-link href="{{ $user->id == auth()->id() ? route('profile.index', 'post') : route('profile.show', [$user->id, 'post']) }}" :active="$tab === 'post'">Post</x-partials.profile.nav-link>

        <x-partials.profile.nav-link href="{{ $user->id == auth()->id() ? route('profile.index', 'tentang') : route('profile.show', [$user->id, 'tentang']) }}" :active="$tab === 'tentang'">Tentang</x-partials.profile.nav-link>

        <x-partials.profile.nav-link href="{{ $user->id == auth()->id() ? route('profile.index', 'teman') : route('profile.show', [$user->id, 'teman']) }}" :active="$tab === 'teman'">Teman</x-partials.profile.nav-link>
        
        <x-partials.profile.nav-link href="{{ $user->id == auth()->id() ? route('profile.index', 'foto') : route('profile.show', [$user->id, 'foto']) }}" :active="$tab === 'foto'">Foto</x-partials.profile.nav-link>
        

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

    <div id="profileContent" class="w-full md:w-225 items-center justify-center">
      @include('public.profile.tabs.' . $tab, ['user' => $user])
    </div>

  </div>
</x-layouts.app>