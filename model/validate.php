<?php
include_once "connect.php";
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function signupValidate($studentID, $studentname, $birthday, $password, $confirm, mysqli $connect) {
    $studentIDQuery = "SELECT studentID FROM students WHERE studentID = '$studentID'";
    $result = $connect->query($studentIDQuery);
    if ($result->num_rows > 0) {
//        echo "This account has been registered before, please login to continue <a href='javascript: history.go(-1)'>Back</a>";
        echo "<script>window.alert('This account is real exists.')</script>";
        return false;
    }
    if (ctype_digit($studentID) == false || empty($studentID)) {
        echo "<script>window.alert('Student code is wrong')</script>";
        return false;
    }
    if (test_input($studentname) != $studentname || empty($studentname)) {
        echo "<script>window.alert('Names must contain only letters and spaces')</script>";
        return false;
    }
    if (strlen($birthday) != 10) {
//        $_SESSION["error"]["birthday"] = "Please enter the correct date of birth";
        echo "<script>window.alert('Please enter the correct date of birth')</script>";
        return false;
    }
    if (strlen($password) > 16) {
//        $_SESSION["error"]["password"] = "Password must be less than 16 characters";
        echo "<script>window.alert('Password must be less than 16 characters')</script>";
        return false;
    }
    if (strlen($password) <= 4 || empty($password)) {
//        $_SESSION["error"]["password"] = "Password must be greater than 4 characters";
        echo "<script>window.alert('Password must be greater than 4 characters')</script>";
        return false;
    }
    if (str_replace("'", "", $password) != $password) {
        echo "<script>window.alert('Password not allowed contain single quote and space')</script>";
    }
    if (str_replace(" ", "", $password) != $password) {
        echo "<script>window.alert('Password not allowed contain single quote and space')</script>";
    }
    if ($confirm != $password) {
//        $_SESSION["error"]["confirm"] = "Confirm password incorrect";
        echo "<script>window.alert('Confirm password incorrect')</script>";
        return false;
    }
     return true;
}
?>