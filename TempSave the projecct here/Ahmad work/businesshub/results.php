<?php
// File: results.php
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/includes/db.php';

$search = trim($_GET['search'] ?? '');
$found  = ($_GET['found'] ?? '0') === '1';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Search Results – Business Hub</title>
  <!-- Your main stylesheet -->
  <!-- <link rel="stylesheet" href="/businesshub/css/styles.css?v=<?=time()?>" /> -->
  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <!-- Font Awesome (for icons) -->
  <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/deps.css">
  <link rel="stylesheet" href="css/header-footer.css">

</head>

<body>
  <!-- Navbar / header -->
  <?php include __DIR__ . '/includes/header.php'; ?>

  <!-- Main content -->
  <main class="container py-4">
    <h2>Search results for “<?= htmlspecialchars($search) ?>”</h2>

    <?php if (! $found): ?>
      <div class="alert alert-warning">
        No results found for “<?= htmlspecialchars($search) ?>.”
      </div>
    <?php else: ?>
      <?php
        // Fetch matches from books + staff
        $like    = "%{$search}%";
        $results = [];

        // — Books —
        $stmt = $conn->prepare("
          SELECT
            b.id,
            b.book_name AS name,
            b.department_id,
            'book'      AS type
            FROM books AS b
            WHERE b.book_name     LIKE ?
            OR b.book_material LIKE ?
        ");
        $stmt->bind_param('ss', $like, $like);
        $stmt->execute();
        $results = array_merge($results, $stmt->get_result()->fetch_all(MYSQLI_ASSOC));

        // — Academic Staff —
        $stmt = $conn->prepare("
          SELECT id, name AS name, 'staff' AS type
            FROM academic_staff
           WHERE name  LIKE ?
              OR email LIKE ?
        ");
        $stmt->bind_param('ss', $like, $like);
        $stmt->execute();
        $results = array_merge($results, $stmt->get_result()->fetch_all(MYSQLI_ASSOC));

        // highlight helper
        function highlight($text, $search) {
          return preg_replace(
            "/(" . preg_quote($search, '/') . ")/i",
            '<mark>$1</mark>',
            htmlspecialchars($text)
          );
        }
      ?>

      <div class="list-group">
  <?php 
    // map department IDs → department page filenames
    $deptPages = [
      1 => 'MIS',
      2 => 'MKT',
      3 => 'FNC',
      4 => 'ACC',
      5 => 'ECO',
      6 => 'PBUS',
      7 => 'BUS',
    ];

    foreach ($results as $row):
      if ($row['type'] === 'book') {
        // make sure 'department_id' is part of your SELECT
        $deptId = (int) $row['department_id'];
        $slug   = $deptPages[$deptId] ?? 'ACC';        // fallback if id missing
        $url    = "departments/{$slug}.php?book_id={$row['id']}";
        $icon   = '<i class="fas fa-book me-2"></i>';
      } else {
        $url  = "front/AcademicStaff.php?id={$row['id']}";
        $icon = '<i class="fas fa-chalkboard-teacher me-2"></i>';
      }

      $label = highlight($row['name'], $search);
  ?>
    <a href="<?= $url ?>"
       class="list-group-item list-group-item-action
              d-flex justify-content-between align-items-center">
      <div><?= $icon ?><strong><?= $label ?></strong></div>
      <span class="badge bg-secondary text-capitalize"><?= $row['type'] ?></span>
    </a>
  <?php endforeach; ?>
</div>

    <?php endif; ?>
  </main>

  <!-- Footer -->
  <?php include __DIR__ . '/includes/footer.php'; ?>

  <!-- Bootstrap JS (Popper + Bootstrap) -->
  <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMzRJ6Kr6ZXHqQNU6M+gR+49pXtZ2N2zH4EJLecCG1Y3pZLCfXz4lWPGmk4"
    crossorigin="anonymous">
  </script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+AMvyTG2C5GzUYIR+2wII0yAnsx13"
    crossorigin="anonymous">
  </script>
  <!-- Your custom JS -->
  <script src="/businesshub/js/main.js?v=<?=time()?>"></script>
</body>
</html>
