<?php
// includes/model/courses.php

/**
 * Fetch courses for a given department.
 *
 * @param mysqli $conn          Your DB connection (from db.php)
 * @param int    $departmentId  The department_id to filter by
 * @return array                Array of associative arrays: ['id','department_id','course_name','course_link','course_description']
 * @throws Exception            If prepare() fails
 */
function getCoursesByDepartment(mysqli $conn, int $departmentId): array
{
    $sql = "SELECT id, department_id, course_name, course_link, course_description
              FROM courses
             WHERE department_id = ?";
    if (! $stmt = $conn->prepare($sql)) {
        throw new Exception("DB prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $departmentId);
    $stmt->execute();
    $result = $stmt->get_result();
    $courses = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $courses;
}
