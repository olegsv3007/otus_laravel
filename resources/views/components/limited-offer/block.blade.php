<div class="limited_offer">
    <h2 class="header-2">{{ __('public/pages/index.limited_offer.header') }}</h2>
    <div class="limited_offer_container">
        @for($i = 0; $i < 3; $i++)
            <x-limited-offer.item />
        @endfor
    </div>
</div>
