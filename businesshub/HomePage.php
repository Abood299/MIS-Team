<!DOCTYPE php>
<php lang="en"> 
<head>
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- chatgpt addons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- add FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- put on all pages  -->
     
    <base href="/businesshub/">
    <?php $version = filemtime('css/header-footer.css'); ?>
    <link rel="stylesheet" href="css/header-footer.css?v=<?php echo $version; ?>">

    <title>Business Hub</title>


  
    <style>
    body 
        {
    
            margin: 0;
            padding: 0;
            background-color: #FAF9F6; /* Light ivory color */
        }

        /* Moble responsive screens */

        @media (max-width: 768px) {
        .slideshow-container {
            margin-bottom: 100px;
        }
        }


        /* Video Section Styling  */
        
        .video-section {
            width: 100%;
            height: 400px; /* Slightly taller than before */
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            aspect-ratio: 16 / 9; /* Optional: keeps video in nice ratio */
        }

        .background-video {
            width: 100%;
            height: auto; /* 👈 Change this */
            object-fit: cover;
        }

     /* MAIN SERVICES Icon Section Styling - Adjusted for Bigger Icons and Spacing */ 
        
         /* Adjust icon positioning to float over the bottom of the video */
         .icon-section {
            display: flex;
            justify-content: center;
            margin: -63px 0 10px; /* Raised icons higher to overlap video */
            position: relative;
            z-index: 2;
        }
        .icon-container {
            display: flex;
            justify-content: space-between; /* Space between each icon */
            gap: 60px; /* Adjust this value for more/less spacing */
            align-items: center;
            flex-wrap: wrap; /* Allows them to wrap on small screens */
            padding: 0 50px; /* Optional: adds spacing left & right */
        }

        .icon-link {
            flex: 1 1 120px;
            text-align: center;
            margin: 20px;
            }

            /* Icon image style */
            .icon-link img {
            width: 120px;  /* Icon size */
            height: 120px;
            transition: transform 0.3s ease-in-out;
            }

            /* Hover animation */
            .icon-link img:hover {
            transform: scale(1.1);
            }
    

        /* Dropdown for Icons - Styled like Departments Dropdown */
        .icon-dropdown {
            position: relative;
            display: inline-block;
        }

        .icon-dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            min-width: 180px;
            z-index: 1;
            border-radius: 5px;
            padding: 10px;
        }

        .icon-dropdown-content a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: black;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
    
        }
        .icon-dropdown-content a:hover {
            background-color: #EC522D;
            color: white;
        }


        .icon-item:hover .icon-dropdown-content {
            display: block;
        }
        .search-icon,
        .notification-icon,
        .burger-menu {
          color: #ffffff93; /* or any color you prefer */
}



    

            /* first slide show styling */


            /* Section Styling */
            .info-section {
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 85%; /* Control overall section width */
                margin: 50px auto;
            }

            /* Text and Button Styling */
            .info-content {
                width: 50%; /* Adjusted width */
                text-align: left;
            }

            .bold-text {
                font-size: 28px;
                font-weight: bold;
                margin-bottom: 10px;
            /* under is a decorartion for slide show 1 title */
                    background: linear-gradient(to right, #FF5733, #C70039, #900C3F, #581845); 
                    -webkit-background-clip: text; 
                    -webkit-text-fill-color: transparent; 
                
            }

            .description-text {
                font-size: 20px;
                line-height: 1.6;
                margin-bottom: 20px;
                font-family: 'Playfair Display', serif;
            }

            .info-button {
                padding: 12px 20px;
                background-color: #EC522D;
                color: white;
                font-size: 16px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: 0.3s;
            }

            .info-button:hover {
                background-color: #b83e20;
            }

            /* Slideshow Panel 1 */
            .slideshow-container {
                width: 450px; /* Bigger width */
                height: 500px; /* Bigger height */
                border-radius: 25px;
                overflow: hidden;
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
                position: relative;
            }

            .slideshow-container img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                position: absolute;
                opacity: 0;
                transition: opacity 1s ease-in-out;
            }

            .slideshow-container img:first-child {
                opacity: 1; /* First image is visible initially */
            }

            /*  facebook fetching  */



            .fb-section {
                width: 80%;                  /* Responsive width */
            max-width: 950px;            /* Prevent stretching too far */
            height: auto;                /* Let it grow based on content */
            background: white;
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
            margin: 40px auto 60px auto; /* Top & bottom margin + horizontally center */
            padding: 20px;
            text-align: center;

            /* Optional: Slight shift to right */
            position: relative;
            left: 10px; /* Try 10-30px for slight right movement */
            }

            .fb-title {
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 10px;
            }

            .fb-container {
                width: 100%;
            max-width: 100%;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center
            
            }
            .fb-container iframe {
            margin-left: 20px; /* Or more if needed */
            }

            /* 🔧 Make Facebook feed responsive */
            .facebook-feed-wrapper {
                width: 100%;
            max-width: 100%;
            overflow: hidden;
            }

            .facebook-feed-wrapper iframe {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                border-radius: 12px; /* Optional: match the box rounding */
            }
            .fb-page,
            .fb-page iframe,
            .fb-page span,
            .fb-page span iframe {
            width: 100% !important;
            max-width: 100% !important;
            height: 600px !important;  /* Adjust if you want taller */
            border: none;}
            

            /* second slide show  */


            .big-slideshow-section {
                display: flex;
                justify-content: flex-start; /* Aligns the box to the left */
                margin-top: 40px;
                margin-left: 5%;
            }

            /* Slideshow Box */
            .big-slideshow-container {
                width: 450px; /* Bigger width */
                height: 500px; /* Bigger height */
                border-radius: 25px;
                margin-bottom: 60px; /* 👈 This creates space before footer */
                overflow: hidden;
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
                overflow: hidden;
                position: relative;
            }

            /* Hide all images ServicesIcon/by default */
            .big-slideshow-container img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                position: absolute;
                opacity: 0;
                transition: opacity 1s ease-in-out;
            }

            /* Show first image */
            .big-slideshow-container img:first-child {
                opacity: 1;
            }

            /* mobile video responsiveness */
            @media (max-width: 768px) {
            .video-section {
                aspect-ratio: 16 / 9;
                height: auto;
            }

            .background-video {
                height: auto;
                max-height: 300px;
            }
            }


            /* FAQ Modal styles */
            .modal {
            display: none; 
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
            }

            .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            }

            .close {
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            }



            /* for icons main services inside title  */
            .dropdown-title {
            font-weight: bold;
            padding: 10px 16px;
            color: #EC522D; /* Your theme orange */
            font-size: 15px;
            }
            .dropdown-title {
            border-bottom: 1px solid #eee;
            }
            /* info card for box exchange icon when hover  */
            .info-tooltip {
            position: absolute;
            bottom: -40px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.8); /* semi-transparent */
            color: white;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 14px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
            z-index: 10;}
            /* this for icon box exchange for the info card IT'S A BIT SCARY */
            .icon-item-me { 
            position: relative;
            display: inline-block;
            }
    </style>
