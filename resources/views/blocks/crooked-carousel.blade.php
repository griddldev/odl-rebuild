<section class="crooked-carousel-block bg-blue py-14 lg:py-24">
  <div class="container">

    {{-- Header --}}
    @if (!empty($heading))
      <h2 class="heading-2 text-dark-blue mb-4 text-center">{!! wp_kses_post($heading) !!}</h2>
    @endif

    @if (!empty($subtitle))
      <div class="text-large-union text-dark-blue mb-16 text-center">{!! wp_kses_post($subtitle) !!}</div>
    @endif

  </div>

  {{-- Carousel --}}
  @if (!empty($items))
    <div class="swiper px-6">
      <div class="swiper-wrapper pb-8">
        @foreach ($items as $item)
          <div class="swiper-slide">
            <div class="crooked-card flex aspect-square flex-col justify-start rounded-sm bg-white p-4 lg:p-10">
              @if (!empty($item['stat']))
                <p class="stat text-dark-blue mb-4">{!! wp_kses_post($item['stat']) !!}</p>
              @endif

              @if (!empty($item['description']))
                <div class="text-large-union text-dark-blue">{!! wp_kses_post($item['description']) !!}</div>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    </div>

    {{-- Navigation arrows --}}
    <div class="mt-8 flex items-center justify-center gap-4">
      <button class="carousel-prev bg-off-white p-2" aria-label="Previous slide">
        <img src="{{ Illuminate\Support\Facades\Vite::asset('resources/images/icons/button-arrow-default.svg') }}"
          alt="" class="h-4 w-auto rotate-180" aria-hidden="true" />
      </button>
      <button class="carousel-next bg-off-white p-2" aria-label="Next slide">
        <img src="{{ Illuminate\Support\Facades\Vite::asset('resources/images/icons/button-arrow-default.svg') }}"
          alt="" class="h-4 w-auto" aria-hidden="true" />
      </button>
    </div>
  @endif

</section>
