<?php
// api/rounds.php
error_reporting(0);
ini_set('display_errors', 0);
require_once '../config/db.php'; 

$action = $_GET['action'] ?? '';
$input = json_decode(file_get_contents('php://input'), true);

if ($action == 'get') {
    // ดึงข้อมูลรอบทั้งหมด
    $sql = "SELECT * FROM admission_rounds ORDER BY id ASC";
    $result = $conn->query($sql);
    $rounds = [];
    while($row = $result->fetch_assoc()) $rounds[] = $row;
    echo json_encode($rounds);

} elseif ($action == 'add' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // เพิ่มรอบ
    $stmt = $conn->prepare("INSERT INTO admission_rounds (round_name) VALUES (?)");
    $stmt->bind_param("s", $input['round_name']);
    if($stmt->execute()) echo json_encode(["status"=>"success", "message"=>"เพิ่มรอบสำเร็จ"]);
    else echo json_encode(["status"=>"error", "message"=>$conn->error]);

} elseif ($action == 'update' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // แก้ไขชื่อรอบ
    $stmt = $conn->prepare("UPDATE admission_rounds SET round_name = ? WHERE id = ?");
    $stmt->bind_param("si", $input['round_name'], $input['id']);
    if($stmt->execute()) echo json_encode(["status"=>"success", "message"=>"แก้ไขชื่อรอบสำเร็จ"]);
    else echo json_encode(["status"=>"error", "message"=>$conn->error]);

} elseif ($action == 'delete' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // ลบรอบ
    $conn->query("DELETE FROM admission_projects WHERE round_id = " . (int)$input['id']);
    
    $stmt = $conn->prepare("DELETE FROM admission_rounds WHERE id = ?");
    $stmt->bind_param("i", $input['id']);
    if($stmt->execute()) echo json_encode(["status"=>"success", "message"=>"ลบรอบสำเร็จ"]);
    else echo json_encode(["status"=>"error", "message"=>$conn->error]);
}

$conn->close();
?>