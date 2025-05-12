<?php
// chats_list.php
session_start();
require 'includes/db.php';

if (empty($_SESSION['user_id'])) {
  http_response_code(401);
  echo json_encode(['error'=>'not_logged_in']);
  exit;
}

$me = (int)$_SESSION['user_id'];

$sql = <<<SQL
SELECT
  -- pick any chat_id for link; here the one with the newest message
  SUBSTRING_INDEX(GROUP_CONCAT(c.id ORDER BY m.timestamp DESC), ',', 1)
    AS chat_id,

  -- who you're chatting with
  CASE
    WHEN c.user1_id = ? THEN c.user2_id
    ELSE c.user1_id
  END AS other_id,

  u.first_name,
  u.last_name,
  u.avatar_url,

  -- latest message text across *all* chats with that user
  SUBSTRING_INDEX(
    GROUP_CONCAT(
      m2.message
      ORDER BY m2.timestamp DESC
      SEPARATOR '||'
    ),
    '||',
    1
  ) AS preview_text,

  -- timestamp of that latest message
  MAX(m.timestamp) AS last_ts,

  -- total unread messages against you from that user
  SUM(
    notif.type = 'new_message'
    AND notif.receiver_id = ?
    AND notif.action_id = c.id
    AND notif.is_read = 0
  ) AS unread_count

FROM chats AS c

  LEFT JOIN chat_messages AS m
    ON m.chat_id = c.id

  LEFT JOIN chat_messages AS m2
    ON m2.chat_id = c.id

  -- get the other user's details
  JOIN users AS u
    ON u.id = CASE
                WHEN c.user1_id = ? THEN c.user2_id
                ELSE c.user1_id
              END

  -- count unread notifications
  LEFT JOIN notifications AS notif
    ON notif.type = 'new_message'
   AND notif.receiver_id = ?
   AND notif.action_id = c.id
   AND notif.is_read = 0

WHERE c.user1_id = ? OR c.user2_id = ?

GROUP BY other_id, u.first_name, u.last_name, u.avatar_url

ORDER BY last_ts DESC
SQL;

$stmt = $conn->prepare($sql);

// bind six copies of $me
$stmt->bind_param(
  'iiiiii',
  $me, // CASE WHEN c.user1_id
  $me, // notif.receiver_id in SUM
  $me, // JOIN users CASE
  $me, // notif.receiver_id in LEFT JOIN
  $me, // WHERE c.user1_id
  $me  // WHERE c.user2_id
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
