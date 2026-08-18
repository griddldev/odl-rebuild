@props([
    'href' => null,
    'target' => '_self',
    'type' => 'button',
    'color' => 'off-white',
])

@php
  $isExternal = $href && $target === '_blank';
  $rel = $isExternal ? 'noopener noreferrer' : null;
  $arrowDefaultIcon = \Illuminate\Support\Facades\Vite::asset('resources/images/icons/button-arrow-default.svg');
  $arrowHoverIcon = \Illuminate\Support\Facades\Vite::asset('resources/images/icons/button-arrow-hover.svg');

  $colorClass = $color === 'dark-blue' ? 'text-dark-blue' : 'text-off-white';
  $baseClass = "group inline-flex items-center gap-5 {$colorClass} transition-colors duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-red focus-visible:ring-offset-2 focus-visible:ring-offset-dark-blue";
  $textClass = 'font-display button-primary font-bold leading-none tracking-[0.02em]';
  $arrowWrapClass = 'relative inline-flex h-6 w-[2.875rem] items-center overflow-visible';
  $arrowDefaultClass =
      'absolute right-0 top-1/2 h-6 w-auto -translate-y-1/2 opacity-100 transition-all duration-350 ease-out group-hover:translate-x-1 group-hover:opacity-0';
  $arrowHoverClass =
      'absolute right-0 top-1/2 h-6 w-auto -translate-y-1/2 opacity-0 transition-all duration-350 ease-out group-hover:translate-x-1 group-hover:opacity-100';
@endphp

@if ($href)
  <a href="{{ esc_url($href) }}" target="{{ esc_attr($target) }}"
    @if ($rel) rel="{{ esc_attr($rel) }}" @endif
    {{ $attributes->merge(['class' => $baseClass]) }}>
    <span class="{{ $textClass }}">{{ $slot }}</span>
    <span class="{{ $arrowWrapClass }}" aria-hidden="true">
      <img src="{{ esc_url($arrowDefaultIcon) }}" alt="" class="{{ $arrowDefaultClass }}" loading="lazy"
        decoding="async" />
      <img src="{{ esc_url($arrowHoverIcon) }}" alt="" class="{{ $arrowHoverClass }}" loading="lazy"
        decoding="async" />
    </span>
  </a>
@else
  <button type="{{ esc_attr($type) }}" {{ $attributes->merge(['class' => $baseClass]) }}>
    <span class="{{ $textClass }}">{{ $slot }}</span>
    <span class="{{ $arrowWrapClass }}" aria-hidden="true">
      <img src="{{ esc_url($arrowDefaultIcon) }}" alt="" class="{{ $arrowDefaultClass }}" loading="lazy"
        decoding="async" />
      <img src="{{ esc_url($arrowHoverIcon) }}" alt="" class="{{ $arrowHoverClass }}" loading="lazy"
        decoding="async" />
    </span>
  </button>
@endif
