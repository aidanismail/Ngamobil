/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './public/**/*.{html,php}',  // Scan all HTML and PHP files in the public directory and its subdirectories
    './src/**/*.{html,js}',      // Scan all HTML and JS files in the src directory and its subdirectories
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
