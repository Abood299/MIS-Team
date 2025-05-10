<!DOCTYPE php>
<php lang="en"> 
<head>
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Base URL to make all relative paths start from /businesshub -->
  <base href="/businesshub/">

  <!-- FontAwesome + Bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />

  <!-- Custom CSS with cache-busting version -->
  <?php
    $cssVersion = filemtime($_SERVER['DOCUMENT_ROOT'] . '/businesshub/css/header-footer.css');
  ?>
  <link rel="stylesheet" href="css/header-footer.css?v=<?php echo $cssVersion; ?>">
  <link rel="stylesheet" href="css/deps.css">


    <title>Business Hub</title>


  
    <style>
      html {
  scroll-behavior: smooth;
}
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
            margin: -83px 0 10px; /* Raised icons higher to overlap video */
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
            width: auto;  /* Icon size */
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

            .slidePanel1 {
                padding: 12px 20px;
                background-color: #EC522D;
                color: white;
                font-size: 16px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: 0.3s;
            }

            .slidePanel1:hover {
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

    /* Layout container */
    .announcement-layout {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 30px;
      margin: 40px auto;
      padding: 0 20px;
      max-width: 1300px;
    }

    /* Facebook panel */
    .fb-panel {
      flex: 1 1 500px;
      max-width: 48%;
      background: white;
      border-radius: 15px;
      box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
      padding: 20px;
      min-width: 300px; /* Prevent over-shrinking */
      height: 640px;
      display: flex;
      flex-direction: column;
      justify-content: start;
    }

    .fb-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 15px;
      text-align: center;
    }

    .fb-container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: stretch;
      overflow: hidden;
    }

    .fb-page,
    .fb-page iframe,
    .fb-page span,
    .fb-page span iframe {
      width: 100% !important;
      max-width: 100% !important;
      height: 600px !important;
      border: none;
    }

    /* Slideshow box */
    .slideshow-box {
      flex: 1 1 500px;
      max-width: 45%;
      min-width: 300px;
      height: 638px; /* Adjusted to exactly match the Facebook panel */
      border-radius: 25px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
      overflow: hidden;
      position: relative;
      cursor: pointer;


    }

    .slideshow-box img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      position: absolute;
      opacity: 0;
      transition: opacity 1s ease-in-out;

    }
