<?php
include_once "../model/connect.php";
include_once "../model/user.php";
$connect = connectServer("localhost", "root", "", 3306);
$dbname = "library";
$connect->select_db($dbname);
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

    <link
        rel="shortcut icon"
        type="image/x-icon"
        href="../assets/img/favicon.ico"
    />

    <!-- CSS here -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css" / >
    <link rel="stylesheet" href="../assets/css/flaticon.css" />
    <link rel="stylesheet" href="../assets/css/slicknav.css" />
    <link rel="stylesheet" href="../assets/css/animate.min.css" />
    <link rel="stylesheet" href="../assets/css/magnific-popup.css" />
    <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css" />
    <link rel="stylesheet" href="../assets/css/themify-icons.css" />
    <link rel="stylesheet" href="../assets/css/slick.css" />
    <link rel="stylesheet" href="../assets/css/nice-select.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
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
                                            if (isset($_SESSION['admin']) || isset($_SESSION['employee'])) {
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
                                    if (isset($_SESSION['student']['id']) || isset($_SESSION['admin'])) {
                                        if (isset($_SESSION['student']['id'])) {
                                            ?>
                                            <li>
                                                <a style="cursor: pointer;" title="Your books" href="cart.php">
                                                    <i class="fas fa-book" style="font-size: 20px;">
                                                        <span class="badge badge-danger"><?php if (isset($cartDetail)) echo $cartDetail->num_rows;?></span>
                                                    </i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="profile.php">
                                                    Profile
                                                </a>
                                            </li>
                                            <?php
                                        }
                                        elseif (isset($_SESSION['admin']) && $_SESSION['admin'] == 'uetLicAdmin') {
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
                    <?php
                    if (!isset($_SESSION['student']['id']) && !isset($_SESSION['admin'])) {
                        ?>
                        <div class="col-xl-2 col-lg-2 col-md-3">
                            <div class="header-right-btn f-right d-none d-lg-block">
                                <a href="login.php" class="btn header-btn">Login</a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
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
            <div
                class="single-slider slider-height d-flex align-items-center"
                data-background="assets/img/hero/h1_hero.png"
            >
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-7 col-md-9">
                            <div class="hero__caption">
                                <h1
                                    style="color: rgb(192, 43, 43);"
                                    data-animation="fadeInLeft"
                                    data-delay=".4s"
                                >
                      <span>
                        <img
                            src="../assets/img/UET.png"
                            alt=""
                            width="70"
                            height="70"
                            style="float: left;"
                            class="mr-1"
                        />
                        NLINE
                      </span>
                                    <br />
                                    LIBRARY SYSTEM
                                </h1>
                                <p data-animation="fadeInLeft" data-delay=".6s">
                                    A service dedicated to students of the
                                    <b>University of Engineering & Technology (UET)</b>
                                    learning community. We provide online resources,
                                    professional support and guidance to all our students
                                    whenever, and from wherever they have chosen to study.
                                </p>
                                <!-- Hero-btn -->
                                <?php
                                if (!isset($_SESSION['student']['id']) && !isset($_SESSION['admin'])) {
                                    ?>
                                    <div
                                        class="hero__btn"
                                        data-animation="fadeInLeft"
                                        data-delay=".8s"
                                    >
                                        <a href="login.php" class="btn hero-btn">TRY NOW</a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div
                                class="hero__img d-none d-lg-block"
                                data-animation="fadeInRight"
                                data-delay="1s"
                            >
                                <img src="../assets/img/hero/hero_right.png" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="single-slider slider-height d-flex align-items-center"
                data-background="assets/img/hero/h1_hero.png"
            >
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-7 col-md-9">
                            <div class="hero__caption">
                                <h1 data-animation="fadeInLeft" data-delay=".4s">
                                    ONLINE<br />
                                    LIBRARY SYSTEM
                                </h1>
                                <p data-animation="fadeInLeft" data-delay=".6s">
                                    A service dedicated to students of the University of
                                    Engineering & Technology learning community. We provide
                                    online resources, professional support and guidance to all
                                    our students whenever, and from wherever they have chosen
                                    to study.
                                </p>
                                <!-- Hero-btn -->
                                <div
                                    class="hero__btn"
                                    data-animation="fadeInLeft"
                                    data-delay=".8s"
                                >
                                    <a href="industries.html" class="btn hero-btn">TRY NOW</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div
                                class="hero__img d-none d-lg-block"
                                data-animation="fadeInRight"
                                data-delay="1s"
                            >
                                <img src="../assets/img/hero/hero_right.png" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Slider Area End-->
    <!-- What We do start-->
    <div class="what-we-do we-padding">
        <div class="container">
            <!-- Section-tittle -->
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="section-tittle text-center">
                        <h2>Main Feature</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-do text-center mb-30">
                        <div class="do-icon">
                            <span class="flaticon-tasks"></span>
                        </div>
                        <div class="do-caption">
                            <h4>Search Every Books</h4>
                            <p>
                                Search between thousands of books within seconds
                            </p>
                        </div>
                        <div class="do-btn">
                            <a href="searchBookView.php"><i class="ti-arrow-right"></i>Search</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-do active text-center mb-30">
                        <div class="do-icon">
                            <span class="flaticon-social-media-marketing"></span>
                        </div>
                        <div class="do-caption">
                            <h4>Borrow books online</h4>
                            <p>
                                Borrow at home without a library
                            </p>
                        </div>
                        <div class="do-btn">
                            <a href="searchBookView.php"><i class="ti-arrow-right"></i> Borrow Book Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-do text-center mb-30">
                        <div class="do-icon">
                            <span class="flaticon-project"></span>
                        </div>
                        <div class="do-caption">
                            <h4>Book management</h4>
                            <p>
                                Manage borrowed books in just a few clicks!
                            </p>
                        </div>
                        <div class="do-btn">
                            <a href="cart.php"><i class="ti-arrow-right"></i> Manage now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tips Triks Start -->
    <div class="tips-triks-area tips-padding">
        <div class="container">
            <!-- Section-tittle -->
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 col-md-8 pr-0">
                    <div class="section-tittle text-center">
                        <h2>Some outstanding books</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single-tips mb-50">
                        <div class="tips-img">
                            <img src="../assets/img/tips/tips_1.jpg" alt="" />
                        </div>
                        <div class="tips-caption">
                            <h4><a href="#">Cách để qua môn Công Nghệ Phần Mềm</a></h4>
                            <span>Continue Reading</span>
                            <p>March 3, 2020</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single-tips mb-50">
                        <div class="tips-img">
                            <img src="../assets/img/tips/tips_2.jpg" alt="" />
                        </div>
                        <div class="tips-caption">
                            <h4><a href="#">Cách để cưa đổ Crush trong vài ngày</a></h4>
                            <span>Continue Reading</span>
                            <p>March 3, 2020</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single-tips mb-50">
                        <div class="tips-img">
                            <img src="../assets/img/tips/tips_3.jpg" alt="" />
                        </div>
                        <div class="tips-caption">
                            <h4><a href="#">Cách để kiếm 1 tỉ trong một giờ</a></h4>
                            <span>Continue Reading</span>
                            <p>March 3, 2020</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tips Triks End -->
    <!-- have-project Start-->
    <div class="have-project">
        <div class="container">
            <div class="haveAproject" data-background="assets/img/team/have.jpg">
                <?php
                if (!isset($_SESSION['student']['id']) && !isset($_SESSION['admin'])) {
                    ?>
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-7 col-lg-9 col-md-12">
                            <div class="wantToWork-caption">
                                <h2>You have not an account?</h2>
                                <p>
                                    If you do not have an account, create one immediately
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-3 col-md-12">
                            <div class="wantToWork-btn f-right">
                                <a href="signUp.php" class="btn btn-ans">Create Account</a>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                    ?>
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-7 col-lg-9 col-md-12">
                            <div class="wantToWork-caption">
                                <h2>Website is in the process of development</h2>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-- have-project End -->
</main>
<footer class="m-5">
    <!-- Footer Start-->

    <!-- Footer End-->
</footer>

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
        $("#employee").click(function () {
            window.location.replace('admin.php');
        });
    });
</script>
</body>
</html>
