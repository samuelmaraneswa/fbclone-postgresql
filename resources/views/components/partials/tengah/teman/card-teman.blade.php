@props(['user'])

<div class="bg-white rounded-lg overflow-hidden shrink-0 friend-wrapper" data-id="{{ $user->id }}">
  <a href="{{route('profile.show', $user->id)}}">
    <img 
      src="{{ ($friend->avatar && file_exists(public_path('storage/' . $friend->avatar))) 
        ? asset('storage/' . $friend->avatar) 
        : asset('images/img-default.png') }}" 
      class="w-full h-full object-cover">
    <p class="p-2 font-semibold">{{$user->name}}</p>
  </a>

  <button class="btn-friend btn-action bg-blue-600 text-white py-1 text-xs md:text-sm w-full text-center cursor-pointer hover:bg-blue-700" data-status="none">
    <span class="btn-text">Tambah teman</span>
  </button>
</div>