/* I'll add text for the slide show IN THE PICS  */
    .slideshow-box img.active {
  opacity: 1;
  z-index: 1;
}
    .slideshow-box img:first-child {
      opacity: 1;
    }

   /* Responsive layout */
   @media (max-width: 768px) {
      .announcement-layout {
        flex-direction: column;
        align-items: center;
      }

     
      .slideshow-box {
        max-width: 100%;
        min-width: 0;
        height: auto;
   
      }

      .slideshow-box img {
        position: static;
        opacity: 1;
     
      }
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
            


            /* style for services card */
            .services-card-container {
                display: flex;
                flex-wrap: wrap;                  /* Allow multiple rows */

                grid-template-columns: repeat(auto-fit, minmax(220px, auto));
                justify-content: center; /* Center cards when fewer in row */
                gap: 20px;
                padding: 20px;
                max-width: 1400px; /* controls how wide the card row can grow , كل ما زدت المساحة العرضية بتزيد عدد البوكسات بالسطر الواحد */
                margin: 0 auto;     /* centers the whole grid */
                }
                /* When active, it becomes flex */
          
                             /* this for Wanna have fun  */
                            .services-card-container-2 {
                               display: flex;
                                flex-wrap: wrap;                  /* Allow multiple rows */

                                grid-template-columns: repeat(auto-fit, minmax(220px, auto));
                                justify-content: center; /* Center cards when fewer in row */
                                gap: 20px;
                                padding: 20px;
                                max-width: 1400px; /* controls how wide the card row can grow , كل ما زدت المساحة العرضية بتزيد عدد البوكسات بالسطر الواحد */
                                margin: 0 auto;     /* centers the whole grid */
                                }

                        
                                .slidePanel2 {
                                    font-size: 4vw; /* Use vw for scaling text with screen size */
                                    text-decoration: none;
                                    color: #5E2950;
                                    font-weight: bold;
                                    transition: color 0.3s ease-in-out;
                                    cursor: pointer;
                                    display: inline-block;
                                    text-align: center;
                                    margin: 20px auto;
                                    padding-right: 30px;  /* 👈 shifts the text a bit to the right */
                                }

                                .slidePanel2:hover {
                                color: #EC522D;
                                }
                .services-card {
                background: white;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                padding: 15px;
                text-align: center;
            
                overflow: hidden;
                transition: all 0.3s ease;
                width: 320px; /* ⬅️ Force same width , حجم ثابت للعرض والطول بتغير وفقا اله  */
                height: auto;     /* you can also fix height if needed */
                cursor: pointer; /* Makes the card feel clickable */
  
                }

                .services-card:hover {
                transform: scale(1.02);
                box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
                transition: 0.3s ease;
                }


                .services-card img { 
                width: 100%;
                height: 200px;       /* ✅ Adjust this height to fit your design */
                object-fit: cover;   /* ✅ Ensures image fills space without distortion */
                border-radius: 8px;
                }

                .services-card-text { 
                font-size: 18px; 
                margin: 10px 0; 
                line-height: 1.6; 
                font-weight: bold;
                }


                .services-card-more {
                display: none;
                font-weight: normal;
                }

                .services-card.expanded .services-card-more {
                display: inline;
                }

                .read-more-btn {
                background-color: #EC522D;
                color: white;
                padding: 8px 12px;
                border: none;
                border-radius: 5px;
                font-size: 13px;
                cursor: pointer;
                transition: background 0.3s;
                }

                .read-more-btn:hover {
                background-color: #b24120;
                }

                /* 🔁 Responsive for phones */
                @media (max-width: 768px) {
                .services-card-container {
                    grid-template-columns: 1fr;
                }
                }
                /* for thier slide show  */
                .cards-slide-modal {
                display: none;
                position: fixed;
                z-index: 9999;
                left: 0; top: 0;
                width: 100%; height: 100%;
                background-color: rgba(0, 0, 0, 0.85);
                justify-content: center;
                align-items: center;
                
                }

                .cards-slide-content {
                position: relative;
                max-width: 700px;
                width: 90%;
                }

                .cards-slide-content img {
                width: 100%;
                border-radius: 10px;
                }

                .cards-slide-close {
                position: absolute;
                top: 20px;
                right: 40px;
                color: white;
                font-size: 35px;
                cursor: pointer;
                }

                .cards-slide-prev,
                .cards-slide-next {
                cursor: pointer;
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background: rgba(0, 0, 0, 0.5);
                border: none;
                color: white;
                font-size: 30px;
                padding: 8px 12px;
                border-radius: 5px;
                }

                .cards-slide-prev { left: 10px; }
                .cards-slide-next { right: 10px; }

    </style>
</head>

   <?php include 'includes/header.php'; ?>
<body>
    
   

  
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
               
                <a href="javascript:void(0);" class="icon-link"><img src="images/ServicesIcon/tree.png" alt="Icon 1"></a>
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
                <a href="javascript:void(0);" class="icon-link"><img src="images/ServicesIcon/courses.png" alt="Icon 2"></a>
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
            <div class="icon-item icon-dropdown">
                <a href="halls.php" class="icon-link"><img src="images/ServicesIcon/build.png" alt="Icon 3"></a>
                <div class="info-tooltip" id="new-tooltip">
   القاعات الدراسية
  </div>
            </div>
            <div class="icon-item-me">
                <a href="booksexchange.php" class="icon-link" id="books-icon">
                  <img src="images/ServicesIcon/Books.png" alt="Icon 4">
                </a>
                <div class="info-tooltip" id="books-tooltip">
                  تبادل الكتب
                </div>
   
              </div>
            <div class="icon-item">
                <a href="#" class="icon-link"><img src="images/ServicesIcon/FAQ.png" alt="Icon 5"></a>
            </div>

            <!-- FAQ Modal -->
<div id="faqModal" class="modal" >
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
        <button class="slidePanel1" onclick="document.getElementById('nearbyServices').scrollIntoView({ behavior: 'smooth' });">
  استكشف
</button>

    </div>

    <!-- Slideshow Panel 1-->
    <div class="slideshow-container">

        <img src="images/services-nearby-page/bus2.jpeg" alt="Slideshow Image 2">
        <img src="images/services-nearby-page/stadium2.png" alt="Slideshow Image 1">
        <img src="images/services-nearby-page/id1.jpg" alt="Slideshow Image 3">
        <img src="images/services-nearby-page/law-prayermain.jpg" alt="Slideshow Image 3">
        <img src="images/services-nearby-page/food-restaurant5.jpg" alt="Slideshow Image 3">
    </div>
</section>

<!-- services nearby first row 🔴🔴🔴-->
<div class="services-card-container"id="nearbyServices">

 <!-- card 1 - مطعم الجامعة -->

 <div class="services-card" data-images="
 images/services-nearby-page/food-restaurant1.jpg,
 images/services-nearby-page/food-restaurant2.jpg,
 images/services-nearby-page/food-restaurant3.jpg,
 images/services-nearby-page/food-restaurant4.jpg,
 images/services-nearby-page/food-restaurant5.jpg">
  <img src="images/services-nearby-page/food-restaurant1.jpg" alt="University Restaurant">
  <p class="services-card-text">
    مطعم الجامعة يقدم وجبات يومية بأسعار رمزية <span class="services-card-more">يشمل خيارات متعددة مثل المنسف، الدجاج، السمك، والمزيد مع لبن وحلويات، مناسب للطلاب الباحثين عن وجبة مشبعة واقتصادية.</span>
  </p>
  <button class="read-more-btn">اقرأ المزيد</button>
</div>
<!-- card 2 - مختبرات الطباعة المجانية -->
<div class="services-card" data-images="
images/services-nearby-page/lab-andalus-printing.jpg,
images/services-nearby-page/lab-humanities-printing.jpg,
images/services-nearby-page/lab-law-printing.jpg">
  <img src="images/services-nearby-page/printing1.png" alt="Free Printing Labs">
  <p class="services-card-text">
  مختبرات طباعة متاحة للطلاب
    <span class="services-card-more">تعمل مختبرات الأندلس، الحقوق، والإنسانية: توفر خدمات طباعة مجانية أو مدعومة للمواد الدراسية</span>
  </p>
  <button class="read-more-btn">اقرأ المزيد</button>
</div>
<!-- card 3 - قاعة زينك المكيّفة -->
<div class="services-card" data-images="
images/services-nearby-page/zinc1.jpg,
images/services-nearby-page/zinc2.jpg,
images/services-nearby-page/zinc3.jpg">
  <img src="images/services-nearby-page/zinc3.jpg" alt="قاعة زينك">
  <p class="services-card-text">
    قاعة زينك المكيّفة للدراسة الجماعية <span class="services-card-more">مجهزة بطاولات وكراسي ومكيف هواء، مثالية للجلسات الدراسية أو التحضير للاختبارات.</span>
  </p>
  <button class="read-more-btn">اقرأ المزيد</button>
</div>

<!-- card 4 - كفتيريا الاعمال ذات الاسعار المخفضة -->
<div class="services-card" data-images="
images/services-nearby-page/businesslounge1.jpg,
images/services-nearby-page/businesslounge2.jpg">
  <img src="images/services-nearby-page/businesslounge2.jpg" alt="كفتيريا الأعمال">
  <p class="services-card-text">
    كفتيريا بأسعار رمزية داخل كلية الأعمال <span class="services-card-more">تقدّم ساندويشات ومشروبات بأسعار مناسبة، وتُعد ملاذاً للطلاب بين المحاضرات.</span>
  </p>
  <button class="read-more-btn">اقرأ المزيد</button>
</div>


<!-- card 5 – مصليات أخرى قريبة منك -->
<div class="services-card" data-images="
  images/services-nearby-page/entrance-female-prayer-room-humanities.jpg,
  images/services-nearby-page/entrance-male-prayer-room-humanities.jpg,
  images/services-nearby-page/entrance-prayer-room-law.jpg,
  images/services-nearby-page/entrance-prayer-room-shariah-b.jpg,
  images/services-nearby-page/female-prayer-room-humanities.jpg,
  images/services-nearby-page/law-prayermain.jpg,
  images/services-nearby-page/male-prayer-room-humanities.jpg
">
  <img src="images/services-nearby-page/law-prayermain.jpg" alt="Prayer Rooms">
  <p class="services-card-text">
    مصليّات حول الأعمال<span class="services-card-more"> من مصلى الشريعة، إلى مصليات كلية الحقوق والإنسانية للذكور والإناث، نوفر لك أقرب الأماكن لأداء الصلاة في يومك الجامعي.</span>
  </p>
  <button class="read-more-btn">اقرأ المزيد</button>
</div>

    

<!-- card - مكان إصدار بطاقة الجامعة -->
<div class="services-card" data-images="
images/services-nearby-page/id1.jpg,
images/services-nearby-page/id2.jpg,
images/services-nearby-page/id3.jpg">
  <img src="images/services-nearby-page/id1.jpg" alt="مكان إصدار بطاقة الجامعة">
  <p class="services-card-text">
    مكان إصدار بطاقة الجامعة للطلبة الجدد <span class="services-card-more">تقع عند المدخل الجانبي لعمادة شؤون الطلبة، وتُستخدم لإصدار البطاقات الجامعية الرسمية للطلاب والطالبات.</span>
  </p>
  <button class="read-more-btn">اقرأ المزيد</button>
</div>

    
  <!-- تيستو الاعمال -->
  <div class="services-card" data-images="images/services-nearby-page/bus-testo.jpg">
  <img src="images/services-nearby-page/bus-testo.jpg" alt="كشك تيستو الأعمال">
  <p class="services-card-text">
    كشك تيستو - مكتبة صغيرة تخدم طلاب كلية الأعمال <span class="services-card-more">تحوي قرطاسية، مستلزمات دراسية، خدمات طباعة وتصوير، وأغراض متنوعة يحتاجها الطالب بشكل يومي.</span>
  </p>
  <button class="read-more-btn">اقرأ المزيد</button>
</div>
  

<!-- card - عيادة الجامعة -->
<div class="services-card" data-images="images/services-nearby-page/clinc1.jpg,images/services-nearby-page/clinc2.jpg">
  <img src="images/services-nearby-page/clinc1.jpg" alt="عيادة الجامعة">
  <p class="services-card-text">
    عيادة الجامعة الطبية 
    <span class="services-card-more">
  توفر <a href="https://eservices.ju.edu.jo/ClinicApp/Login.aspx" target="_blank">عيادة الطلبة</a> خدمات طبية أولية للطلبة والكادر الأكاديمي، تشمل الفحص والعلاج الأساسي، وتضم أقسامًا للأطباء العامين والأسنان.
</span>

  </p>
  <button class="read-more-btn">اقرأ المزيد</button>
</div>

<!-- card - كراج التربية -->
<div class="services-card" data-images="images/services-nearby-page/garage1.jpg">
  <img src="images/services-nearby-page/garage1.jpg" alt="كراج التربية">
  <p class="services-card-text">
    كراج التربية <span class="services-card-more">مواقف لسيارات الطلبة تقي من الحر والظروف الجوية المتنوعة، بمقابل رمزي 1 دينار لعدد طويل من الساعات.</span>

  </p>
  <button class="read-more-btn">اقرأ المزيد</button>
</div>

<!-- card - باص الجامعة -->
<div class="services-card" data-images="
images/services-nearby-page/bus1.jpeg,
images/services-nearby-page/bus2.jpeg">
  <img src="images/services-nearby-page/bus1.jpeg" alt="باص الجامعة">
  <p class="services-card-text">
    باص الجامعة 
    <span class="services-card-more">وسيلة نقل داخلية تصل الطالب إلى جميع الكليات، حيث يمر الباص بمعدل كل 10 - 15 دقيقة مما يسهل التنقل داخل الحرم الجامعي.</span>
  </p>
  <button class="read-more-btn">اقرأ المزيد</button>
</div>

<!-- card - ملعب الجامعة -->
<div class="services-card" data-images="
images/services-nearby-page/stadium1.png,
images/services-nearby-page/stadium2.png,
images/services-nearby-page/stadium3.jpg,
images/services-nearby-page/stadium7.jpg,
images/services-nearby-page/stadium4.jpg,
images/services-nearby-page/stadium5.jpg,
images/services-nearby-page/stadium6.jpg
">
  <img src="images/services-nearby-page/stadium5.jpg" alt="ملعب الجامعة">
  <p class="services-card-text">
    ملعب الجامعة والصالة الرياضية
    <span class="services-card-more">
  يمكنك <a href="stadiumRes.php">حجز الملعب</a> مجاناً للعب أو إقامة الفعاليات، كما يمكن حجز دراجات هوائية للاستمتاع داخل الحرم. تعتبر هذه المساحة الخضراء من أكثر الأماكن المحببة للطلاب، وخاصة في أوقات العصر والغروب.
</span>

  </p>
  <button class="read-more-btn">اقرأ المزيد</button>
</div>

<!-- card - مطعم الأموية (ميلك بار) -->
<div class="services-card" data-images="
  images/services-nearby-page/umawi1.jpg,
  images/services-nearby-page/umawi2.jpg,
  images/services-nearby-page/umawi3.jpg">

  <img src="images/services-nearby-page/umawi3.jpg" alt="مطعم الأموية (ميلك بار)">

  <p class="services-card-text">
    <strong>مطعم الأموية (ميلك بار)</strong>
    <span class="services-card-more">
      مطعم يقدم سناكات سريعة وسندويشات بأسعار تعتبر من الأرخص في الجامعة. يوفر تشكيلة من العصائر والمشروبات الباردة بالإضافة إلى السكاكر والحلويات الخفيفة، ويُعد خيارًا مثاليًا للطلاب الذين يبحثون عن وجبة سريعة واقتصادية.
    </span>
  </p>

  <button class="read-more-btn">اقرأ المزيد</button>
</div>

</div>

<!-- slide show for cards  -->

<!-- Cards Slide Modal -->
<div id="cardsSlideModal" class="cards-slide-modal">
  <span class="cards-slide-close">&times;</span>
  <div class="cards-slide-content">
    <img id="cardsSlideImage" src="" alt="cards slideshow image">
    <button class="cards-slide-prev">&#10094;</button>
    <button class="cards-slide-next">&#10095;</button>
  </div>
</div>


<section class="announcement-layout">
  <!-- Facebook Fetch Panel -->
  <div class="fb-panel">
    <h2 class="fb-title">📌 اعلانات صفحة الكلية</h2>
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
  </div>

  <!-- Slideshow Box -->
  <div class="slideshow-box"  id="slideshowBox">
    <h2 class="slideshow-title" style="text-align: center; background-color:#5E2950; color: white; padding: 15px;    margin: 0;">لا تفوّت زيارة هذه الاماكن</h2>
    <img src="images/services-nearby-page/slide22.jpg" alt="Slideshow Image 1">
    <img src="images/services-nearby-page/green3.jpg" alt="Slideshow Image 2">
    <img src="images/services-nearby-page/museum3.jpg" alt="Slideshow Image 3">
  </div>
  
</section>






<!-- second panel title  -->
<section style="text-align: center;">
  <div style="display: inline-block; padding-right: 40px;">
    <div class="slidePanel2">
      اصنع ذكريات في هذه الاماكن 
    </div>
  </div>
</section>

<section>
<!-- Wanna have fun 2 -->
<div class="services-card-container-2" id="wannaHaveFun">

<!-- card - حديقة الزراعة -->
<div class="services-card" data-images="images/services-nearby-page/agri1.jpg">
  <img src="images/services-nearby-page/agri1.jpg" alt="حديقة الزراعة">
  <p class="services-card-text">
    حديقة الزراعة <span class="services-card-more">، تحتوي على مناظر طبيعية رائعة، مراجيح، وأماكن مخصصة لإقامة الفعاليات الممتعة داخل كلية الزراعة.</span>
  </p>
  <button class="read-more-btn">اقرأ المزيد</button>
</div>


<!-- card - مركز المخطوطات -->
<div class="services-card" data-images="images/services-nearby-page/history1.jpg,images/services-nearby-page/history2.jpg">
  <img src="images/services-nearby-page/history1.jpg" alt="مركز المخطوطات">
  <p class="services-card-text">
    مركز المخطوطات <span class="services-card-more">يضم مجموعة نادرة من المخطوطات التاريخية القديمة، ويُعد وجهة للباحثين والمهتمين بالتاريخ والتراث العربي والإسلامي. يتميز بتصميم معماري جميل وموقع هادئ مناسب للدراسة والبحث.</span>
  </p>
  <button class="read-more-btn">اقرأ المزيد</button>
</div>


<!-- card - المسطح الأخضر -->
<div class="services-card" data-images="images/services-nearby-page/green1.jpg,images/services-nearby-page/green2.jpg,images/services-nearby-page/green3.jpg">
  <img src="images/services-nearby-page/green1.jpg" alt="المسطح الأخضر">
  <p class="services-card-text">
    <strong>المسطح الأخضر</strong>
    <span class="services-card-more">
      يعتبر المسطح الأخضر من أكثر الأماكن هدوءًا وجمالاً في الجامعة، مناسب للجلوس، الدراسة، أو قضاء وقت ممتع مع الأصدقاء. يتميز بالمساحات العشبية الواسعة والأشجار الظليلة، ويقع بالقرب من عدد من الكليات.
    </span>
  </p>
  <button class="read-more-btn">اقرأ المزيد</button>
</div>


    
<!-- card - متحف الآثار -->
<div class="services-card" data-images="
  images/services-nearby-page/museum1.jpg,
  images/services-nearby-page/museum2.jpg,
  images/services-nearby-page/museum3.jpg,
  images/services-nearby-page/museum4.jpg,
  images/services-nearby-page/museum5.jpg">
  
  <img src="images/services-nearby-page/museum2.jpg" alt="متحف الآثار">

  <p class="services-card-text">
    <strong>متحف الآثار</strong>
    <span class="services-card-more">
      يقع متحف الآثار في مبنى تراثي مميز داخل الجامعة ويضم مجموعة رائعة من القطع الأثرية التي تعود لحضارات مختلفة، مثل الأواني الفخارية، الأدوات الحجرية، والتماثيل. يوفر المتحف فرصة مميزة للطلاب والزوار للتعرف على تاريخ المنطقة بأسلوب تفاعلي وتعليمي.
    </span>
  </p>

  <button class="read-more-btn">اقرأ المزيد</button>
</div>

 
            </div>
    </section>











    <?php include 'includes/footer.php'; ?>



<!-- script for services cards -->

<script>
  // Expand text (اقرأ المزيد button)
  document.querySelectorAll(".read-more-btn").forEach(button => {
    button.addEventListener("click", (e) => {
      e.stopPropagation(); // prevent card click from triggering slideshow

      const card = button.closest(".services-card");
      card.classList.toggle("expanded");

      button.textContent = card.classList.contains("expanded") 
        ? "عرض أقل" 
        : "اقرأ المزيد";
    });
  });
</script>


<!-- script for cards slide show -->
<script>
const modal = document.getElementById("cardsSlideModal");
const slideImage = document.getElementById("cardsSlideImage");
const closeModal = document.querySelector(".cards-slide-close");
const prevBtn = document.querySelector(".cards-slide-prev");
const nextBtn = document.querySelector(".cards-slide-next");

let currentImages = [];
let currentIndex = 0;

// Open slideshow when clicking a card
document.querySelectorAll(".services-card").forEach(card => {
    card.addEventListener("click", (e) => {
        if (e.target.closest(".read-more-btn")) return; // Ignore clicks on the button
        const images = card.getAttribute("data-images").split(",");  // Fix splitting the images
        currentImages = images;
        currentIndex = 0; // Start from the first image
        showSlide(currentIndex);
        modal.style.display = "flex"; // Show the modal
    });
});

// Close modal when clicking on the close button
closeModal.onclick = () => modal.style.display = "none";

// Navigate to the previous slide
prevBtn.onclick = () => {
    currentIndex = (currentIndex - 1 + currentImages.length) % currentImages.length;
    showSlide(currentIndex);
};

// Navigate to the next slide
nextBtn.onclick = () => {
    currentIndex = (currentIndex + 1) % currentImages.length;
    showSlide(currentIndex);
};

// Function to show the image at the given index
function showSlide(index) {
    slideImage.src = currentImages[index];  // Update the slide image source
}

// Close modal when clicking outside the modal content
window.onclick = (event) => {
    if (event.target === modal) {  // If click is on the background (outside modal content)
        modal.style.display = "none";  // Close the modal
    }
};

// Close modal when pressing ESC key
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && modal.style.display === "flex") {  // If ESC key is pressed and modal is open
        modal.style.display = "none";  // Close the modal
    }
});
</script>

    <!-- script for icon hover for info card book exchange to be shown -->
 <!-- Book exchange tooltip -->
