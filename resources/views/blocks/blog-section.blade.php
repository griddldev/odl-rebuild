<section class="blog-section-block bg-off-white lg:!pt-30 py-24 lg:py-28">
  <div class="container">
    {{-- Featured Blog --}}
    <div class="blog-section-featured relative flex flex-col justify-between gap-10 md:flex-row">
      @if (!empty($featuredPost))
        <div class="flex w-full flex-col justify-between md:w-[50%]">
          <h2 class="h2 mb-10 md:mb-0">{{ $title }}</h2>

          @if (!empty($featuredPost['image']))
            <div class="relatve">
              <img src="{{ Illuminate\Support\Facades\Vite::asset('resources/images/icons/star-red.svg') }}"
                alt="" class="absolute right-[-60px] top-[53px] w-full max-w-[120px] object-cover md:hidden"
                aria-hidden="true" />

              <img src="{{ esc_url($featuredPost['image']) }}"
                alt="{{ esc_attr($featuredPost['imageAlt'] ?: $featuredPost['title']) }}"
                class="aspect-[4/3] w-full object-cover md:hidden" loading="lazy" />
            </div>
          @else
            <div class="bg-dark-blue/10 aspect-[4/3] w-full rounded-lg"></div>
          @endif

          <div>
            <p class="eyebrow mb-5">Featured Blog</p>
            <h3 class="heading-3-small !mb-4">
              <a href="{{ esc_url($featuredPost['permalink']) }}">
                {!! wp_kses_post($featuredPost['title']) !!}
              </a>
            </h3>
            <p class="text-body !mb-6">{!! wp_kses_post($featuredPost['excerpt']) !!}</p>
          </div>
          <x-button href="{{ esc_url($featuredPost['permalink']) }}" color="dark-blue">
            Read the Full Blog
          </x-button>
        </div>
        <div class="w-[80%]">
          <div class="relative left-0 top-0 h-full w-full">
            <img src="{{ Illuminate\Support\Facades\Vite::asset('resources/images/icons/star-red.svg') }}"
              alt=""
              class="absolute hidden w-full max-w-[190px] -translate-x-1/2 -translate-y-1/2 object-cover md:block"
              aria-hidden="true" />

            @if (!empty($featuredPost['image']))
              <img src="{{ esc_url($featuredPost['image']) }}"
                alt="{{ esc_attr($featuredPost['imageAlt'] ?: $featuredPost['title']) }}"
                class="hidden aspect-[4/3] w-full object-cover md:block" loading="lazy" />
            @else
              <div class="bg-dark-blue/10 aspect-[4/3] w-full rounded-lg"></div>
            @endif
          </div>
        </div>
      @endif
    </div>
    {{-- End of featured blog --}}

    <hr class="md:my-15 border-dark-blue my-5 border-2">

    {{-- Latest Blogs --}}
    @if (!empty($latestPosts))
      <div class="">
        <div class="mb-8 flex items-center justify-between lg:mb-12">
          <h3 class="text-xlarge">Latest Blogs</h3>
          <div class="hidden md:block">
            <x-button href="#" target="#" color="dark-blue">
              See All Blogs
            </x-button>
          </div>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
          @foreach ($latestPosts as $index => $post)
            @php
              $color = $cardColors[$index % count($cardColors)];
            @endphp
            <div class="blog-section-card bg-{{ $color }} block p-6">
              <a href="{{ esc_url($post['permalink']) }}" class="blog-section-card-image mb-4 block">
                @if (!empty($post['image']))
                  <img src="{{ esc_url($post['image']) }}" alt="{{ esc_attr($post['imageAlt'] ?: $post['title']) }}"
                    class="aspect-[4/3] w-full object-cover" loading="lazy" />
                @endif
              </a>

              @if (!empty($post['categories']))
                <div class="mb-6 flex flex-wrap gap-2">
                  @foreach ($post['categories'] as $category)
                    <span
                      class="text-small text-dark-blue {{ $color === 'off-white' ? 'blog-section-card-category--pink' : 'bg-off-white' }} px-2 py-1 font-medium">
                      {{ esc_html($category) }}
                    </span>
                  @endforeach
                </div>
              @endif

              <h4 class="button-secondary !mb-6 no-underline">
                <a href="{{ esc_url($post['permalink']) }}"
                  class="text-inherit no-underline hover:underline">{!! wp_kses_post($post['title']) !!}</a>
              </h4>
              <p class="text-body mb-6 line-clamp-3">{!! wp_kses_post($post['excerpt']) !!}</p>
              <p class="primary-nav text-dark-blue !mb-0">{{ esc_html($post['date']) }}</p>
            </div>
          @endforeach
        </div>

        <div class="mt-10 flex justify-center md:hidden">
          <x-button href="#" target="#" color="dark-blue">
            See All Blogs
          </x-button>
        </div>

      </div>
    @endif
  </div>
</section>
