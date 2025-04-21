import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import javascriptObfuscator from "vite-plugin-javascript-obfuscator";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        javascriptObfuscator({
            rotateStringArray: true,
            stringArray: true,
            stringArrayEncoding: ["base64"],
            stringArrayThreshold: 0.75,
        }),
    ],
});
