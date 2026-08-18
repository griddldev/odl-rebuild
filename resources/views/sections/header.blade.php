@php
  $logo = \Illuminate\Support\Facades\Vite::asset('resources/images/icons/odl-fullcolor-logo.png');
  $searchIcon = \Illuminate\Support\Facades\Vite::asset('resources/images/icons/search.svg');
@endphp

<div class="bg-dark-blue py-3">
  <div class="container flex flex-row items-center justify-between">
    @if (has_nav_menu('top_navigation'))
      {!! wp_nav_menu([
          'theme_location' => 'top_navigation',
          'menu_class' => 'nav-top flex items-center gap-5 px-0',
      ]) !!}
    @endif

    @if (has_nav_menu('secondary_top_navigation'))
      {!! wp_nav_menu([
          'theme_location' => 'secondary_top_navigation',
          'menu_class' => 'nav-secondary flex items-center gap-5 px-0',
      ]) !!}
    @endif
  </div>
</div>
<header class="banner px-9 py-2.5">
  <div class="align-center container flex flex-row justify-between">
    <!-- logo -->
    <img src="{{ esc_url($logo) }}" alt="" width="2871" height="530" class="block h-auto w-40" aria-hidden="true">

    <div class="flex flex-row items-center gap-6">
      <!-- menu -->
      <div class="nav-primary flex items-center gap-6">
        @if (has_nav_menu('primary_navigation'))
          {!! wp_nav_menu([
              'theme_location' => 'primary_navigation',
              'menu_class' => 'nav flex items-center gap-6',
          ]) !!}
        @endif
      </div>

      <!-- search -->
      <div class="nav-search">
        <img src="{{ esc_url($searchIcon) }}" alt="" width="24" height="24" aria-hidden="true">
      </div>
    </div>

  </div>
</header>
