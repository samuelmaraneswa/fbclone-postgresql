<x-layouts.auth title="Verify Email">
  <div class="flex mt-15 justify-center">

    <div class="bg-gray-100 w-100 rounded-lg overflow-hidden shadow">
      <div class="bg-blue-500 text-white text-lg p-3">
        <h3>Verify Email</h3>
      </div>
      <div class="p-4">
        <p>Kami sudah mengirim link verifikasi ke email Anda. Silahkan cek inbox (atau spam).</p>
      </div>

      <hr class="border-gray-300 mb-2">

      @if (session('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-3">
          {{ session('message') }}
        </div>
      @endif

      <div class="p-3">
        <form method="POST" action="{{route('verification.send')}}">
          @csrf

          <button type="submit" class="bg-blue-500 hover:bg-blue-600 cursor-pointer text-white p-3 rounded-lg">Kirim Ulang Email</button>
        </form>
      </div>
    </div>

  </div>
</x-layouts.auth>