<?php
include_once "../model/connect.php";
include_once "../model/employee.php";
$connect = connectServer("localhost", "root", "", 3306);
$dbname ="library";
$connect->select_db($dbname);
if (!isset($_SESSION['admin'])) header("Location: ../controller/logout.php");
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $studentID = $_GET['id'];
    $studentInfo = getStudentInfo($connect, $studentID);
    $bookManager = bookManager($connect, $studentID);
}
if (isset($_POST['check'])) {
    if (isset($_POST['paid']) && isset($_POST['quantity']) && sizeof($_POST['paid']) > 0 && isset($_GET['id'])) {
        for ($i = 0; $i < sizeof($_POST['paid']); $i++) {
            updateBook($connect, $_POST['paid'][$i], $_POST['quantity'][$i], $_GET['id']);
        }
        echo "<script>window.location.replace(window.location.href)</script>";
    }
    else {
        echo "<script>window.alert('Nothing to change');window.location.replace(window.location.href)</script>";
    }
}
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!--    <link rel="manifest" href="site.webmanifest" />-->
    <link
        rel="shortcut icon"
        type="image/x-icon"
        href="../assets/img/favicon.ico"
    />

    <!-- CSS here -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="../assets/css/flaticon.css" />
    <link rel="stylesheet" href="../assets/css/slicknav.css" />
    <link rel="stylesheet" href="../assets/css/animate.min.css" />
    <link rel="stylesheet" href="../assets/css/magnific-popup.css" />
    <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css" />
    <link rel="stylesheet" href="../assets/css/themify-icons.css" />
    <link rel="stylesheet" href="../assets/css/slick.css" />
    <link rel="stylesheet" href="../assets/css/nice-select.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/responsive.css" />
    <!--    <link rel="stylesheet" href="../assets/css/searchBook.css">-->
    <script type="text/javascript" src="../public/jquery.min.js"></script>
    <link rel="stylesheet" href="../public/jquery-ui.css">
    <script type="text/javascript" src="../public/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="../public/jquery-ui.js"></script>
    <script type="text/javascript" src="../assets/js/cart.js"></script>
    <title>Library System</title>
</head>

<body>
<!-- Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="../assets/img/UET.png" alt="" />
            </div>
        </div>
    </div>
