document.addEventListener("DOMContentLoaded", function () {
  const container = document.getElementById("container");
  const registerBtn = document.getElementById("register");
  const loginBtn = document.getElementById("login");
  const registerBtnMobile = document.getElementById("register-mobile");
  const showButton = document.getElementById("type1");
  const hideButton = document.getElementById("type2");
  const div = document.getElementById("doc-info");
  const showLoginBtn = document.querySelector("#show-login");
  const closeLoginBtn = document.querySelector("#close");

  // Website toggler
  if (registerBtn) {
    registerBtn.addEventListener("click", () => {
      container.classList.add("active");
    });
  }

  if (loginBtn) {
    loginBtn.addEventListener("click", () => {
      container.classList.remove("active");
      toggleButtonText();
    });
  }

  // Mobile toggler
  if (registerBtnMobile) {
    registerBtnMobile.addEventListener("click", () => {
      container.classList.toggle("active");
    });
  }

  // Toggle type selection
  const buttons = document.querySelectorAll(".type-btn");
  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      buttons.forEach((btn) => btn.classList.remove("selected"));
      button.classList.add("selected");
    });
  });

  // Show/hide doctor info
  if (showButton) {
    showButton.addEventListener("click", () => {
      div.style.display = "block";
      document.querySelector('input[name="verification_id"]').setAttribute("required", true);
    });
  }

  if (hideButton) {
    hideButton.addEventListener("click", () => {
      div.style.display = "none";
      document.querySelector('input[name="verification_id"]').removeAttribute("required");
      document.querySelector('input[name="license"]').value = '';
      document.querySelector('input[name="degree"]').value = '';
      document.querySelector('input[name="verification_id"]').value = '';
    });
  }

  // Show/hide login modal
  if (showLoginBtn) {
    showLoginBtn.addEventListener("click", () => {
      document.querySelector(".login-modal").classList.add("active");
    });
  }

  if (closeLoginBtn) {
    closeLoginBtn.addEventListener("click", () => {
      document.querySelector(".login-modal").classList.remove("active");
    });
  }

  function toggleButtonText() {
    if (registerBtnMobile && registerBtnMobile.innerText === "Register") {
      registerBtnMobile.innerText = "Login";
    } else if (registerBtnMobile) {
      registerBtnMobile.innerText = "Register";
    }
  }
});