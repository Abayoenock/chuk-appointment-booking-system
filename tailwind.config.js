module.exports = {
  content: ['./*.{html,js,php}', './rec/*.{html,js,php}', './admin/*.{html,js,php}', './doc/*.{html,js,php}'],
  theme: {
    screens: {
      sm: '480px',
      md: '768px',
      lg: '976px',
      xl: '1440px',
    },
    extend: {
      animation: {
        'spin-slow': 'spin 30s linear infinite',
      },
      colors: {
        brightRed: 'hsl(12, 88%, 59%)',
        brightRedLight: 'hsl(12, 88%, 69%)',
        brightRedSupLight: 'hsl(12, 88%, 95%)',
        darkBlue: 'hsl(228, 39%, 23%)',
        darkGrayishBlue: 'hsl(227, 12%, 61%)',
        veryDarkBlue: 'hsl(233, 12%, 13%)',
        veryPaleRed: 'hsl(13, 100%, 96%)',
        veryLightGray: 'hsl(0, 0%, 98%)',
        veryLightBlueIll: '#9AB3DA',
        lightBlack: '#404B7C',
        primary: '#23a2c5',

      },
      zIndex: {
        '1': '1',
        '2': '2',
        '100': '100',
      },
    },
  },
  plugins: [],
}
