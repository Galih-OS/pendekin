<?php
require 'db.php';

$id = $_POST['id'];
$original_url = $_POST['original_url'];
$short_code = $_POST['short_code'];
$title = $_POST['title'];

// Check for existing short_code
$stmt = $conn->prepare("SELECT COUNT(*) FROM urls WHERE short_code = ? AND id != ?");
$stmt->bind_param("si", $short_code, $id);
$stmt->execute();
$stmt->bind_result($short_code_count);
$stmt->fetch();
$stmt->close();

if ($short_code_count > 0) {
    echo json_encode(['success' => false, 'message' => 'Short Url Sudah Pernah Di Inputkan']);
    exit;
}

// Check for existing title
$stmt = $conn->prepare("SELECT COUNT(*) FROM urls WHERE title = ? AND id != ?");
$stmt->bind_param("si", $title, $id);
$stmt->execute();
$stmt->bind_result($title_count);
$stmt->fetch();
$stmt->close();

if ($title_count > 0) {
    echo json_encode(['success' => false, 'message' => 'Judul Sudah Pernah Di Inputkan']);
    exit;
}

// Update the URL if no conflicts
$stmt = $conn->prepare("UPDATE urls SET original_url = ?, short_code = ?, title = ? WHERE id = ?");
$stmt->bind_param("sssi", $original_url, $short_code, $title, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'URL Sudah Terbaru']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal Di Diperbaharui']);
}

$stmt->close();
$conn->close();
?>
