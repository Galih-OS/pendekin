<?php
require 'db.php';

$id = $_POST['id'];
$stmt = $conn->prepare("DELETE FROM urls WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Data Berhasil Di Hapus']);
} else {
    echo json_encode(['success' => false, 'message' => 'Data Gagal Dihapus']);
}

$stmt->close();
$conn->close();
?>
