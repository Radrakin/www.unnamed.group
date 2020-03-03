const path = require("path");
const CopyPlugin = require("copy-webpack-plugin");

module.exports = {
  entry: "./src/main.js",
  output: {
    filename: "_main.js",
    path: path.resolve(__dirname, "dist/")
  },
  plugins: [
    new CopyPlugin([
      {
        from: "node_modules/xterm/css/xterm.css",
        to: "_xterm.css"
      }
    ])
  ]
};
