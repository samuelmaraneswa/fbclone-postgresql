@props(['posts', 'users'])

<main class="box-border mx-0 md:mx-85 p-2 space-y-3">
  <x-partials.tengah.top-section />

  <x-partials.tengah.cerita-section />

  <x-partials.tengah.friends-section :users="$users" />

  <div id="postContainer" class="">
    @foreach ($posts as $post)
      <x-partials.tengah.post-section :profile_img="$post->user->avatar ? 'storage/'.$post->user->avatar : 'images/img-default.png'" :first_name="$post->user->first_name" :last_name="$post->user->last_name" :posting_time="$post->created_at->diffForHumans()" :title_post="$post->content" :media="$post->media" :total_interaction="$post->reactions_count ?? 0" :comment="$post->comments_count ?? 0" :share="$post->shares_count ?? 0" :post="$post" />  
    @endforeach
  </div>
</main>