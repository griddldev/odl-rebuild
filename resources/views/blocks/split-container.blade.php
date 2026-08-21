<section class="split-container-block bg-off-white py-14 lg:py-28">
    <div class="container">
        <div class="flex flex-col items-start gap-10 lg:flex-row lg:gap-16">

            {{-- Image --}}
            <div class="w-full lg:w-[60%]">
                @if (!empty($imageUrl))
                    <img src="{{ esc_url($imageUrl) }}" alt="{{ esc_attr($imageAlt) }}" loading="lazy"
                        class="h-[250px] w-full object-cover lg:h-auto lg:max-h-[675px]" />
                @endif
            </div>

            {{-- Content --}}
            <div class="lg:w-[40%]">
                @if (!empty($mobileTitle))
                    <p class="callout-small text-dark-blue mb-6 lg:hidden">{!! wp_kses_post($mobileTitle) !!}</p>
                @endif

                @if (!empty($heading))
                    <h2 class="heading-2 text-dark-blue mb-6 hidden lg:block">{!! wp_kses_post($heading) !!}</h2>
                @endif

                @if (!empty($subtitle))
                    <p class="callout-small text-dark-blue mb-6 hidden lg:block">{!! wp_kses_post($subtitle) !!}</p>
                @endif

                @if (!empty($body))
                    <p class="text-dark-blue mb-8">{!! wp_kses_post($body) !!}</p>
                @endif

                <div class="flex flex-col gap-4">
                    @if (!empty($link1Text) && !$link1['isEmpty'])
                        <x-button :href="$link1['url']" :target="$link1['target']" color="dark-blue">
                            {!! wp_kses_post($link1Text) !!}
                        </x-button>
                    @endif
                    @if (!empty($link2Text) && !$link2['isEmpty'])
                        <x-button :href="$link2['url']" :target="$link2['target']" color="dark-blue">
                            {!! wp_kses_post($link2Text) !!}
                        </x-button>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>
