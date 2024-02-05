<?php
include_once 'classes/dbh.php';
spl_autoload_register('autoLoad');

function autoLoad($className) {
    $path = "classes/";
    $extension = ".classes.php";
    $fullPath = $path . $className . $extension;

    if (!file_exists($fullPath)) {
        return false;
    }

    include_once $fullPath;
}
