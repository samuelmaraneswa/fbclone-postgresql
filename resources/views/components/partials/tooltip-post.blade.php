@props(['title' => null])

<div class="hidden md:block absolute bg-black/70 p-2 rounded-lg text-xs text-white pointer-events-none max-w-[90vw] wrap-break-word opacity-0 invisible group-hover:opacity-100 group-hover:pointer-events-auto group-hover:visible transition duration-200 z-30 tooltip-child left-1/2 -translate-x-1/2">
  <ul>
    @if ($title)
      <li class="font-semibold mb-0.5">{{$title}}</li>  
    @endif

    <li>Annga Pangestu</li>
    <li>Nina Laraswati Setyaningsih</li>
    <li>Zack Smith</li>
    <li>Zack Smith</li>
    <li>Zack Smith</li>
    <li>Zack Smith</li>
    <li>Zack Smith</li>
    <li>Zack Smith</li>
    <li>Zack Smith</li>
    <li>Zack Smith</li>
    <li>Zack Smith</li>
    <li>Zack Smith</li>
  </ul>
</div>