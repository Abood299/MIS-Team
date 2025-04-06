  <!-- HEADER SECTION 🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥-->


    <header class="navbar">
        <div class="logo-container">
            <a href="HomePage.php">
                <img src="images/logo.png" alt="Business Hub Logo" class="logo">
            </a>
            
            <a href="HomePage.php" style="text-decoration: none; white-space: nowrap; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"> 
              <span class="business-text" style="text-shadow: 0 0 5px #EC522D;">Business</span><span class="hub-text" style="text-shadow: 0 0 7px #5E2950;">Hub</span>
              
</a>



            </a>
        </div>
        <nav class="nav-links" >
            <div class="dropdown">
                <button class="dropbtn">الأقسام <i class="fas fa-caret-down"></i></button>
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
            <i class="fas fa-search search-icon" onclick="toggleSearchPopup()"></i>


            <i class="fas fa-bars burger-menu" ></i>
            <a href="HomePage.php" class="sign-in">Sign in</a>
     

        </div>


    </header>

    <!-- Search Bar Popup -->
    <div class="search-popup-header">
    <div class="search-container-header">
        <input type="text" class="search-input-header" placeholder="Search...">
        <button class="search-close-btn-header">✖</button>
    </div>
</div>


<!-- Grey Overlay Menu --> 
<div class="menu-overlay">

  <!-- Logo in the Grey Overlay Menu -->
  <div class="menu-logo">
    <a href="HomePage.php">
      <img src="images/logo.png" alt="Business Hub Logo">
    </a>
    <a href="HomePage.php" style="text-decoration: none; white-space: nowrap; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
      <span class="business-text" style="text-shadow: 0 0 10px #EC522D, 0 0 20px #EC522D;">Business</span>&nbsp;
      <span class="hub-text" style="text-shadow: 0 0 10px #5E2950, 0 0 20px #5E2950;">Hub</span>
    </a>
  </div>

  <!-- Correct position of the close button -->
  <button class="menu-close-btn">✖</button>

    <div class="menu-links">
        <div class="halls-dropdown">
            <a href="halls.php">القاعات </a>
          
        </div>
        <a href="#">الأقسام</a>
        <a href="booksexchange.php">تبادل الكتب</a>
        <a href="AcademicStaff.php">هيئة التدريس</a>
        <a href="GPA.php">حساب المعدل التراكمي</a>
        <a href="GraduateReq.php">متطلبات التخرج</a>
        <a href="#">هل تود خوض تجربة جديدة؟</a>
        <a href="#">خدمات استفد منها قبل تخرجك</a>
    </div>
</div>
  




 

      <!-- HEADER SECTION 🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥-->


      <script>
document.addEventListener("DOMContentLoaded", function () {
  // 🎯 Search popup
  const searchIcon = document.querySelector(".fa-search");
  const searchPopup = document.querySelector(".search-popup-header");
  const closeSearch = document.querySelector(".search-close-btn-header");

  searchIcon?.addEventListener("click", () => {
    searchPopup?.classList.add("active");
  });

  closeSearch?.addEventListener("click", () => {
    searchPopup?.classList.remove("active");
  });

  searchPopup?.addEventListener("click", (e) => {
    if (e.target === searchPopup) {
      searchPopup.classList.remove("active");
    }
  });

  // 🍔 Burger menu + Grey overlay
  const burgerMenu = document.querySelector(".burger-menu");
  const menuOverlay = document.querySelector(".menu-overlay");
  const closeButton = document.querySelector(".menu-close-btn");


  burgerMenu?.addEventListener("click", () => {
    menuOverlay?.classList.add("active");
  });

  closeButton?.addEventListener("click", () => {
    menuOverlay?.classList.remove("active");
  });
});

</script>
