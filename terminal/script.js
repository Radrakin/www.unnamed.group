// https://github.com/jcubic/jquery.terminal/wiki/Getting-Started

$(function() {
  $("html").terminal(
    {
      login: login
    },
    {
      greetings: greetings(),
      prompt: prompt()
    }
  );
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
    "[[;red;]Connected to terminal #" + randomNum(10, 1000000) + "]";

  return greetingString;
}
