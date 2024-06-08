const passShowHide = document.querySelectorAll(".pass-hide");

passShowHide.forEach((icon) => {
    icon.addEventListener("click", () => {
      let getPwInput = icon.parentElement.querySelector("input");
      if (getPwInput.type === "password") {
        getPwInput.type = "text";
        icon.classList.replace("uil-eye-slash", "uil-eye");
      } else {
        getPwInput.type = "password";
        icon.classList.replace("uil-eye", "uil-eye-slash");
      }
    });
  });

// Function to reload the CAPTCHA
function reloadCaptcha() {
  const captchaTextBox = document.querySelector(".captch-box input");

  // Make an AJAX request to a PHP script to generate a new CAPTCHA code
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
          // Update the input field with the new CAPTCHA code
          captchaTextBox.value = xhr.responseText;
      }
  };
  xhr.open('GET', 'Captcha/reGenerateCaptcha.php', true);
  xhr.send();
}

// Attach an event listener to the reload icon (button)
const refreshButton = document.querySelector(".refresh-button");
refreshButton.addEventListener('click', reloadCaptcha);