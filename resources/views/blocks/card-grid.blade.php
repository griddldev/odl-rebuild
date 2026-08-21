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
                        <p class="callout-small text-dark-blue mb-10">{!! wp_kses_post($subtitle) !!}</p>
                    @endif

                    @if (!empty($body))
                        <p class="text-dark-blue mb-8">{!! wp_kses_post($body) !!}</p>
                    @endif
                </div>

                <div class="absolute -bottom-[20%] right-0 hidden md:block">
                    <img class="w-[450px]"
                        src="{{ Illuminate\Support\Facades\Vite::asset('resources/images/icons/arrows-up.svg') }}"
                        alt="" aria-hidden="true" />
                </div>
            </div>

            {{-- Right: 2x2 card grid --}}
            @if (!empty($cards))
                <div class="relative grid grid-cols-1 gap-3 sm:grid-cols-2 lg:w-2/3">
                    <div class="z-1 absolute right-[-35px] top-[-70px] block md:hidden">
                        <img class="w-[150px]"
                            src="{{ Illuminate\Support\Facades\Vite::asset('resources/images/icons/arrows-up.svg') }}"
                            alt="" aria-hidden="true" />
                    </div>

                    @foreach ($cards as $card)
                        <div
                            class="bg-{{ $card['backgroundColor'] }} z-1 flex flex-col justify-between overflow-hidden p-8 md:aspect-square lg:p-10">
                            <div>
                                @if (!empty($card['title']))
                                    <h3 class="heading-3 text-dark-blue mb-4">{!! wp_kses_post($card['title']) !!}</h3>
                                @endif

                                @if (!empty($card['subtitle']))
                                    <p class="text-large-union text-dark-blue mb-3">{!! wp_kses_post($card['subtitle']) !!}</p>
                                @endif

                                @if (!empty($card['body']))
                                    <p class="text-dark-blue mb-6">{!! wp_kses_post($card['body']) !!}</p>
                                @endif
                            </div>

                            @if (!empty($card['linkText']) && !$card['link']['isEmpty'])
                                <a href="{{ esc_url($card['link']['url']) }}" target="{{ $card['link']['target'] }}"
                                    class="button-secondary text-dark-blue decoration-2 underline-offset-8">
                                    {!! $card['linkText'] !!}
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</section>
