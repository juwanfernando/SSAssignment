<?php
include_once "../model/connect.php";
class Student {
    private $studentID;
    private $studentName;
    private $dateOfBirth;
    private $faculty;
    private $class;
    private $password;
    public function __construct($studentID, $studentName, $dateOfBirth, $faculty, $class, $password) {
        $this->studentID = $studentID;
        $this->studentName = $studentName;
        $this->dateOfBirth = $dateOfBirth;
        $this->faculty = $faculty;
        $this->class = $class;
        $this->password = $password;
    }
    public function getID() {
        return $this->studentID;
    }
    public function getName() {
        return $this->studentName;
    }
    public function getDateOfBirth() {
        return $this->dateOfBirth;
    }
    public function getFaculty() {
        return $this->faculty;
    }
    public function getClass() {
        return $this->class;
    }
    public function getPassword() {
        return $this->password;
    }
}