<?php
//include "connect.php";
function getEmployeeInfo(mysqli $connect) {
    $query = "SELECT *FROM employee";
    $result = mysqli_query($connect, $query);
    return $result;
}
?>