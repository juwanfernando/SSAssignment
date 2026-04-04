<?php
include_once "connect.php";
function existsUser($studentID, $password, mysqli $connect) {
    $userQuery = "SELECT *FROM students WHERE studentID = '$studentID' AND password = '$password'";
    $result = $connect->query($userQuery);
    if ($result->num_rows == 0) {
        echo "<script>window.alert('This account is not exists, please check your account');
               window.location.replace(window.location.href);
               </script>";
        return false;
    }
    return true;
}
function confirmAdmin($username, $password, mysqli $connect) {
    $adminQuery = "SELECT *FROM admin WHERE username = '$username' AND password = '$password'";
    $result = $connect->query($adminQuery);
    if ($result->num_rows == 0) {
//        session_destroy();
        return false;
    } else {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $_SESSION['admin'] = $row['username'];
        return true;
    }
}
function confirmEmployee($username, $password, mysqli $connect) {
    $employeeQuery = "SELECT *FROM employee WHERE employeeID = '$username' AND password = '$password'";
    $result = $connect->query($employeeQuery);
    if ($result->num_rows == 0) return false;
    else {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $_SESSION['admin'] = $row['employeeID'];
        return true;
    }
}
function getInfo($studentID, $password, mysqli $connect){
    $userQuery = "SELECT *FROM students WHERE studentID = '$studentID' AND password = '$password'";
    $result = $connect->query($userQuery);
    if ($result->num_rows == 0) die("Error");
    else {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $_SESSION["student"]["id"] = $row["studentID"];
        $_SESSION["student"]["name"] = $row["studentName"];
        $_SESSION["student"]["birthday"] = $row["dateOfBirth"];
        $_SESSION["student"]["faculty"] = $row["faculty"];
        $_SESSION["student"]["class"] = $row["class"];
        $_SESSION["student"]["password"] = $row["password"];
    }
}
function getInfoCart($studentID, mysqli $connect) {
        $cartQuery = "SELECT b.name, borrowbook.quantity, DATE_FORMAT(borrowDate, '%d-%m-%Y') AS date1, DATE_FORMAT(returnDate, '%d-%m-%Y') date2, r.roundID
                     FROM borrowbook
                            INNER JOIN returnbook r ON borrowbook.bookID = r.bookID
                            INNER JOIN books b ON borrowbook.bookID = b.bookID
                     WHERE borrowbook.studentID = '$studentID' AND borrowbook.studentID = r.studentID";
        $cartDetail = mysqli_query($connect, $cartQuery);
        return $cartDetail;
}
function changeReturnDate($borrowDate, $returnDate, $newDate) {
    if (!isset($newDate) || empty($newDate) || strlen($newDate) != 10) return false;
    $deadline = strtotime($borrowDate) + 4*30*24*3600;
    $deadline = date("Y-m-d", $deadline);
    $time = date("Y-m-d", time());
    $returnDate = new DateTime($returnDate);
    $deadline = new DateTime($deadline);
    $newDate = new DateTime($newDate);
    $time = new DateTime($time);
    if ($newDate > $time && $newDate < $returnDate) return true;
    if ($newDate > $returnDate && $newDate <= $deadline) return true;
    return false;
}
function update(mysqli $connect, $newDate, $roundID) {
    $updateQuery = "UPDATE returnbook SET returnDate = '$newDate' WHERE roundID = '$roundID'";
    if ($connect->query($updateQuery) == true) return true;
    else {
        echo $connect->error; return false;
    }
}
?>
