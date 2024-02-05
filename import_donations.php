<?php
include_once 'classes/dbh.php';

//Fetch records from database
    $sql = "SELECT * FROM donations ORDER BY id ASC";
    $result = $connection->query($sql);


    $delimiter = ",";
    $filename = "Donations" . date('Y-m-d') . ".csv";

    // Create a file pointer
    $output = fopen("php://memory", "w");

    //Set Column headers
    $fields = mysqli_fetch_fields($result);
    $column_headers = [];
    foreach ($fields as $field) {
        $column_headers[] = $field->name;
    }
    fputcsv($output, $column_headers, $delimiter);

    // Write data rows to the CSV file
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row, $delimiter);
    }

    //Move back to beginning of file
    fseek($output, 0);

    //Set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer
    fpassthru($output);
exit;

?>