<?php
include_once "../model/connect.php";
include "../model/modelCategory.php";
function getCategory(mysqli $connect, $category) {
    return splitTabs($connect, $category);
}
?>