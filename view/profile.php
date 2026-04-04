<?php
include_once  "../model/connect.php";
$connect = connectServer("localhost", "root", "", 3306);
$dbname = "library";
$connect->select_db($dbname);
if (!isset($_SESSION['student']['id'])) header("Location: login.php");
?>
<!DOCTYPE html>
<html>
<head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="../assets/css/profile.css">
    <title>Student Profile</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src="../image/user.png" alt="" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4>
                            <?php echo $_SESSION['student']['name'];?></h4>
                        <small><cite title="San Francisco, USA">Trường Đại học Công nghệ, ĐHQGHN<i class="glyphicon glyphicon-map-marker">
                                </i></cite></small>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i><?php echo $_SESSION['student']['id'];?>@vnu.edu.vn
                            <br />
                            <br />
                            <i class="glyphicon glyphicon-gift"></i><?php echo date("d-m-Y", strtotime($_SESSION["student"]["birthday"]));?></p>
                        <!-- Split button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" onclick="location.href='index.php'">
                                Home
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