</div>
<!-- Preloader Start -->
<header>
    <!-- Header Start -->
    <div class="header-area header-transparrent">
        <div class="main-header header-sticky">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-xl-2 col-lg-2 col-md-1">
                        <div class="logo">
                            <a href="index.php"
                            ><img src="../assets/img/logo/logo.png" alt=""
                                /></a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8">
                        <!-- Main-menu -->
                        <div class="main-menu f-right d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li><a href="index.php"> Home</a></li>
                                    <li>
                                        <a href="searchBookView.php">Search</a>
                                        <ul class="submenu">
                                            <li><a href="searchBookView.php">Search Book</a></li>
                                            <?php
                                            if (isset($_SESSION['admin'])) {
                                                ?>
                                                <li><a href="searchUser.php">Search User</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="addBook.php">Add</a>
                                    </li>
                                    <?php
                                    } else echo "</ul>";
                                    ?>
                                    <li>
                                        <a href="category.php">Category</a>
                                        <ul class="submenu">
                                            <li><a href="category.php">Information Technology</a></li>
                                            <li><a href="category.php">Law and Social</a></li>
                                            <li><a href="category.php">Science and Technology</a></li>
                                            <li><a href="category.php">Education</a></li>
                                            <li><a href="category.php">Philosophy and Life</a></li>
                                            <li><a href="category.php">Human History</a></li>
                                        </ul>
                                    </li>
                                    <?php
                                    if (isset($_SESSION['admin'])) {
                                        if ($_SESSION['admin'] == 'uetLicAdmin') {
                                            ?>
                                            <li>
                                                <a style="cursor: pointer;" id="employee">Employee</a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                        <li>
                                            <a id="logout" title="Logout">
                                                <i class="fas fa-power-off" style="font-size: 20px;"></i>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3">
                        <?php
                        if (!isset($_SESSION['admin'])) {
                            ?>
                            <div class="header-right-btn f-right d-none d-lg-block">
                                <a href="login.php" class="btn header-btn">Login</a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>
<main>
    <!-- Slider Area Start-->
    <div class="slider-area">
        <div class="slider-active">
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-4 d-none d-xl-block">
                            <div
                                class="hero__img hero__img2"
                                data-animation="fadeInLeft"
                                data-delay="1s"
                            >
                                <img src="../assets/img/hero/book.png" alt="" />
                            </div>
                        </div>
                        <div class="col col-sm-2"></div>
                        <div class="col col-sm-4" id="stInfo">
                            <h4>Student Information</h4>
                            <?php
                            if (isset($studentInfo) && mysqli_num_rows($studentInfo) > 0) {
                                $row1 = $studentInfo->fetch_array(MYSQLI_ASSOC);
                                echo "<p> Student's ID: " . $row1['studentID'] . "<br/>";
                                echo "<p> Student's Name: " . $row1['studentName'] . "<br/>";
                                echo "<p> Student's Date Of Birth: " . date("d-m-Y", strtotime($row1['dateOfBirth'])) . "<br/>";
                                echo "<p> Student's Faculty: " . $row1['faculty'] . "<br/>";
                                echo "<p> Student's class: " . $row1['class'] . "<br/>";
                            }
                            ?>
                        </div>
                        <div class="col col-sm-2"></div>
                    </div>
                    <div class="row d-flex align-items-center">
                        <h4>Book Management</h4>
                        <div class="container">
                            <form action="manager.php?id=<?php if (isset($_GET['id'])) echo $_GET['id'];?>" method="post" style="margin-bottom: 100px;">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Borrow Date</th>
                                    <th>Return Date</th>
                                    <th>Status</th>
                                    <th>Check</th>
                                </tr>
                                </thead>
                                <?php
                                if (isset($bookManager) && mysqli_num_rows($bookManager) > 0) {
                                    while ($row2 = mysqli_fetch_array($bookManager)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row2['name']?></td>
                                            <td><?php echo $row2['quantity']?></td>
                                            <td><?php echo $row2['date1']?></td>
                                            <td><?php echo $row2['date2']?></td>
                                            <td><?php echo $row2['status']?></td>
                                            <td>
                                                <input type="checkbox" name="paid[]" value="<?php echo $row2['bookID'];?>" class="checked"> Paid
                                                <input type="hidden" name="quantity[]" value="<?php echo $row2['bquantity'];?>">
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </table>
                                <button type="submit" name="check" class="btn-outline-success">Confirm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    $(".dateChange").datepicker({
        dateFormat: "dd-mm-yy",
        showAnim: "explode",
    });
</script>
<!-- JS here -->

<!-- All JS Custom Plugins Link Here here -->
<script src="../assets/js/vendor/modernizr-3.5.0.min.js"></script>

<!-- Jquery, Popper, Bootstrap -->
<script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<!-- Jquery Mobile Menu -->
<script src="../assets/js/jquery.slicknav.min.js"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="../assets/js/owl.carousel.min.js"></script>
<script src="../assets/js/slick.min.js"></script>
<!-- Date Picker -->
<script src="../assets/js/gijgo.min.js"></script>
<!-- One Page, Animated-HeadLin -->
<script src="../assets/js/wow.min.js"></script>
<script src="../assets/js/animated.headline.js"></script>
<script src="../assets/js/jquery.magnific-popup.js"></script>

<!-- Scrollup, nice-select, sticky -->
<script src="../assets/js/jquery.scrollUp.min.js"></script>
<script src="../assets/js/jquery.nice-select.min.js"></script>
<script src="../assets/js/jquery.sticky.js"></script>

<!-- contact js -->
<script src="../assets/js/contact.js"></script>
<script src="../assets/js/jquery.form.js"></script>
<script src="../assets/js/jquery.validate.min.js"></script>
<script src="../assets/js/mail-script.js"></script>
<script src="../assets/js/jquery.ajaxchimp.min.js"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="../assets/js/plugins.js"></script>
<script src="../assets/js/main.js"></script>
<script>
    $(document).ready(function () {
        $("#logout").click(function () {
            if (confirm('Are you sure you want to log out?')) {
                window.location.replace('../controller/logout.php');
            } else window.location.replace(window.location.href);
        });
        $(".checked").click(function () {
            window.alert("The system only confirms changes when you press the confirm button");
        });
        $("#employee").click(function () {
            window.location.replace('admin.php');
        });
    });
</script>
</body>
</html>
