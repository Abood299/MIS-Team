<?php
// includes/model/books.php

/**
 * Fetch books for a given department and optional year.
 *
 * @param mysqli $conn          Your DB connection (from db.php)
 * @param int    $departmentId  The department_id to filter by
 * @param string $year          The enum year value ('1','2','3','4')
 * @return array                Array of associative arrays: ['id','department_id','year','book_name','book_material']
 * @throws Exception            If prepare() fails
 */
function getBooksByDepartmentAndYear(mysqli $conn, int $departmentId, string $year): array
{
    $sql = "SELECT id, department_id, year, book_name, book_material
              FROM books
             WHERE department_id = ?
               AND year = ?";
    if (! $stmt = $conn->prepare($sql)) {
        throw new Exception("DB prepare failed: " . $conn->error);
    }
    $stmt->bind_param("is", $departmentId, $year);
    $stmt->execute();
    $result = $stmt->get_result();
    $books  = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $books;
}   
