<div class="space-y-3 p-1">
  <h1 class="font-semibold text-2xl my-4">
    {{ $user->id === auth()->id()
      ? 'Foto-foto Anda'
      : 'Foto-foto ' . $user->first_name }}
  </h1>

  @if ($photos->count())
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
      @foreach ($photos->take(4) as $photo)
        <x-partials.profile.foto :photo="$photo" :user="$user" />
      @endforeach
    </div>

    <a href="{{ $user->id == auth()->id() ? route('profile.index', 'foto') : route('profile.show', [$user->id, 'foto']) }}" class="lihat-semua-foto w-full">
      <button class="bg-black/70 rounded-lg text-white font-semibold w-full py-2 cursor-pointer hover:bg-black/80">
        Lihat foto lainnya
      </button>
    </a>

  @else
    <div class="text-center py-6 text-gray-500">
      <p class="font-medium">
        {{ $user->id === auth()->id()
          ? 'Anda belum memiliki foto'
          : $user->first_name . ' belum memiliki foto' }}
      </p>
    </div>
  @endif
</div>