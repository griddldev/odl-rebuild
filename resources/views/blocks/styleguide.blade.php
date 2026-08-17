<section class="styleguide-block bg-off-white py-14 lg:py-24">
  <div class="container mx-auto max-w-6xl px-6">

    {{-- ─── Colors ─── --}}
    <h2 class="font-display text-h2 text-dark-blue mb-10 font-bold" style="font-stretch: 110%">Color</h2>

    <div class="mb-20 grid grid-cols-2 gap-6 sm:grid-cols-4 lg:grid-cols-8">
      @php
        $colors = [
            ['name' => 'Off-white', 'class' => 'bg-off-white', 'hex' => '#EBEFE6', 'border' => true],
            ['name' => 'Dark Blue', 'class' => 'bg-dark-blue', 'hex' => '#242F3F'],
            ['name' => 'Yellow', 'class' => 'bg-yellow', 'hex' => '#FDDD4F'],
            ['name' => 'Blue', 'class' => 'bg-blue', 'hex' => '#4BC3FF'],
            ['name' => 'Teal', 'class' => 'bg-teal', 'hex' => '#42B289'],
            ['name' => 'Pink', 'class' => 'bg-pink', 'hex' => '#F2C8F7'],
            ['name' => 'Red', 'class' => 'bg-red', 'hex' => '#E02B44'],
            ['name' => 'Black', 'class' => 'bg-black', 'hex' => '#000000'],
            ['name' => 'White', 'class' => 'bg-white', 'hex' => '#FFFFFF', 'border' => true],
        ];
      @endphp

      @foreach ($colors as $color)
        <div class="flex flex-col items-center gap-2">
          <div
            class="{{ $color['class'] }} {{ !empty($color['border']) ? 'border border-dark-blue-30' : '' }} h-20 w-20 rounded-xl">
          </div>
          <span class="text-small text-dark-blue font-bold">{{ $color['name'] }}</span>
          <span class="text-small text-dark-blue-70">{{ $color['hex'] }}</span>
        </div>
      @endforeach
    </div>

    {{-- Dark Blue variants --}}
    <div class="mb-20 flex gap-6">
      <div class="flex flex-col items-center gap-2">
        <div class="bg-dark-blue-70 h-20 w-20 rounded-xl"></div>
        <span class="text-small text-dark-blue font-bold">dark-blue-70</span>
        <span class="text-small text-dark-blue-70">242F3F 70%</span>
      </div>
      <div class="flex flex-col items-center gap-2">
        <div class="bg-dark-blue-30 h-20 w-20 rounded-xl"></div>
        <span class="text-small text-dark-blue font-bold">dark-blue-30</span>
        <span class="text-small text-dark-blue-70">242F3F 30%</span>
      </div>
    </div>

    {{-- ─── Heading ─── --}}
    <h2 class="font-display text-h2 text-dark-blue mb-10 font-bold" style="font-stretch: 110%">Heading</h2>

    <div class="mb-20 flex flex-col gap-6">
      {{-- H1 Home --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold" style="font-stretch: 110%">H1 Home</p>
          <p class="text-small text-dark-blue-70 !mb-0">Union Gothic Expanded 700<br>5 rem / 1.2 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">Text example</p>
          <p class="font-display text-dark-blue !mb-0 font-bold"
            style="font-size: 5rem; line-height: 1.2; font-stretch: 110%">Lorem ipsum dolor sit amet, consecte.</p>
        </div>
      </div>

      {{-- H1 --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold" style="font-stretch: 110%">H1</p>
          <p class="text-small text-dark-blue-70 !mb-0">Union Gothic Expanded 700<br>4.25 rem / 1.2 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">Text example</p>
          <h1 class="font-display text-dark-blue !mb-0 font-bold" style="font-stretch: 110%">Lorem ipsum dolor sit amet,
            consecte.</h1>
        </div>
      </div>

      {{-- H2 --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold" style="font-stretch: 110%">H2</p>
          <p class="text-small text-dark-blue-70 !mb-0">Union Gothic Expanded 700<br>3.5 rem / 1.3 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">Text example</p>
          <h2 class="font-display text-dark-blue !mb-0 font-bold" style="font-stretch: 110%">Lorem ipsum dolor sit amet
            consectetur sit pellentesque</h2>
        </div>
      </div>

      {{-- H3 --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold">H3</p>
          <p class="text-small text-dark-blue-70 !mb-0">Union Gothic Standard 700<br>2.75 rem / 1.35 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">Text example</p>
          <h3 class="font-display text-dark-blue !mb-0 font-bold">Lorem ipsum dolor sit amet consectetur. Sit
            pellentesque</h3>
        </div>
      </div>

      {{-- H4 --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold" style="font-stretch: 110%">H4</p>
          <p class="text-small text-dark-blue-70 !mb-0">Union Gothic Expanded 700<br>2 rem / 1.3 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">Text example</p>
          <h4 class="font-display text-dark-blue !mb-0 font-bold" style="font-stretch: 110%">Lorem ipsum dolor sit amet
            consectetur. Sit pellentesque</h4>
        </div>
      </div>

      {{-- H5 --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold" style="font-stretch: 110%">H5</p>
          <p class="text-small text-dark-blue-70 !mb-0">Union Gothic Expanded 700<br>1.75 rem / 1.3 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">Text example</p>
          <h5 class="font-display text-dark-blue !mb-0 font-bold" style="font-stretch: 110%">Lorem ipsum dolor sit amet
            consectetur. Sit pellentesque</h5>
        </div>
      </div>
    </div>

    {{-- ─── Additional heading styles ─── --}}
    <div class="mb-20 flex flex-col gap-6">
      {{-- Eyebrow --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold" style="font-stretch: 110%">Eyebrow</p>
          <p class="text-small text-dark-blue-70 !mb-0">Inclusive Sans Regular<br>1.6 rem / 1.4 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">TEXT EXAMPLE</p>
          <p class="font-body text-dark-blue !mb-0 uppercase" style="font-size: 1.6rem; line-height: 1.4">Lorem ipsum
            dolor sit amet consectetur. Sit pellentesque aliquam adipiscing mattis urna ac phasellus</p>
        </div>
      </div>

      {{-- Subhead Wide --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold" style="font-stretch: 110%">Subhead Wide</p>
          <p class="text-small text-dark-blue-70 !mb-0">Union Gothic Expanded 700<br>1.75 rem / 1.5 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">Text example</p>
          <p class="font-display text-dark-blue !mb-0 font-bold"
            style="font-size: 1.75rem; line-height: 1.5; font-stretch: 110%">Lorem ipsum dolor sit amet consectetur. Sit
            pellentesque aliquam adipiscing mattis urna ac phasellus</p>
        </div>
      </div>

      {{-- Subhead --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold">Subhead</p>
          <p class="text-small text-dark-blue-70 !mb-0">Union Gothic Standard 700<br>1.75 rem / 1.5 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">Text example</p>
          <p class="font-display text-dark-blue !mb-0 font-bold" style="font-size: 1.75rem; line-height: 1.5">Lorem
            ipsum dolor sit amet consectetur. Sit pellentesque aliquam adipiscing mattis urna ac phasellus</p>
        </div>
      </div>

      {{-- Body Callout --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold" style="font-stretch: expanded">Body Callout</p>
          <p class="text-small text-dark-blue-70 !mb-0">Union Gothic Expanded 700<br>2.625 rem / 1.45 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">Text example</p>
          <p class="callout text-dark-blue !mb-0">Lorem ipsum dolor sit amet consectetur. Sit pellentesque aliquam
            adipiscing mattis urna ac phasellus</p>
        </div>
      </div>

      {{-- Body Callout Small --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold">Body Callout Small</p>
          <p class="text-small text-dark-blue-70 !mb-0">Union Gothic Standard 700<br>1.75 rem / 1.3 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">Text example</p>
          <p class="callout-small text-dark-blue !mb-0">Lorem ipsum dolor sit amet consectetur. Sit pellentesque
            aliquam adipiscing mattis urna ac phasellus</p>
        </div>
      </div>
    </div>

    {{-- ─── Text ─── --}}
    <h2 class="font-display text-h2 text-dark-blue mb-10 font-bold" style="font-stretch: 110%">Text</h2>

    <div class="mb-20 flex flex-col gap-6">
      {{-- Text XLarge Union --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold">Text XLarge Union</p>
          <p class="text-small text-dark-blue-70 !mb-0">Union Gothic Standard 400<br>1.5 rem / 1.4 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">TEXT EXAMPLE</p>
          <p class="font-display text-dark-blue !mb-0" style="font-size: 1.5rem; line-height: 1.4; font-weight: 400">
            Lorem ipsum dolor sit amet consectetur. At sed cum rutrum fermentum lorem duis nibh amet. Id massa ut orci
            arcu massa in pharetra non. Sit lacus sagittis egestas lorem eget nec pharetra.</p>
        </div>
      </div>

      {{-- Text XLarge --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold" style="font-stretch: 110%">Text XLarge</p>
          <p class="text-small text-dark-blue-70 !mb-0">Inclusive Sans Regular<br>1.5 rem / 1.4 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">TEXT EXAMPLE</p>
          <p class="font-body text-dark-blue !mb-0" style="font-size: 1.5rem; line-height: 1.4">Lorem ipsum dolor sit
            amet consectetur. At sed cum rutrum fermentum lorem duis nibh amet. Id massa ut orci arcu massa in pharetra
            non. Sit lacus sagittis egestas lorem eget nec pharetra.</p>
        </div>
      </div>

      {{-- Text Large --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold">Text Large</p>
          <p class="text-small text-dark-blue-70 !mb-0">Union Gothic Standard 400<br>1.25 rem / 1.6 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">TEXT EXAMPLE</p>
          <p class="font-display text-dark-blue !mb-0" style="font-size: 1.25rem; line-height: 1.6; font-weight: 400">
            Lorem ipsum dolor sit amet consectetur. At sed cum rutrum fermentum lorem duis nibh amet. Id massa ut orci
            arcu massa in pharetra non. Sit lacus sagittis egestas lorem eget nec pharetra.</p>
        </div>
      </div>

      {{-- Text Normal --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold">Text Normal</p>
          <p class="text-small text-dark-blue-70 !mb-0">Inclusive Sans Regular<br>1 rem / 1.625 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">TEXT EXAMPLE</p>
          <p class="font-body text-dark-blue !mb-0" style="font-size: 1rem; line-height: 1.625">Lorem ipsum dolor sit
            amet consectetur. At sed cum rutrum fermentum lorem duis nibh amet. Id massa ut orci arcu massa in pharetra
            non. Sit lacus sagittis egestas lorem eget nec pharetra.</p>
        </div>
      </div>

      {{-- Text Small --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold">Text Small</p>
          <p class="text-small text-dark-blue-70 !mb-0">Inclusive Sans Regular<br>0.75 rem / 1.6 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">TEXT EXAMPLE</p>
          <p class="font-body text-dark-blue !mb-0" style="font-size: 0.75rem; line-height: 1.6">Lorem ipsum dolor sit
            amet consectetur. At sed cum rutrum fermentum lorem duis nibh amet. Id massa ut orci arcu massa in pharetra
            non. Sit lacus sagittis egestas lorem eget nec pharetra.</p>
        </div>
      </div>
    </div>

    {{-- ─── Interactive ─── --}}
    <h2 class="font-display text-h2 text-dark-blue mb-10 font-bold" style="font-stretch: 110%">Interactive</h2>

    <div class="flex flex-col gap-6">
      {{-- Primary nav --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold">Primary nav</p>
          <p class="text-small text-dark-blue-70 !mb-0">Union Gothic Standard 400<br>1 rem / 1.625 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">Text example</p>
          <p class="font-display text-dark-blue !mb-0" style="font-size: 1rem; line-height: 1.625; font-weight: 400">
            Button Text</p>
        </div>
      </div>

      {{-- Small nav --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold">Small nav</p>
          <p class="text-small text-dark-blue-70 !mb-0">Inclusive Sans Regular<br>0.75 rem / 1.6 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">Text example</p>
          <p class="font-body text-dark-blue !mb-0" style="font-size: 0.75rem; line-height: 1.6">Lorem ipsum dolor sit
            amet consectetur. At sed cum rutrum fermentum.</p>
        </div>
      </div>

      {{-- Primary button --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold" style="font-stretch: 110%">Primary button</p>
          <p class="text-small text-dark-blue-70 !mb-0">Union Gothic Expanded 700<br>1 rem / 1.625 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">Text example</p>
          <p class="font-display text-dark-blue !mb-0 font-bold"
            style="font-size: 1rem; line-height: 1.625; font-stretch: 110%">Button text</p>
        </div>
      </div>

      {{-- Secondary button --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold">Secondary button</p>
          <p class="text-small text-dark-blue-70 !mb-0">Union Gothic Standard 400<br>1.25 rem / 1.6 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">Text example</p>
          <p class="font-display text-dark-blue !mb-0 underline"
            style="font-size: 1.25rem; line-height: 1.6; font-weight: 400">Link text</p>
        </div>
      </div>

      {{-- Input Text --}}
      <div class="grid grid-cols-[200px_1fr] items-start gap-8 rounded-xl bg-white p-8">
        <div>
          <p class="text-small text-dark-blue-70 !mb-1">Text style</p>
          <p class="font-display text-dark-blue !mb-1 text-lg font-bold">Input Text</p>
          <p class="text-small text-dark-blue-70 !mb-0">Inclusive Sans Regular<br>1 rem / 1.625 em</p>
        </div>
        <div>
          <p class="text-small text-dark-blue-70 !mb-2">Text example</p>
          <p class="font-body text-dark-blue !mb-0" style="font-size: 1rem; line-height: 1.625">Lorem ipsum dolor sit
            amet consectetur. At sed cum rutrum fermentum.</p>
        </div>
      </div>
    </div>

  </div>
</section>
