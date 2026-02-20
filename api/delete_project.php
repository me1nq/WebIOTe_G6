<?php
// api/delete_project.php
error_reporting(0);
ini_set('display_errors', 0);
require_once '../config/db.php'; 

try {
    $inputJSON = file_get_contents('php://input');
    $data = json_decode($inputJSON, true);

    if (!isset($data['id'])) throw new Exception("No ID provided");

    // SQL สำหรับลบข้อมูล (DELETE)
    $sql = "DELETE FROM admission_projects WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    if (!$stmt) throw new Exception("Prepare failed: " . $conn->error);

    $p_id = (int)$data['id'];
    $stmt->bind_param("i", $p_id); 

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "ลบโครงการสำเร็จ"]);
    } else {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    
    $stmt->close(); 
    $conn->close();

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>