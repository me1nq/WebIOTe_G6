<?php
// api/add_project.php
error_reporting(0);
ini_set('display_errors', 0);
require_once '../config/db.php'; 

try {
    $inputJSON = file_get_contents('php://input');
    $data = json_decode($inputJSON, true);

    // SQL สำหรับเพิ่มข้อมูล (INSERT)
    $sql = "INSERT INTO admission_projects (round_id, project_name, seat_count, apply_link, details) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) throw new Exception("Prepare failed: " . $conn->error);

    // Bind params: i=int, s=string
    $stmt->bind_param("isiss", $data['round_id'], $data['project_name'], $data['seat_count'], $data['apply_link'], $data['details']);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "เพิ่มโครงการสำเร็จ"]);
    } else {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    
    $stmt->close(); 
    $conn->close();

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>