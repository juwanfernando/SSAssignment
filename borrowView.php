<?php
include_once "../model/connect.php";
include_once "../Objects/Search.php";
include_once "../Objects/searchBook.php";
include_once "../Objects/Book.php";
include_once "../model/timeout.php";
include_once "../model/user.php";
$connect = connectServer("localhost", "root", "", 3306);
$dbname = "library";
$connect->select_db($dbname);
$book = new Book($connect, 0);
if (!isset($_SESSION['student']['id'])) header("Location: login.php");
if (isset($_GET['bookID']) && !empty($_GET['bookID'])) {
    $bookID = $_GET['bookID'];
    $capacity = intval($_GET['cap']);
    $book->setBookID($bookID);
    $result = $book->getInfoByID();
    $row = $result->fetch_array(MYSQLI_ASSOC);
}
else {
    echo "<script>
if (confirm('Nothing to borrow, please return to homepage.')) {
    window.location.replace('searchBookView.php');
} else window.location.replace('NotFound.html');
</script>";
}
if (isset($_POST['confirm'])) {
    if (($book->validate($_POST['borrowDate'], $_POST['returnDate']) == false) || $book->test($_POST['borrowDate'], $_POST['returnDate'])== false) {
        echo "<script>window.alert('Error');</script>";
    }
    else {
        $returnDate = $_POST['returnDate'];
        $borrowDate = $_POST['borrowDate'];
        if (empty($_POST['returnDate'])) {
            $returnDate = strtotime($borrowDate) + 4*30*24*3600;
            $returnDate = date("Y-m-d", $returnDate);
        }
        $borrowDate = date("Y-m-d", strtotime($borrowDate));
        $returnDate = date("Y-m-d", strtotime($returnDate));
        if ($book->checkBorrowed() == true) {
            $book->borrowBook($borrowDate, $returnDate, intval($_GET['cap']));
            echo "<script>
                    if (confirm('Congratulations! Borrow books successfully.')) {
                        window.location.href = 'cart.php';
                    }
                  </script>";
        } else {
            echo "<script>window.alert('You can not borrow this book.')</script>";
        }
    }
}
if (isset($_SESSION['student']['id'])) $cartDetail = getInfoCart($_SESSION['student']['id'], $connect);
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Library System</title>
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
    <link rel="stylesheet" href="../assets/css/searchBook.css">
    <script type="text/javascript" src="../public/jquery.min.js"></script>
    <link rel="stylesheet" href="../public/jquery-ui.css">
    <script type="text/javascript" src="../public/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="../public/jquery-ui.js"></script>
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
                                    <li><a href="index.php">Home</a></li>
                                    <li>
                                        <a href="searchBookView.php">Search</a>
                                        <ul class="submenu">
                                            <li><a href="searchBookView.php">Search Book</a></li>
                                            <?php
                                            if (isset($_SESSION['admin'])) {
                                                ?>
                                                <li><a href="searchUser.php">Search User</a></li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </li>
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
                                    if (isset($_SESSION['student']['id'])) {
                                        ?>
                                        <li>
                                            <a style="cursor: pointer;" title="Your books" href="cart.php">
                                                <i class="fas fa-book" style="font-size: 20px;">
                                                    <span class="badge badge-danger">
                                                        <?php
                                                        if (isset($cartDetail)) echo $cartDetail->num_rows;
                                                        ?>
                                                    </span>
                                                </i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="profile.php">
                                                Profile
                                            </a>
                                        </li>
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
                        if (!isset($_SESSION['student']['id'])) {
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
                        <div class="col-lg-5 d-none d-xl-block">
                            <div
                                class="hero__img hero__img2"
                                data-animation="fadeInLeft"
                                data-delay="1s"
                            >
                                <img src="../assets/img/hero/book.png" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="borrowForm">
        <form action="borrowView.php?bookID=<?php if (isset($bookID)) echo $bookID;?>&cap=<?php echo $row['quantity'];?>" method="post" >
            <input
                class="form-control form-control-lg mb-2"
                type="text"
                name="borrowDate"
                id="borrowDate"
                placeholder="Borrow Date..."
            /> <br/><br/>
            <input
                class="form-control form-control-lg mb-2"
                type="text"
                name="returnDate"
                id="returnDate"
                placeholder="Return Date..."
            />
            <p data-animation="fadeInRight" data-delay=".6s">
                You can skip return date field and the default is after 4 months
            </p> <br/>
            <button class="btn" type="submit" name="confirm" style="font-weight: bold;">CONFIRM</button>
        </form>
    </div>
    <!-- Slider Area End-->
</main>
<script>
    $("#borrowDate").datepicker({
        dateFormat: "dd-mm-yy",
        showAnim: "explode",
        minDate: -0,
        maxDate: +7
    });
    $("#returnDate").datepicker({
        dateFormat: "dd-mm-yy",
        showAnim: "explode",
        minDate: -0,
        maxDate: "+3M"
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
    });
</script>
</body>
</html>
