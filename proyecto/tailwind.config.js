/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      //De esta manera se pueden añadir clases personalizados a tailwind
      colors: {
        'custom-purple':'#5D00C7',
        'custom-blue':'#1C00C7',
        'custom-black':'#050406',
        'custom-white':'#F9F9F9',
      },
      boxShadow: {
        'custom-sm': '5px 5px 0px 0px',
        'custom-md': '10px 10px 0px 0px',
        'custom-lg': '15px 15px 0px 0px',
      }
    },
  },
  plugins: [],
}

