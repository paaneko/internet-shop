<div>
    <div class="flex space-x-5">
        <x-entities.banner-carousel />
        <x-entities.limited-offers-carousel :$products />
    </div>
    <div>
        <h2 class="my-5 text-2xl font-semibold">Brand's</h2>
        <x-entities.brands-list />
    </div>
    <div>
        <h2 class="my-5 text-2xl font-semibold">Today's Best Deals</h2>
        <x-entities.product-carousel-list :$products />
    </div>
</div>
