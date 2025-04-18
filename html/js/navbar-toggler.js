// ====================================================
// to close navbar-collapse on click
// ====================================================
const btnLogin = document.querySelectorAll(".navbar .btn-login");
btnLogin.forEach((button) => {
  button.addEventListener("click", function () {
    const collapse = document.querySelector(".navbar-collapse");
    // Hide the navbar collapse directly
    const bsCollapse = new bootstrap.Collapse(collapse, { hide: true });
  });
});
// ====================================================
//   to toggle color of nav button
// ====================================================
const btnToggle = document.getElementById("toggle-color");
btnToggle.addEventListener("click", function () {
btnToggle.classList.toggle("toggled");
});