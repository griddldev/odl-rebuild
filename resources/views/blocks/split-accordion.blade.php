@php
    $accordionIcon = \Illuminate\Support\Facades\Vite::asset('resources/images/icons/accordion-open.svg');
@endphp

<section class="split-accordion-block bg-off-white py-14 lg:py-24">
    <div class="container">

        {{-- Header row: heading + subtitle --}}
        @if (!empty($heading) || !empty($subtitleFaded) || !empty($subtitleMain))
            <div class="mb-16 grid grid-cols-1 items-start gap-8 lg:grid-cols-2">
                @if (!empty($heading))
                    <div class="flex flex-col items-start gap-6 md:flex-row md:items-center">
                        <h2 class="heading-2 text-dark-blue stagger-title">
                            @foreach (preg_split('/\s+/', wp_strip_all_tags($heading)) as $word)
                                @if ($word !== '')
                                    <span class="stagger-word">{{ esc_html($word) }}</span>
                                @endif
                            @endforeach
                        </h2>
                        <div class="chevron-group relative ml-0 md:ml-6">
                            <img src="{{ Illuminate\Support\Facades\Vite::asset('resources/images/icons/chevron-right.svg') }}"
                                alt="" class="chevron-arrow w-[65px] shrink-0" aria-hidden="true" />
                            <img src="{{ Illuminate\Support\Facades\Vite::asset('resources/images/icons/chevron-right.svg') }}"
                                alt="" class="chevron-arrow w-[65px] shrink-0" aria-hidden="true" />
                            <img src="{{ Illuminate\Support\Facades\Vite::asset('resources/images/icons/chevron-right.svg') }}"
                                alt="" class="chevron-arrow w-[65px] shrink-0" aria-hidden="true" />
                        </div>
                    </div>
                @endif
                @if (!empty($subtitleFaded) || !empty($subtitleMain))
                    <div>
                        @if (!empty($subtitleFaded))
                            <p class="callout text-dark-blue opacity-50">{!! wp_kses_post($subtitleFaded) !!}</p>
                        @endif
                        @if (!empty($subtitleMain))
                            <p class="callout text-dark-blue">{!! wp_kses_post($subtitleMain) !!}</p>
                        @endif
                    </div>
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
                                    <span class="heading-3-small text-dark-blue pr-4">{!! wp_kses_post($item['title']) !!}</span>
                                @endif
                                <img src="{{ esc_url($accordionIcon) }}" alt="" width="40" height="40"
                                    class="accordion-icon shrink-0" aria-hidden="true" />
                            </button>

                            <div class="accordion-panel">
                                <div class="pb-6">
                                    @if (!empty($item['content']))
                                        <p class="text-dark-blue mb-4">{!! wp_kses_post($item['content']) !!}</p>
                                    @endif

                                    @if (!empty($item['linkText']) && !$item['link']['isEmpty'])
                                        <x-button :href="$item['link']['url']" :target="$item['link']['target']" color="dark-blue">
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
