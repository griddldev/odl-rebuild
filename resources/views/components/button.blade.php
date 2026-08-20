@props([
    'href' => null,
    'target' => '_self',
    'type' => 'button',
    'color' => 'off-white',
])

@php
  $isExternal = $href && $target === '_blank';
  $rel = $isExternal ? 'noopener noreferrer' : null;
  $arrowIcon = \Illuminate\Support\Facades\Vite::asset('resources/images/icons/button-arrow-hover.svg');

  $colorClass = $color === 'dark-blue' ? 'text-dark-blue' : 'text-off-white';
  $baseClass = "group inline-flex gap-3 items-center {$colorClass} focus:outline-none focus-visible:ring-2 focus-visible:ring-red focus-visible:ring-offset-2 focus-visible:ring-offset-dark-blue";
  $textClass = 'font-display button-primary font-bold leading-none tracking-[0.02em]';
  $arrowWrapClass = 'inline-flex h-6 items-center overflow-hidden';
  $arrowImgClass =
      'h-6 w-auto max-w-none shrink-0 -ml-[1rem] transition-[margin] duration-350 ease-out group-hover:ml-0';
@endphp

@if ($href)
  <a href="{{ esc_url($href) }}" target="{{ esc_attr($target) }}"
    @if ($rel) rel="{{ esc_attr($rel) }}" @endif
    {{ $attributes->merge(['class' => $baseClass]) }}>
    <span class="{{ $textClass }}">{{ $slot }}</span>
    <span class="{{ $arrowWrapClass }}" aria-hidden="true">
      <img src="{{ esc_url($arrowIcon) }}" alt="" class="{{ $arrowImgClass }}" loading="lazy" decoding="async" />
    </span>
  </a>
@else
  <button type="{{ esc_attr($type) }}" {{ $attributes->merge(['class' => $baseClass]) }}>
    <span class="{{ $textClass }}">{{ $slot }}</span>
    <span class="{{ $arrowWrapClass }}" aria-hidden="true">
      <img src="{{ esc_url($arrowIcon) }}" alt="" class="{{ $arrowImgClass }}" loading="lazy"
        decoding="async" />
    </span>
  </button>
@endif
