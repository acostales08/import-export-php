<?php
require("config/db_config.php");

$sql = 'SELECT fullname, address, gender FROM employeefile';
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


$fileName = 'exported_data.txt';
$file = fopen($fileName, 'w');

if (!empty($result)) {
    foreach ($result as $row) {
        fwrite($file, implode(", ", $row) . "\n");
    }

    fclose($file);
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($fileName));
    readfile($fileName);
    exit;
}
