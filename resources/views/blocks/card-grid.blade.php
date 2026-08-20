@php
  $colorMap = [
      'blue' => 'bg-blue',
      'yellow' => 'bg-yellow',
      'pink' => 'bg-pink',
      'teal' => 'bg-teal',
      'off-white' => 'bg-off-white',
  ];
@endphp

<section class="card-grid-block overflow-hidden bg-white py-14 lg:py-28">
  <div class="container">
    <div class="flex flex-col gap-16 lg:flex-row">

      {{-- Left column: intro --}}
      <div class="relative flex flex-col justify-between lg:w-1/3">
        <div>
          @if (!empty($heading))
            <h2 class="heading-2 text-dark-blue mb-16">{!! wp_kses_post($heading) !!}</h2>
          @endif

          @if (!empty($subtitle))
            <div class="callout-small text-dark-blue mb-10">{!! wp_kses_post($subtitle) !!}</div>
          @endif

          @if (!empty($body))
            <div class="text-dark-blue mb-8">{!! wp_kses_post($body) !!}</div>
          @endif
        </div>

        <div class="absolute -bottom-[20%] right-0">
          <img class="w-[450px]"
            src="{{ Illuminate\Support\Facades\Vite::asset('resources/images/icons/arrows-up.svg') }}" alt=""
            aria-hidden="true" />
        </div>
      </div>

      {{-- Right: 2x2 card grid --}}
      @if (!empty($cards))
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:w-2/3">
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
        </div>
      @endif

    </div>
  </div>
</section>
