<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/includes/db.php';
if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}

// 1) Get & sanitize the search term
$search = trim($_GET['search'] ?? '');
if ($search === '') {
    header('Location: HomePage.php');
    exit;
}
$like = "%{$search}%";

// 2) Collect results from each module
$results = [];

// — Books —
$stmt = $conn->prepare("
    SELECT id, title AS name, 'book' AS type
      FROM book_exchange
     WHERE title LIKE ? OR author LIKE ?
");
$stmt->bind_param('ss', $like, $like);
$stmt->execute();
$results = array_merge($results, $stmt->get_result()->fetch_all(MYSQLI_ASSOC));

// — Courses —
$stmt = $conn->prepare("
    SELECT id, course_name AS name, 'course' AS type
      FROM courses
     WHERE course_name LIKE ? OR course_description LIKE ?
");
$stmt->bind_param('ss', $like, $like);
$stmt->execute();
$results = array_merge($results, $stmt->get_result()->fetch_all(MYSQLI_ASSOC));

// — Academic Staff —
$stmt = $conn->prepare("
    SELECT id, CONCAT(first_name,' ',last_name) AS name, 'staff' AS type
      FROM academic_staff
     WHERE first_name LIKE ? OR last_name LIKE ? OR email LIKE ?
");
$stmt->bind_param('sss', $like, $like, $like);
$stmt->execute();
$results = array_merge($results, $stmt->get_result()->fetch_all(MYSQLI_ASSOC));

// — Halls —
$stmt = $conn->prepare("
    SELECT id, name, 'hall' AS type
      FROM halls
     WHERE name LIKE ? OR building LIKE ?
");
$stmt->bind_param('ss', $like, $like);
$stmt->execute();
$results = array_merge($results, $stmt->get_result()->fetch_all(MYSQLI_ASSOC));

// 3) If exactly one result, redirect straight to its detail page
if (count($results) === 1) {
    $row = $results[0];
    switch ($row['type']) {
        case 'book':
            $url = "book_details.php?id={$row['id']}";
            break;
        case 'course':
            $url = "course_details.php?id={$row['id']}";
            break;
        case 'staff':
            $url = "staff_profile.php?id={$row['id']}";
            break;
        case 'hall':
            $url = "hall_details.php?id={$row['id']}";
            break;
        default:
            $url = 'HomePage.php';
    }
    header("Location: $url");
    exit;
}

/**
 * Simple highlight helper:
 */
function highlight(string $text, string $search): string {
    return preg_replace(
      "/(" . preg_quote($search, '/') . ")/i",
      '<mark>$1</mark>',
      htmlspecialchars($text)
    );
}

// 4) Otherwise render your list of results
include __DIR__ . '/includes/header.php';
?>
<main class="container py-4">
  <h2>Search results for “<?= htmlspecialchars($search) ?>”</h2>

  <?php if (empty($results)): ?>
    <p class="text-muted">No results found.</p>
  <?php else: ?>
    <ul class="list-group">
      <?php foreach ($results as $row): 
        // Decide icon & detail-page URL by type
        switch ($row['type']) {
          case 'book':
            $url  = "book_details.php?id={$row['id']}";
            $icon = '<i class="fas fa-book me-1"></i>';
            break;
          case 'course':
            $url  = "course_details.php?id={$row['id']}";
            $icon = '<i class="fas fa-file-alt me-1"></i>';
            break;
          case 'staff':
            $url  = "staff_profile.php?id={$row['id']}";
            $icon = '<i class="fas fa-chalkboard-teacher me-1"></i>';
            break;
          case 'hall':
            $url  = "hall_details.php?id={$row['id']}";
            $icon = '<i class="fas fa-door-open me-1"></i>';
            break;
          default:
            $url  = "#";
            $icon = '';
        }
        $displayName = highlight($row['name'], $search);
      ?>
      <li class="list-group-item">
        <a href="<?= $url ?>" class="text-decoration-none">
          <?= $icon ?> <?= $displayName ?>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
