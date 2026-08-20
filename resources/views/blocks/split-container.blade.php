<section class="split-container-block bg-off-white py-14 lg:py-28">
  <div class="container">
    <div class="flex flex-col items-start gap-10 lg:flex-row lg:gap-16">

      {{-- Image --}}
      <div class="w-full lg:w-1/2">
        @if (!empty($imageUrl))
          <img src="{{ esc_url($imageUrl) }}" alt="{{ esc_attr($imageAlt) }}" loading="lazy"
            class="h-[250px] w-full object-cover lg:h-auto lg:max-h-[675px]" />
        @endif
      </div>

      {{-- Content --}}
      <div class="lg:w-1/2">
        @if (!empty($mobileTitle))
          <div class="callout-small text-dark-blue mb-6 lg:hidden">{!! wp_kses_post($mobileTitle) !!}</div>
        @endif

        @if (!empty($heading))
          <h2 class="heading-2 text-dark-blue mb-6 hidden lg:block">{!! wp_kses_post($heading) !!}</h2>
        @endif

        @if (!empty($subtitle))
          <div class="callout-small text-dark-blue mb-6 hidden lg:block">{!! wp_kses_post($subtitle) !!}</div>
        @endif

        @if (!empty($body))
          <div class="text-dark-blue mb-8">{!! wp_kses_post($body) !!}</div>
        @endif

        <div class="flex flex-col gap-4">
          @if (!empty($link1Text) && !empty($link1Url))
            <x-button :href="$link1Url" color="dark-blue">
              {!! wp_kses_post($link1Text) !!}
            </x-button>
          @endif
          @if (!empty($link2Text) && !empty($link2Url))
            <x-button :href="$link2Url" color="dark-blue">
              {!! wp_kses_post($link2Text) !!}
            </x-button>
          @endif
        </div>
      </div>

    </div>
  </div>
</section>
