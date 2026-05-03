@props(['user'])

@if ($user->id === auth()->id())
  <form action="{{route('profile.upload.foto-profile')}}" method="POST" enctype="multipart/form-data">
    @csrf
@endif

  <div class="relative">

    @if ($user->avatar)
      <img src="{{asset('storage/' . $user->avatar)}}" alt="" class="w-42 h-42 rounded-full p-1 border-2 md:border border-white md:border-gray-300 bg-gray-200 hover:bg-gray-300 object-cover">
    @else
      <img src="{{asset('images/img-default.png')}}" alt="" class="w-42 h-42 rounded-full p-1 border-2 md:border border-white md:border-gray-300 bg-gray-200 hover:bg-gray-300">
    @endif

    @if ($user->id === auth()->id())
      <button type="button" class="rounded-full bg-gray-200 px-1.5 py-1 absolute text-lg right-2 bottom-2 cursor-pointer hover:bg-gray-300">
        <label for="fotoProfileInput">
          <i class="fa-solid fa-camera cursor-pointer"></i>
        </label>

        <input type="file" name="avatar" id="fotoProfileInput" class="hidden" onchange="this.form.submit()">
      </button>
    @endif

  </div>

@if ($user->id === auth()->id())
  </form>
@endif