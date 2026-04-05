@props(['user'])

<div class="flex flex-col bg-white shadow-sm rounded-lg p-4 mt-2">
  <h1 class="font-semibold text-2xl my-2">Detail Pribadi</h1>
  
  <div class="w-250 text-gray-700 font-semibold">
    <table class="w-full">
      <body>
        <tr>
          <td class="p-1">First Name</td>
          <td class="p-1">: {{$user->first_name}}</td>
        </tr>
        <tr>
          <td class="p-1">Last Name</td>
          <td class="p-1">: {{$user->last_name}}</td>
        </tr>
        <tr>
          <td class="p-1">Tanggal lahir</td>
          <td class="p-1">: {{$user->date_of_birth}}</td>
        </tr>
        <tr>
          <td class="p-1">Gender</td>
          <td class="p-1">: {{$user->gender}}</td>
        </tr>
        <tr>
          <td class="p-1">Email</td>
          <td class="p-1">: {{$user->email}}</td>
        </tr>
      </body>
    </table>
  </div>
</div>