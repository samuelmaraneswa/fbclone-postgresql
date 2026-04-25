<x-layouts.auth title="Register">
  <form id="formRegister" action="{{route('register')}}" method="POST">
    @csrf

    <div class="flex justify-center items-center bg-gray-100 pb-8 p-4 sm:p-0">
      
      <div class="w-150 overflow-hidden flex-col">
        <div class="p-4 mt-2">
          <h3 class="text-2xl font-semibold">Get Started With Facebook</h3>
          <p class="mt-2">Create an account to connect with friends, family and communities of people who share your interests.</p>
        </div>

        <div class="px-4 py-2 flex flex-col space-y-2">
          <p class="font-semibold text-xl">Name</p>

          <div class="w-full flex flex-col items-center sm:flex-row gap-4">

            <div class="flex flex-col flex-1 w-full">
              <input type="text" name="first_name" class="px-3 py-2 border w-full sm:flex-1 border-gray-300 rounded focus:outline-none" placeholder="First name" autocomplete="off">
              <p id="error-first_name" class="text-sm text-red-500"></p>
            </div>
            
            <div class="flex flex-col flex-1 w-full">
              <input type="text" name="last_name" class="px-3 py-2 border w-full sm:flex-1 border-gray-300 rounded focus:outline-none" placeholder="Surname" autocomplete="off">
              <p id="error-last_name" class="text-sm text-red-500"></p>
            </div>

          </div>
        </div>
        
        <div class="px-4 py-2 flex flex-col space-y-2">
          <p class="font-semibold text-xl">Date of Birth</p>

          <input type="date" name="date_of_birth" class="border border-gray-300 rounded-lg px-3 py-2 text-gray-700">
          <p id="error-date_of_birth" class="text-sm text-red-500"></p>
        </div>
        
        <div class="px-4 py-2 flex flex-col space-y-2">
          <p class="font-semibold text-xl">Gender</p>
          
          <select name="gender" id=""  class="border border-gray-300 rounded-lg px-3 py-2 text-gray-700">
            <option value="">Select your gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
          <p id="error-gender" class="text-sm text-red-500"></p>
        </div>
        
        <div class="px-4 py-2 flex flex-col space-y-2">
          <p class="font-semibold text-xl">Email</p>

          <input type="email" name="email" class="border border-gray-300 rounded-lg px-3 py-2 text-gray-700" placeholder="Email">
          <p id="error-email" class="text-sm text-red-500"></p>
        </div>
        
        <div class="px-4 py-2 flex flex-col space-y-2">
          <p class="font-semibold text-xl">Password</p>

          <input type="password" name="password" class="border border-gray-300 rounded-lg px-3 py-2 text-gray-700" placeholder="Password">
          <p id="error-password" class="text-sm text-red-500"></p>
        </div>

        <div class="p-4 flex flex-col space-y-2">
          <button id="submitRegister" class="bg-gray-600 hover:bg-gray-700 cursor-pointer text-white rounded p-2">Submit</button>
          <p class="text-center text-sm">I already have an account. <a href="{{route('login')}}" class="underline hover:text-blue-600">Sign In</a></p>
        </div>
      </div>

    </div>
  </form>
</x-layouts.auth>