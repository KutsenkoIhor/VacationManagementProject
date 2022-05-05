const colors = require('tailwindcss/colors')
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue"
    ],
    theme: {
        extend: {
            colors: {
                grey: colors.grey,
                cyan: colors.cyan,
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms')
    ],
}


