<x-layouts.auth title="Login">
  <div class="flex justify-center items-center mt-18 p-4 sm:p-0">
    
    <div class="w-107 shadow-[0_1px_12px_rgba(0,0,0,0.15)] rounded-lg border-gray-300 overflow-hidden flex-col">
      <div class="bg-blue-600 text-white p-3 text-center">
        <h3 class="text-2xl">Login</h3>
      </div>

      <form action="{{route('login.process')}}" method="POST">
        @csrf

        @if ($errors->any())
          <div class="bg-red-100 text-red-700 px-3 py-2 rounded mx-4 mt-4">
            {{ $errors->first() }}
          </div>
        @endif

        <div class="p-4 flex flex-col space-y-4 mt-4">
          <input type="text" name="email" value="{{old('email')}}" class="px-3 py-2 border border-gray-300 rounded focus:outline-none" placeholder="Email" autocomplete="off">

          <div class="relative w-full">
            <input id="loginPassword" type="password" name="password" class="px-3 py-2 border w-full border-gray-300 rounded focus:outline-none" placeholder="Password" autocomplete="off">

            <button id="togglePasswordLogin" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 cursor-pointer text-lg hover:text-gray-600">
              <i id="eyeIcon" class="fa-solid fa-eye"></i>
            </button>
          </div>
        </div>

        <div class="p-4 flex flex-col space-y-2">
          <button type="submit" class="bg-gray-600 hover:bg-gray-700 cursor-pointer text-white rounded p-2">Login</button>
          <p class="text-center text-sm">Don't have any account? <a href="{{route('register')}}" class="underline hover:text-blue-600">Sign Up</a></p>
        </div>

      </form>
    </div>

  </div>
</x-layouts.auth>