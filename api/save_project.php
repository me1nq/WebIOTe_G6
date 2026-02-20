<?php
// api/save_project.php
error_reporting(0);
ini_set('display_errors', 0);
require_once '../config/db.php'; 

try {
    $inputJSON = file_get_contents('php://input');
    $data = json_decode($inputJSON, true);

    $sql = "UPDATE admission_projects SET round_id = ?, project_name = ?, seat_count = ?, apply_link = ?, details = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) throw new Exception("Prepare failed: " . $conn->error);

    $stmt->bind_param("isissi", $data['round_id'], $data['project_name'], $data['seat_count'], $data['apply_link'], $data['details'], $data['id']);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "บันทึกข้อมูลสำเร็จ"]);
    } else {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    $stmt->close(); 
    $conn->close();

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>