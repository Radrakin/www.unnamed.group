module.exports = () => {
  return {
    enhanceAppFiles() {
      return {
        name: "darkreader",
        content: `export default () => {
           try {
            window.addEventListener('load', function () {
              var DarkReader = require("darkreader");
              var Cookies = require("js-cookie");
 
              var darkModeOptions = {
                  brightness: 100,
                  contrast: 100,
                  sepia: 0,
              };
 
              var toggler = document.createElement("a");
 
              toggler.classList.add("repo-link");
              toggler.href = "javascript:null";
 
              if (Cookies.get("darkModeToggle") === undefined) {
               Cookies.set("darkModeToggle", "1", { expires: 30 });
              }
 
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
           } catch (e) {}
         }`
      };
    }
  };
};
