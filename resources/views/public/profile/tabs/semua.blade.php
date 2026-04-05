<div class="space-y-6 mt-4 mb-20">
  <x-public.tengah.profile.post :user="$user" :notPostTab="true" />
  <x-public.tengah.profile.tentang :user="$user" />

  <div class="bg-white space-y-2">
    <h3 class="text-2xl font-semibold p-3">Teman Anda</h1>
      
    <div class="grid grid-cols-4 gap-4">
      @for ($i = 0; $i < 4; $i++)
      <x-partials.profile.card-teman />
      @endfor
    </div>
    
    <button class="bg-black/70 rounded-lg text-white font-semibold w-full py-2 cursor-pointer hover:bg-black/80">Lihat teman lainnya</button>
  </div>

  <x-public.tengah.profile.foto />
</div> 