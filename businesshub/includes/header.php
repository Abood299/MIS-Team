<?php 
// includes/header.php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<header class="navbar">
  <div class="logo-container">
    <a href="HomePage.php">
      <img src="images/3d-logo2.png" alt="Business Hub Logo" class="logo">
    </a>
    <a href="HomePage.php" class="brand-text">
      <span class="business-text">Business</span>
      <span class="hub-text">Hub</span>
    </a>
  </div>

  <nav class="nav-links">
    <div class="dropdown">
      <button class="dropbtn">
        الأقسام <i class="fas fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="MIS.php">نظم المعلومات الإدارية</a>
        <a href="BUS.php">إدارة الأعمال</a>
        <a href="ECO.php">اقتصاد الأعمال</a>
        <a href="PBUS.php">الإدارة العامة</a>
        <a href="FNC.php">التمويل</a>
        <a href="MKT.php">التسويق</a>
        <a href="ACC.php">المحاسبة</a>
      </div>
    </div>
    <a href="AcademicStaff.php">أعضاء هيئة التدريس</a>
    <a href="halls.php">القاعات</a>
    <a href="booksexchange.php">تبادل الكتب</a>
  </nav>

  <div class="icons">
    <?php if (isset($_SESSION['user_id'])): ?>
      <!-- 1) Welcome text first -->
      <span class="nav-link welcome-text">
        Welcome <?= htmlspecialchars($_SESSION['first_name']) ?>
      </span>
    <?php endif; ?>

    <!-- 2) Search icon -->
    <i class="fas fa-search search-icon" onclick="toggleSearchPopup()"></i>
    <!-- 3) Burger menu -->
    <i class="fas fa-bars burger-menu"></i>

    <?php if (isset($_SESSION['user_id'])): ?>
      <!-- 4) Sign Out on the far right -->
      <a href="logout.php" class="sign-in">Sign Out</a>
    <?php else: ?>
      <!-- or Sign In if not logged in -->
      <a href="user_login.php" class="sign-in">Sign In</a>
    <?php endif; ?>
  </div>
</header>

<!-- Search Bar Popup -->
<div class="search-popup-header">
  <div class="search-container-header">
    <input type="text" class="search-input-header" placeholder="Search...">
    <button class="search-close-btn-header">
      <i class="fas fa-times"></i>
    </button>
  </div>
</div>

<!-- Grey Overlay Menu -->
<div class="menu-overlay">
  <!-- top: logo -->
  <div class="menu-logo">
    <a href="HomePage.php">
      <img src="images/logo.png" alt="Business Hub Logo">
    </a>
    <a href="HomePage.php" class="brand-text">
      <span class="business-text">Business</span>
      <span class="hub-text">Hub</span>
    </a>
  </div>

  

  <button class="close-btn-gry"><i class="fas fa-times"></i></button>

  <!-- your menu links -->
  <div class="menu-links">
    <a href="halls.php">القاعات</a>
    <a href="MIS.php">الأقسام</a>
    <a href="booksexchange.php">تبادل الكتب</a>
    <a href="AcademicStaff.php">هيئة التدريس</a>
    <a href="GPA.php">حساب المعدل التراكمي</a>
    <a href="GraduateReq.php">متطلبات التخرج</a>

    <!-- at bottom: sign in/out -->
    <div class="mobile-auth">
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="logout.php" class="mobile-signout">Sign Out</a>
      <?php else: ?>
        <a href="user_login.php" class="mobile-signin">Sign In</a>
      <?php endif; ?>
    </div>
  </div>
</div>

<script>
// Re-enable your existing search popup and burger menu scripts:
function toggleSearchPopup() {
  document.querySelector('.search-popup-header')?.classList.toggle('active');
}
document.addEventListener("DOMContentLoaded", () => {
  // close search on click outside, ESC, etc. (your code)

  document.addEventListener("DOMContentLoaded", function () {
    // 🎯 Search popup
    const searchIcon = document.querySelector(".fa-search");
    const searchPopup = document.querySelector(".search-popup-header");
    const closeSearch = document.querySelector(".search-close-btn-header");
    const searchContainer = document.querySelector(".search-container-header");

    searchIcon?.addEventListener("click", () => {
      searchPopup?.classList.toggle("active");
    });

    closeSearch?.addEventListener("click", () => {
      searchPopup?.classList.remove("active");
    });

    searchPopup?.addEventListener("click", (e) => {
      if (!searchContainer.contains(e.target)) {
        searchPopup.classList.remove("active");
      }
    });

    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && searchPopup?.classList.contains("active")) {
        searchPopup.classList.remove("active");
      }
    });
  });

  // burger menu toggle:
  document.querySelector('.burger-menu')?.addEventListener('click', () => {
    document.querySelector('.menu-overlay')?.classList.add('active');
  });
  document.querySelector('.close-btn-gry')?.addEventListener('click', () => {
    document.querySelector('.menu-overlay')?.classList.remove('active');
  });
});
</script>

<style>
/* Just the bits that changed positioning */
.brand-text {
  text-decoration: none;
  white-space: nowrap;
  font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;
}
.welcome-text {
    margin-right: auto;
    color: #ffffff93;
}
.sign-in {
  margin-left: 0.5rem;
}
/* Move the welcome/signout further right on desktop: */
.icons {
  display: flex;
  align-items: center;
  gap: 1rem;   
  /* already your styles */
}
</style>
