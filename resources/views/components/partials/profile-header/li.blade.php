@props(['icon', 'text', 'arrow' => true, 'type' => 'div', 'action' => null])

@if ($type === 'button')
  <form action="{{$action}}" method="POST">
    @csrf
    <button type="submit" class="w-full">
@endif

<div class="flex items-center hover:bg-gray-100 justify-between text-base p-2 rounded-lg cursor-pointer">
  <div class="flex items-center gap-2">
    <span class="rounded-full bg-gray-200 px-1.5 py-1"><i class="{{$icon}}"></i></span>
    <p>{{$text}}</p>
  </div>

  @if ($arrow)
    <i class="fa-solid fa-angle-right"></i>   
  @endif

  @if ($type === 'button')
      </button>
    </form>
  @endif
</div>