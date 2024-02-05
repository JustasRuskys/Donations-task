<?php
include 'includes/autoloader.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM charities WHERE id=$id";
    $connection->query($sql);

    header("location: /donations/charities.php");
    exit;
}