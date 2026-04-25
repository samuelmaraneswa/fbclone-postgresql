<x-layouts.app>
  <x-public.sidebar-kiri.sidebar-kiri :user="$user" />

  <x-public.tengah.tengah :users="$users" :posts="$posts" />

  <x-public.sidebar-kanan.sidebar-kanan />
</x-layouts.app>