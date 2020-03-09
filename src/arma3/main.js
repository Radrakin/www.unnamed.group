import $ from "jquery";

window.addEventListener("load", event => {
  localStorage.removeItem("currentBackgroundImageName");

  setInterval(() => {
    $.getJSON("./gallery/manifest.json", data => {
      let list = [];
      data.children.forEach(element => {
        list.push(element.name);
      });

      if (localStorage.getItem("currentBackgroundImageName") !== null) {
        list = list.filter(item => {
          return item !== localStorage.getItem("currentBackgroundImageName");
        });
      }

      let random = list[Math.floor(Math.random() * list.length)];

      localStorage.setItem("currentBackgroundImageName", random);

      document.body.style.backgroundImage = "url(./gallery/" + random + ")";
    });
  }, 3000);
});
