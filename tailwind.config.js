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
    extend: {
      colors: {
        'prim-white' : '#E8E8E8',
        'prim-red' : '#F05454',
        'prim-blue' : '#30475E',
        'prim-black' : '#222831',
        'prim-grey-light' : '#9ca3af',
        'prim-grey-dark': '#111827',
      }
    },
  },
  plugins: [],
}
