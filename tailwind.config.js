/** @type {import('tailwindcss').Config} */
module.exports = {
  // Specify the paths to all of the template files in your project
  content: [
    './public/**/*.{html,php}', // Scan all HTML and PHP files in the public directory and its subdirectories
    './src/**/*.{html,js}',     // Scan all HTML and JS files in the src directory and its subdirectories
  ],
  
  // Extend the default Tailwind theme
  theme: {
    extend: {
      // Extend the default color palette
      colors: {
        'custom-blue': '#21408E'  // Define a custom blue color
      },
      // Extend the default height scale
      height: {
        'custom-card': '50rem' // Define a custom height for your cards
      }
      // You can add more theme extensions here (e.g., spacing, border radius)
    }
  },
  
  // Include any Tailwind plugins you are using
  plugins: [
    // List your Tailwind CSS plugins here
  ],
}
