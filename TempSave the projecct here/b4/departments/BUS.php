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

    <title>Business Adminstration</title>

    <style>

   </style>



    </head>

<?php include(__DIR__ . '/../includes/header.php'); ?>

<body>
    

    



  
 <!-- START TREE GRID CONTAINER -->
<div class="tree-grid-container">
  
  <!-- START TREE BLOCK 1 -->
  <div class="tree-block">
    <div class="tree-title-wrapper">
      <h2 class="tree-title">إدارة الأعمال العام الأول</h2>
    </div>
    <div class="tree-responsive-wrapper">
      <div class="tree-container">
        <img src="images/treedep.png" alt="Tree" class="tree-image">
        <div class="icon-grid">
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">إدارة الأعمال</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">محاسبة 1 </span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">إقتصاد الجزئي</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">مبادئ إحصاء</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">إدارة عامة حديثة</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">تشريعات تجارية</span></div></a>

          <div class="last-row">
            <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">مدخل الى الاقتصاد الرياضي</span></div></a>
            <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">مبادئ الإدارة المالية</span></div></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END TREE BLOCK 1 -->

  <!-- START TREE BLOCK 2 -->
  <div class="tree-block">
    <div class="tree-title-wrapper">
      <h2 class="tree-title">إدارة الأعمال العام الثاني</h2>
    </div>
    <div class="tree-responsive-wrapper">
      <div class="tree-container">
        <img src="images/treedep.png" alt="Tree" class="tree-image">
        <div class="icon-grid">
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">السلوك التنظيمي</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">مبادئ التسويق</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">مبادئ MIS </span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">منهجية البحث العلمي</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">بحوث الأعمال</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">نظرية وتصميم المنظمة</span></div></a>

          <div class="last-row">
            <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">متطلب تخصص اختياري</span></div></a>
            <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">متطلب تخصص اختياري</span></div></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END TREE BLOCK 2 -->

</div>
<!-- END TREE GRID CONTAINER -->

<!-- START TREE GRID CONTAINER (for next 2 blocks) -->
<div class="tree-grid-container">
  
  <!-- START TREE BLOCK 3 -->
  <div class="tree-block">
    <div class="tree-title-wrapper">
      <h2 class="tree-title">إدارة الأعمال العام الثالث</h2>
    </div>
    <div class="tree-responsive-wrapper">
      <div class="tree-container">
        <img src="images/treedep.png" alt="Tree" class="tree-image">
        <div class="icon-grid">
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">إدارة سلسلة التزويد</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">الحوكمة المؤسسية</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">إدارة الموارد البشرية</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">إدارة عمليات الخدمات</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">إدارة الابتكار</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">إدارة الجودة الشاملة</span></div></a>

          <div class="last-row">
            <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">إدارة أعمال دولية</span></div></a>
            <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">متطلب تخصص اختياري</span></div></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END TREE BLOCK 3 -->

  <!-- START TREE BLOCK 4 -->
  <div class="tree-block">
    <div class="tree-title-wrapper">
      <h2 class="tree-title">إدارة الأعمال العام الرابع</h2>
    </div>
    <div class="tree-responsive-wrapper">
      <div class="tree-container">
        <img src="images/treedep.png" alt="Tree" class="tree-image">
        <div class="icon-grid">
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">الريادة في الأعمال</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">إدارة العمليات والإنتاج</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">إدارة استراتيجية</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">مهارات الاستعداد لسوق العمل (1)</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">مهارات الاستعداد لسوق العمل (2)</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">إدارة المشاريع</span></div></a>

          <div class="last-row">
            <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">إدارة المعرفة</span></div></a>
            <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">التدريب العملي</span></div></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END TREE BLOCK 4 -->