<script>
  const icon = document.getElementById("books-icon");
  const tooltip = document.getElementById("books-tooltip");
  let tooltipTimer;

  icon.addEventListener("mouseenter", () => {
    tooltipTimer = setTimeout(() => {
      tooltip.style.opacity = "1";
    }, 100);
  });

  icon.addEventListener("mouseleave", () => {
    clearTimeout(tooltipTimer);
    tooltip.style.opacity = "0";
  });
</script>

<!-- Halls icon tooltip -->
<script>
  const newIcon = document.querySelector('.icon-link[href="halls.php"]');
  const newTooltip = document.getElementById("new-tooltip");
  let newTooltipTimer;

  newIcon.addEventListener("mouseenter", () => {
    newTooltipTimer = setTimeout(() => {
      newTooltip.style.opacity = "1";
    }, 100);
  });

  newIcon.addEventListener("mouseleave", () => {
    clearTimeout(newTooltipTimer);
    newTooltip.style.opacity = "0";
  });
</script>


<!-- Facebook SDK Script -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" 
  src="https://connect.facebook.net/ar_AR/sdk.js#xfbml=1&version=v17.0" 
  nonce="FbScript">
</script>



<!-- first slide show script code 1-->

<script>document.addEventListener("DOMContentLoaded", function () {
    let slides = document.querySelectorAll(".slideshow-container img");
    let index = 0;

    function showNextSlide() {
        slides[index].style.opacity = 0; // Hide current
        index = (index + 1) % slides.length;
        slides[index].style.opacity = 1; // Show next
    }

    setInterval(showNextSlide, 2700); // Change every 3 seconds
});

