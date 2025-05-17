<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// load the DB from the correct path:
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/model/academicStaffModel.php';

$staffList = getAllAcademicStaff();
$deptRes   = $conn->query("SELECT DISTINCT department_name FROM departments ORDER BY department_name");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>الطاقم الأكاديمي</title>
  <!-- Base URL -->
  <base href="/businesshub/">

  <!-- Bootstrap & FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <!-- DataTables CSS -->
  <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <?php $cssVersion = filemtime($_SERVER['DOCUMENT_ROOT'] . '/businesshub/css/header-footer.css'); ?>
  <link rel="stylesheet" href="css/header-footer.css?v=<?php echo $cssVersion; ?>">

  <style>
    .modal-backdrop.show { backdrop-filter: blur(5px); }
    /* Hide default DataTables search and length UI */
    .dataTables_filter, .dataTables_length, .dataTables_info, .dataTables_paginate { display: none !important; }

/* Remove underline & keep default color on email links */
#staffTable tbody td:nth-child(3) a {
  text-decoration: none !important;
}
/* Hover effect on “الاسم” links */
#staffTable tbody td:nth-child(2) a:hover {
 
  color: #C7431D !important; /* a darker shade of your #EC522D */
}
    /* Remove underline & set soft-orange color on names (“الاسم” column) */
#staffTable tbody td:nth-child(2) a {
  text-decoration: none !important;
  color: #EC522D !important;
}
/* Email links: no underline + custom color */
#staffTable tbody td:nth-child(3) a {
  text-decoration: none !important;
  color:rgb(148, 37, 118) !important;
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
    -1px -1px 2px #7b7979;
  margin: 0;
  user-select: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  animation: glowTitle 3s ease-in-out infinite;
}
  </style>
</head>
  <?php include '../includes/header.php'; ?>
<body class="bg-light">
<main class="page-content">
   <div class="graduate-title">
        <h1>الطاقم الأكاديمي</h1>
      </div>
      
  <div class="container my-5">


    <!-- Custom Search + Major Filter -->
    <div class="row mb-4">
      <div class="col-md-6">
        <input type="text" id="searchInput" class="form-control" placeholder="ابحث عن عضو أو تخصص">
      </div>
      <div class="col-md-6">
        <select id="majorFilter" class="form-select">
          <option value="">جميع التخصصات</option>
          <?php while ($d = mysqli_fetch_assoc($deptRes)): ?>
            <option value="<?= htmlspecialchars(strtolower($d['department_name'])) ?>">
              <?= htmlspecialchars($d['department_name']) ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>
    </div>

    <div class="table-responsive">
      <table id="staffTable" class="table table-striped table-bordered text-center">
        <thead class="table-dark">
          <tr>
            <th>الصورة</th>
           <th>
  الاسم
  <i class="fab fa-linkedin fa-sm" style="color:#0A66C2; margin-left:6px;"></i>
</th>
            <th>البريد الإلكتروني</th>
            <th>موقع المكتب</th>
            <th>التخصص</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($staffList)): ?>
            <?php foreach ($staffList as $row): ?>
              <tr>
                <td>
                  <?php if (!empty($row['image'])): ?>
                    <img src="images/Academicpics/<?= htmlspecialchars($row['image']) ?>"
                         alt="<?= htmlspecialchars($row['name']) ?>" width="60" height="60"
                         style="cursor:pointer; border-radius:50%;">
                  <?php else: ?>
                    <span class="text-muted">بدون صورة</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if (!empty($row['linkedin'])): ?>
                    <a href="<?= htmlspecialchars($row['linkedin']) ?>" target="_blank"><?= htmlspecialchars($row['name']) ?></a>
                  <?php else: ?>
                    <?= htmlspecialchars($row['name']) ?>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if (!empty($row['email'])): ?>
                    <a href="mailto:<?= htmlspecialchars($row['email']) ?>"><?= htmlspecialchars($row['email']) ?></a>
                  <?php else: ?>
                    <span class="text-muted">غير متوفر</span>
                  <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($row['office_location']) ?></td>
                <td><?= htmlspecialchars($row['department_name']) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="5" class="text-center text-muted">لا توجد بيانات متاحة</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Image Preview Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
          <img id="modalImage" class="img-fluid" alt="صورة الطاقم">
        </div>
      </div>
    </div>
  </div>
</main>
  <?php include '../includes/footer.php'; ?>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      // Initialize DataTable with no pagination or info
      var table = $('#staffTable').DataTable({
        paging: false,
        info: false,
        lengthChange: false,
        ordering: true,
        language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json' }
      });

      // Custom filter function
      $.fn.dataTable.ext.search.push(function(settings, data) {
        var name      = data[1].toLowerCase();
        var dept      = data[4].toLowerCase();
        var term      = $('#searchInput').val().trim().toLowerCase();
        var selected  = $('#majorFilter').val();

        var matchName = term === '' || name.includes(term);
        var matchDept = selected === '' || dept === selected;

        return matchName && matchDept;
      });

      // Trigger filtering
      $('#searchInput').on('keyup', function() { table.draw(); });
      $('#majorFilter').on('change', function() { table.draw(); });

      // Image click preview
      $('#staffTable tbody').on('click', 'img', function() {
        $('#modalImage').attr('src', $(this).attr('src'));
        new bootstrap.Modal(document.getElementById('imageModal')).show();
      });
    });
  </script>
</body>
</html>
