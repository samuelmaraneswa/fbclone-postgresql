@props(['user'])

<form action="{{route('profile.upload.cover')}}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="relative w-full bg-gray-200 h-48 md:h-90 border border-gray-300 rounded-lg -mt-3 overflow-hidden">

    @if ($user->cover)
      <img src="{{asset('storage/' . $user->cover)}}" alt="" class="w-full h-full object-cover">
    @else
      <div class="w-full h-full"></div>
    @endif
    
    <div class="absolute bottom-6 right-8">
      <label for="coverInput" class="cursor-pointer rounded-lg bg-white shadow p-2 font-semibold hover:bg-gray-100">
        <i class="fa-solid fa-camera"></i>
        <p class="hidden md:inline">{{$user->cover ? 'Ganti foto sampul' : 'Tambahkan foto sampul'}}</p>
      </label>

      <input type="file" name="cover" id="coverInput" class="hidden" onchange="this.form.submit()">
    </div>
  </div>
</form>