</script>

 <!-- Slideshow 2 Script -->
 <script>
  document.addEventListener("DOMContentLoaded", function () {
    const slides = document.querySelectorAll('.slideshow-box img');
    let current = 0;

    // Slideshow functionality
    setInterval(() => {
      slides[current].classList.remove('active');
      current = (current + 1) % slides.length;
      slides[current].classList.add('active');
    }, 3000);

    // Redirect on click
    const slideshowBox = document.getElementById('slideshowBox');
    slideshowBox.style.cursor = 'pointer';
    slideshowBox.addEventListener('click', () => {
      const target = document.getElementById('wannaHaveFun');
      if (target) {
        target.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });
</script>

</script>


  <!-- this script for FAQ OPEN -->
<script>
document.addEventListener("DOMContentLoaded", function () {
  const faqIcon = document.querySelector('a[href="#"] img[src="images/ServicesIcon/FAQ.png"]').parentElement;
  const modal = document.getElementById("faqModal");
  const closeBtn = document.querySelector(".modal .close");

  faqIcon.addEventListener("click", function (e) {
    e.preventDefault(); // prevent href="#" from jumping
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
});
</script>

<!-- for grey menu js all pages  -->
<script src="js/grey.js?v=<?= time(); ?>"></script>



</body>
</php>