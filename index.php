<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/style.css">
    <title>File Upload</title>
</head>

<body>
    <center>
        <div class="container">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="file">Choose file to upload:</label>
                    <input type="file" name="file" id="file" accept=".txt">
                    <input type="submit" class="import-button" value="Import">
                </div>
            </form>
            <input type="Button" value="Export" class="export-button" onclick="window.location.href='export.php'">
            <div class="card">
                <table border="1">
                    <thead>
                        <tr>
                            <th>fullname</th>
                            <th>address</th>
                            <th>gender</th>
                        </tr>
                    </thead>
                    <tbody id="table">
                        <?php
                        require("config/db_config.php");
                        $query = $conn->query("SELECT `fullname`, `address`, `gender` FROM `employeefile`");
                        $results = $query->fetchAll(PDO::FETCH_ASSOC);

                        if ($results) {
                            foreach ($results as $row) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>

                </table>
            </div>

        </div>
    </center>
</body>

</html>