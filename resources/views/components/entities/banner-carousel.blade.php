<div class="swiper-container bannerSwiper relative w-[1256px]">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img
                class="h-[502px] w-[1256px] rounded-md"
                src="https://as2.ftcdn.net/v2/jpg/02/49/50/15/1000_F_249501541_XmWdfAfUbWAvGxBwAM0ba2aYT36ntlpH.jpg"
            />
        </div>
        <div class="swiper-slide">
            <img
                class="h-[502px] w-[1256px] rounded-md"
                src="https://as1.ftcdn.net/v2/jpg/04/65/46/52/1000_F_465465254_1pN9MGrA831idD6zIBL7q8rnZZpUCQTy.jpg"
            />
        </div>
        <div class="swiper-slide">
            <img
                class="h-[502px] w-[1256px] rounded-md"
                src="https://as2.ftcdn.net/v2/jpg/04/30/04/89/1000_F_430048954_Iw0YZEUr2ZTwnoKzKgfJogGpKXWGuIe2.jpg"
            />
        </div>
    </div>
    <div class="swiper-pagination text-lime-600"></div>
    <script>
        var swiper = new Swiper('.bannerSwiper', {
            spaceBetween: 30,
            effect: 'fade',
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>
</div>
