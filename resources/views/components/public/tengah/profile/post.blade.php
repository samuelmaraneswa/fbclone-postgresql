@props(['user', 'notPostTab' => false])

<div class="flex flex-col bg-white shadow-sm rounded-lg p-4 mt-2">
  <h1 class="font-semibold text-lg md:text-2xl my-2">Postingan Anda</h1>
  
  @if ($notPostTab)
    <p class="text-gray-500 mb-2">Postingan terbaru</p>  
  @endif
  
  <x-partials.tengah.post-section profile_img="images/img-default.png" name="Bella Andine" posting_time="12 Jam" img_post="images/posts/g4.jpg" total_interaction="230" comment="30" share="3" />

  @if ($notPostTab)
    <button class="bg-black/70 text-white font-semibold text-base px-2 py-1.5 cursor-pointer rounded-lg mt-3">Lihat semua Postingan Anda</button>
  @endif
</div>