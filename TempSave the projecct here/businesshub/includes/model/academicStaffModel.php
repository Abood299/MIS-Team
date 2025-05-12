<?php
// includes/model/academicStaffModel.php
require_once __DIR__ . '/../db.php';

function getAllAcademicStaff() {
    global $conn;
    $sql = "
    SELECT 
        a.id,
        a.name,
        a.email,
        a.linkedin,
        a.image,
        a.office_location,
        d.department_name
      FROM academic_staff AS a
      LEFT JOIN departments    AS d 
        ON a.department_id = d.id
      ORDER BY a.id ASC 
    ";
    $res = $conn->query($sql);
    if (!$res) {
        throw new mysqli_sql_exception($conn->error);
    }
    return $res->fetch_all(MYSQLI_ASSOC);
}