</head>
<body>
    
   
  <?php include 'includes/header.php'; ?>
  
    <!-- Video Section -->
    <section class="video-section">
        <video autoplay loop muted playsinline class="background-video">
            <source src="videos/test for now.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section>

    <!-- Icon Section Below Video -->
    <section class="icon-section">
        <div class="icon-container">
            <div class="icon-item icon-dropdown">
               
                <a href="#" class="icon-link"><img src="images/ServicesIcon/tree.png" alt="Icon 1"></a>
                   </button><div class="icon-dropdown-content"> 
                    <div class="dropdown-title">شجرة التخصص</div>
                    <a href="MIS.php">نظم المعلومات الإدارية</a>
                    <a href="BUS.php">إدارة الأعمال</a>
                    <a href="ECO.php">اقتصاد الأعمال</a>
                    <a href="PBUS.php">الإدارة العامة</a>
                    <a href="FNC.php">التمويل</a>
                    <a href="MKT.php">التسويق</a>
                    <a href="ACC.php">المحاسبة</a>
                    
                </div>
            </div>
            <div class="icon-item icon-dropdown">
                <a href="#" class="icon-link"><img src="images/ServicesIcon/Books.png" alt="Icon 2"></a>
                <div class="icon-dropdown-content">
                    <div class="dropdown-title">كتب التخصص</div>
                    <a href="MIS.php">نظم المعلومات الإدارية</a>
                    <a href="BUS.php">إدارة الأعمال</a>
                    <a href="ECO.php">اقتصاد الأعمال</a>
                    <a href="PBUS.php">الإدارة العامة</a>
                    <a href="FNC.php">التمويل</a>
                    <a href="MKT.php">التسويق</a>
                    <a href="ACC.php">المحاسبة</a>
                </div>
            </div>
            <div class="icon-item icon-dropdown">
                <a href="#" class="icon-link"><img src="images/ServicesIcon/courses.png" alt="Icon 3"></a>
                <div class="icon-dropdown-content">
                    <div class="dropdown-title">دورات داعمة للتخصص</div>
                    <a href="MIS.php#courses-table-MIS">نظم المعلومات الإدارية</a>
                    <a href="BUS.php#courses-table-BUS">إدارة الأعمال</a>
                    <a href="ECO.php#courses-table-ECO">اقتصاد الأعمال</a>
                    <a href="PBUS.php#courses-table-PBUS">الإدارة العامة</a>
                    <a href="FNC.php#courses-table-FNC">التمويل</a>
                    <a href="MKT.php#courses-table-MKT">التسويق</a>
                    <a href="ACC.php#courses-table-ACC">المحاسبة</a>
                </div>
            </div>
            <div class="icon-item-me">
                <a href="booksexchange.php" class="icon-link" id="books-icon">
                  <img src="images/ServicesIcon/Booksexchange.png" alt="Icon 4">
                </a>
                <div class="info-tooltip" id="books-tooltip">
                  تبادل الكتب
                </div>
   
              </div>
            <div class="icon-item">
                <a href="#" class="icon-link"><img src="images/ServicesIcon/FAQ.png" alt="Icon 5"></a>
            </div>

            <!-- FAQ Modal -->
