<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// load the DB
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/model/academicStaffModel.php';

$staffList = getAllAcademicStaff();
$deptRes   = $conn->query("SELECT DISTINCT department_name FROM departments ORDER BY department_name");
?>
<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>الطاقم الأكاديمي</title>
  <base href="/businesshub/">

  <!-- CSS libs -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">

  <!-- your custom CSS -->
  <?php $v = filemtime($_SERVER['DOCUMENT_ROOT'].'/businesshub/css/header-footer.css'); ?>
  <link rel="stylesheet" href="css/header-footer.css?v=<?= $v ?>">

  <style>
    /* hide default DataTables UI */
    .dataTables_filter,
    .dataTables_length,
    .dataTables_info,
    .dataTables_paginate {
      display: none !important;
    }
    /* link styling */
    #staffTable tbody td:nth-child(2) a {
      text-decoration: none !important;
      color: #EC522D !important;
    }
    #staffTable tbody td:nth-child(2) a:hover {
      color: #C7431D !important;
    }
    #staffTable tbody td:nth-child(3) a {
      text-decoration: none !important;
      color: rgb(148,37,118) !important;
    }

    /* page title */
    .graduate-title { text-align: center; padding: 40px 20px 20px; }
    .graduate-title h1 {
      font-size: 75px; font-weight: bold; color: #5E2950;
      text-shadow: 0 0 1px #7b7979,0 0 2px #7b7979,1px 1px 2px #7b7979,-1px -1px 2px #7b7979;
      user-select: none;
      animation: glowTitle 3s ease-in-out infinite;
    }

    /* fade‐out highlight */
    .highlight {
      background-color: #fff3a6 !important;
      transition: background-color 2s ease-out;
    }
    /* dim all rows */
    .dimmed {
      opacity: 0.3;
      transition: opacity 0.5s ease;
    }
    /* keep the focused row full-bright */
    .focused {
      opacity: 1 !important;
      background-color: #fff3a6;
      transition: background-color 0.5s ease;
    }
  </style>
</head>
<body class="bg-light">
  <?php include '../includes/header.php'; ?>

  <main class="page-content">
    <div class="graduate-title">
      <h1>الطاقم الأكاديمي</h1>
    </div>

    <div class="container my-5">
      <!-- filters -->
      <div class="row mb-4">
        <div class="col-md-6 mb-2">
          <input id="searchInput" type="text" class="form-control" placeholder="ابحث عن عضو أو تخصص">
        </div>
        <div class="col-md-6 mb-2">
          <select id="majorFilter" class="form-select">
            <option value="">جميع التخصصات</option>
            <?php while($d = mysqli_fetch_assoc($deptRes)): ?>
              <option value="<?= htmlspecialchars(strtolower($d['department_name'])) ?>">
                <?= htmlspecialchars($d['department_name']) ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>
      </div>

      <!-- table -->
      <div class="table-responsive">
        <table id="staffTable" class="table table-striped table-bordered text-center">
          <thead class="table-dark">
            <tr>
              <th>الصورة</th>
              <th>الاسم</th>
              <th>البريد الإلكتروني</th>
              <th>موقع المكتب</th>
              <th>التخصص</th>
            </tr>
          </thead>
          <tbody>
            <?php if($staffList): foreach($staffList as $row): ?>
              <tr id="staff-<?= htmlspecialchars($row['id']) ?>">
                <td>
                  <?php if($row['image']): ?>
                    <img src="images/Academicpics/<?= htmlspecialchars($row['image'])?>"
                         alt="<?= htmlspecialchars($row['name'])?>"
                         width="60" height="60"
                         style="cursor:pointer;border-radius:50%">
                  <?php else: ?>
                    <span class="text-muted">بدون صورة</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if($row['linkedin']): ?>
                    <a href="<?=htmlspecialchars($row['linkedin'])?>" target="_blank">
                      <?=htmlspecialchars($row['name'])?>
                    </a>
                  <?php else: ?>
                    <?=htmlspecialchars($row['name'])?>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if($row['email']): ?>
                    <a href="mailto:<?=htmlspecialchars($row['email'])?>">
                      <?=htmlspecialchars($row['email'])?>
                    </a>
                  <?php else: ?>
                    <span class="text-muted">غير متوفر</span>
                  <?php endif; ?>
                </td>
                <td><?=htmlspecialchars($row['office_location'])?></td>
                <td><?=htmlspecialchars($row['department_name'])?></td>
              </tr>
            <?php endforeach; else: ?>
              <tr><td colspan="5" class="text-center text-muted">لا توجد بيانات متاحة</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <!-- Image Preview Modal -->
  <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-transparent border-0">
        <img id="modalImage" class="img-fluid" alt="صورة الطاقم">
      </div>
    </div>
  </div>

  <?php include '../includes/footer.php'; ?>

  <!-- JS libs -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
$(function(){
  // 1) init DataTable once
  var table = $('#staffTable').DataTable({
    paging: false,
    info:   false,
    lengthChange: false,
    ordering:     true,
    language:     { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json' }
  });

  // 2) combined search + filter
  $.fn.dataTable.ext.search.push(function(settings, data){
    var name     = data[1].toLowerCase();
    var dept     = data[4].toLowerCase();
    var term     = $('#searchInput').val().trim().toLowerCase();
    var selected = $('#majorFilter').val();
    return (!term || name.includes(term)) && (!selected || dept === selected);
  });
  $('#searchInput').on('keyup',   () => table.draw());
  $('#majorFilter').on('change',  () => table.draw());

  // 3) image modal
  $('#staffTable tbody').on('click','img', function(){
    $('#modalImage').attr('src', $(this).attr('src'));
    new bootstrap.Modal($('#imageModal')[0]).show();
  });

  // 4) spotlight jumpToStaff
  window.jumpToStaff = function(id){
    var $rows   = $('#staffTable tbody tr');
    var $target = $('#staff-' + id);
    if (!$target.length) return;

    // scroll into view
    $('html,body').animate({ scrollTop: $target.offset().top - 100 }, 300);

    // dim all, then spotlight the one
    $rows.addClass('dimmed');
    $target.removeClass('dimmed').addClass('focused');

    // after 2s, restore all
    setTimeout(function(){
      $rows.removeClass('dimmed focused');
    }, 2000);
  };

  // 5) on page-load ?highlight, then remove it from URL
  var params = new URLSearchParams(window.location.search);
  if (params.has('highlight')) {
    jumpToStaff(params.get('highlight'));
    params.delete('highlight');
    var newSearch = params.toString();
    var newUrl = window.location.pathname + (newSearch ? '?' + newSearch : '');
    history.replaceState(null, '', newUrl);
  }
});
</script>

</body>
</html>
