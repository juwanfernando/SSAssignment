<?php
include_once "../model/connect.php";
session_destroy();
header("Location: ../view/index.php");
?>