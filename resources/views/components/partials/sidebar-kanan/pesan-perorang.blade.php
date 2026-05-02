<div id="chatUserBox" class="hidden fixed max-md:top-23 max-md:left-0 bottom-0 max-md:right-0 md:right-25 max-md:h-[calc(100%-5.7rem)] md:h-110 md:w-85 overflow-y-auto bg-gray-100 md:bg-white px-4 py-2 rounded-lg shadow-[0_2px_8px_rgba(0,0,0,0.15),0_4px_16px_rgba(0,0,0,0.1)] hover:shadow-[0_4px_12px_rgba(0,0,0,0.2),0_8px_24px_rgba(0,0,0,0.15)] transition overscroll-contain z-60">
  
  <div class="relative">
    <button data-close="chatUserBox" class="absolute right-0 top-0 text-purple-500 cursor-pointer"><li class="fa-solid fa-x"></li></button>
    
    <div class="flex items-center gap-2">
      <img id="chatUserAvatar" src="" alt="" class="h-8 w-8 rounded-full bg-gray-100 object-cover">
      <p id="chatUserName" class="font-semibold"></p>
    </div>
  </div>

  <hr class=" text-gray-300 my-3 -mx-4">

  {{-- isi pesan --}}
  <div id="chatMessages" class="overflow-y-auto max-md:h-[calc(100%-3rem)] md:max-h-80">
    
  </div>

  <div class="absolute bottom-2 right-0 px-4 left-0 flex items-center">
    <input 
      id="chatInput"
      data-send-message
      type="text" 
      placeholder="Aa" 
      class="bg-gray-200 rounded-full px-3 py-1 focus:outline-none w-full"
    >
    <button data-send-message class="hidden cursor-pointer">
      <i class="fa-solid fa-paper-plane text-gray-500"></i>
    </button>
  </div>
</div>