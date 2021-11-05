module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: theme => ({
        'primary': '#9b59b6',
        'secondary': '#95a5a6',
        'success': '#27ae60',
        'error': '#c0392b',
        'infos': '#3498db',
        'warning': '#e67e22',
        'red-light': '#e74c3c',
        'red-dark': '#c0392b',
        'green-light': '#2ecc71',
        'green-dark': '#27ae60',
      })
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
