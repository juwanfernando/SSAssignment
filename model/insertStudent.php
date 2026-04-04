<?php
include_once "connect.php";
include_once "validate.php";
function insertStudent($id, $name, $birthday, $faculty, $class, $password, $confirm, mysqli $connect) {
    if ( signupValidate($id, $name, $birthday, $password, $confirm, $connect) == true ) {
        $dateOfBirth = date("Y-m-d", strtotime($birthday));
        $addStudentQuery = "INSERT INTO students (studentID, studentName, dateOfBirth, faculty, class, password)
                            VALUES ('$id', '$name', '$dateOfBirth', '$faculty', '$class', '$password')";
        if ($connect->query($addStudentQuery) == true) {
            header("Location: ../view/login.php");
        }
    }
}
?>
