/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './**/*.php',
        './assets/js/*.js'
    ],
    theme: {
        extend: {
            colors: {
                'light-grey': '#EBEBEB',
                'light-rose': '#FDF6F5',
                'light-white': '#E9E7E7'
            },
            fontFamily: {
                sans: ['"Geologica"', ...defaultTheme.fontFamily.sans],
                title: ['"Submica"', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                xxs: '0.6rem', // 9.5px
                xs: '0.85rem', // 13.6px
                sm: '1rem', // 16px
                base: '1.2rem', // 18px
                l: '1.25rem', // 20px
                xl: '1.45rem', // 24px
                xl2: '1.72rem', // 28px
                xl3: '2rem', // 32px
                xl4: '2.5rem', // 40px
                xl5: '3rem', // 48px
                xl6: '4rem', // 64px
                xl7: '5rem', // 80px
            },
            height: {
                '10vh': '10vh',
                '20vh': '20vh',
                '30vh': '30vh',
                '40vh': '40vh',
                '50vh': '50vh',
                '60vh': '60vh',
                '70vh': '70vh',
                '80vh': '80vh',
                '90vh': '90vh',
                '100vh': '100vh',
            },
            backgroundSize: {
                '300': '300%'
            },
            keyframes: {
                translateCardTitle: {
                    '0%, 100%': { transform: 'translateY(-60px)' },
                }
            },
            animation: {
                cardTitleAnimation: 'translateCardTitle 0.5s ease forwards',
            },
            backgroundPosition: {
                'center-top': 'center top',
                '20_center': '20% center',
                '25_center': '25% center',
                'center_-12rem': 'center -12rem',
            },
            backgroundColor: {
                'dark-opacity': 'rgba(0 0 0 / 60%)',
            },
            boxShadow: {
                'narrow-25': '0px 2px 2px 0px rgba(0, 0, 0, 0.25)',
                'simple-25': '0px 4px 4px 0px rgba(0, 0, 0, 0.25)',
            },
            gridTemplateRows: {
                '3fr': '3fr 3fr 3fr',
            },
            gridTemplateColumns: {
                'custom-fr': '1fr 2fr 2fr',
            }
        },
    },
    plugins: [],
}