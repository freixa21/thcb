  module.exports = {
   content: [
     './resources/**/*.blade.php',
     './resources/**/*.js',
     './resources/**/*.vue',
   ],
   theme: {
    extend: {
      colors: {
        blue: {
          '950': '#9b4132',
          '900': '#9b4132',
          '800': '#a14e40',
          '700': '#9b4132',
          '600': '#9b4132',
          '500': '#a14e40',
          '300': '#9b4132',
        }
      }
    },
  },
    variants: {
      extend: {
        fontFamily: {
          'Recoleta Regular': ['Recoleta Regular', 'sans-serif']
        }
      },
    },
    plugins: [],
 }
