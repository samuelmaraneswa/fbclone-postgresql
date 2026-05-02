@props(['isTemanTab' => false, 'friend', 'user'])

<div class="w-full rounded-lg overflow-hidden">
  <div class="shadow {{$isTemanTab ? 'bg-gray-100' : 'bg-white'}} w-full h-55">
    <img 
      src="{{ ($friend->avatar && file_exists(public_path('storage/' . $friend->avatar))) 
        ? asset('storage/' . $friend->avatar) 
        : asset('images/img-default.png') }}" 
      class="w-full h-full object-cover">
  </div>

  <a href="{{route('profile.show', $friend->id)}}">
    <button class="bg-blue-600 mt-1 text-white font-semibold w-full rounded-lg px-3 py-2 cursor-pointer hover:bg-blue-700">
      Lihat profil
    </button>
  </a>
</div>