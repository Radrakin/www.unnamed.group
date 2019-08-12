const http = require("http");
const fs = require("fs");

const hostname = "0.0.0.0";
const port = process.argv[2];

function minifyLoadout(input) {
  return input
    .toString()
    .trim()
    .replace(/(\r\n|\n|\r)/gm, "")
    .replace(/\s*;\s*/g, ";");
}

function indexPage() {
  let publicLoadouts = require("./src/publicLoadouts.json");

  let data = "<h1>PUBLIC LOADOUTS:</h1><ul>";

  for (var x in publicLoadouts) {
    if (publicLoadouts.hasOwnProperty(x)) {
      data += "<li><a href='/" + x + "'><b>[" + x + "]</b> " + publicLoadouts[x] + "</a></li>";
    }
  }

  return data + "</ul>";
}

const server = http.createServer((req, res) => {
  switch (req.url) {
    case "/":
      res.statusCode = 200;
      res.setHeader("Content-Type", "text/html");
      res.end(indexPage());
      break;
    case "/favicon.ico":
      //TODO: add favicon image
      res.statusCode = 404;
      res.end();
      break;
    default:
      const _s = req.url
        .trim()
        .replace("src/", "")
        .replace("..", "");
      let path = "src/loadouts" + _s + ".sqf";
      if (fs.existsSync(path)) {
        let _x = minifyLoadout(fs.readFileSync(path));
        res.statusCode = 200;
        res.setHeader("Content-Type", "text/plain");
        res.end(_x);
      } else {
        res.statusCode = 404;
        res.setHeader("Content-Type", "text/plain");
        res.end("that loadout doesn't exist, normie! REEEEEEEEE! >:C");
      }
  }
});

server.listen(port, hostname, () => {
  console.log(`Server running at http://${hostname}:${port}/`);
});
