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

    <title>Accounting</title>




    </head>
<?php include '../includes/header.php'; ?>
<body>





<!-- START TREE GRID CONTAINER -->
<div class="tree-grid-container">

  <!-- START TREE BLOCK 1 -->
  <div class="tree-block">
    <div class="tree-title-wrapper">
      <h2 class="tree-title">المحاسبة - العام الأولى</h2>
    </div>
    <div class="tree-responsive-wrapper">
      <div class="tree-container">
        <img src="images/treedep.png" alt="Tree" class="tree-image">
        <div class="icon-grid">
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">إدارة الأعمال</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">محاسبة 1</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">اقتصاد الجزئي</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">مبادئ إحصاء</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">إدارة عامة حديثة</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">محاسبة 2 </span></div></a>

          <div class="last-row">
            <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">أساسيات البحث في الأعمال</span></div></a>
            <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">مبادئ MIS</span></div></a>
          </div>
        </div> <!-- /.icon-grid -->
      </div>   <!-- /.tree-container -->
    </div>     <!-- /.tree-responsive-wrapper -->
  </div>       <!-- /.tree-block -->
  <!-- END TREE BLOCK 1 -->

  <!-- START TREE BLOCK 2 -->
  <div class="tree-block">
    <div class="tree-title-wrapper">
      <h2 class="tree-title">المحاسبة - العام الثانية</h2>
    </div>
    <div class="tree-responsive-wrapper">
      <div class="tree-container">
        <img src="images/treedep.png" alt="Tree" class="tree-image">
        <div class="icon-grid">
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">المحاسبة المتوسطة (1)</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">المحاسبة الإدارية لطلبة المحاسبة</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">مبادئ الإدارة المالية</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">المحاسبة المتوسطة (2)</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">محاسبة الشركات</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">مبادئ التسويق</span></div></a>

          <div class="last-row">
            <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">محاسبة تكاليف</span></div></a>
            <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">تخصص اختياري</span></div></a>
          </div>
        </div> <!-- /.icon-grid -->
      </div>   <!-- /.tree-container -->
    </div>     <!-- /.tree-responsive-wrapper -->
  </div>       <!-- /.tree-block -->
  <!-- END TREE BLOCK 2 -->

</div>
<!-- END TREE GRID CONTAINER -->

<!-- START TREE GRID CONTAINER (for next 2 blocks) -->
<div class="tree-grid-container">

  <!-- START TREE BLOCK 3 -->
  <div class="tree-block">
    <div class="tree-title-wrapper">
      <h2 class="tree-title">المحاسبة - العام الثالثة</h2>
    </div>
    <div class="tree-responsive-wrapper">
      <div class="tree-container">
        <img src="images/treedep.png" alt="Tree" class="tree-image">
        <div class="icon-grid">
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">تدقيق الحسابات (1)</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">إدارة الاستثمار</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">محاسبة المنشآت الحكومية</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">نظم المعلومات المحاسبية</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">تطبيقات محاسبية باستخدام الحاسوب</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">تدقيق داخلي</span></div></a>

          <div class="last-row">
            <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">محاسبة منشآت مالية</span></div></a>
            <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">منهجية البحث العلمي في المحاسبة</span></div></a>
          </div>
        </div> <!-- /.icon-grid -->
      </div>   <!-- /.tree-container -->
    </div>     <!-- /.tree-responsive-wrapper -->
  </div>       <!-- /.tree-block -->
  <!-- END TREE BLOCK 3 -->

  <!-- START TREE BLOCK 4 -->
  <div class="tree-block">
    <div class="tree-title-wrapper">
      <h2 class="tree-title">المحاسبة - العام الرابعة</h2>
    </div>
    <div class="tree-responsive-wrapper">
      <div class="tree-container">
        <img src="images/treedep.png" alt="Tree" class="tree-image">
        <div class="icon-grid">
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">محاسبة متقدمة</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">نظرية المحاسبة المالية</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">تحليل القوائم المالية</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">معايير محاسبة دولية</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">محاسبة ضريبة المبيعات</span></div></a>
          <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">مهارات الاستعداد لسوق العمل</span></div></a>

          <div class="last-row">
            <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">التدريب العملي لطلبة المحاسبة</span></div></a>
            <a href="#"><div class="tree-icon-wrapper"><img src="images/apple4.png" class="tree-icon"><span class="icon-text">تخصص اختياري</span></div></a>
          </div>
        </div> <!-- /.icon-grid -->
      </div>   <!-- /.tree-container -->
    </div>     <!-- /.tree-responsive-wrapper -->
  </div>       <!-- /.tree-block -->
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
  

      <!--heading for courses  -->
      <div class="big-title">
        <h1>دورات داعمة للتخصص</h1>
      </div>
  <!-- for courses table  -->
  
      <table class="styled-table" id="courses-table-ACC">
        <thead>
          <tr>
            <th>اسم الدورة</th>
            <th>رابط الدورة</th>
            <th>وصف الدورة</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>المحاسبة المتوسطة (1)</td>
            <td><a href="#" class="button-link-table">اضغط هنا</a></td>
            <td>مفاهيم محاسبية متقدمة في الأصول والخصوم</td>
          </tr>
          <tr>
            <td>تدقيق الحسابات</td>
            <td><a href="#" class="button-link-table">اضغط هنا</a></td>
            <td>مبادئ وأساليب تدقيق القوائم المالية</td>
          </tr>
          <tr>
            <td>نظرية المحاسبة المالية</td>
            <td><a href="#" class="button-link-table">اضغط هنا</a></td>
            <td>إطار نظري لفهم المعايير المحاسبية</td>
          </tr>
          <tr>
            <td>محاسبة التكاليف</td>
            <td><a href="#" class="button-link-table">اضغط هنا</a></td>
            <td>تحليل تكلفة المنتجات والخدمات واتخاذ القرار</td>
          </tr>
        </tbody>
      </table>
  
<?php include '../includes/footer.php'; ?>

        <!-- script for button  -->
  <script>
    function showPopup() {
      document.getElementById("popupModal").style.display = "block";
    }
  
    function closePopup() {
      document.getElementById("popupModal").style.display = "none";
    }
  </script>
    <!-- script for download book -->
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

     <!-- for grey menu js all pages  -->
<script src="js/grey.js?v=<?= time(); ?>"></script>
</body>
</html>