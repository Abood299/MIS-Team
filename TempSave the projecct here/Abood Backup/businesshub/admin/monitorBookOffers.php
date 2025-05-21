<?php

session_start();

include(__DIR__ . '/../includes/db.php');

// Only Super Admins may view
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'super_admin') {
    header("Location: admin_login_page.php");
    exit;
}

// — determine overall date range from book_offers —
$rangeRes = $conn->query("
  SELECT 
    MIN(timestamp) AS min_ts, 
    MAX(timestamp) AS max_ts 
  FROM book_offers
");
$range    = $rangeRes->fetch_assoc();
$minDate  = $range['min_ts'] ? substr($range['min_ts'], 0, 10) : date('Y-m-d');
$maxDate  = $range['max_ts'] ? substr($range['max_ts'], 0, 10) : date('Y-m-d');

// — build list of years —
$minYear = (int)substr($minDate, 0, 4);
$maxYear = (int)substr($maxDate, 0, 4);
$years   = range($minYear, $maxYear);

// — build list of month-day options —
$start    = new DateTime($minDate);
$end      = new DateTime($maxDate);
$end->modify('+1 day');
$interval = new DateInterval('P1D');
$period   = new DatePeriod($start, $interval, $end);
$mdList   = [];
foreach ($period as $dt) {
    $md = $dt->format('m-d');
    if (!in_array($md, $mdList)) {
        $mdList[] = $md;
    }
}

// — Filters from GET —
$search        = trim($_GET['search']       ?? '');
$statusFilter  = $_GET['status']           ?? '';
$yearFrom      = $_GET['year_from']        ?? '';
$mdFrom        = $_GET['md_from']          ?? '';
$yearTo        = $_GET['year_to']          ?? '';
$mdTo          = $_GET['md_to']            ?? '';
$desiredFilter = $_GET['desired_filter']   ?? 'both';

// — Allowed lists —
$statusList   = ['active','dropped','exchanged'];
$desiredList  = ['both','with','without'];

// — combine year+md into ISO dates for filtering —
$dateFrom = ($yearFrom && $mdFrom) ? "$yearFrom-$mdFrom" : '';
$dateTo   = ($yearTo   && $mdTo)   ? "$yearTo-$mdTo"     : '';

// — Build WHERE clauses —
$clauses = [];
if ($search !== '') {
    $s = mysqli_real_escape_string($conn, $search);
    $clauses[] = "(be1.book_name LIKE '%$s%' OR be2.book_name LIKE '%$s%')";
}
if (in_array($statusFilter, $statusList)) {
    $sf = mysqli_real_escape_string($conn, $statusFilter);
    $clauses[] = "bo.status = '$sf'";
}
if ($dateFrom && $dateTo) {
    $df = mysqli_real_escape_string($conn, $dateFrom).' 00:00:00';
    $dt = mysqli_real_escape_string($conn, $dateTo)  .' 23:59:59';
    $clauses[] = "bo.timestamp BETWEEN '$df' AND '$dt'";
}
if (in_array($desiredFilter, $desiredList)) {
    if ($desiredFilter === 'with')    $clauses[] = "bo.desired_book_id IS NOT NULL";
    elseif ($desiredFilter === 'without') $clauses[] = "bo.desired_book_id IS NULL";
}
$whereClause = $clauses ? 'WHERE ' . implode(' AND ', $clauses) : '';

// — Fetch offers with all filters applied —
$sql = "
  SELECT
    bo.id,
    be1.book_name               AS offered_book,
    bo.user_id,
    COALESCE(be2.book_name,'—') AS desired_book,
    bo.details,
    bo.timestamp,
    bo.status
  FROM book_offers bo
    JOIN book_exchange be1 ON bo.book_id = be1.id
    LEFT JOIN book_exchange be2 ON bo.desired_book_id = be2.id
  $whereClause
  ORDER BY bo.timestamp DESC
";
$offers = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Book Offers</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    @media print {
      body * { visibility: hidden; }
      #reportArea, #reportArea * { visibility: visible; }
      #reportArea { position: absolute; top:0; left:0; width:100%; }
    }
    th.sortable { cursor: pointer; }
  </style>
</head>
<body class="bg-dark text-white p-4">

  <?php include __DIR__ . '/../includes/admin_nav.php'; ?>

  <div class="container">

    <!-- 1) Search & Status Filter with Go button -->
    <form method="GET" class="row g-2 align-items-center mb-4">
      <div class="col-md-5">
        <input
          type="text"
          name="search"
          class="form-control"
          placeholder="Search offered or desired book…"
          value="<?= htmlspecialchars($search) ?>"
        >
      </div>
      <div class="col-md-4">
        <select name="status" class="form-select">
          <option value="">All Statuses</option>
          <?php foreach ($statusList as $st): ?>
            <option value="<?= $st ?>" <?= $st === $statusFilter ? 'selected' : '' ?>>
              <?= ucfirst($st) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-3 text-end">
        <button type="submit" class="btn btn-secondary">Filter</button>
      </div>
    </form>

    <!-- 2) Generate Report Button -->
    <button class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#reportModal">
      <i class="fa fa-file-alt me-1"></i> Generate Report
    </button>

    <!-- 3) Printable Report Area -->
    <div id="reportArea">
      <h2 class="mb-4 text-center text-white">Book Offers</h2>
      <table class="table table-dark table-striped table-bordered text-center shadow-sm">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Offered Book</th>
            <th>User ID</th>
            <th>Desired Book</th>
            <th>Details</th>
            <th id="timestampHeader" class="sortable">
              Timestamp <i id="timestampIcon" class="fa fa-sort"></i>
            </th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($offers)): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['offered_book']) ?></td>
            <td><?= $row['user_id'] ?></td>
            <td><?= htmlspecialchars($row['desired_book']) ?></td>
            <td><?= htmlspecialchars($row['details']) ?></td>
            <td><?= $row['timestamp'] ?></td>
            <td><?= ucfirst($row['status']) ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

  </div>

  <!-- Report Modal -->
  <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="GET" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="reportModalLabel">Generate Report</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3 mb-3">
            <div class="col-6">
              <label for="yearFrom" class="form-label text-dark">From Year</label>
              <select id="yearFrom" name="year_from" class="form-select">
                <?php foreach ($years as $y): ?>
                  <option value="<?= $y ?>" <?= $y == $yearFrom ? 'selected' : '' ?>>
                    <?= $y ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-6">
              <label for="mdFrom" class="form-label text-dark">From Month-Day</label>
              <select id="mdFrom" name="md_from" class="form-select">
                <?php foreach ($mdList as $md): ?>
                  <option value="<?= $md ?>" <?= $md == $mdFrom ? 'selected' : '' ?>>
                    <?= date('M j', strtotime("{$minYear}-{$md}")) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="row g-3 mb-3">
            <div class="col-6">
              <label for="yearTo" class="form-label text-dark">To Year</label>
              <select id="yearTo" name="year_to" class="form-select">
                <?php foreach ($years as $y): ?>
                  <option value="<?= $y ?>" <?= $y == $yearTo ? 'selected' : '' ?>>
                    <?= $y ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-6">
              <label for="mdTo" class="form-label text-dark">To Month-Day</label>
              <select id="mdTo" name="md_to" class="form-select">
                <?php foreach ($mdList as $md): ?>
                  <option value="<?= $md ?>" <?= $md == $mdTo ? 'selected' : '' ?>>
                    <?= date('M j', strtotime("{$maxYear}-{$md}")) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label for="statusSelect" class="form-label text-dark">حالة العرض</label>
            <select id="statusSelect" name="status" class="form-select">
              <option value="" <?= $statusFilter === '' ? 'selected' : '' ?>>All</option>
              <option value="dropped" <?= $statusFilter === 'dropped' ? 'selected' : '' ?>>Dropped</option>
              <option value="exchanged" <?= $statusFilter === 'exchanged' ? 'selected' : '' ?>>Exchanged</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="desiredFilter" class="form-label text-dark">نوع العرض</label>
            <select id="desiredFilter" name="desired_filter" class="form-select">
              <option value="both"    <?= $desiredFilter === 'both'    ? 'selected' : '' ?>>Give + Give For Take Offers</option>
              <option value="with"    <?= $desiredFilter === 'with'    ? 'selected' : '' ?>>Give For Take Offers Only</option>
              <option value="without" <?= $desiredFilter === 'without' ? 'selected' : '' ?>>Give Offers Only</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Generate</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  // sort by timestamp
  document.addEventListener('DOMContentLoaded', function(){
    const th = document.getElementById('timestampHeader');
    const icon = document.getElementById('timestampIcon');
    const tbody = document.querySelector('#reportArea table tbody');
    let asc = false;
    th.addEventListener('click', () => {
      const rows = Array.from(tbody.querySelectorAll('tr'));
      rows.sort((a, b) => {
        const dA = new Date(a.cells[5].textContent);
        const dB = new Date(b.cells[5].textContent);
        return asc ? dA - dB : dB - dA;
      });
      rows.forEach(r => tbody.appendChild(r));
      asc = !asc;
      icon.className = asc ? 'fa fa-sort-up' : 'fa fa-sort-down';
    });

    // auto-print when date filters applied
    const p = new URLSearchParams(window.location.search);
    if (p.has('year_from') && p.has('md_from') && p.has('year_to') && p.has('md_to')) {
      window.print();
    }
  });
  </script>
</body>
</html>
