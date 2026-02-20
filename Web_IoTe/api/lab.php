<?php
// ไฟล์: api/lab.php
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json');

require_once '../config/db.php'; 

$action = $_GET['action'] ?? '';

// ==========================================
// 1. จัดการข้อมูล Lab (ดึงจากตาราง labs)
// ==========================================
if ($action == 'get_info') {
    $sql = "SELECT * FROM labs WHERE id = 1";
    $result = $conn->query($sql);
    if($result) echo json_encode($result->fetch_assoc());
    else echo json_encode(null);
    exit();
}

if ($action == 'save_info' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['lab_name'];
    $desc = $_POST['description'];
    $logo_name = $_POST['old_logo'] ?? '';

    if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
        $upload_dir = '../assets/images/lab/';
        if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);
        $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $new_filename = "lab_logo_" . time() . "." . $ext;
        if(move_uploaded_file($_FILES['logo']['tmp_name'], $upload_dir . $new_filename)) {
            $logo_name = $new_filename;
        }
    }
    
    $sql = "UPDATE labs SET lab_name=?, description=?, logo_url=? WHERE id=1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $desc, $logo_name);
    if ($stmt->execute()) echo json_encode(["status"=>"success"]);
    else echo json_encode(["status"=>"error", "message"=>$conn->error]);
    exit();
}

// ==========================================
// 2. จัดการหมวดหมู่ (ดึงจากตาราง categories)
// ==========================================
if ($action == 'get_categories') {
    $sql = "SELECT * FROM categories ORDER BY display_order ASC";
    $result = $conn->query($sql);
    $cats = [];
    if($result) {
        while($row = $result->fetch_assoc()) $cats[] = $row;
    }
    echo json_encode($cats);
    exit();
}

if ($action == 'save_category' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $name = $_POST['category_name']; 
    $order = $_POST['display_order'] ?? 0;

    if ($id) {
        $stmt = $conn->prepare("UPDATE categories SET category_name=?, display_order=? WHERE id=?");
        $stmt->bind_param("sii", $name, $order, $id);
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("INSERT INTO categories (category_name, display_order) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $order);
        $stmt->execute();
    }
    echo json_encode(["status"=>"success"]);
    exit();
}

if ($action == 'delete_category' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $conn->query("DELETE FROM categories WHERE id=$id");
    echo json_encode(["status"=>"success"]);
    exit();
}

// ==========================================
// 3. จัดการสมาชิก (ตาราง lab_members)
// ==========================================
if ($action == 'get_members') {
    // ใช้ JOIN เพื่อดึง category_name ออกมา
    $sql = "SELECT m.*, c.category_name 
            FROM lab_members m
            LEFT JOIN categories c ON m.category_id = c.id
            WHERE m.lab_id = 1 
            ORDER BY c.display_order ASC, m.display_order ASC";
            
    $result = $conn->query($sql);
    $members = [];
    if($result) {
        while($row = $result->fetch_assoc()) $members[] = $row;
    }
    echo json_encode($members);
    exit();
}

if ($action == 'save_member' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $lab_id = 1; 
    $category_id = $_POST['category_id']; 
    $name = $_POST['name'];
    $position = $_POST['position'];
    $image_name = $_POST['old_image'] ?? '';
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = '../assets/images/lab/';
        if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $new_filename = uniqid() . "." . $ext;
        if(move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $new_filename)) {
            $image_name = $new_filename;
        }
    }

    if ($id) {
        $sql = "UPDATE lab_members SET category_id=?, name=?, position=?, image_url=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssi", $category_id, $name, $position, $image_name, $id);
    } else {
        $sql = "INSERT INTO lab_members (lab_id, category_id, name, position, image_url) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisss", $lab_id, $category_id, $name, $position, $image_name);
    }
    
    if ($stmt->execute()) echo json_encode(["status"=>"success"]);
    else echo json_encode(["status"=>"error", "message" => $conn->error]);
    exit();
}

if ($action == 'delete_member' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $conn->query("DELETE FROM lab_members WHERE id=$id");
    echo json_encode(["status"=>"success"]);
    exit();
}
?>