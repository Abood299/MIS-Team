<?php
// fetchMessages.php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/chat_functions.php';

// 1) Auth & param check
if (empty($_SESSION['user_id']) || !isset($_GET['conversation_id'])) {
    http_response_code(400);
    echo json_encode(['error'=>'missing_parameters']);
    exit;
}

$conversationId = (int) $_GET['conversation_id'];
$after          = isset($_GET['after']) ? $_GET['after'] : null;

try {
    // 2) If caller passed an `after` timestamp, only grab newer rows:
    if ($after) {
        $stmt = $conn->prepare("
            SELECT
              id,
              sender_id,
              content,
              created_at,
              edited_at,
              is_deleted,
              deleted_at,
              deleted_by
            FROM messages
           WHERE conversation_id = ?
             AND created_at > ?
           ORDER BY created_at ASC
        ");
        $stmt->bind_param("is", $conversationId, $after);
        $stmt->execute();
        $result = $stmt->get_result();

        $msgs = [];
        while ($row = $result->fetch_assoc()) {
            $msgs[] = $row;
        }
        $stmt->close();

    } else {
        // 3) Otherwise fall back to your helper (all messages)
        $msgs = fetchMessages($conn, $conversationId);
    }

    // 4) Return JSON array
    echo json_encode($msgs);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error'=>$e->getMessage()]);
}
