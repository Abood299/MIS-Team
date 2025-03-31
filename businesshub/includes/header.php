
<!DOCTYPE html>
<html lang="en"> 
<head>
    <!-- the link tag below for linking css bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- chatgpt addons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


<!-- add FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <title>Business Hub</title>
    <!-- css withing the style -->
<!-- this is for burger menu toggle  -->
    <script> document.addEventListener("DOMContentLoaded", function() {
        const burgerMenu = document.querySelector(".burger-menu");
        const menuOverlay = document.querySelector(".menu-overlay");
    
        burgerMenu.addEventListener("click", function() {
            menuOverlay.classList.toggle("active");
        });
    });
    </script>
       <!-- this script for closing the burger menu with ✖ -->
       <script>
        document.addEventListener("DOMContentLoaded", function() {
            const burgerMenu = document.querySelector(".burger-menu");
            const menuOverlay = document.querySelector(".menu-overlay");
            const closeButton = document.querySelector(".close-btn");
    
            // Open the menu when clicking the burger icon
            burgerMenu.addEventListener("click", function() {
                menuOverlay.classList.add("active"); // Ensure it opens correctly
            });
    
            // Close the menu when clicking the close (X) button
            closeButton.addEventListener("click", function() {
                menuOverlay.classList.remove("active"); // Properly hides the overlay
            });
        });
    </script>
    
<base href="/businesshub/">
<?php $version = filemtime('css/header-footer.css'); ?>
<link rel="stylesheet" href="css/header-footer.css?v=<?php echo $version; ?>">

  
</head>
<!-- PUT YOUR STYLE HERE GUYS ⬇⬇⬇⬇⬇⬆ -->
<style>




</style>




    
      <!-- HEADER SECTION 🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥-->


    <header class="navbar">
        <div class="logo-container">
            <a href="MainPagefull.html">
                <img src="images/logo.png" alt="Business Hub Logo" class="logo">
            </a>
            
            <a href="MainPagefull.html" style="text-decoration: none; white-space: nowrap;">
                <span class="business-text" style="text-shadow: 0 0 5px #EC522D;">Business</span><span class="hub-text" style="text-shadow: 0 0 7px #5E2950;">Hub</span>



            </a>
        </div>
        <nav class="nav-links">
            <div class="dropdown">
                <button class="dropbtn">الأقسام <i class="fas fa-caret-down"></i></button>
                <div class="dropdown-content">
                    <a href="MIS.html">نظم المعلومات الإدارية</a>
                    <a href="BUS.html">إدارة الأعمال</a>
                    <a href="ECO.html">اقتصاد الأعمال</a>
                    <a href="PBUS.html">الإدارة العامة</a>
                    <a href="FNC.html">التمويل</a>
                    <a href="MKT.html">التسويق</a>
                    <a href="ACC.html">المحاسبة</a>
                </div>
            </div>
            <a href="#">أعضاء هيئة التدريس</a>
            <a href="#">القاعات</a>
            <a href="#">تبادل الكتب</a>
        </nav>
        <div class="icons">
            <i class="fas fa-search search-icon" onclick="toggleSearchPopup()"></i>


            <i class="fas fa-bars burger-menu" ></i>
            <a href="MainPagefull.html" class="sign-in">Sign in</a>
     

        </div>

    </header>
    <!-- Grey Overlay Menu -->
<div class="menu-overlay">
   
    <!-- Logo in the Grey Overlay Menu -->
    <div class="menu-logo">
        <a href="MainPagefull.html">
            <img src="images/logo.png" alt="Business Hub Logo">
        </a>
        <a href="MainPagefull.html" style="text-decoration: none;">
            <span class="business-text" style="text-shadow: 0 0 10px #EC522D, 0 0 20px #EC522D;">Business</span>&nbsp; <span class="hub-text" style="text-shadow: 0 0 10px #5E2950, 0 0 20px #5E2950;">Hub</span>



        </a>
    </div>
    <button class="close-btn">✖</button>
    <div class="menu-links">
        <div class="halls-dropdown">
            <a href="#">القاعات </a>
          
        </div>
        <a href="#">الأقسام</a>
        <a href="#">تبادل الكتب</a>
        <a href="#">هيئة التدريس</a>
        <a href="#">حساب المعدل التراكمي</a>
        <a href="#">متطلبات التخرج</a>
        <a href="#">هل تود خوض تجربة جديدة؟</a>
        <a href="#">خدمات استفد منها قبل تخرجك</a>
    </div>
</div>

  

  <!-- this script for notification center open  -->
  <script>
    const notifBtn = document.getElementById('notification-btn');
    const notifPanel = document.getElementById('notification-panel');
  
    notifBtn.addEventListener('click', () => {
      notifPanel.classList.toggle('show');
    });
  
    // Hide panel when clicking outside
    window.addEventListener('click', function (e) {
      if (!notifBtn.contains(e.target) && !notifPanel.contains(e.target)) {
        notifPanel.classList.remove('show');
      }
    });
  </script>
  
 

<!-- Search Bar Popup -->
<div class="search-popup">
    <div class="search-container">
        <input type="text" class="search-input" placeholder="Search...">
        <button class="close-search">✖</button>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchIcon = document.querySelector(".fa-search");
        const searchPopup = document.querySelector(".search-popup");
        const closeSearch = document.querySelector(".close-search");

        searchIcon.addEventListener("click", function () {
            searchPopup.classList.add("active");
        });

        closeSearch.addEventListener("click", function () {
            searchPopup.classList.remove("active");
        });

        // Close on outside click
        searchPopup.addEventListener("click", function (e) {
            if (e.target === searchPopup) {
                searchPopup.classList.remove("active");
            }
        });
    });
</script>

    </script>   
    <!-- this small code to open the grey list -->
 <div class="menu-overlay">
        <button class="close-btn">✖</button>
    </div>
  
      <!-- HEADER SECTION 🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥-->



</body>
</html>





