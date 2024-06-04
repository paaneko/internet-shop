@props([
    'products',
])
<div class="relative h-full">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($products as $product)
                <div class="swiper-slide">
                    <livewire:product.product-card :key="$product->id" :variation="$product" />
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next text-lime-600"></div>
        <div class="swiper-button-prev text-lime-600"></div>
    </div>
</div>
<script>
    new Swiper('.mySwiper', {
        slidesPerView: 5,
        spaceBetween: 8,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
