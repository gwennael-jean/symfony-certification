module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: theme => ({
        'primary': '#9b59b6',
        'secondary': '#95a5a6',
        'success': '#2ecc71',
        'error': '#e74c3c',
        'infos': '#3498db',
        'warning': '#e67e22',
      })
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
