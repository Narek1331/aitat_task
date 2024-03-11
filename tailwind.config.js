/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/js/**/*.{vue,js}"],
    theme: {
      extend: {},
      container: {
        center: true,
      },
    },
    plugins: [
      require('tailwindcss'),
      require('autoprefixer'),
    ],
  }
