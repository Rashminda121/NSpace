document.addEventListener("DOMContentLoaded", function() {
  var toggleNav = document.getElementById("toggleNav");
  var navbarDefault = document.getElementById("navbar-default");

  toggleNav.addEventListener("click", function() {
    navbarDefault.classList.toggle("hidden");
  });
});
