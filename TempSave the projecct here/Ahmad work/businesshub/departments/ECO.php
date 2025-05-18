<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
} 

// load the DB from the correct path:
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/model/books.php';
require_once __DIR__ . '/../includes/model/courses.php';

// decide which department_id this page is for:
$departmentId = 5;   // e.g. 1 = المحاسبة (adjust to match your DB)
// now, for each year-block you can fetch:
$year1Books = getBooksByDepartmentAndYear($conn, $departmentId, '1');
$year2Books = getBooksByDepartmentAndYear($conn, $departmentId, '2');
$year3Books = getBooksByDepartmentAndYear($conn, $departmentId, '3');
$year4Books = getBooksByDepartmentAndYear($conn, $departmentId, '4');

$courses = getCoursesByDepartment($conn, $departmentId);
// etc.
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

  <!-- --- Table Fix for Button Alignment --- -->
  <style>
    #courses-table-ECO td, #courses-table-ECO th {
      vertical-align: middle;
    }
    #courses-table-ECO td:nth-child(2), #courses-table-ECO th:nth-child(2) {
      min-width: 120px;
      width: 140px;
      text-align: center;
    }
    .button-link-table {
      display: inline-block;
      padding: 8px 16px;
      background: #EC522D;
      color: #fff !important;
      border-radius: 10px;
      font-weight: bold;
      text-decoration: none;
      box-shadow: 0 2px 6px #e0e0e0;
      transition: background 0.2s;
      margin: 0 auto;
    }
    .button-link-table:hover {
      background: #cf3a0b;
    }
  </style>

    <title>Economics of Business</title>
    </head>
<?php include(__DIR__ . '/../includes/header.php'); ?>

<body>
    



<!-- START TREE GRID CONTAINER -->
<div class="tree-grid-container">

  <!-- START TREE BLOCK 1 -->
  <div class="tree-block">
    <div class="tree-title-wrapper">
      <h2 class="tree-title">الاقتصاد العام الأول</h2>
    </div>
    <div class="tree-responsive-wrapper">
      <div class="tree-container">
        <img src="images/treedep.png" alt="Tree" class="tree-image">
        <div class="icon-grid">
            <?php foreach ($year1Books as $book): ?>
              <a href="<?= htmlspecialchars($book['book_material']) ?>">
                <div class="tree-icon-wrapper">
                  <img src="images/apple4.png" class="tree-icon">
                  <span class="icon-text"><?= htmlspecialchars($book['book_name']) ?></span>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
      </div>   <!-- /.tree-container -->
    </div>     <!-- /.tree-responsive-wrapper -->
  </div>       <!-- /.tree-block -->
  <!-- END TREE BLOCK 1 -->

  <!-- START TREE BLOCK 2 -->
  <div class="tree-block">
    <div class="tree-title-wrapper">
      <h2 class="tree-title">الاقتصاد العام الثاني</h2>
    </div>
    <div class="tree-responsive-wrapper">
      <div class="tree-container">
        <img src="images/treedep.png" alt="Tree" class="tree-image">
         <div class="icon-grid">
            <?php foreach ($year2Books as $book): ?>
              <a href="<?= htmlspecialchars($book['book_material']) ?>">
                <div class="tree-icon-wrapper">
                  <img src="images/apple4.png" class="tree-icon">
                  <span class="icon-text"><?= htmlspecialchars($book['book_name']) ?></span>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
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
      <h2 class="tree-title">الاقتصاد العام الثالث</h2>
    </div>
    <div class="tree-responsive-wrapper">
      <div class="tree-container">
        <img src="images/treedep.png" alt="Tree" class="tree-image">
        <div class="icon-grid">
            <?php foreach ($year3Books as $book): ?>
              <a href="<?= htmlspecialchars($book['book_material']) ?>">
                <div class="tree-icon-wrapper">
                  <img src="images/apple4.png" class="tree-icon">
                  <span class="icon-text"><?= htmlspecialchars($book['book_name']) ?></span>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
      </div>   <!-- /.tree-container -->
    </div>     <!-- /.tree-responsive-wrapper -->
  </div>       <!-- /.tree-block -->
  <!-- END TREE BLOCK 3 -->

  <!-- START TREE BLOCK 4 -->
  <div class="tree-block">
    <div class="tree-title-wrapper">
      <h2 class="tree-title">الاقتصاد العام الرابع</h2>
    </div>
    <div class="tree-responsive-wrapper">
      <div class="tree-container">
        <img src="images/treedep.png" alt="Tree" class="tree-image">
         <div class="icon-grid">
            <?php foreach ($year4Books as $book): ?>
              <a href="<?= htmlspecialchars($book['book_material']) ?>" target="_blank">
                <div class="tree-icon-wrapper">
                  <img src="images/apple4.png" class="tree-icon">
                  <span class="icon-text"><?= htmlspecialchars($book['book_name']) ?></span>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
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

      <!--  for title  -->
      <div class="big-title">
        <h1>دورات داعمة للتخصص</h1>
      </div>
  
      <!--  for table  -->
      <table class="styled-table" id="courses-table-ECO">  
        <thead>  
          <tr>  
            <th>اسم الدورة</th>  
            <th>رابط الدورة</th>  
            <th>وصف الدورة</th>  
          </tr>  
        </thead>  
         <tbody>
            <?php foreach ($courses as $course): ?>
                <tr>
                  <td><?= htmlspecialchars($course['course_name']) ?></td>
                  <td>
                    <?php if (!empty($course['course_link'])): ?>
                      <a href="<?= htmlspecialchars($course['course_link']) ?>" target="_blank" class="button-link-table">اضغط هنا</a>
                    <?php else: ?>
                      —
                    <?php endif; ?>
                  </td>
                  <td><?= htmlspecialchars($course['course_description']) ?></td>
                </tr>
            <?php endforeach; ?>
          </tbody>
      </table>
      
<?php include(__DIR__ . '/../includes/footer.php'); ?>
        <!-- script for button  -->
        <script>
        function showPopup() {
          document.getElementById("popupModal").style.display = "block";
        }
      
        function closePopup() {
          document.getElementById("popupModal").style.display = "none";
        }
      </script>
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
           <!-- for grey menu js all pages  -->
<script src="js/grey.js?v=<?= time(); ?>"></script>
</body>
</html>
