/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            maxWidth:{
                container: "1440px"
            },
            backgroundImage: {
                'bgImage':'url(\'/public/images/bgImage.jpg\')'
            }
        },
    },
    plugins: [],
}

