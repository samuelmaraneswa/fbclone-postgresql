@props([
  'profile_img' => 'images/img-default.png',
  'name' => null,
  'posting_time' => null,
  'title_post' => null,
  'img_post' => null,
  'total_interaction' => null,
  'comment' => null,
  'share' => null,
  ])

<div class="bg-white rounded-lg border border-gray-200 shadow-[0_1px_6px_rgba(0,0,0,0.12)]">
  {{-- header post start --}}
  <div class="flex items-center justify-between p-3">
    <div class="flex items-start gap-3">
      @isset($profile_img)
        <img src="{{asset($profile_img)}}" alt="" class="w-11 h-11 cursor-pointer rounded-full bg-gray-100 p-1">  
      @endisset
 
      <div class="">
        @isset($name)
          <a href="" class="font-semibold">{{$name}}</a>
        @endisset

        @isset($posting_time)
          <p class="text-gray-500 text-sm font-semibold">{{$posting_time}}</p>
        @endisset
      </div>

      <a href="" class="text-blue-600 font-semibold">Ikuti</a>
    </div>
    <div class="flex items-center gap-3">
      <button class="px-1.5 py-1 rounded-full cursor-pointer p-2 text-base text-gray-500 hover:bg-gray-200"><i class="fa-solid fa-ellipsis"></i></button>
      <button class="px-1.5 py-1 rounded-full cursor-pointer p-2 text-base text-gray-500 hover:bg-gray-200"><i class="fa-solid fa-x"></i></button>
    </div>
  </div>
  {{-- header post end --}}

  {{-- body post start --}}
  <div class="">
    @isset($title_post)
      <p class="-mt-2 pl-4 pb-2" class="">{{$title_post}}</p>
    @endisset

    @if($img_post)
      <img src="{{asset($img_post)}}" alt="" class="w-full h-auto object-contain bg-black max-h-150">
    @endif
  </div>
  {{-- body post end --}}

  {{-- bottom post top section start --}}
  <div class="flex items-center py-2 px-3 justify-between">

    {{-- like & heart start --}}
    <div class="text-xs relative flex items-center gap-2">
      <div class="flex items-center">

        <div class="group relative tooltip-parent">
          <button class="p-0.5 cursor-pointer rounded-full bg-blue-400 text-white border-2 border-white relative z-10"><i class="fa-solid fa-thumbs-up"></i></button>

          <x-partials.tooltip-post title="Suka" />
        </div>

        <div class="group relative tooltip-parent">
          <button class="p-0.5 cursor-pointer rounded-full bg-red-400 text-white -ml-2 relative"><i class="fa-solid fa-heart"></i></button>

          <x-partials.tooltip-post title="Super" />
        </div>

      </div>
      
      <div class="flex items-center">

        @isset($total_interaction)
          <p class="text-gray-500 text-base">{{$total_interaction}}</p>  
        @endisset
        
      </div>
    </div>
    {{-- like & heart end --}}

    
    {{-- commetn & share start --}}
    <div class="text-base gap-2 flex items-center">
      <div class="flex items-center gap-1">

        @isset($comment)
          <p class="text-gray-500">{{$comment}}</p>  
        @endisset
        
        <div class="group relative tooltip-parent">
          <button class="p-0.5 cursor-pointer rounded-full text-gray-500">
            <i class="fa-solid fa-comment"></i>
          </button>

          <x-partials.tooltip-post />
        </div>
      </div>

      <div class="flex items-center gap-1">
        
        @isset($share)
          <p class="text-gray-500">{{$share}}</p>  
        @endisset

        <div class="group relative tooltip-parent">
          <button class="p-0.5 cursor-pointer rounded-full text-gray-500">
            <i class="fa-solid fa-share"></i>
          </button>

          <x-partials.tooltip-post />
        </div>
      </div>
    </div>
    {{-- comment & share end --}}
  </div>
  {{-- bottom post top section end --}}

  <hr class="border-gray-500 mx-3">


  {{-- bottom post bottom section start --}}
  <div class="flex items-center text-gray-500 justify-between text-lg px-3 py-1 gap-2">

    {{-- like start --}}
    <div class="relative group flex items-center gap-1 hover:bg-gray-100 justify-center rounded-lg cursor-pointer py-1 flex-1">
      <button><i class="fa-solid fa-thumbs-up"></i></button>
      <p>Suka</p>

      {{-- tooltip like --}}
      <div class="absolute flex bottom-full bg-white rounded-full border border-gray-200 shadow-[0_1px_12px_rgba(0,0,0,0.12)] p-1 text-3xl gap-2 left-0 opacity-0 translate-y-2 scale-95 pointer-events-none transition-all duration-200 ease-out group-hover:opacity-100 group-hover:translate-y-0 group-hover:scale-100 group-hover:pointer-events-auto z-30">

        <button class="p-1 bg-blue-500 text-white rounded-full cursor-pointer"><i class="fa-solid fa-thumbs-up"></i></button>
        <button class="p-1 bg-red-500 text-white rounded-full cursor-pointer"><i class="fa-solid fa-heart"></i></button>
        <button class="p-1 bg-yellow-500 text-white rounded-full cursor-pointer"><i class="fa-solid fa-face-kiss"></i></button>
        <button class="p-1 bg-blue-500 text-white rounded-full cursor-pointer"><i class="fa-solid fa-face-laugh"></i></button>
        <button class="p-1 bg-red-500 text-white rounded-full cursor-pointer"><i class="fa-solid fa-face-angry"></i></button>

      </div>
    </div>
    {{-- like end --}}

    <div class="flex items-center gap-1 hover:bg-gray-100 justify-center rounded-lg cursor-pointer py-1 flex-1">
      <button class=""><i class="fa-solid fa-comment"></i></button>
      <p>Komentari</p>
    </div>

    <div class="flex items-center gap-1 hover:bg-gray-100 justify-center rounded-lg cursor-pointer py-1 flex-1">
      <button><i class="fa-solid fa-share"></i></button>
      <p>Bagikan</p>
    </div>
  </div>
  {{-- bottom post bottom section end --}}
</div>