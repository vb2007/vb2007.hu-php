//script that makes the shorten button rainbow
//it highlights the site's core function...
window.onload = function () {
   const button = document.querySelector("#nav-shorten");
   let hue = 0;

   setInterval(() => {
       button.style.color = `hsl(${hue}, 100%, 50%)`;
       hue = (hue + 1) % 360;
   }, 20);
}