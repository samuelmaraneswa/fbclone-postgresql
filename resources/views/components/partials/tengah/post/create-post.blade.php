<div id="modalCreatePost" class="fixed inset-0 bg-white/50 z-100 w-full h-full shadow-sm flex justify-center items-center hidden">
  <div id="modalContent" class="bg-white rounded-lg shadow w-175 p-4">
    
    <div class="relative">
      <h1 class="font-bold text-xl text-center">Buat Postingan</h1>
      <button id="xModalCreatePost" class="absolute cursor-pointer hover:bg-gray-200 rounded-full px-2 py-1.5 bg-gray-100 right-0 top-0"><i class="fa-solid fa-x"></i></button>
    </div>

    <hr class="my-4 border border-gray-300">

    <div class="flex items-center gap-4">
      <img src="{{asset('images/img-default.png')}}" alt="" class="h-12 w-12 p-1 rounded-full bg-gray-200">
      <div class="">
        <p class="font-semibold">Neswa Tob</p>
        <select name="" id="" class="bg-gray-200 text-xs rounded-lg p-1 font-semibold cursor-pointer">
          <option value="">Teman</option>
          <option value="">Public</option>
          <option value="">Private</option>
        </select>
      </div>
    </div>

    <form id="formCreatePost" enctype="multipart/form-data">
      <div class="mb-22"> 
        <input name="content" type="text" placeholder="Apa yang anda pikirkan, Neswa?" class="py-6 text-xl w-full focus:outline-none">
      </div>

      <input type="file" name="mediaCreatePost[]" multiple accept="image/*,video/*" class="block w-full text-sm text-gray-600
        file:mr-4 file:py-2 file:px-4
        file:rounded-lg file:border-0
        file:text-sm file:font-semibold
        file:bg-blue-50 file:text-blue-700
        hover:file:bg-blue-100 border rounded-lg cursor-pointer border-gray-300" 
      />
      <p id="errorImage" class="text-red-500 text-sm mt-1 hidden"></p>

      <button id="btnCreatePost" type="submit" class="w-full mt-6 rounded-lg bg-black/70 text-white p-2 cursor-pointer hover:bg-black/80">Kirim</button>
    </form>
  </div>
</div>