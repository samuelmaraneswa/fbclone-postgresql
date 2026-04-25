@props(['users'])

@if ($users->isNotEmpty())
  <div class="w-full rounded-lg bg-white p-3 shadow-[0_1px_6px_rgba(0,0,0,0.12)]">
    <div class="min-w-37.5">
      <h1 class="font-semibold text-base md:text-lg mb-1">Orang yang mungkin Anda kenal</h1>

      {{-- card --}}
      <div class="flex items-center bg-gray-100 border border-gray-300 rounded-lg gap-2 p-2 overflow-x-auto">
        @foreach ($users as $u)
          <x-partials.tengah.teman.card-teman :user="$u" />  
        @endforeach
      </div>
    </div>
  </div>
@endif