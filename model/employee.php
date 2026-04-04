<?php
function getStudentInfo(mysqli $connect, $studentID) {
    $getInfoQuery = "SELECT *FROM students WHERE studentID = '$studentID'";
    $result = mysqli_query($connect, $getInfoQuery);
    return $result;
}
function bookManager(mysqli $connect, $studentID) {
    $managerQuery = "SELECT b.quantity AS bquantity, b.bookID, b.name, borrowbook.quantity, DATE_FORMAT(borrowDate, '%d-%m-%Y') AS date1, DATE_FORMAT(returnDate, '%d-%m-%Y') date2, r.roundID, r.status
                     FROM borrowbook
                            INNER JOIN returnbook r ON borrowbook.bookID = r.bookID
                            INNER JOIN books b ON borrowbook.bookID = b.bookID
                     WHERE borrowbook.studentID = '$studentID' AND borrowbook.studentID = r.studentID";
    $result = mysqli_query($connect, $managerQuery);
    return $result;
}
function updateBook(mysqli $connect, $bookID, $current, $studentID) {
    $bookID = intval($bookID);
    $current = intval($current) + 1;
    $updateQuery = "UPDATE books SET quantity = '$current' WHERE  bookID = '$bookID'";
    $dropQuery1 = "DELETE FROM returnbook WHERE studentID = '$studentID' AND bookID = '$bookID'";
    $dropQuery2 = "DELETE FROM borrowbook WHERE studentID = '$studentID' AND bookID = '$bookID'";
    $connect->query($updateQuery);
    $connect->query($dropQuery1);
    $connect->query($dropQuery2);
}
?>