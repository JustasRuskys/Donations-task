<?php
include 'includes/autoloader.php';

$donorName = "";
$amount = "";
$charityID ="";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
    $donorName = mysqli_real_escape_string($connection, $_POST["donor_name"]);
    $amount = mysqli_real_escape_string($connection, $_POST["amount"]);
    $charityID = mysqli_real_escape_string($connection, $_POST["charity_id"]);

    if ( empty($donorName) || empty($amount) || empty($charityID)) {
        $errorMessage = "All the fields are required";
        return;
    } else {

        // add new client to database
        $sql = "INSERT INTO donations (donor_name, amount, charity_id)" . 
            "VALUES (?, ?, ?)";
            $stmt = mysqli_stmt_init($connection);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "SQL Error";
            } else {
                mysqli_stmt_bind_param($stmt, "sss", $donorName, $amount, $charityID);
                mysqli_stmt_execute($stmt);
            }

        $successMessage = "Client added correctly";

        header("location: /donations/index.php");
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TWODAY-HOMEWORK</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="container my-5">
        <h2>New Donation</h2>

        <?php 
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="donor_name" value="<?php echo $donorName; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Amount</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="amount" value="<?php echo $amount; ?>">
                </div>
            </div>
            <p> Select charity:
            <br>
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
                    <input class='mx-3' type='radio' name='charity_id' value='$row[name]'>$row[name]
                    ";
                }
                ?>
            </p>

            <?php 
            if(!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/donations/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>