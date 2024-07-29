<?php
require 'db.php';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 5;
$offset = ($page - 1) * $per_page;
$query = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : '';

$sql = "SELECT * FROM urls WHERE original_url LIKE '%$query%' OR short_code LIKE '%$query%' OR title LIKE '%$query%' LIMIT $offset, $per_page";
$result = $conn->query($sql);

$urls = [];
while ($row = $result->fetch_assoc()) {
    $urls[] = $row;
}

$total_query = "SELECT COUNT(*) AS total FROM urls WHERE original_url LIKE '%$query%' OR short_code LIKE '%$query%' OR title LIKE '%$query%'";
$total_result = $conn->query($total_query);
$total = $total_result->fetch_assoc()['total'];

echo json_encode(['urls' => $urls, 'total' => $total]);

$conn->close();
?>