</div>
<!-- END TREE GRID CONTAINER -->


  
  
  <!-- button for more books -->
    <div class="center-button-wrapper">
      <a  class="custom-button" onclick="showPopup()">المواد الاخرى</a>
    </div>
  
    <!-- Popup Modal -->
    <div id="popupModal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);">
      <h2 style="text-align: center; color: #5E2950;">قائمة المواد</h2>
      <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
          <tr style="background-color: #5E2950; color: white;">
            <th style="padding: 10px; border: 1px solid #ddd;">اسم المادة</th>
            <th style="padding: 10px; border: 1px solid #ddd;">السنة</th>
            <th style="padding: 10px; border: 1px solid #ddd;">تحميل</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="padding: 10px; border: 1px solid #ddd;">سلسلة تزويد</td>
            <td style="padding: 10px; border: 1px solid #ddd;">السنة الثالثة</td>
            <td style="padding: 10px; border: 1px solid #ddd; text-align: center;"><a href="#" style="color: #EC522D; text-decoration: none;">تحميل</a></td>
          </tr>
          <tr>
            <td style="padding: 10px; border: 1px solid #ddd;">إدارة موارد بشرية</td>
            <td style="padding: 10px; border: 1px solid #ddd;">السنة الثانية</td>
            <td style="padding: 10px; border: 1px solid #ddd; text-align: center;"><a href="#" style="color: #EC522D; text-decoration: none;">تحميل</a></td>
          </tr>
          <tr>
            <td style="padding: 10px; border: 1px solid #ddd;">أمن المعلومات</td>
            <td style="padding: 10px; border: 1px solid #ddd;">السنة الرابعة</td>
            <td style="padding: 10px; border: 1px solid #ddd; text-align: center;"><a href="#" style="color: #EC522D; text-decoration: none;">تحميل</a></td>
          </tr>
          <tr>
            <td style="padding: 10px; border: 1px solid #ddd;">التسويق الإلكتروني</td>
            <td style="padding: 10px; border: 1px solid #ddd;">السنة الأولى</td>
            <td style="padding: 10px; border: 1px solid #ddd; text-align: center;"><a href="#" style="color: #EC522D; text-decoration: none;">تحميل</a></td>
          </tr>
          <tr>
            <td style="padding: 10px; border: 1px solid #ddd;">إدارة سياحية</td>
            <td style="padding: 10px; border: 1px solid #ddd;">السنة الثالثة</td>
            <td style="padding: 10px; border: 1px solid #ddd; text-align: center;"><a href="#" style="color: #EC522D; text-decoration: none;">تحميل</a></td>
          </tr>
                                                         <!-- Add more rows as needed -->
        </tbody>
      </table>
      <tbody>
   
      </tbody>
      <div style="text-align: center; margin-top: 20px;">
        <button onclick="closePopup()" style="padding: 10px 20px; background-color: #5E2950; color: white; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#EC522D'" onmouseout="this.style.backgroundColor='#5E2950'">إغلاق</button>
      </div>
      </div>
  

      <div class="big-title">
        <h1>دورات داعمة للتخصص</h1>
      </div>
  <!-- table of courses  -->
  <table class="styled-table" id="courses-table-BUS">
    <thead>
      <tr>
        <th>اسم الدورة</th>
        <th>رابط الدورة</th>
        <th>وصف الدورة</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>مبادئ الإدارة</td>
        <td><a href="#" class="button-link-table">اضغط هنا</a></td>
        <td>أساسيات الإدارة وتطبيقها في بيئة الأعمال</td>
      </tr>
      <tr>
        <td>التسويق الحديث</td>
        <td><a href="#" class="button-link-table">اضغط هنا</a></td>
        <td>مفاهيم واستراتيجيات التسويق في السوق الرقمي</td>
      </tr>
      <tr>
        <td>إدارة الموارد البشرية</td>
        <td><a href="#" class="button-link-table">اضغط هنا</a></td>
        <td>إستراتيجيات التوظيف وتحفيز الموظفين</td>
      </tr>
      <tr>
        <td>الريادة في الأعمال</td>
        <td><a href="#" class="button-link-table">اضغط هنا</a></td>
        <td>كيفية تحويل الأفكار الريادية إلى مشاريع ناجحة</td>
      </tr>
    </tbody>
  </table>
  

<?php include(__DIR__ . '/../includes/footer.php'); ?>
   
  <!-- for download book -->
  <script>
    function forceDownload() {
        const link = document.createElement('a');
        link.href = 'downloads/ReportOne.pdf';
        link.setAttribute('download', 'ReportOne.pdf');
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
    </script>

    <!-- script for button  -->
    <script>
        function showPopup() {
          document.getElementById("popupModal").style.display = "block";
        }
      
        function closePopup() {
          document.getElementById("popupModal").style.display = "none";
        }
      </script>

<!-- for grey menu js all pages  -->
<script src="js/grey.js?v=<?= time(); ?>"></script>
</body>
</html>