<div id="faqModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>الأسئلة الأكثر تكرارا</h2>
      <p><strong>Q1:</strong> What is Business Hub?</p>
      <p><strong>A:</strong> A platform to help business students with resources and support.</p>
      <hr>
      <p><strong>Q2:</strong> How do I exchange books?</p>
      <p><strong>A:</strong> Login and visit the Book Exchange section.</p>
      <hr>
      <p><strong>Q3:</strong> Who can use this site?</p>
      <p><strong>A:</strong> Business students, assistants, and admins.</p>
      <p><strong>Q1:</strong> What is Business Hub?</p>
      <p><strong>A:</strong> A platform to help business students with resources and support.</p>
     
      <hr>
   
    </div>
  </div>
 
  

  
    </section>
<!-- Section for Text and Slideshow 1 -->
<section class="info-section">
    <div class="info-content">
        <h1 class="bold-text">خدمات استفد منها قبل تخرجك</h1>





        
        <p class="description-text">
    
            أربع سنوات. محاضرات لا تُحصى. ليالٍ لا تنتهي من القهوة. لكن ماذا لو قلنا لك إن هناك المزيد؟<br>

            أكثر من مجرد قاعات دراسية وممرات. أكثر من نفس الأماكن المألوفة التي يعرفها الجميع.<br>
            
            في زوايا الحرم الجامعي غير الملحوظة، توجد شبكة خدمات خفية <br>
            أماكن تُوحي بالراحة لكنها تبقى بعيدة عن أنظار معظم الناس.
       
            
        </p>
        <button class="info-button">استكشف</button>
    </div>

    <!-- Slideshow Panel 1-->
    <div class="slideshow-container">
        <img src="images/slide1.jpg" alt="Slideshow Image 1">
        <img src="images/slide2.jpg" alt="Slideshow Image 2">
        <img src="images/slide3.jpg" alt="Slideshow Image 3">
    </div>
