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
if (!isset($_SESSION['student']['id'])) header("Location: login.php");
$book = new Book($connect, 0);
if (isset($_POST['dateChange'])) {
    if (!isset($_POST['dateChange']) || empty($_POST['dateChange'])) {
        $currentPage = $_SERVER['PHP_SELF'];
        header("Location: $currentPage");
    } else {
        $borrowDate = $_POST['borrowDate'];
        $returnDate = $_POST['returnDate'];
        $newDate = date("Y-m-d", strtotime($_POST['dateChange']));
        if (changeReturnDate($borrowDate, $returnDate, $newDate) == true && update($connect, $newDate, $_GET['id'])) {
            echo "<script>
                    window.alert('Change return date successfully.');
                    window.location.replace('cart.php');
                  </script>";
        } else {
            echo "<script>
                    window.location.replace('cart.php');
                    window.alert('Change failed.');
                  </script>";
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
                                                <i class="fas fa-book">
                                                    <span class="badge badge-danger" style="margin-bottom: 20px;"><?php if (isset($cartDetail)) echo mysqli_num_rows($cartDetail);?></span>
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
                        <div class="col-lg-4 d-none d-xl-block">
                            <div
                                class="hero__img hero__img2"
                                data-animation="fadeInLeft"
                                data-delay="1s"
                            >
                                <img src="../assets/img/hero/book.png" alt="" />
                            </div>
                        </div>
                        <div class="col col-lg-8" style="margin-top: 150px; margin-bottom: 100px;">
                            <div class="alert alert-success" role="alert">
                                The number of books you borrow is: <strong><?php if (isset($cartDetail)) echo $cartDetail->num_rows;?> </strong>
                            </div>
                            <table class="table table-striped" id="detail" style="display: none;">
                                <thead>
                                <tr>
                                    <th>Book's Name</th>
                                    <th>Quantity</th>
                                    <th>Borrow Date</th>
                                    <th>Return Date</th>
                                    <th>Change Return Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($cartDetail)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['name'];?></td>
                                        <td style="text-align: center;"><?php echo $row['quantity'];?></td>
                                        <td><?php echo $row['date1'];?></td>
                                        <td><?php echo $row['date2'];?></td>
                                        <td>
                                            <form action="cart.php?id=<?php if (isset($row['roundID'])) echo $row['roundID'];?>">
                                                <input type="text" class="form-control dateChange" name="dateChange" id="myInput" placeholder="dd-mm-yyyy">
                                                <input type="hidden" name="borrowDate" value="<?php echo $row['date1']?>">
                                                <input type="hidden" name="returnDate" value="<?php echo $row['date2']?>">
                                                <button style="color: #34ce57; margin-left: 70px;
                                                        background-color: transparent;
                                                        outline: none;"
                                                         title="change"
                                                         name="change" type="submit" formmethod="post"
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
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
    });
</script>
</body>
</html>
