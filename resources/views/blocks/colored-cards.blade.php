@php
  $colorMap = [
      'blue' => 'bg-blue',
      'yellow' => 'bg-yellow',
      'pink' => 'bg-pink',
      'teal' => 'bg-teal',
      'off-white' => 'bg-off-white',
  ];
@endphp

<section class="colored-cards-block bg-white py-14 lg:py-28">
  <div class="container">

    {{-- Header row: heading + description --}}
    @if (!empty($heading) || !empty($description))
      <div class="mb-16 grid grid-cols-1 items-start gap-8 lg:grid-cols-2">
        @if (!empty($heading))
          <h2 class="heading-2 text-dark-blue">{!! wp_kses_post($heading) !!}</h2>
        @endif
        @if (!empty($description))
          <div class="text-dark-blue lg:pt-2">{!! wp_kses_post($description) !!}</div>
        @endif
      </div>
    @endif

    {{-- Cards grid --}}
    @if (!empty($cards))
      <div class="grid grid-cols-1 gap-14 lg:grid-cols-3">
        @foreach ($cards as $card)
          @php
            $bgClass = $colorMap[$card['backgroundColor'] ?? 'blue'] ?? 'bg-blue';
          @endphp
          <div class="{{ $bgClass }} flex flex-col justify-between p-8 lg:p-10">
            <div>
              @if (!empty($card['title']))
                <h3 class="heading-3 text-dark-blue mb-6">{!! wp_kses_post($card['title']) !!}</h3>
              @endif

              @if (!empty($card['subtitle']))
                <div class="text-large-union text-dark-blue mb-4">{!! wp_kses_post($card['subtitle']) !!}</div>
              @endif

              @if (!empty($card['body']))
                <div class="text-dark-blue mb-8">{!! wp_kses_post($card['body']) !!}</div>
              @endif
            </div>

            <div class="mt-auto flex flex-col gap-3">
              @if (!empty($card['link1Text']) && !empty($card['link1Url']))
                <a href="{{ esc_url($card['link1Url']) }}"
                  class="button-secondary text-dark-blue decoration-dark-blue decoration-2 underline-offset-8">
                  {!! wp_kses_post($card['link1Text']) !!}
                </a>
              @endif
              @if (!empty($card['link2Text']) && !empty($card['link2Url']))
                <a href="{{ esc_url($card['link2Url']) }}"
                  class="button-secondary text-dark-blue decoration-dark-blue decoration-2 underline-offset-8">
                  {!! wp_kses_post($card['link2Text']) !!}
                </a>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    @endif

  </div>
</section>
