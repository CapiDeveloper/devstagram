/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php"
  ],
  theme: {
    extend: {
      colors:{
        "obscuro":"#000000",
        "claro":"#DBDBDB"
      }
    },
  },
  plugins: [],
}
// C:\Laravel\devstagram\vendor\laravel\framework\src\Illuminate\Pagination\resources\views