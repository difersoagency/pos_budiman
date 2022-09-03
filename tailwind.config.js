module.exports = {
  mode : 'jit',
  corePlugins:{
    preflight: false,
  },
  prefix: 'tw-',
  important: true,
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
