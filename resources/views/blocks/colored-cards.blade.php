<section class="colored-cards-block bg-white py-14 lg:py-28">
    <div class="container">

        {{-- Header row: heading + description --}}
        @if (!empty($heading) || !empty($description))
            <div class="mb-16 grid grid-cols-1 items-start gap-8 lg:grid-cols-2">
                @if (!empty($heading))
                    <h2 class="heading-2 text-dark-blue">{!! wp_kses_post($heading) !!}</h2>
                @endif
                @if (!empty($description))
                    <p class="text-dark-blue lg:pt-2">{!! wp_kses_post($description) !!}</p>
                @endif
            </div>
        @endif

        {{-- Cards grid --}}
        @if (!empty($cards))
            <div class="grid grid-cols-1 gap-14 lg:grid-cols-3">
                @foreach ($cards as $card)
                    <div class="bg-{{ $card['backgroundColor'] }} flex flex-col justify-between p-6">
                        <div>
                            @if (!empty($card['title']))
                                <h3 class="heading-3 text-dark-blue mb-6 !text-[2rem] md:text-[2.75rem]">
                                    {!! wp_kses_post($card['title']) !!}</h3>
                            @endif

                            @if (!empty($card['subtitle']))
                                <p class="text-large-union text-dark-blue mb-4">{!! wp_kses_post($card['subtitle']) !!}</p>
                            @endif

                            @if (!empty($card['body']))
                                <p class="text-dark-blue mb-8">{!! wp_kses_post($card['body']) !!}</p>
                            @endif
                        </div>

                        <div class="mt-auto flex flex-col gap-3">
                            @if (!empty($card['link1Text']) && !$card['link1']['isEmpty'])
                                <a href="{{ esc_url($card['link1']['url']) }}" target="{{ $card['link1']['target'] }}"
                                    class="button-secondary text-dark-blue decoration-dark-blue decoration-2 underline-offset-8">
                                    {!! $card['link1Text'] !!}
                                </a>
                            @endif
                            @if (!empty($card['link2Text']) && !$card['link2']['isEmpty'])
                                <a href="{{ esc_url($card['link2']['url']) }}" target="{{ $card['link2']['target'] }}"
                                    class="button-secondary text-dark-blue decoration-dark-blue decoration-2 underline-offset-8">
                                    {!! $card['link2Text'] !!}
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>
