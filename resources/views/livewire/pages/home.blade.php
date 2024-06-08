<div>
    <div class="flex space-x-5">
        <x-entities.banner-carousel />
        <x-entities.limited-offers-carousel :$products />
    </div>
    <div>
        <h2 class="mb-5 mt-10 text-2xl font-semibold">Brand's</h2>
        <x-entities.brands-list />
    </div>
    <div>
        <h2 class="mb-5 mt-10 text-2xl font-semibold">Today's Best Deals</h2>
        <x-entities.product-carousel-list :$products />
    </div>
    <div class="pt-10">
        <x-entities.trusted-by />
    </div>
    <div class="mt-20">
        <x-entities.home-description />
    </div>
</div>
