<!DOCTYPE html>
<html lang="en"> 
<meta charset="UTF-8">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- chatgpt addons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- add FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- put on all pages  -->
     
       <!-- Bootstrap 5 CSS -->
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
     
     
    <base href="/businesshub/">
    <?php $version = filemtime('css/header-footer.css'); ?>
    <link rel="stylesheet" href="css/header-footer.css?v=<?php echo $version; ?>">


    <title>StadiumReservation</title>



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

    /* Purple glow */
    0 0 30px rgba(94, 41, 80, 0.95),
    0 0 60px rgba(94, 41, 80, 0.85),
    0 0 90px rgba(94, 41, 80, 0.75);

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
  

</style>



<body>
    
<?php include 'includes/header.php'; ?>

      <div class="graduate-title">
        <h1>خطوات حجز الملعب</h1>
      </div>
      



      <div class="guide-container">

      <div class="step">
  <button class="step-header">الخطوة الأولى - زيارة كابتن الملعب</button>
  <div class="step-content">
    <p>توجه إلى مكتب الكابتن المسؤول عن الملعب داخل الصالة الرياضية وبلّغه أنك ترغب بالحجز.</p>
  </div>
</div>

<div class="step">
  <button class="step-header">الخطوة الثانية - تحديد الموعد المناسب</button>
  <div class="step-content">
    <p>يقوم الكابتن بمراجعة دفتر الحجوزات لاختيار الوقت المتاح والمناسب لك.</p>
  </div>
</div>

<div class="step">
  <button class="step-header">الخطوة الثالثة - تعبئة الأوراق المطلوبة</button>
  <div class="step-content">
    <p>سيسلمك ورقتين: الأولى لموافقة المسؤول الرياضي في كليتك، والثانية لتعبئة أسماء الطلاب وأرقامهم الجامعية.</p>
  </div>
</div>

<div class="step">
  <button class="step-header">الخطوة الرابعة - تسليم الأوراق</button>
  <div class="step-content">
    <p>أعد الأوراق للكابتن قبل موعد الحجز بيومين كحد أقصى لتأكيد الحجز.</p>
  </div>
</div>

<div class="step">
  <button class="step-header">الخطوة الخامسة - تنفيذ الحجز</button>
  <div class="step-content">
    <p>يوم الحجز، سلّم هويتك للكابتن، استمع للتعليمات، واستلم الكرة لبدء اللعب.</p>
  </div>
</div>

      
      </div>
      

      <?php include 'includes/footer.php'; ?>

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