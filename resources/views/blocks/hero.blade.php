<section class="hero-block relative flex flex-col" data-playing="true" data-muted="true">
  <div class="relative h-full min-h-[950px] overflow-hidden md:h-[75vh] md:min-h-0">

    {{-- Background video --}}
    @if (!empty($videoUrl))
      <video class="hero-video absolute inset-0 h-full w-full object-cover" autoplay muted loop playsinline
        @if (!empty($backgroundImageUrl)) poster="{{ esc_url($backgroundImageUrl) }}" @endif>
        <source src="{{ esc_url($videoUrl) }}" type="video/mp4">
      </video>
    @elseif (!empty($backgroundImageUrl))
      {{-- Fallback image when no video --}}
      <img src="{{ esc_url($backgroundImageUrl) }}" alt="{{ esc_attr($backgroundImageAlt) }}"
        class="absolute inset-0 h-full w-full object-cover" loading="eager" />
    @endif

    {{-- Overlay --}}
    <div class="bg-dark-blue/40 absolute inset-0"></div>

    {{-- Heading --}}
    @if (!empty($heading))
      <div class="absolute inset-0 flex items-center justify-center px-6">
        <h1 class="heading-1-home max-lg:text-h2 text-center text-white">{!! $heading !!}</h1>
      </div>
    @endif

    {{-- Video controls --}}
    @if (!empty($videoUrl))
      <div class="bg-off-white absolute right-0 top-[75%] flex -translate-y-1/2 flex-col items-center gap-3 md:top-1/2">
        <button class="hero-play-btn bg-off-white flex items-center justify-center p-6" aria-label="Pause video">
          <img class="hero-icon-pause"
            src="{{ Illuminate\Support\Facades\Vite::asset('resources/images/icons/pause-32.svg') }}" alt=""
            aria-hidden="true" />
          <img class="hero-icon-play"
            src="{{ Illuminate\Support\Facades\Vite::asset('resources/images/icons/play-32.svg') }}" alt=""
            aria-hidden="true" />
        </button>

        <button class="hero-mute-btn bg-off-white flex items-center justify-center p-6" aria-label="Unmute video">
          <img class="hero-icon-muted"
            src="{{ Illuminate\Support\Facades\Vite::asset('resources/images/icons/mute-32.svg') }}" alt=""
            aria-hidden="true" />
          <img class="hero-icon-unmuted"
            src="{{ Illuminate\Support\Facades\Vite::asset('resources/images/icons/sound-32.svg') }}" alt=""
            aria-hidden="true" />
        </button>

        <button class="bg-off-white flex items-center justify-center p-6" aria-label="Settings">
          <img src="{{ Illuminate\Support\Facades\Vite::asset('resources/images/icons/settings-32.svg') }}"
            alt="" aria-hidden="true" />
        </button>
      </div>
    @endif
  </div>

  {{-- Bottom navigation bar --}}
  @if (count($links) > 0)
    <div
      class="bg-dark-blue absolute bottom-0 z-10 hidden w-[900px] max-w-[900px] translate-y-[50%] self-center lg:flex">
      <div class="container flex flex-wrap justify-center gap-x-16 gap-y-4 py-5">
        @foreach ($links as $link)
          <x-button :href="$link['url']" :target="$link['target']" class="justify-center">
            {!! $link['text'] !!}
          </x-button>
        @endforeach
      </div>
    </div>
  @endif
</section>
