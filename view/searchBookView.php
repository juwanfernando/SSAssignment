<?php
include_once "../model/connect.php";
include_once "../Objects/Search.php";
include_once "../Objects/searchBook.php";
include_once "../model/timeout.php";
include_once "../model/user.php";
include_once "../model/validate.php";
$connect = connectServer("localhost", "root", "", 3306);
$dbname = "library";
$connect->select_db($dbname);
if (isset($_POST["search"])) {
    $condition = $_POST["name"];
    if (!empty($condition)) {
        $_SESSION['condition'] = $condition;
        $searchBook = new searchBook($connect, $condition);
        $result = $searchBook->getResult();
        $_SESSION['total'] = mysqli_num_rows($result);
        header("Location: searchBookResult.php?key=$condition");
    }
}
if (isset($_GET['key']) && !empty($_GET['key'])) {
    if (isset($_GET['page']) && !empty($_GET['page'])) $currentPage = intval($_GET['page']);
    else $currentPage = 1;
    $recordPerPage = 10;
    $start = ($currentPage*$recordPerPage) - $recordPerPage;
    $condition = $_GET['key'];
    $searchBook = new searchBook($connect, $condition);
    if (isset($_SESSION['total']) && $_SESSION['total'] != 0) {
        $total = $_SESSION['total'];
        $lastPage = ceil($total/$recordPerPage);
    }
    $firstPage = 1;
    $nextPage = $currentPage + 1;
    $previousPage = $currentPage - 1;
    $limitResult = $searchBook->getLimitResult($start, $recordPerPage);
}
if (isset($_GET['name']) && !empty($_GET['name'])) {
    $condition = $_GET['name'];
    $searchBook = new searchBook($connect, $condition);
    $someResult = $searchBook->getResult();
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
                                    }
                                            else echo "</ul>";
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
                                    if (isset($_SESSION['student']['id']) || isset($_SESSION['admin'])) {
                                        if (isset($_SESSION['student']['id'])) {
                                            ?>
                                            <li>
                                                <a style="cursor: pointer;" title="Your books" href="cart.php">
                                                    <i class="fas fa-book" style="font-size: 20px;">
                                                        <span class="badge badge-danger"><?php echo $cartDetail->num_rows;?></span>
                                                    </i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="profile.php">
                                                    Profile
                                                </a>
                                            </li>
                                            <?php
                                        } elseif (isset($_SESSION['admin']) && $_SESSION['admin'] == 'uetLicAdmin') {
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
                        if ((!isset($_SESSION['student']['id']) && !isset($_SESSION['admin']))) {
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
                        <div class="col-lg-7 col-md-9">
                            <div class="hero__caption hero__caption2">
                                <h1 data-animation="fadeInRight" data-delay=".4s">
                                    Search<br />
                                    Every Book
                                </h1>
                                <form action="searchBookResult.php" method="post">
                                    <input
                                            class="form-control form-control-lg mb-2"
                                            type="search"
                                            name="name"
                                            placeholder="Search"
                                            aria-label="Search"
                                    />
                                    <p data-animation="fadeInRight" data-delay=".6s">
                                        Search any book in a second!
                                    </p>
                                    <!-- Hero-btn -->
                                    <div
                                            class="hero__btn"
                                            data-animation="fadeInRight"
                                            data-delay=".8s"
                                    >
                                        <button type="submit" class="btn hero-btn" name="search"
                                        ><span style="size: 10;">SEARCH</span
                                            ><i class="fas fa-lg fa-search ml-2"></i
                                            ></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Slider Area End-->
</main>


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
        $(".over").click(function () {
            window.alert("This book's quantity less 0");
        });
        $("#employee").click(function () {
            window.location.replace('admin.php');
        });
    });
</script>
</body>
</html>
