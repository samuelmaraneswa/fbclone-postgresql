@props([
  'img_user_posting' => null,
  'first_name' => null,
  'last_name' => null,
  'created_at' => null,
  'text' => null,
  'total_like' => null,
  'total_comment' => null,
  'total_share' => null,
  'media' => null,
  'img_comment' => null,
  'first_name_user_comment' => null,
  'last_name_user_comment' => null,
  'comment' => null,
  'my_img' => null,
  ])

<div id="modalPost" class="modal-post fixed inset-0 bg-black z-50 hidden">
  <div id="modalPostContent" class="modal-post-content shadow rounded-lg h-screen flex relative">

    {{-- kiri section: tombol close dan fb brands --}}
    <div class="relative">

      <div class="md:block">
        <button id="modalPostCloseBtn" class="z-50 absolute md:left-2 top-1 md:top-5 cursor-pointer hover:bg-gray-200 rounded-full text-white md:text-black md:bg-gray-100 p-1 h-10 w-10"><i class="fa-solid fa-x"></i></button>

        <button class="absolute hidden md:flex items-center justify-center left-14 top-5 cursor-pointer rounded-full bg-white text-blue-600 h-10 w-10 z-50 hover:bg-gray-100 hover:text-blue-700"><i class="fa-brands fa-facebook text-[42px]"></i></button>
      </div>

    </div>

    {{-- media --}}
    <div id="modalPostMediaWrapper" class="modal-post-media-wrapper md:w-[70%] bg-black absolute md:relative inset-0 md:flex md:items-center md:justify-center"> 

      {{-- <img id="modalPostMedia" src="{{$media ?? asset('images/post-default.png')}}" alt="" class="modal-media w-full h-full md:max-w-full md:max-h-full object-contain"> --}}

      <div class="modal-media-container w-full h-full md:max-w-full md:max-h-full object-contain"></div>

      <button class="modal-post-prev md:absolute left-2 cursor-pointer hover:bg-gray-200 top-1/2 -translate-y-1/2 bg-gray-100 rounded-full text-2xl px-1 py-1 hidden">
        <i class="fa-solid fa-angle-left"></i>
      </button>

      <button class="modal-post-next md:absolute right-2 cursor-pointer hover:bg-gray-200 top-1/2 -translate-y-1/2 bg-gray-100 rounded-full text-2xl px-1 py-1 hidden">
        <i class="fa-solid fa-angle-right"></i>
      </button>

    </div>

    {{-- kanan section: like, comment and sharing --}}
    <div id="modalPostSidebar" class="modal-post-sidebar absolute md:relative bottom-0 md:w-[30%] bg-none text-white md:text-black md:bg-white p-3"> 

      <div id="modalPostHeader" class="modal-post-header flex items-center gap-2">
        {{-- top kanan --}}
        <img id="modalPostProfile" src="{{$img_user_posting ?? asset('images/img-default.png')}}" alt="" class="modal-post-profile h-10.5 w-10 border border-gray-200 rounded-full object-cover">
        <div class="">
          <h3 id="modalPostUsername" class="modal-post-username font-semibold">{{($first_name || $last_name) ? $first_name . ' ' . $last_name : 'User1' }}</h3>
          <p id="modalPostTime" class="modal-post-time text-gray-500 text-xs font-semibold">{{$created_at ?? '12 jam'}}</p>
        </div>
      </div>

      {{-- title post --}}
      <p id="modalPostText" class="modal-post-text mt-1">{{$text ?? 'Title post'}}</p>

      <div class="modal-action mt-4 flex gap-2 md:gap-1 md:justify-between">

        <div class="">
          <button id="modalLikeIcon" class="modal-like-icon rounded-full h-6 w-6 md:bg-gray-200 hover:bg-gray-300 cursor-pointer text-blue-600"><i class="fa-solid fa-thumbs-up"></i></button>
          <span class="modal-like-count -ml-1 md:ml-0">{{$total_like ?? '0'}}</span>
        </div>

        <div class="flex items-center gap-2">
          <div class="">
            <button id="modalCommentIcon" class="modal-comment-icon rounded-full h-6 w-6 text-gray-500 md:bg-gray-200 hover:bg-gray-300 cursor-pointer"><i class="fa-solid fa-comment"></i></button>
            <span class="modal-comment-count -ml-1 md:ml-0">{{$total_comment ?? '0'}}</span>
          </div>

          <div class="">
            <button id="modalShareIcon" class="modal-share-icon rounded-full h-6 w-6 text-gray-500 md:bg-gray-200 hover:bg-gray-300 cursor-pointer"><i class="fa-solid fa-share"></i></button>
            <span class="modal-share-count -ml-1 md:ml-0">{{$total_share ?? '0'}}</span>
          </div>
        </div>

      </div>

      {{-- button like, comment and share --}}
      <div class="modal-bottom-action w-full md:flex items-center justify-between text-lg text-gray-600 mt-2 hidden">

        <div id="modalBtnLike" class="modal-btn-like flex-1 flex items-center justify-center">
          <button class="flex items-center justify-center gap-2 hover:bg-gray-100 rounded-lg cursor-pointer px-2 py-1"><i class="fa-solid fa-thumbs-up"></i><p>Suka</p></button>
        </div>

        <div id="modalBtnComment" class="modal-btn-comment flex-1 flex items-center justify-center">
          <button class="flex items-center justify-center gap-2 hover:bg-gray-100 rounded-lg cursor-pointer px-2 py-1"><i class="fa-solid fa-comment"></i><p>Comment</p></button>
        </div>

        <div id="modalBtnShare" class="modal-btn-share flex-1 flex items-center justify-center">
          <button class="flex items-center justify-center gap-2 hover:bg-gray-100 rounded-lg cursor-pointer px-2 py-1"><i class="fa-solid fa-share"></i><p>Share</p></button>
        </div>
      </div>

      {{-- comment section --}}
      <div id="modalCommentList" class="modal-comment-list hidden md:flex items-start gap-2 border border-gray-300 rounded-lg p-2 mt-2 fixed md:static h-full md:h-auto bg-white inset-0 z-70">
        {{-- top kanan --}}
        <img src="{{$img_comment ?? asset('images/img-default.png')}}" alt="" class="md:static h-9.5 w-9 bg-gray-100 border border-gray-200 rounded-full">

        <div class=" bg-gray-100 rounded-lg p-1">
          <h3 class="font-semibold text-black">{{($first_name_user_comment || $last_name_user_comment) ? $first_name_user_comment . ' ' . $last_name_user_comment : 'Comment name'}}</h3>

          {{-- comment teks --}}
          <p class="text-gray-500">{{$comment ?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum sunt voluptates porro rem nesciunt distinctio repellendus ex repudiandae voluptatem ipsam.'}}</p>
        </div>
      </div>

      <div id="modalCommentInput" class="modal-comment-input hidden md:bottom-1 p-2 rounded-lg w-full md:flex items-center gap-2 fixed z-80 bg-none bottom-0 left-0 md:absolute md:left-auto">
        <img src="{{$my_image ?? asset('images/img-default.png')}}" alt="" class="hidden md:block md:static h-10 w-10 rounded-full bg-gray-200">
        <div class="relative flex items-center w-full">
          <input type="text" class="text-black border w-full md:w-[98%] rounded py-1 pl-1.5 pr-4 focus:outline-none bg-gray-200 border-gray-300" placeholder="Tulis komentar...">

          <button class="modal-send absolute right-3 text-gray-500 cursor-pointer"><i class="fa-solid fa-paper-plane cursor-pointer"></i></button>
        </div>
      </div>

    </div>
  </div>
</div>