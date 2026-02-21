<?php
// ไฟล์: api/admission.php (รวมทุกคำสั่งของระบบรับสมัคร)
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json');

require_once '../config/db.php'; 

$action = $_GET['action'] ?? '';
// รับค่าที่ส่งมาแบบ JSON (ใช้แทน $_POST สำหรับ Fetch API)
$inputJSON = file_get_contents('php://input');
$data = json_decode($inputJSON, true);

// ==========================================
// 1. จัดการข้อมูลโครงการ (Admission Projects)
// ==========================================
if ($action == 'get_projects') {
    $sql = "SELECT p.*, r.round_name AS round_title 
            FROM admission_projects p 
            LEFT JOIN admission_rounds r ON p.round_id = r.id 
            ORDER BY r.id, p.id";
            
    $result = $conn->query($sql);
    $projects = [];
    if ($result) {
        while($row = $result->fetch_assoc()) $projects[] = $row;
    }
    echo json_encode($projects);
    exit();
}

if ($action == 'add_project' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // เพิ่ม conditions และ scoring เข้าไปแล้ว!
    $sql = "INSERT INTO admission_projects (round_id, project_name, seat_count, apply_link, details, conditions, scoring) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    // isissss หมายถึง: Int, String, Int, String, String, String, String
    $stmt->bind_param("isissss", $data['round_id'], $data['project_name'], $data['seat_count'], $data['apply_link'], $data['details'], $data['conditions'], $data['scoring']);
    
    if ($stmt->execute()) echo json_encode(["status" => "success", "message" => "เพิ่มโครงการสำเร็จ"]);
    else echo json_encode(["status" => "error", "message" => $stmt->error]);
    exit();
}

if ($action == 'save_project' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // เพิ่ม conditions และ scoring เข้าไปแล้ว!
    $sql = "UPDATE admission_projects SET round_id=?, project_name=?, seat_count=?, apply_link=?, details=?, conditions=?, scoring=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    
    // isissssi หมายถึง: Int, String, Int, String, String, String, String, Int(id)
    $stmt->bind_param("isissssi", $data['round_id'], $data['project_name'], $data['seat_count'], $data['apply_link'], $data['details'], $data['conditions'], $data['scoring'], $data['id']);
    
    if ($stmt->execute()) echo json_encode(["status" => "success", "message" => "บันทึกข้อมูลสำเร็จ"]);
    else echo json_encode(["status" => "error", "message" => $stmt->error]);
    exit();
}

if ($action == 'delete_project' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "DELETE FROM admission_projects WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $data['id']);
    
    if ($stmt->execute()) echo json_encode(["status" => "success", "message" => "ลบโครงการสำเร็จ"]);
    else echo json_encode(["status" => "error", "message" => $stmt->error]);
    exit();
}

// ==========================================
// 2. จัดการรอบการรับสมัคร (Admission Rounds)
// ==========================================
if ($action == 'get_rounds') {
    $sql = "SELECT * FROM admission_rounds ORDER BY id ASC";
    $result = $conn->query($sql);
    $rounds = [];
    if($result) {
        while($row = $result->fetch_assoc()) $rounds[] = $row;
    }
    echo json_encode($rounds);
    exit();
}

if ($action == 'add_round' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO admission_rounds (round_name) VALUES (?)");
    $stmt->bind_param("s", $data['round_name']);
    
    if($stmt->execute()) echo json_encode(["status"=>"success"]);
    else echo json_encode(["status"=>"error", "message"=>$conn->error]);
    exit();
}

if ($action == 'update_round' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("UPDATE admission_rounds SET round_name = ? WHERE id = ?");
    $stmt->bind_param("si", $data['round_name'], $data['id']);
    
    if($stmt->execute()) echo json_encode(["status"=>"success"]);
    else echo json_encode(["status"=>"error", "message"=>$conn->error]);
    exit();
}

if ($action == 'delete_round' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // ลบโปรเจกต์ในรอบนั้นทิ้งก่อน (กันบั๊ก)
    $conn->query("DELETE FROM admission_projects WHERE round_id = " . (int)$data['id']);
    // ลบรอบ
    $stmt = $conn->prepare("DELETE FROM admission_rounds WHERE id = ?");
    $stmt->bind_param("i", $data['id']);
    
    if($stmt->execute()) echo json_encode(["status"=>"success"]);
    else echo json_encode(["status"=>"error", "message"=>$conn->error]);
    exit();
}
?>