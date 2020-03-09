const path = require("path");

const dirTree = require("directory-tree");
const fs = require("fs");
const tree = dirTree(path.resolve(__dirname, "public/gallery"), {
  extensions: /\.(png|jpg|jpeg|gif|image)$/
});
fs.writeFile(
  "public/gallery/manifest.json",
  JSON.stringify(tree, null, " "),
  err => {
    if (err) throw err;
    console.log("Gallery manifest.json saved!");
  }
);

module.exports = {
  mode: "production",
  entry: "./main.js",
  output: {
    path: path.resolve(__dirname, "public"),
    filename: "main.bundle.js"
  }
};
