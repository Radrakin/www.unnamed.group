// https://github.com/jcubic/jquery.terminal/wiki/Getting-Started

const commandPallette = {
  help: help,
  login: login
};

function help() {
  return Object.keys(commandPallette).join(", ");
}

$(function() {
  $("html").terminal(commandPallette, {
    greetings: greetings(),
    prompt: prompt()
  });
});

function login(params) {
  return "Unable to connect to authentication servers, please try again later.";
}

function randomNum(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

function prompt() {
  return "[[;lime;]>>> ]";
}

function greetings() {
  greetingString = "";

  greetingString +=
    "[[;red;]Connected, terminal ID:" +
    randomNum(10, 1000000) +
    "]\n" +
    "[[;green;]host fingerprint uuid: " +
    uuidv4() +
    "]\n" +
    "Welcome to UAGOS 20E (GNU/Linux 5.3.0-1011-gcp x86_64)\n\n" +
    "  System information as of " +
    getCurrentDateTime() +
    "\n\n" +
    "  System load:  " +
    randomNum(0, 100) +
    "%              Processes:           " +
    randomNum(10, 300) +
    "\n" +
    "  Usage of /:   " +
    randomNum(3, 98) +
    "% of 999.58GB   Users logged in:     " +
    randomNum(1, 39) +
    "\n" +
    "  Memory usage: " +
    randomNum(2, 73) +
    "%                IP address for ens4: " +
    randomIPAddress() +
    "\n" +
    "  Swap usage:   " +
    randomNum(0, 90) +
    "%\n\n" +
    "[[;yellow;]To list available commands run: help]\n\n";

  return greetingString;
}

function randomIPAddress() {
  return (
    randomNum(0, 256) +
    "." +
    randomNum(0, 256) +
    "." +
    randomNum(0, 256) +
    "." +
    randomNum(0, 256)
  );
}

function getCurrentDateTime() {
  let currentdate = new Date();
  return (
    currentdate.getDate() +
    "/" +
    (currentdate.getMonth() + 1) +
    "/" +
    currentdate.getFullYear() +
    " @ " +
    currentdate.getHours() +
    ":" +
    currentdate.getMinutes() +
    ":" +
    currentdate.getSeconds()
  );
}

function uuidv4() {
  return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
    (
      c ^
      (crypto.getRandomValues(new Uint8Array(1))[0] & (15 >> (c / 4)))
    ).toString(16)
  );
}
