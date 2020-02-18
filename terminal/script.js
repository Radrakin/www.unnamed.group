// https://github.com/jcubic/jquery.terminal/wiki/Getting-Started

const commandPallette = {
  help: help,
  about: about,
  discord: discord,
  handbook: handbook,
  login: login
};

function about() {
  return (
    "\n[[;yellow;]Welcome to unnamed.group!]\n\n" +
    "[[;lime;]Who We Are]\n" +
    'Firstly, we’re not a "unit," we’re a group of friends who enjoy playing Arma together as the bad guys. Now that’s out of the way, we are the Unnamed Arma Group, an organization for mercenaries who care about nothing but getting the job done and getting paid. We operate with an arsenal more advanced than any other military force on the planet, meaning more opportunities to experience a unique perspective of Arma 3 MILSIM gameplay.\n\n' +
    "[[;lime;]What We Expect]\n" +
    "Due to the way we like to keep this group about having fun and just playing Arma together with friends, we don’t expect too much in terms of behaviour and protocol. All we expect from our members is respect and commitment to making UAG a place we can all enjoy. Other than that, we do have some basic requirements:\n- Legitimate copy of Arma 3\n- Working microphone\n- Intermediate English skills\n- Ability to achieve minimum attendance (one session a week)\n\n" +
    "[[;lime;]Our Schedule]\n" +
    "Every Saturday and Sunday at 18:00 UTC!\n\n" +
    "[[;lime;]Still Interested?]\n" +
    "Hit us up in Discord by running the following command: discord\n"
  );
}

function discord() {
  openInNewTab("https://unnamed.group/discord");
}

function handbook() {
  openInNewTab("https://unnamed.group/handbook");
}

function openInNewTab(href) {
  Object.assign(document.createElement("a"), {
    target: "_blank",
    href
  }).click();
}

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
  return "[[;lime;]=>> ]";
}

function greetings() {
  return (
    "[[;red;]Connected, terminal ID: " +
    randomNum(10, 1000000) +
    "]\n" +
    "[[;green;]host fingerprint uuid: " +
    uuidv4() +
    "]\n" +
    "Welcome to UAGOS 20.1E (UNL/UKNL 1.2.1-2400-gcp x86_64)\n\n" +
    "  System information as of " +
    getCurrentDateTime() +
    "\n\n" +
    "  System load: " +
    randomNum(0, 100) +
    "%\n  Processes: " +
    randomNum(10, 300) +
    "\n" +
    "  Usage of /: " +
    randomNum(3, 98) +
    "% of 999.58GB\n  Users logged in: " +
    randomNum(1, 39) +
    "\n" +
    "  Memory usage: " +
    randomNum(2, 73) +
    "%\n  IP address for ens4: " +
    randomIPAddress() +
    "\n" +
    "  Swap usage: " +
    randomNum(0, 90) +
    "%\n\n" +
    "[[;yellow;]To learn more about the group, run: about]\n\n"
  );

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
