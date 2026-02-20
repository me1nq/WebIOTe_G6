<?php
// api/lab.php
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json');

require_once '../config/db.php'; 

$action = $_GET['action'] ?? '';

// --- 1. จัดการข้อมูล Lab (Info) ---
if ($action == 'get_info') {
    $sql = "SELECT * FROM lab_info WHERE id = 1";
    $result = $conn->query($sql);
    echo json_encode($result->fetch_assoc());
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
        if(move_uploaded_file($_FILES['logo']['tmp_name'], $upload_dir . $new_filename)) $logo_name = $new_filename;
    }
    $sql = "UPDATE lab_info SET lab_name=?, description=?, logo_url=? WHERE id=1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $desc, $logo_name);
    if ($stmt->execute()) echo json_encode(["status"=>"success"]);
    else echo json_encode(["status"=>"error", "message"=>$conn->error]);
    exit();
}

// --- 2. จัดการหมวดหมู่ (Categories) [NEW!] ---
if ($action == 'get_categories') {
    $sql = "SELECT * FROM lab_categories ORDER BY display_order ASC";
    $result = $conn->query($sql);
    $cats = [];
    while($row = $result->fetch_assoc()) $cats[] = $row;
    echo json_encode($cats);
    exit();
}
if ($action == 'save_category' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'];
    $order = $_POST['display_order'] ?? 0;

    if ($id) {
        // กรณีแก้ไข: ต้องอัปเดตชื่อหมวดหมู่ในตารางสมาชิกด้วย
        // 1. หาชื่อเก่าก่อน
        $old_res = $conn->query("SELECT name FROM lab_categories WHERE id=$id");
        $old_name = $old_res->fetch_assoc()['name'];

        // 2. อัปเดตตารางหมวดหมู่
        $stmt = $conn->prepare("UPDATE lab_categories SET name=?, display_order=? WHERE id=?");
        $stmt->bind_param("sii", $name, $order, $id);
        $stmt->execute();

        // 3. อัปเดตสมาชิกที่อยู่หมวดเดิม ให้เป็นชื่อใหม่
        $stmt2 = $conn->prepare("UPDATE lab_members SET category=? WHERE category=?");
        $stmt2->bind_param("ss", $name, $old_name);
        $stmt2->execute();
    } else {
        // กรณีเพิ่มใหม่
        $stmt = $conn->prepare("INSERT INTO lab_categories (name, display_order) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $order);
        $stmt->execute();
    }
    echo json_encode(["status"=>"success"]);
    exit();
}
if ($action == 'delete_category' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $conn->query("DELETE FROM lab_categories WHERE id=$id");
    // (Optional: อาจจะลบสมาชิกในหมวดนี้ด้วย หรือปล่อยไว้ก็ได้)
    echo json_encode(["status"=>"success"]);
    exit();
}

// --- 3. จัดการสมาชิก (Members) ---
if ($action == 'get_members') {
    $sql = "SELECT * FROM lab_members ORDER BY category, display_order";
    $result = $conn->query($sql);
    $members = [];
    while($row = $result->fetch_assoc()) $members[] = $row;
    echo json_encode($members);
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($action == 'save_member') {
        $id = $_POST['id'] ?? '';
        $name = $_POST['name'];
        $position = $_POST['position'];
        $category = $_POST['category'];
        $image_name = $_POST['old_image'] ?? '';
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $upload_dir = '../assets/images/lab/';
            if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $new_filename = uniqid() . "." . $ext;
            if(move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $new_filename)) $image_name = $new_filename;
        }

        if ($id) {
            $sql = "UPDATE lab_members SET name=?, position=?, category=?, image_url=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $name, $position, $category, $image_name, $id);
        } else {
            $sql = "INSERT INTO lab_members (name, position, category, image_url) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $name, $position, $category, $image_name);
        }
        if ($stmt->execute()) echo json_encode(["status"=>"success"]);
        else echo json_encode(["status"=>"error"]);
    } 
    else if ($action == 'delete_member') {
        $id = $_POST['id'];
        $conn->query("DELETE FROM lab_members WHERE id=$id");
        echo json_encode(["status"=>"success"]);
    }
}
?>