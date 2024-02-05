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
        <h2>List of Donations</h2>
        <a class="btn btn-primary my-2" href="/donations/charities.php" role="button">View Charities</a>
        <a class="btn btn-primary my-2" href="/donations/add_donation.php" role="button">Add Donation</a>
        <br>
        <table class="table table-bordered table-hover border-dark">
            <thead>
                <tr>
                    <th class="bg-dark text-white border-light">ID</th>
                    <th class="bg-dark text-white border-light">Donor Name</th>
                    <th class="bg-dark text-white border-light">Amount</th>
                    <th class="bg-dark text-white border-light">Charity</th>
                    <th class="bg-dark text-white border-light">Date Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Read all row from database table
                $sql = "SELECT * FROM donations";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }

                // Read data of each row
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[donor_name]</td>
                        <td>$row[amount]</td>
                        <td>$row[charity_id]</td>
                        <td>$row[date_time]</td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
        <div class="container w-100 d-flex align-items-center justify-content-center">
            <a class="btn btn-success text-light" href="/donations/import_donations.php" role="button">Download Table</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>