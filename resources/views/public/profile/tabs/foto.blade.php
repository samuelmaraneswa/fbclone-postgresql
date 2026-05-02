@props(['photos'])

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-20">
  @foreach ($photos as $photo)
    <x-partials.profile.foto :photo="$photo" />
  @endforeach
</div>