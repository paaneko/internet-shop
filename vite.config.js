import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js"
            ],
            refresh: true
        })
    ],
    // Use it if you running app on herd
    // Otherwise comment this
    server: {
        host: "internet-shop.test"
    }
});
