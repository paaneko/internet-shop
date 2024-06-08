<div
    x-data="{
        activeAccordion: '',
        setActiveAccordion(id) {
            this.activeAccordion = this.activeAccordion == id ? '' : id
        },
    }"
    class="relative mx-auto w-full divide-y divide-gray-200 overflow-hidden rounded-md border border-gray-400/70 bg-white text-sm font-normal"
>
    <div x-data="{ id: $id('accordion') }" class="group cursor-pointer">
        <div class="flex w-full items-center justify-between p-5">
            <h2 class="text-2xl font-semibold">About Us</h2>
        </div>
        <p class="prose max-w-full px-5">
            At LimeTech, we're passionate about technology and dedicated to providing our customers with the latest
            gadgets, electronics, and accessories. With a commitment to innovation and customer satisfaction, we strive
            to be your one-stop destination for all things tech. Step into LimeTech's digital realm, where innovation is
            not just a concept but a way of life. We've meticulously crafted an online space that caters to the needs of
            every tech aficionado, from the seasoned professionals to the curious beginners.
        </p>
        <button
            class="mt-5 px-5 font-medium text-lime-700 hover:underline"
            x-show="! activeAccordion"
            @click="setActiveAccordion(id)"
        >
            Read more
        </button>
        <div class="px-5 pb-5 text-left"></div>
        <div x-show="activeAccordion==id" x-collapse x-cloak>
            <div class="prose max-w-full p-5 pt-5">
                <h3>Our Mission</h3>
                <p>
                    Our mission at LimeTech is to empower individuals and businesses by offering cutting-edge technology
                    solutions that enhance productivity, connectivity, and enjoyment. We believe that technology should
                    be accessible to everyone, and we're committed to making the latest innovations available at
                    competitive prices.
                </p>

                <h3>Why Choose LimeTech?</h3>
                <ul>
                    <li>
                        <strong>Extensive Product Selection:</strong>
                        With hundreds of product categories to choose from, we offer a diverse range of options to suit
                        every need and preference.
                    </li>
                    <li>
                        <strong>Exceptional Service:</strong>
                        Our knowledgeable and friendly staff are here to provide expert advice and assistance every step
                        of the way. Whether you have questions about a product or need help with setup and installation,
                        we're here to help.
                    </li>
                    <li>
                        <strong>Quality Assurance:</strong>
                        We source our products from reputable manufacturers and brands to ensure high quality and
                        reliability. Every product undergoes rigorous testing and inspection to meet our standards of
                        excellence.
                    </li>
                    <li>
                        <strong>Convenience:</strong>
                        Shopping with LimeTech is convenient and hassle-free. Our user-friendly website allows you to
                        browse and purchase products with ease, and our flexible payment options and fast delivery make
                        the entire shopping experience seamless.
                    </li>
                    <li>
                        <strong>Commitment to Sustainability:</strong>
                        We're committed to reducing our environmental impact and promoting sustainability. That's why we
                        offer recycling services for old electronics and strive to minimize packaging waste in our
                        operations.
                    </li>
                </ul>

                <h3>Our Team</h3>
                <p>
                    At LimeTech, our team consists of passionate tech enthusiasts who are dedicated to providing
                    exceptional service and support to our customers. From our product specialists to our customer
                    service representatives, everyone at LimeTech shares a common goal: to help you find the perfect
                    tech solutions for your needs.
                </p>

                <h3>Contact Us</h3>
                <p>
                    Have a question or need assistance? Don't hesitate to get in touch with us! You can reach our
                    customer service team by phone, email, or live chat during business hours. We're here to help you
                    with anything you need, whether it's product recommendations, troubleshooting assistance, or order
                    tracking.
                </p>

                <p>
                    Thank you for choosing LimeTech as your trusted source for all things tech. We look forward to
                    serving you and exceeding your expectations with our products and services.
                </p>
            </div>
            <button
                class="mb-5 px-5 font-medium text-lime-700 hover:underline"
                x-show="activeAccordion"
                @click="setActiveAccordion(id)"
            >
                Close
            </button>
        </div>
    </div>
</div>
