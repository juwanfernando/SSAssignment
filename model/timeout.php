<?php
function setTimeOut($start) {
    $duration = 86400;
    $current_time = time();
    if ($duration < $current_time - $start) return true;
    return false;
}
?>