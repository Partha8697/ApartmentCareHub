let emailRef = document.getElementById("email");
let passwordRef = document.getElementById("password");
let captchaRef = document.getElementById("captcha-check");
let eyeL = document.querySelector(".eyeball-l");
let eyeR = document.querySelector(".eyeball-r");
let handL = document.querySelector(".hand-l");
let handR = document.querySelector(".hand-r");

let normalEyeStyle = () => {
  eyeL.style.cssText = "left: 0.8em; top: 0.63em;";
  eyeR.style.cssText = "right: 0.8em; top: 0.63em;";
};

let normalHandStyle = () => {
  handL.style.cssText =
    "height: 3.18em; top: -1em; left: 3.2em; transform: rotate(0deg);";
  handR.style.cssText =
    "height: 3.18em; top: -1em; right: 3.2em; transform: rotate(0deg);";
};

// When clicked on username input
emailRef.addEventListener("focus", () => {
  eyeL.style.cssText = "left: 0.9em; top: 1.25em;";
  eyeR.style.cssText = "right: 0.9em; top: 1.27em;";
  normalHandStyle();
});

// When clicked on captcha input
captchaRef.addEventListener("focus", () => {
  eyeL.style.cssText = "left: 0.9em; top: 1.25em;";
  eyeR.style.cssText = "right: 0.9em; top: 1.27em;";
  normalHandStyle();
});

// When clicked on password input
passwordRef.addEventListener("focus", () => {
  handL.style.cssText =
    "height: 7.43em; top: -6.13em; left: 7.25em; transform: rotate(-155deg);";
  handR.style.cssText =
    "height: 7.43em; top: -6.13em; right: 7.25em; transform: rotate(155deg);";
  normalEyeStyle();
});

// When clicked outside username and password input
document.addEventListener("click", (e) => {
  let clickedElem = e.target;
  if (clickedElem != emailRef && clickedElem != passwordRef && clickedElem != captchaRef) {
    normalEyeStyle();
    normalHandStyle();
  }
});

