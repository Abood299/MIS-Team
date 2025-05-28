document.addEventListener("DOMContentLoaded", function () {
    // 🍔 Burger menu + Grey overlay
    const burgerMenu = document.querySelector(".burger-menu");
    const menuOverlay = document.querySelector(".menu-overlay");
    const closeButton = document.querySelector(".close-btn-gry");
  
    burgerMenu?.addEventListener("click", () => {
      menuOverlay?.classList.add("active");
      document.body.classList.add("menu-open"); // Prevent background scroll
    });
  
    closeButton?.addEventListener("click", () => {
      menuOverlay?.classList.remove("active");
      document.body.classList.remove("menu-open"); // Restore scroll
    });
  
    // Optionally close menu on ESC key
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && menuOverlay?.classList.contains("active")) {
        menuOverlay.classList.remove("active");
        document.body.classList.remove("menu-open");
      }
    });
  });

