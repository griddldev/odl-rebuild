@php
  $accordionIcon = \Illuminate\Support\Facades\Vite::asset('resources/images/icons/accordion-open.svg');
@endphp

<section class="split-accordion-block bg-off-white py-14 lg:py-24">
  <div class="container">

    {{-- Header row: heading + subtitle --}}
    @if (!empty($heading) || !empty($subtitle))
      <div class="mb-16 grid grid-cols-1 items-start gap-8 lg:grid-cols-2">
        @if (!empty($heading))
          <h2 class="heading-1 text-dark-blue">{!! wp_kses_post($heading) !!}</h2>
        @endif
        @if (!empty($subtitle))
          <div class="text-large-union text-dark-blue">{!! wp_kses_post($subtitle) !!}</div>
        @endif
      </div>
    @endif

    {{-- Body: image + accordion --}}
    <div class="grid grid-cols-1 items-start gap-10 lg:grid-cols-2 lg:gap-16">

      {{-- Image --}}
      <div>
        @if (!empty($imageUrl))
          <img src="{{ esc_url($imageUrl) }}" alt="{{ esc_attr($imageAlt) }}" loading="lazy"
            class="h-auto w-full object-cover" />
        @endif
      </div>

      {{-- Accordion --}}
      @if (!empty($items))
        <div>
          @foreach ($items as $index => $item)
            <div class="accordion-item border-dark-blue-30 border-b">
              <button class="accordion-trigger flex w-full items-center justify-between py-6 text-left"
                aria-expanded="false">
                @if (!empty($item['title']))
                  <span class="subhead text-dark-blue pr-4">{!! wp_kses_post($item['title']) !!}</span>
                @endif
                <img src="{{ esc_url($accordionIcon) }}" alt="" width="24" height="24"
                  class="accordion-icon shrink-0" aria-hidden="true" />
              </button>

              <div class="accordion-panel">
                <div class="pb-6">
                  @if (!empty($item['content']))
                    <div class="text-dark-blue mb-4">{!! wp_kses_post($item['content']) !!}</div>
                  @endif

                  @if (!empty($item['linkText']) && !empty($item['linkUrl']))
                    <x-button :href="$item['linkUrl']" color="dark-blue">
                      {!! wp_kses_post($item['linkText']) !!}
                    </x-button>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif

    </div>
  </div>
</section>
