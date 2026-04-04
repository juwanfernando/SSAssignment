<?php


class searchUser extends Search
{
    public function __construct(mysqli $connect, $condition)
    {
        parent::__construct($connect, $condition);
    }

    public function getResult()
    {
        $this->condition = "SELECT *FROM students WHERE studentName LIKE '%$this->condition%' OR studentID LIKE '%$this->condition%'";
        $result = mysqli_query($this->connect, $this->condition);
        return $result;
        // TODO: Implement getResult() method.
    }

    public function getLimitResult($start, $limit)
    {
        // TODO: Implement getLimitResult() method.
    }
}