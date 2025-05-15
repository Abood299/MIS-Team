<?php
// chats_list.php
session_start();
require __DIR__ . '/includes/db.php';

if (empty($_SESSION['user_id'])) {
  http_response_code(401);
  echo json_encode(['error'=>'not_logged_in']);
  exit;
}

$me = (int)$_SESSION['user_id'];

// Fetch one chat row per other user, with their latest message
$sql = "
  SELECT
    c.id            AS chat_id,
    other_u.id      AS other_id,
    other_u.first_name,
    other_u.last_name,
    other_u.avatar_url,

    -- grab the very last message text
    (
      SELECT m1.message
        FROM chat_messages AS m1
       WHERE m1.chat_id = c.id
       ORDER BY m1.timestamp DESC
       LIMIT 1
    ) AS preview_text,

    -- grab its timestamp
    (
      SELECT m2.timestamp
        FROM chat_messages AS m2
       WHERE m2.chat_id = c.id
       ORDER BY m2.timestamp DESC
       LIMIT 1
    ) AS last_ts,

    -- count unread messages for you in this chat
    IFNULL((
      SELECT COUNT(*)
        FROM notifications AS n
       WHERE n.type        = 'new_message'
         AND n.receiver_id = ?
         AND n.action_id   = c.id
         AND n.is_read     = 0
    ), 0) AS unread_count

  FROM chats AS c

    -- figure out who “other” is
    JOIN users AS other_u
      ON other_u.id = CASE
                        WHEN c.user1_id = ? THEN c.user2_id
                        ELSE c.user1_id
                      END

  WHERE
    c.user1_id = ? OR c.user2_id = ?

  -- this next bit ensures that if somehow you end up with
  -- more than one chat row for the same pair, we only keep
  -- the *newest* one by last message time
  AND c.id IN (
    SELECT sub.max_chat
      FROM (
        SELECT
          CASE
            WHEN c2.user1_id = ? THEN c2.user2_id
            ELSE c2.user1_id
          END        AS other_id,
          MAX(c2.id) AS max_chat
        FROM chats AS c2
        WHERE c2.user1_id = ? OR c2.user2_id = ?
        GROUP BY other_id
      ) AS sub
  )

  ORDER BY last_ts DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
  'iiiiiii',
  $me, // unread_count subquery
  $me, // JOIN users CASE WHEN
  $me, // WHERE c.user1_id
  $me, // WHERE c.user2_id
  $me, // IN (sub) CASE WHEN
  $me, // IN (sub) WHERE c2.user1_id
  $me  // IN (sub) WHERE c2.user2_id
);
$stmt->execute();
$result = $stmt->get_result();

$chats = [];
while ($row = $result->fetch_assoc()) {
  $chats[] = [
    'chat_id'      => (int)$row['chat_id'],
    'other_id'     => (int)$row['other_id'],
    'first_name'   => $row['first_name'],
    'last_name'    => $row['last_name'],
    'avatar_url'   => $row['avatar_url'],
    'preview_text' => $row['preview_text'] ?? '',
    'last_ts'      => $row['last_ts'],
    'unread_count' => (int)$row['unread_count'],
  ];
}

header('Content-Type: application/json');
echo json_encode($chats);
