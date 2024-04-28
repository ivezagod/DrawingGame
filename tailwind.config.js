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
                'bgImage':'url(\'/public/images/bgImage.jpg\')',
                'bgImage2':'url(\'/public/images/bgImage2.jpg\')',
                'bgImage3':'url(\'/public/images/bgImage3.jpg\')',
                'bgImage4':'url(\'/public/images/bgImage4.jpg\')',
            }
        },
        boxShadow: {
            'blue':'shadow-[5px_5px_rgba(0,_98,_90,_0.4),_10px_10px_rgba(0,_98,_90,_0.3),_15px_15px_rgba(0,_98,_90,_0.2),_20px_20px_rgba(0,_98,_90,_0.1),_25px_25px_rgba(0,_98,_90,_0.05)]'
        },
        fontFamily:{
            'first':['Oswald']
        }
    },
    plugins: [],
}

