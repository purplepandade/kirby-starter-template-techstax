module.exports = {
    darkMode: 'class',
    theme: {
      extend: {
        colors: {
          transparent: 'transparent',
          primary: "var(--primaryColor)",
          lightbg: "var(--lightBg)",
          font: "var(--fontColor)",
          bodyBG: "var(--bodyBG)",
          colorBurn: "var(--colorBurn)"
        },
        gridTemplateColumns: {
          'jobs': '7fr repeat(2, 2fr) 1fr',
          'footer': '2fr 1fr 1.5fr 1fr',
          'jobs-mobile': '4fr 1fr',
    
          'job-grid': "6fr 3fr",
          'contact': "6fr 4fr",
          
        }
      },
      fontFamily: {
        karla: ['"Karla"', 'sans-serif']
      },
    },
    variants: {},
    plugins: []
 
  }