<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// load the DB
require_once __DIR__ . '/../includes/db.php';
?>
<!DOCTYPE html>
<html lang="en"> 
<meta charset="UTF-8">
<head>
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

  <!-- Notify styles (FontAwesome duplicate removed because already above) -->
  <!-- You can remove this if not used -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/> -->


    <title>GraduateRequirement</title>



    </head>
 
<style>

.guide-container {
  max-width: 800px;
  margin: 40px auto;
  direction: rtl;
  font-family: 'Cairo', sans-serif;
}

.step {
  border-radius: 8px;
  margin-bottom: 15px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(38, 1, 67, 0.1);
  border: 1px solid #ccc;
  transition: all 0.3s ease;
}

.step-header {
  width: 100%;
  text-align: right;
  padding: 15px 20px;
  background-color: #260143;
  color: #fff;
  font-weight: bold;
  border: none;
  font-size: 18px;
  cursor: pointer;
  outline: none;
  transition: background 0.3s;
  text-align: center;         /* 🔥 CENTER the text */
  display: flex;              /* makes alignment work well */
  justify-content: space-between; /* Text on left, icon on right */
  align-items: center;        /* center vertically */
}

.step-header:hover {
    background-color: #3b1961;
  color: #EC522D;
  text-shadow:
    0 0 5px #EC522D,
    0 0 10px #EC522D,
    0 0 15px rgba(236, 82, 45, 0.6); /* soft glow */
}
.step-header::after {
  content: "▼"; /* Down arrow icon */
  font-size: 18px;
  transition: transform 0.3s ease;
  margin-right: 10px;
}
.step-header.active::after {
  content: "▲"; /* Up arrow when active */
}
.step-content {
  background-color: #f9f4f2;
  padding: 15px 20px;
  display: none;
  animation: slideDown 0.3s ease forwards;
  line-height: 1.8;
  color: #333;
}

/* Optional slide animation */
@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}


.graduate-title {
text-align: center;
padding: 40px 20px 20px;

}
.graduate-title h1 {
  font-size: 75px;
  font-weight: bold;
  color: #5E2950;
  text-shadow:
    /* Soft gray stroke */
    0 0 1px #7b7979,
    0 0 2px #7b7979,
    1px 1px 2px #7b7979,
    -1px -1px 2px #7b7979,


  margin: 0;
  user-select: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  animation: glowTitle 3s ease-in-out infinite;
}
/* empty  block */
.empty-block {
    height: 50px;
  }
  
    /* to make the footer down  */
    html, body {
  height: 100%;
  margin: 0;
}

body {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

/* allow the page‐content to grow and push the footer down */
.page-content {
  flex: 1 0 auto;
}
</style>



<?php include '../includes/header.php'; ?>
<body>
    

 <main class="page-content">
      <div class="graduate-title">
        <h1>متطلبات التخرّج</h1>
      </div>
      


<div class="guide-container">

        <div class="step">
          <button class="step-header">الخطوة الأولى -  ظهور متوقع تخرجه</button>
          <div class="step-content">
            <p>زي ما بحكو اول الغيث قطرة ف بالبداية رح يظهرلك متوقع تخرجه في موقع التسجيل الذاتي و هيك بتكون بداية النهاية السعيدة .</p>
            <p>طبعا كتير مهم نحكيلكم انو من وقت ظهور متوقع تخرجه لحد ما تمتحن فاينل و يطلعو علاماتك مافي عليك ولا اشي تعملو .</p>
           
          </div>
        </div>
      
        <div class="step">
          <button class="step-header">الخطوة الثانية -  اجراءات براءة الذمة</button>
          <div class="step-content">
            <p>بعد باسبوع من العلامات اذا كنت ناجح بكلشي يا خريجنا الحلو رح تظهرلك كلمة خريج و تنور موقع التسجيل الذاتي و هون ببلش الشغل .</p>
            <p>لما تظهرلك كلمة خريج بتروح عموقع التسجيل الذاتي و بتعمل اعتماد لبيانات الطالب .</p>
              <p>لما تعمل اعتماد لبياناتك رح يطلعلك قديش لازم تدفع براءة ذمة و رح يعطوك رقم الدفع على اي فواتيركم .</p>
          </div>
        </div>
      
        <div class="step">
          <button class="step-header">الخطوة الثالثة -  شعبة الوثائق</button>
          <div class="step-content">
            <p>بما انك دفعت براءة الذمة وقتها بتحمل حالك و بتروح على القبول و التسجيل (شعبة الوثائق) و بتعطيهم رقمك الجامعي , و بعدها همة بعطوك اوراقك.</p>
          </div>
        </div>
      
        <div class="step">
          <button class="step-header">الخطوة الرابعة - توثيق الأوراق  </button>
          <div class="step-content">
            <p> بعد ما تاخذ الشهادة من القبول والتسجيل بتروح على وزارة التعليم العالي ومكانها قريب من البوابة الشمالية وبتوثق اوراقك. </p>
          </div>
        </div>
      
        
      
      </div>
</main>

<?php include '../includes/footer.php'; ?>

<!-- script for the page  -->
      <script>
        const steps = document.querySelectorAll(".step");
      
        steps.forEach(step => {
          const btn = step.querySelector(".step-header");
          const content = step.querySelector(".step-content");
      
          btn.addEventListener("click", () => {
            // Collapse all others
            steps.forEach(s => {
              if (s !== step) {
                s.querySelector(".step-content").style.display = "none";
                s.querySelector(".step-header").classList.remove("active");
              }
            });
      
            // Toggle current
            const isOpen = content.style.display === "block";
            content.style.display = isOpen ? "none" : "block";
            btn.classList.toggle("active", !isOpen);
          });
        });
      </script>

          <!-- for grey menu js all pages  -->
<script src="js/grey.js?v=<?= time(); ?>"></script>

</body>
</html>