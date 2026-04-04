<?php

abstract class Search {
    protected $connect;
    protected $condition;
    public function __construct(mysqli $connect, $condition) {
        $this->connect = $connect;
        $this->condition = $condition;
    }
    abstract public function getResult();
    abstract public function getLimitResult($start, $limit);
}