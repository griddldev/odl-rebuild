@php
  $colorMap = [
      'blue' => 'bg-blue',
      'yellow' => 'bg-yellow',
      'pink' => 'bg-pink',
      'teal' => 'bg-teal',
      'off-white' => 'bg-off-white',
  ];
@endphp

<section class="card-grid-block py-14 lg:py-24">
  <div class="container">
    <div class="grid grid-cols-1 items-start gap-10 lg:grid-cols-3">

      {{-- Left column: intro --}}
      <div class="flex flex-col justify-between lg:row-span-2">
        @if (!empty($heading))
          <h2 class="heading-1 text-dark-blue mb-6">{!! wp_kses_post($heading) !!}</h2>
        @endif

        @if (!empty($subtitle))
          <div class="callout-small text-dark-blue mb-6">{!! wp_kses_post($subtitle) !!}</div>
        @endif

        @if (!empty($body))
          <div class="text-dark-blue mb-8">{!! wp_kses_post($body) !!}</div>
        @endif
      </div>

      {{-- Right: 2x2 card grid --}}
      @if (!empty($cards))
        @foreach ($cards as $card)
          @php
            $bgClass = $colorMap[$card['backgroundColor'] ?? 'blue'] ?? 'bg-blue';
          @endphp
          <div
            class="{{ $bgClass }} flex aspect-square flex-col justify-between overflow-hidden rounded-sm p-8 lg:p-10">
            <div>
              @if (!empty($card['title']))
                <h3 class="heading-3 text-dark-blue mb-4">{!! wp_kses_post($card['title']) !!}</h3>
              @endif

              @if (!empty($card['subtitle']))
                <div class="text-large-union text-dark-blue mb-3">{!! wp_kses_post($card['subtitle']) !!}</div>
              @endif

              @if (!empty($card['body']))
                <div class="text-dark-blue mb-6">{!! wp_kses_post($card['body']) !!}</div>
              @endif
            </div>

            @if (!empty($card['linkText']) && !empty($card['linkUrl']))
              <a href="{{ esc_url($card['linkUrl']) }}"
                class="primary-nav text-dark-blue decoration-dark-blue underline decoration-2 underline-offset-8">
                {!! wp_kses_post($card['linkText']) !!}
              </a>
            @endif
          </div>
        @endforeach
      @endif

    </div>
  </div>
</section>
