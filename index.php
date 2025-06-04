<?php
$servername = getenv('DB_SERVERNAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = $_POST['subject'] ?? '';
    $name = $_POST['name'] ?? '';
    $comment = $_POST['comment'] ?? '';

    $sql = 'INSERT INTO comment (subject, name, comment) VALUES (?, ?, ?)';
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('sss', $subject, $name, $comment);
        if ($stmt->execute()) {
            echo 'New record created successfully';
        } else {
            http_response_code(500);
            echo 'Error: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        http_response_code(500);
        echo 'Error preparing statement: ' . $conn->error;
    }
}

$conn->close();
?>
