<?php
include 'includes/autoloader.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Charities</h2>
        <a class="btn btn-primary my-2" href="/donations/index.php" role="button">Return to Donations</a>
        <a class="btn btn-primary my-2" href="/donations/add_charity.php" role="button">Add Charity</a>
        <br>
        <table class="table table-bordered table-hover border-dark">
            <thead>
                <tr>
                    <th class="bg-dark text-white border-light">ID</th>
                    <th class="bg-dark text-white border-light">Charity</th>
                    <th class="bg-dark text-white border-light">Email</th>
                    <th class="bg-dark"></th>
                </tr>
            </thead>
            <tbody>
                <?php

                // Read all row from database table
                $sql = "SELECT * FROM charities";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }

                // Read data of each row
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[name]</td>
                        <td>$row[email]</td>
                        <td class='d-flex justify-content-evenly'>
                            <a class='btn btn-primary btn-sm' href='/donations/edit_charity.php?id=$row[id]'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='/donations/delete_charity.php?id=$row[id]'>Delete</a>
                        </td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
        <div class="container w-100 d-flex align-items-center justify-content-center">
        <a class="btn btn-success text-light" href="/donations/import_charity.php" role="button">Download Table</a>
        </div>
    </div>
    
</body>
</html>