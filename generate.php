<?php
require 'db.php';

$original_url = $_POST['original_url'];
$short_code = substr(md5(uniqid(rand(), true)), 0, 6);

// Fetch the title of the webpage
$title = '';
$headers = @get_headers($original_url, 1);
if (strpos($headers[0], '200') !== false) {
    $html = file_get_contents($original_url);
    preg_match("/<title>(.+)<\/title>/i", $html, $matches);
    $title = isset($matches[1]) ? $matches[1] : '';
}

// Prepare the SQL query
$stmt = $conn->prepare("INSERT INTO urls (original_url, short_code, title) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $original_url, $short_code, $title);

// Execute the query
if ($stmt->execute()) {
    // Get the ID of the inserted row
    $id = $stmt->insert_id;

    // Prepare the SELECT query
    $stmt = $conn->prepare("SELECT * FROM urls WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Execute the SELECT query
    $stmt->execute();
    $result = $stmt->get_result();
    $urlData = $result->fetch_assoc();

    echo json_encode(['success' => true, 'url' => $urlData]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to insert URL']);
}

$stmt->close();
$conn->close();
?>
