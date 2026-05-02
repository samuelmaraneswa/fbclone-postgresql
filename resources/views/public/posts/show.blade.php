<x-layouts.app>

  <x-partials.tengah.post-section :post="$post" :user="$user" :profile_img="$post->user->avatar? 'storage/'.$post->user->avatar : 'images/img-default.png'" :first_name="$post->user->first_name" :last_name="$post->user->last_name" :posting_time="$post->created_at->diffForHumans()" :title_post="$post->content" :media="$post->media" :total_interaction="$post->reactions_count ?? 0" :comment="$post->comments_count ?? 0" :share="$post->shares_count ?? 0" />

</x-layouts.app>