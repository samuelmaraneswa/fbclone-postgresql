<x-layouts.app>
  <div class="flex items-center justify-center mt-4">
    <div class="space-y-3 w-200 bg-white rounded-lg p-2 pb-10 overflow-x-auto">
      <h1 class="font-semibold text-xl text-center mt-8">Edit Profile</h1>

      <form id="updateProfile" action="{{route('profile.update')}}" method="POST">
        @csrf

        <div class="">
          <div class="flex items-center p-2">
            <label for="" class="w-35 md:w-50">First Name</label>
            <div class="w-full">
              <input type="text" name="first_name" value="{{$user->first_name}}" class="border focus:outline-none w-full rounded-lg px-2 py-1">
              <p class="text-red-500 italic text-xs md:text-base" id="text-error-first_name"></p>
            </div>
          </div>
        </div>
        
        <div class="">
          <div class="flex items-center p-2">
            <label for="" class="w-35 md:w-50">Last Name</label>
            <div class="w-full">
              <input type="text" name="last_name" value="{{$user->last_name}}" class="border focus:outline-none w-full rounded-lg px-2 py-1">
              <p class="text-red-500 italic text-xs md:text-base" id="text-error-last_name"></p>
            </div>
          </div>
        </div>
        
        <div class="">
          <div class="flex items-center p-2">
            <label for="" class="w-35 md:w-50">Date of birth</label>
            <div class="w-full">
              <input type="date" name="date_of_birth" value="{{$user->date_of_birth}}" class="border focus:outline-none w-full rounded-lg px-2 py-1">
              <p class="text-red-500 italic text-xs md:text-base" id="text-error-date_of_birth"></p>
            </div>
          </div>
        </div>
        
        <div class="">
          <div class="flex items-center p-2">
            <label for="" class="w-35 md:w-50">Gender</label>
            <div class="w-full">
              <select name="gender" id="" class="w-full px-2 py-1 rounded-lg border">
                <option value="male" {{$user->gender === "male" ? "selected" : ""}}>Male</option>
                <option value="female" {{$user->gender === "female" ? "selected" : ""}}>Female</option>
              </select>
              <p class="text-red-500 italic text-xs md:text-base" id="text-error-gender"></p>
            </div>
          </div>
        </div>
        
        <div class="">
          <div class="flex items-center p-2">
            <label for="" class="w-35 md:w-50">Email</label>
            <div class="w-full">
              <input type="email" name="email" value="{{$user->email}}" class="border focus:outline-none w-full rounded-lg px-2 py-1" autocomplete="off">
              <p class="text-red-500 italic text-xs md:text-base" id="text-error-email"></p>
            </div>
          </div>
        </div>

        <button id="saveUpdateProfile" class="bg-black/70 hover:bg-black/80 cursor-pointer rounded-lg mx-auto py-1.5 w-full text-white mt-4 mx">Save</button>
      </form>
    </div>
  </div>
</x-layouts.app>