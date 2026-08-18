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
            <div class="crooked-card flex aspect-square flex-col justify-start rounded-sm bg-white p-8 lg:p-10">
              @if (!empty($item['stat']))
                <p class="heading-1 text-dark-blue mb-4">{!! wp_kses_post($item['stat']) !!}</p>
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
      <button class="carousel-prev" aria-label="Previous slide">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
          aria-hidden="true">
          <path d="M19 12H5M5 12l6-6M5 12l6 6" stroke="#e02b44" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
      </button>
      <button class="carousel-next" aria-label="Next slide">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
          aria-hidden="true">
          <path d="M5 12h14M13 6l6 6-6 6" stroke="#e02b44" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
      </button>
    </div>
  @endif

</section>
