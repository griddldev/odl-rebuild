<section class="interactive-gallery-block bg-yellow py-14 lg:py-24">
  <div class="container">

    {{-- Section heading --}}
    @if (!empty($heading))
      <h2 class="heading-2 text-dark-blue mb-16 text-center">{!! wp_kses_post($heading) !!}</h2>
    @endif

    {{-- Image grid --}}
    @if (!empty($items))
      <div class="gallery-grid" data-active="0">
        @foreach ($items as $index => $item)
          @if (!empty($item['imageUrl']))
            <button class="gallery-item {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"
              aria-label="{{ esc_attr($item['title'] ?? '') }}">
              <img src="{{ esc_url($item['imageUrl']) }}" alt="{{ esc_attr($item['imageAlt'] ?? '') }}" loading="lazy" />
            </button>
          @endif
        @endforeach
      </div>

      {{-- Content area --}}
      <div class="mt-16 grid grid-cols-1 items-start gap-8 lg:grid-cols-2">
        <div>
          @foreach ($items as $index => $item)
            @if (!empty($item['title']))
              <h3 class="gallery-title heading-3 text-dark-blue {{ $index === 0 ? 'active' : '' }}"
                data-index="{{ $index }}">
                {!! wp_kses_post($item['title']) !!}
              </h3>
            @endif
          @endforeach
        </div>
        <div>
          @foreach ($items as $index => $item)
            @if (!empty($item['description']))
              <div class="gallery-description text-dark-blue {{ $index === 0 ? 'active' : '' }}"
                data-index="{{ $index }}">
                {!! wp_kses_post($item['description']) !!}
              </div>
            @endif
          @endforeach
        </div>
      </div>
    @endif

  </div>
</section>
