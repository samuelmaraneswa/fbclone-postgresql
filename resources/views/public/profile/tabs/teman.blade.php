<h1 class="font-semibold text-2xl my-2">
  {{ $user->id === auth()->id()
    ? 'Teman Anda'
    : 'Teman ' . $user->first_name }}
</h1>

@if ($friends->count())
  <x-public.tengah.profile.teman :user="$user" :friends="$friends"  />
@else
  <div class="text-center py-6 text-gray-500 mb-20">
    <p class="font-medium">
      {{ $user->id === auth()->id()
        ? 'Anda belum memiliki teman'
        : $user->first_name . ' belum memiliki teman lain' }}
    </p>
  </div>
@endif
