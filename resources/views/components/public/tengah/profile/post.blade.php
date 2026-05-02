@props(['user', 'posts' => [], 'notPostTab' => false])

<div class="flex flex-col bg-white shadow-sm rounded-lg p-4 mt-2">
  <h1 class="font-semibold text-lg md:text-2xl my-2">
    {{ $user->id === auth()->id()
      ? 'Postigan Anda'
      : 'Postingan ' . $user->first_name }}
  </h1>
  
  @if ($notPostTab)
    <p class="text-gray-500 mb-2">Postingan terbaru</p>  
  @endif
  
 @foreach ($posts as $post)
    <x-partials.tengah.post-section
      :profile_img="$post->user->avatar ? 'storage/'.$post->user->avatar : 'images/img-default.png'"
      :first_name="$post->user->first_name"
      :last_name="$post->user->last_name"
      :posting_time="$post->created_at->diffForHumans()"
      :title_post="$post->content"
      :media="$post->media"
      :total_interaction="$post->reactions_count ?? 0"
      :comment="$post->comments_count ?? 0"
      :share="$post->shares_count ?? 0"
      :post="$post"
    />
  @endforeach

  @if ($notPostTab)
    <a href="{{ $user->id == auth()->id() ? route('profile.index', 'post') : route('profile.show', [$user->id, 'post']) }}" class="lihat-semua-post w-full">
      <button class="bg-black/70 text-white w-full font-semibold text-base px-2 py-1.5 cursor-pointer rounded-lg mt-3 hover:bg-black/80"> 
        {{ $user->id === auth()->id()
          ? 'Lihat semua postingan Anda'
          : 'Lihat semua postingan ' . $user->first_name }}
      </button>
    </a>
  @endif
</div>