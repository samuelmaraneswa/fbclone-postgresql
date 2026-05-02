<div class="grid grid-cols-2 md:grid-cols-4 gap-4 shadow-sm rounded-lg p-4 mt-2 w-full">

  @foreach ($friends as $friend)
    <x-partials.profile.card-teman :friend="$friend" :isTemanTab="true" />
  @endforeach

</div>