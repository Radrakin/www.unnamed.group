module.exports = () => {
  return {
    enhanceAppFiles() {
      return {
         name: 'darkreader',
         content: `export default () => {
           window.addEventListener('load', function () {
             var DarkReader = require("darkreader");
             var Cookies = require("js-cookie");

             var darkModeOptions = {
                 brightness: 150,
                 contrast: 80,
                 sepia: 0,
             };

             var toggler = document.createElement("a");

             toggler.classList.add("repo-link");
             toggler.href = "javascript:null";

             if (Cookies.get("darkModeToggle") === "1") {
                 DarkReader.enable(darkModeOptions);
                 toggler.innerHTML = "Light Mode";
             } else {
                 toggler.innerHTML = "Dark Mode";
             }

             toggler.addEventListener("click", function (e) {
                 if (Cookies.get("darkModeToggle") === "1") {
                     DarkReader.disable()
                     Cookies.set("darkModeToggle", "0", { expires: 30 });
                     this.innerHTML = "Dark Mode";
                 } else {
                     DarkReader.enable(darkModeOptions);
                     Cookies.set("darkModeToggle", "1", { expires: 30 });
                     this.innerHTML = "Light Mode";
                 }
             });

             document.body.getElementsByClassName('nav-links')[0].appendChild(toggler);
           })
         }`
       }
    }
  }
}
