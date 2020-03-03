import { Terminal } from "xterm";

document.addEventListener("DOMContentLoaded", () => {
  var term = new Terminal();
  term.open(document.getElementById("terminal"));
  term.write("WIP $ ");
});
