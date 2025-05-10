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

<!DOCTYPE html>
<html lang="en">
<head>

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
 <!-- DataTables CSS -->
  <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
  <!-- Notify styles (FontAwesome duplicate removed because already above) -->
  <!-- You can remove this if not used -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/> -->

  <style>
    .modal-backdrop.show { backdrop-filter: blur(5px); }
  </style>
</head>
   <?php include '../includes/header.php'; ?>
<body class="bg-light">




  <div class="container my-5">
    <h2 class="text-center mb-4">الطاقم الأكاديمي</h2>

    <!-- Search + Major Filter -->
    <div class="row mb-4">
      <div class="col-md-6">
        <input type="text" id="searchInput" class="form-control" placeholder="ابحث عن عضو">
      </div>
      <div class="col-md-6">
        <select id="majorFilter" class="form-select">
          <option value="">جميع التخصصات</option>
          <?php while ($d = mysqli_fetch_assoc($deptRes)): ?>
            <option value="<?= htmlspecialchars($d['department_name']) ?>">
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
            <th>الاسم</th>
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
                    <img
                      src="../images/Academicpics/<?= htmlspecialchars($row['image']) ?>"
                      
                      
                      alt="<?= htmlspecialchars($row['name']) ?>"
                      width="60" height="60"
                      style="cursor:pointer; border-radius:50%;"
                    >
                  <?php else: ?>
                    <span class="text-muted">بدون صورة</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if (!empty($row['linkedin'])): ?>
                    <a href="<?= htmlspecialchars($row['linkedin']) ?>" target="_blank">
                      <?= htmlspecialchars($row['name']) ?>
                    </a>
                  <?php else: ?>
                    <?= htmlspecialchars($row['name']) ?>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if (!empty($row['email'])): ?>
                    <a href="mailto:<?= htmlspecialchars($row['email']) ?>">
                      <?= htmlspecialchars($row['email']) ?>
                    </a>
                  <?php else: ?>
                    <span class="text-muted">غير متوفر</span>
                  <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($row['office_location']) ?></td>
                <td><?= htmlspecialchars($row['department_name']) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" class="text-center text-muted">لا توجد بيانات متاحة</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Image Preview Modal -->
  <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-transparent border-0">
        <img id="modalImage" class="img-fluid" alt="صورة الطاقم">
      </div>
    </div>
  </div>

  <!-- Shared footer -->
   <?php include '../includes/footer.php'; ?>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery & DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script>
    // DataTable initialization
    $(document).ready(function(){
      $('#staffTable').DataTable();
    });

    // Click-to-preview
    document.querySelectorAll('tbody img').forEach(img =>
      img.addEventListener('click', () => {
        document.getElementById('modalImage').src = img.src;
        new bootstrap.Modal(document.getElementById('imageModal')).show();
      })
    );

    // Live filter
    const searchInput = document.getElementById('searchInput');
    const majorFilter = document.getElementById('majorFilter');

    function filterTable() {
      const term = searchInput.value.trim().toLowerCase();
      const selectedValue = majorFilter.value.trim().toLowerCase();
      document.querySelectorAll('tbody tr').forEach(row => {
        const name      = row.cells[1].textContent.trim().toLowerCase();
        const majorCell = row.cells[4].textContent.trim().toLowerCase();
        const matchesName  = name.includes(term);
        const matchesMajor = !selectedValue || majorCell === selectedValue;
        row.style.display = (matchesName && matchesMajor) ? '' : 'none';
      });
    }

    searchInput.addEventListener('input', filterTable);
    majorFilter.addEventListener('change', filterTable);
  </script>
</body>
</html>
