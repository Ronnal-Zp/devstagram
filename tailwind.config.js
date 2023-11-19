/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php"
  ],
  theme: {
    extend: {
      spacing: {
        '128': '32rem',
        '256': '64rem',
        '274': '82rem'
      }
    },
  },
  plugins: [],
}

