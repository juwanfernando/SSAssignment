<?php
include_once "connect.php";
function splitTabs(mysqli $connect, $category) {
    $categoryQuery = "SELECT name FROM books WHERE category = '$category' LIMIT 0, 20";
    $result = mysqli_query($connect, $categoryQuery);
    return $result;
}
?>