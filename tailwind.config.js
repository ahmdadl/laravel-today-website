const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('@tailwindcss/ui/colors');
// const { after } = require('lodash');

module.exports = {
    purge: {
        enable: false,
        mode: 'all',
        preserveHtmlElements: false,
        content: [
            // './storage/framework/views/*.php',
            // './resources/views/*.blade.php',
            './resources/views/auth/*.blade.php',
            './resources/views/components/*.blade.php',
            './resources/views/footer/*.blade.php',
            './resources/views/index/*.blade.php',
            './resources/views/layouts/*.blade.php',
            './resources/views/posts/*.blade.php',
            './resources/views/provider/*.blade.php',
            './resources/views/sidebar/*.blade.php',
            './resources/views/vendor/*.blade.php',
            './resources/views/dashboard.blade.php',
            './resources/views/footer.blade.php',
            './resources/views/index.blade.php',
            './resources/views/lost_classes.blade.php',
            './resources/views/splash.blade.php',
            './resources/js/components/**/*.vue',
            './node_modules/@fortawesome/fontawesome-free/css/fontawesome.min.css'
        ],
        options: {
            safelist: {
                // standard: ['bg-blue-500', 'bg-red-500'],
                // deep: [/bg-green-500/],
            },
        },
    },

    theme: {
        themeVariants: ['dark', 'rtl'],
        fontFamily: false,
        extend: {
            colors: {
                teal: colors.teal,
                green: colors.emerald,
                orange: colors.orange,
                gray: colors.blueGray,
                dark: '#1a202c',
            },
        },
    },

    variants: {
        animation: ['responsive', 'hover'],
        backgroundColor: [
            'disabled',
            'hover',
            'focus',
            'active',
            'invalid',
            'dark',
            'dark:hover',
            'dark:focus',
        ],
        backgroundImage: [
            'disabled',
            'dark',
            'dark:hover',
            'dark:focus',
            'responsive',
        ],
        borderColor: [
            'disabled',
            'hover',
            'focus',
            'active',
            'invalid',
            'group-hover',
            'dark',
            'dark:hover',
            'dark:focus',
        ],
        boxShadow: [
            'disabled',
            'hover',
            'focus',
            'active',
            'invalid',
            'dark',
            'dark:hover',
            'dark:focus',
        ],
        cursor: ['disabled', 'hover'],
        gradientColorStops: [
            'responsive',
            'dark',
            'dark:hover',
            'dark:focus',
            'hover',
            'focus',
        ],
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
        outline: ['invalid', 'hover', 'focus', 'disabled'],
        textColor: [
            'invalid',
            'hover',
            'disabled',
            'group-hover',
            'dark',
            'dark:hover',
            'dark:focus',
        ],
    },

    plugins: [
        require('@tailwindcss/ui'),
        require('@tailwindcss/forms'),
        require('tailwindcss-invalid-variant-plugin'),
        require('tailwindcss-multi-theme'),
        require('tailwind-bootstrap-grid')(),
    ],
    corePlugins: {
        container: false,
    },
};
