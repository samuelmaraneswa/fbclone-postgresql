@props(['photo'])

@if ($photo['type'] === 'post')
  <div
    class="post-item bg-white rounded-lg border border-gray-200 shadow-[0_1px_6px_rgba(0,0,0,0.12)] cursor-pointer"
    data-post-id="{{ $photo['post']->id }}"
    data-name="{{ $photo['post']->user->first_name }} {{ $photo['post']->user->last_name }}"
    data-time="{{ $photo['post']->created_at->diffForHumans() }}"
    data-text="{{ $photo['post']->content }}"
    data-img="{{ $photo['post']->user->avatar
      ? asset('storage/' . $photo['post']->user->avatar)
      : asset('images/img-default.png') }}"
    data-media='@json(
      $photo["post"]->media->map(function($m){
        return [
          "type" => $m->type,
          "url" => asset("storage/" . $m->file_path)
        ];
      })->values()->all()
    )'
  >
    <div class="media-wrapper h-40 md:h-52 overflow-hidden relative">

      @foreach ($photo['post']->media as $index => $m)
        <div class="media-item {{ $index === 0 ? '' : 'hidden' }} h-full">

          @if ($m->type === 'image')
            <img
              src="{{ asset('storage/' . $m->file_path) }}"
              class="w-full h-full object-cover brightness-90 hover:brightness-100"
            >
          @endif

          @if ($m->type === 'video')
            <div class="relative h-full">
              <video class="w-full h-full object-cover" muted>
                <source src="{{ asset('storage/' . $m->file_path) }}" type="video/mp4">
              </video>

              <div class="media-overlay absolute inset-0 z-10"></div>
            </div>
          @endif

        </div>
      @endforeach

    </div>

    <span class="like-count hidden">
        {{ $photo['post']->reactions_count }}
    </span>

    <button class="btn-like hidden {{ $photo['post']->is_liked ? 'text-blue-600' : '' }}">
    </button>
  </div>
@else
  <div class="w-full h-40 md:h-52 rounded-lg overflow-hidden">
    <img
      src="{{ $photo['image'] }}"
      alt="Photo"
      class="w-full h-full object-cover shadow brightness-90 hover:brightness-100"
    >
  </div>
@endif