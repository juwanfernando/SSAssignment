<?php
include_once "../model/connect.php";
include_once "../model/timeout.php";
include_once "../model/validate.php";
include_once "../controller/addAccount.php";
include_once "../Objects/Student.php";
$connect = connectServer("localhost", "root", "", 3306);
$dbname = "library";
$connect->select_db($dbname);
if (isset($_POST["signup"])) {
    $student = new Student($_POST["studentID"], $_POST["studentname"], $_POST["birthday"], $_POST["faculty"], $_POST["class"], $_POST["password"]);
    $_SESSION["student"]["confirm"] = $_POST["confirm"];
    addAccount($student, $connect);
}
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
                                    <li><a href="index.php"> Home</a></li>
                                    <li>
                                        <a href="searchBookView.php">Search</a>
                                        <ul class="submenu">
                                            <li><a href="searchBookView.php">Search Book</a></li>
<!--                                            <li><a href="searchUser.html">Search User</a></li>-->
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="category.html">Category</a>
                                        <ul class="submenu">
                                            <li><a href="blog.html">Information Technology</a></li>
                                            <li><a href="single-blog.html">Law and Social</a></li>
                                            <li><a href="blog.html">Science and Technology</a></li>
                                            <li><a href="single-blog.html">Education</a></li>
                                            <li><a href="blog.html">Philosophy and Life</a></li>
                                            <li><a href="single-blog.html">Human History</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3">
                        <div class="header-right-btn f-right d-none d-lg-block">
                            <a href="login.php" class="btn header-btn">Login</a>
                        </div>
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
                                <img src="../assets/img/hero/hero_left.png" alt="" />
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-9">
                            <div class="hero__caption hero__caption2">
                                <h1 data-animation="fadeInRight mt-50" data-delay=".4s">
                                    Sign Up<br />
                                </h1>
                                <form action="signUp.php?action=add" method="post">
                                    <input
                                        class="form-control form-control-lg mb-30"
                                        type="text"
                                        name="studentID"
                                        id="studentID"
                                        placeholder="Student Code..."
                                    >
                                    <input
                                        class="form-control form-control-lg mb-30"
                                        type="text"
                                        placeholder="Your Name..."
                                        name="studentname"
                                        id="studentname"
                                    >
                                    <input
                                        type="text"
                                        class="form-control form-control-lg mb-30"
                                        name="birthday"
                                        id="birthday"
                                        placeholder="Date Of Birth..."/>
                                    <select name="faculty" class="form-control form-control-lg mb-30">
                                        <option value="CN1" class="form-control form-control-lg mb-30">Information Technology(CN1)</option>
                                        <option value="CN2" class="form-control form-control-lg mb-30">Computers and Robots(CN2)</option>
                                        <option value="CN3" class="form-control form-control-lg mb-30">Technical physics(CN3)</option>
                                        <option value="CN4" class="form-control form-control-lg mb-30">Mechanical Engineer(CN4)</option>
                                        <option value="CN5" class="form-control form-control-lg mb-30">Construction engineering(CN5)</option>
                                        <option value="CN6" class="form-control form-control-lg mb-30">Mechatronics engineering technology(CN6)</option>
                                        <option value="CN7" class="form-control form-control-lg mb-30">Aerospace Technology(CN7)</option>
                                        <option value="CN8" class="form-control form-control-lg mb-30">Information Technology-CLC(CN8)</option>
                                        <option value="CN9" class="form-control form-control-lg mb-30">Electronics and telecommunications technology(CN9)</option>
                                        <option value="CN10" class="form-control form-control-lg mb-30">Agricultural Technology(CN10)</option>
                                        <option value="CN11" class="form-control form-control-lg mb-30">Control engineering and automation(CN11)</option>
                                    </select> <br/>
                                    <select name="class" class="form-control form-control-lg mb-30">
                                        <option value="K64" class="form-control form-control-lg mb-30">QH-2019</option>
                                        <option value="K63" class="form-control form-control-lg mb-30">QH-2018</option>
                                        <option value="K62" class="form-control form-control-lg mb-30">QH-2017</option>
                                        <option value="K61" class="form-control form-control-lg mb-30">QH-2016</option>
                                        <option value="K60" class="form-control form-control-lg mb-30">QH-2015</option>
                                        <option value="K59" class="form-control form-control-lg mb-30">QH-2014</option>
                                    </select> <br/>
                                    <input
                                        class="form-control form-control-lg mb-30"
                                        type="password"
                                        name="password"
                                        id="password"
                                        placeholder="Your Password..."
                                    >
                                    <input
                                        class="form-control form-control-lg mb-30"
                                        type="password"
                                        name="confirm"
                                        id="confirm"
                                        placeholder="Confirm Password..."
                                    >

<!--                                    Hero-btn-->
                                    <div
                                        class="hero__btn"
                                        data-animation="fadeInRight"
                                        data-delay=".8s"
                                    >
                                        <button class="btn hero-btn" type="submit" name="signup" id="signup"
                                        ><span style="size: 10;">Sign Up</span
                                            ><i class="fas fa-plus-circle fa-lg ml-2"></i
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
<script>
    $("#birthday").datepicker({
        dateFormat: "dd-mm-yy",
        showAnim: "explode",
        minDate: -0,
        maxDate: +7
    });
    window.onload = function() {
        const birthday = document.getElementById('birthday');
        birthday.onpaste = function(e) {
            e.preventDefault();
        }
    }
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
</body>
</html>
