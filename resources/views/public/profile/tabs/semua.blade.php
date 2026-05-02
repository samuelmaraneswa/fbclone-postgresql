<div class="space-y-6 mt-4 mb-20">

  <x-public.tengah.profile.post :user="$user" :posts="$posts->take(1)" :notPostTab="true" />

  <x-public.tengah.profile.tentang :user="$user" />

  <div class="bg-white space-y-2 px-1">
    <h3 class="text-2xl font-semibold p-3">
      {{ $user->id === auth()->id()
          ? 'Teman Anda'
          : 'Teman ' . $user->first_name }}
    </h1>
      
    @if ($friends->count())
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach ($friends->take(4) as $friend)
          <x-partials.profile.card-teman :friend="$friend" />
        @endforeach
      </div>
    @else
      <div class="text-center py-6 text-gray-500">
        <p class="font-medium">
          {{ $user->id === auth()->id()
            ? 'Anda belum memiliki teman'
            : $user->first_name . ' belum memiliki teman lain' }}
        </p>
      </div>
    @endif
    
    <a href="{{ $user->id == auth()->id() ? route('profile.index', 'teman') : route('profile.show', [$user->id, 'teman']) }}" class="lihat-semua-teman w-full">
      <button class="bg-black/70 rounded-lg text-white font-semibold w-full py-2 cursor-pointer hover:bg-black/80">
        {{ $user->id === auth()->id()
          ? 'Lihat teman lainnya'
          : 'Lihat teman ' . $user->first_name }}
      </button>
    </a>
  </div>

  <x-public.tengah.profile.foto :user="$user" :photos="$photos" />
</div> 