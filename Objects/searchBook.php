<?php
//include_once "../model/connect.php";
class searchBook extends Search {
    function __construct(mysqli $connect, $condition)
    {
        parent::__construct($connect, $condition);
    }
    public function getResult()
    {
        $this->condition = "SELECT *FROM books WHERE name LIKE '%$this->condition%' OR caption LIKE '%$this->condition%'";
        $result = mysqli_query($this->connect, $this->condition);
        return $result;
    }
    public function getBookByID() {
        $this->condition = "SELECT *FROM books WHERE bookID = '$this->condition'";
        $result = mysqli_query($this->connect, $this->condition);
        return $result;
    }
    public function getLimitResult($start, $limit) {
        $this->condition = "SELECT *FROM books WHERE name LIKE '%$this->condition%' OR caption LIKE '%$this->condition%' LIMIT $start, $limit";
        $result1 = mysqli_query($this->connect, $this->condition);
        return $result1;
    }

}