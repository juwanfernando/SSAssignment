<?php
include "../model/connect.php";
include_once "../controller/controlCategory.php";
include_once "../model/user.php";
$connect = connectServer("localhost", "root", "", 3306);
$dbname = "library";
$connect->select_db($dbname);
$category1 = getCategory($connect, 'information technology');
$category2 = getCategory($connect, 'Law&Social');
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
    <link rel="stylesheet" href="../assets/css/category.css">
    <script type="text/javascript" src="../public/jquery.min.js"></script>
    <script type="text/javascript" src="../public/jquery-1.12.4.js"></script>
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
                                                <li><a href="searchUser.html">Search User</a></li>
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
                        <div class="header-right-btn f-right d-none d-lg-block">
                            <?php
                            if (!isset($_SESSION['student']['id']) && !isset($_SESSION['admin'])) {
                                ?>
                                <div class="header-right-btn f-right d-none d-lg-block">
                                    <a href="login.php" class="btn header-btn">Login</a>
                                </div>
                                <?php
                            }
                            ?>
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
    <div class="services-area">
        <div class="container">
            <!-- Section-tittle -->
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="section-tittle text-center mb-80">
                        <span>Book Categories</span>
                        <h2>Here are all book Categories​</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="category" style="display: none;">
        <div class="row">
            <div class="col col-sm-4" style="text-align: center;">
                <span>Information Technology</span>
                <ul class="list-group">
                    <?php
                    if ($category1->num_rows > 0) {
                        while ($row1 = mysqli_fetch_array($category1)) {
                            ?>
                            <a href="searchBookResult.php?name=<?php echo $row1['name'];?>" style="color: #34ce57;">
                                <li class="list-group-item">
                                    <?php
                                    echo $row1['name'];
                                    ?>
                                </li>
                            </a>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="col col-sm-4" style="text-align: center;">
                <span>Law and Social</span>
                <ul class="list-group">
                    <?php
                    if ($category2->num_rows > 0) {
                        while ($row1 = mysqli_fetch_array($category2)) {
                            ?>
                            <a href="searchBookResult.php?name=<?php echo $row1['name'];?>" style="color: #34ce57;">
                                <li class="list-group-item">
                                    <?php
                                    echo $row1['name'];
                                    ?>
                                </li>
                            </a>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- Slider Area End-->
</main>
<script>
    $("#category").fadeIn(1800);
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
        $("#employee").click(function () {
            window.location.replace('admin.php');
        });
    });
</script>
</body>
</html>