</section>



<!-- fetch facebook posts code -->

<section class="fb-section">
    <h2 class="fb-title">📢 اعلانات صفحة الكلية</h2>
    <div class="fb-container">
        <div class="fb-page"
            data-href="https://web.facebook.com/JUBS.Official.Site/?locale=ar_AR&_rdc=1&_rdr"
            data-tabs="timeline"
            data-width="500"
            data-height="700"
            data-small-header="false"
            data-adapt-container-width="true"
            data-hide-cover="false"
            data-show-facepile="true">
        </div>
    </div>
</section>




<!-- Section for Auto Slideshow Below Faculty Announcements -->
<section class="big-slideshow-section">
    <div class="big-slideshow-container">
        <img src="images/slide4.jpg" alt="Slide 1">
        <img src="images/slide5.jpg" alt="Slide 2">
        <img src="images/slide6.jpg" alt="Slide 3">
    </div>
</section>





<section style="text-align: right; margin-top: -140px; margin-right: 20px;">
    <a href="#" style="font-size: 80px; text-decoration: none; color: #5E2950; font-weight: bold; transition: color 0.3s ease-in-out; position: relative; right: 50px; top: -70px;" 
       onmouseover="this.style.color='#EC522D';" 
       onmouseout="this.style.color='#5E2950';">اصنع ذكريات في هذه الأماكن
        <span style="font-size: 15px;"> اكبسني</span>
    </a>
</section>

    <!-- script for icon hover for info card to be shown -->
      <script>
      const icon = document.getElementById("books-icon");
      const tooltip = document.getElementById("books-tooltip");
       let tooltipTimer;
                  
       icon.addEventListener("mouseenter", () => {
        tooltipTimer = setTimeout(() => {
         tooltip.style.opacity = "1";
          }, 300); // 0.65 seconds
            });
                  
         icon.addEventListener("mouseleave", () => {
         clearTimeout(tooltipTimer);
         tooltip.style.opacity = "0";
           });
 </script>
                  

<!-- Facebook SDK (Required for the Feed to Work) -->
<script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v17.0"></script>



<!-- first slide show script code 1-->

<script>document.addEventListener("DOMContentLoaded", function () {
    let slides = document.querySelectorAll(".slideshow-container img");
    let index = 0;

    function showNextSlide() {
        slides[index].style.opacity = 0; // Hide current
        index = (index + 1) % slides.length;
        slides[index].style.opacity = 1; // Show next
    }

    setInterval(showNextSlide, 3000); // Change every 3 seconds
});

</script>

   <!-- script for slide show 2  -->
<script>document.addEventListener("DOMContentLoaded", function () {
    let slides = document.querySelectorAll(".big-slideshow-container img");
    let index = 0;

    function showNextSlide() {
        slides.forEach(img => img.style.opacity = "0"); // Hide all
        slides[index].style.opacity = "1"; // Show one
        index = (index + 1) % slides.length; // Loop back to start
    }

    setInterval(showNextSlide, 3000); // Change slide every 3 seconds
});
</script>


  <!-- this script for FAQ OPEN -->
  <script>
    const faqIcon = document.querySelector('a[href="#"] img[src="images/ServicesIcon/FAQ.png"]').parentElement;
    const modal = document.getElementById("faqModal");
    const closeBtn = document.querySelector(".modal .close");
  
    faqIcon.addEventListener("click", function (e) {
      e.preventDefault();
      modal.style.display = "block";
    });
  
    closeBtn.addEventListener("click", function () {
      modal.style.display = "none";
    });
  
    window.addEventListener("click", function (e) {
      if (e.target === modal) {
        modal.style.display = "none";
      }
    });
  </script>


<?php include 'includes/footer.php'; ?>

</body>
</php>