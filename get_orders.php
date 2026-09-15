<?php
// ملف get_orders.php لجلب البيانات من قاعدة البيانات وإرسالها بصيغة JSON
header('Content-Type: application/json');

// بيانات الاتصال بقاعدة البيانات الخاصة بك
$host = "localhost";
$username = "root";
$password = "";
$dbname = "اسم_قاعدة_بياناتك";

$conn = new mysqli($host, $username, $password, $dbname);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    echo json_encode([]);
    exit();
}

$result = $conn->query("SELECT * FROM orders ORDER BY id DESC");
$orders = [];

while($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

echo json_encode($orders);
$conn->close();
?>
