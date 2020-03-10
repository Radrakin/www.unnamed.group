window.addEventListener("load", event => {
  localStorage.removeItem("currentBackgroundImageName");

  setInterval(() => {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "./gallery/manifest.json", true);
    xmlhttp.onreadystatechange = () => {
      if (xmlhttp.readyState == 4) {
        if (xmlhttp.status == 200) {
          let reponseJSON = JSON.parse(xmlhttp.responseText);

          let list = [];
          reponseJSON.children.forEach(element => {
            list.push(element.name);
          });

          if (localStorage.getItem("currentBackgroundImageName") !== null) {
            list = list.filter(item => {
              return (
                item !== localStorage.getItem("currentBackgroundImageName")
              );
            });
          }

          let random = list[Math.floor(Math.random() * list.length)];

          localStorage.setItem("currentBackgroundImageName", random);

          document.body.style.backgroundImage = "url(./gallery/" + random + ")";
        }
      }
    };
    xmlhttp.send(null);
  }, 5000);
});
