<?php
// ไฟล์: api/subjects.php
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json');

require_once '../config/db.php'; 

$action = $_GET['action'] ?? '';

// ==========================================
// ส่วนที่ 1: READ 
// ==========================================
if ($action == 'get') {
    $sql = "SELECT * FROM subjects ORDER BY category, course_code ASC";
    $result = $conn->query($sql);
    
    $subjects = [];
    while($row = $result->fetch_assoc()) {
        $subjects[] = $row; 
    }
    echo json_encode($subjects);
    exit();
}

// ==========================================
// ส่วนที่ 2: CREATE & UPDATE 
// ==========================================
if ($action == 'save' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? ''; 
    $code = $_POST['course_code'];
    $name = $_POST['name']; // เปลี่ยนมารับแค่ name
    $credit = $_POST['credit'];
    $cat = $_POST['category'];

    if ($id) {
        // อัปเดต SQL ใหม่ (s = string, i = int)
        $sql = "UPDATE subjects SET course_code=?, name=?, credit=?, category=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssii", $code, $name, $credit, $cat, $id);
    } else {
        $sql = "INSERT INTO subjects (course_code, name, credit, category) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $code, $name, $credit, $cat);
    }

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
    exit();
}

// ==========================================
// ส่วนที่ 3: DELETE 
// ==========================================
if ($action == 'delete' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM subjects WHERE id=?");
    $stmt->bind_param("i", $id); 
    
    if ($stmt->execute()) echo json_encode(["status" => "success"]);
    else echo json_encode(["status" => "error", "message" => $conn->error]);
    exit();
}
?>