<?php
include_once "../model/connect.php";
include_once "../model/insertStudent.php";
include_once "../Objects/Student.php";
function addAccount(Student $student, mysqli $connect) {
    $id = $student->getID();
    $name = $student->getName();
    $birthday = $student->getDateOfBirth();
    $faculty = $student->getFaculty();
    $class = $student->getClass();
    $password = $student->getPassword();
    $confirm = $_SESSION["student"]["confirm"];
    insertStudent($id, $name, $birthday, $faculty, $class, $password, $confirm, $connect);
}
?>
