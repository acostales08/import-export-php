<?php
require('config/db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'import/';
        $uploadFile = $uploadDir . basename($_FILES['file']['name']);

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            echo "File is valid, and was successfully uploaded.\n";
        } else {
            echo "File upload failed!\n";
            exit;
        }
    } else {
        echo "No file uploaded or there was an upload error!\n";
        exit;
    }
}

$file = fopen($uploadFile, "r");

if ($file) {
    $stmt = $conn->prepare("INSERT INTO `employeefile`(`fullname`, `address`, `gender`) VALUES (:fullname, :address, :gender)");

    while (($content = fgets($file)) !== false) {
        $contentArray = explode(",", $content);

        if (count($contentArray) >= 3) {
            $fullname = trim($contentArray[0]);
            $address = trim($contentArray[1]);
            $gender = trim($contentArray[2]);

            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':gender', $gender);
            try {
                $stmt->execute();
                header('location:index.php');
            } catch (PDOException $e) {
                echo "Error inserting data: " . $e->getMessage() . "\n";
            }
        } else {
            echo "Invalid data format in line: " . htmlspecialchars($content) . "\n";
        }
    }

    fclose($file);
} else {
    echo "Unable to open the file.\n";
}
