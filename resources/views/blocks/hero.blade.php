<section class="hero-block relative flex flex-col" data-playing="true" data-muted="true">
  <div class="relative h-[75vh] min-h-[500px] overflow-hidden">

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
      <div class="absolute right-6 top-1/2 flex -translate-y-1/2 flex-col items-center gap-3">
        <div class="hero-indicator"></div>

        <button
          class="hero-play-btn bg-dark-blue/60 flex h-10 w-10 items-center justify-center rounded-full text-white backdrop-blur-sm"
          aria-label="Pause video">
          {{-- Pause icon (visible when playing) --}}
          <svg class="hero-icon-pause h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <rect x="6" y="4" width="4" height="16" rx="1" />
            <rect x="14" y="4" width="4" height="16" rx="1" />
          </svg>
          {{-- Play icon (visible when paused) --}}
          <svg class="hero-icon-play h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M8 5.14v13.72a1 1 0 0 0 1.5.86l11.04-6.86a1 1 0 0 0 0-1.72L9.5 4.28a1 1 0 0 0-1.5.86z" />
          </svg>
        </button>

        <button
          class="hero-mute-btn bg-dark-blue/60 flex h-10 w-10 items-center justify-center rounded-full text-white backdrop-blur-sm"
          aria-label="Unmute video">
          {{-- Muted icon (visible when muted) --}}
          <svg class="hero-icon-muted h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5" fill="currentColor" />
            <line x1="23" y1="9" x2="17" y2="15" />
            <line x1="17" y1="9" x2="23" y2="15" />
          </svg>
          {{-- Unmuted icon (visible when unmuted) --}}
          <svg class="hero-icon-unmuted h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5" fill="currentColor" />
            <path d="M19.07 4.93a10 10 0 0 1 0 14.14" />
            <path d="M15.54 8.46a5 5 0 0 1 0 7.07" />
          </svg>
        </button>
      </div>
    @endif
  </div>

  {{-- Bottom navigation bar --}}
  @php
    $links = array_filter(
        [
            ['label' => $link1Label, 'url' => $link1Url, 'target' => $link1Target],
            ['label' => $link2Label, 'url' => $link2Url, 'target' => $link2Target],
            ['label' => $link3Label, 'url' => $link3Url, 'target' => $link3Target],
        ],
        fn($link) => !empty($link['label']),
    );
  @endphp

  @if (count($links) > 0)
    <div class="bg-dark-blue absolute bottom-0 z-10 w-[900px] max-w-[900px] translate-y-[50%] self-center">
      <div class="container flex flex-wrap justify-center gap-x-16 gap-y-4 py-5">
        @foreach ($links as $link)
          <x-button :href="$link['url']" :target="$link['target']" class="justify-center">
            {!! wp_kses_post($link['label']) !!}
          </x-button>
        @endforeach
      </div>
    </div>
  @endif
</section>
