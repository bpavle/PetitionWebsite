var timeoutID;

function setup() {
  this.addEventListener("mousemove", resetTimer, false);
  this.addEventListener("mousedown", resetTimer, false);
  this.addEventListener("keypress", resetTimer, false);
  this.addEventListener("DOMMouseScroll", resetTimer, false);
  this.addEventListener("mousewheel", resetTimer, false);
  this.addEventListener("touchmove", resetTimer, false);
  this.addEventListener("MSPointerMove", resetTimer, false);

  startTimer();
}
setup();

function startTimer() {
  timeoutID = window.setTimeout(goInactive, 5000);
}

function resetTimer(e) {
  window.clearTimeout(timeoutID);

  goActive();
}

function goInactive() {
  alert("Korisnik je neaktivan 5 sekundi!");
}

function goActive() {
  startTimer();
}
