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
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<div class="container " id="listBook">
    <?php
    if (isset($limitResult) && mysqli_num_rows($limitResult) > 0 && isset($_SESSION['total']) && !isset($_GET['name'])) {
        ?>
        <div class="alert alert-success alert-dismissible fade show" style="width: 28%; height: 50px;">
            <button type="button" class="close" data-dismiss="alert" style="outline: none;">&times;</button>
            <i class="fas fa-check-circle" style="color: #34ce57;"></i>
            <strong>Success! <?php echo $_SESSION['total'] . " result found.";?></strong>
        </div>
        <?php
        while ($row = mysqli_fetch_array($limitResult)) {
            ?>
            <div class="row book">
                <div class="col col-sm-2">
                    <?php
                    if (!isset($_SESSION['admin'])) {
                        if (intval($row['quantity'] > 0)) {
                            ?>
                            <a href="borrowView.php?bookID=<?php echo $row['bookID'];?>&cap=<?php echo $row['quantity']; ?>">
                                <img src="<?php echo '../image/' . $row['image'] . '.jpg'?>" class="image" width="150px" height="200px">
                            </a>
                            <?php
                        } else {
                            ?>
                            <img src="<?php echo '../image/' . $row['image'] . '.jpg'?>" class="image over" width="150px" height="200px" style="cursor: not-allowed" >
                            <?php
                        }
                        ?>
                        <?php
                    } else {
                        ?>
                        <a href="update.php?bookID=<?php echo $row['bookID'];?>">
                            <img src="<?php echo '../image/' . $row['image'] . '.jpg'?>" class="image" width="150px" height="200px">
                        </a>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-sm-7">
                    <?php
                    if (!isset($_SESSION['admin'])) {
                        if (intval($row['quantity']) > 0) {
                            ?>
                            <a href="borrowView.php?bookID=<?php echo $row['bookID'];?>&cap=<?php echo $row['quantity']; ?>" class="a-custom">
                                <?php echo $row["name"] . "<br/>"; ?>
                                <?php echo $row["caption"]; ?>
                            </a>
                            <?php
                        } else {
                            ?>
                            <p style="cursor: not-allowed" class="over">
                                <?php echo $row["name"] . "<br/>"; ?>
                                <?php echo $row["caption"]; ?>
                            </p>
                            <?php
                        }
                        ?>
                        <?php
                    } else {
                        ?>
                        <a href="update.php?bookID=<?php echo $row['bookID'];?>" class="a-custom">
                            <?php echo $row["name"] . "<br/>"; ?>
                            <?php echo $row["caption"]; ?>
                        </a>
                        <?php
                    }
                    ?>
                    <br/> <br/>
                    <p style="font-family: Arial; font-size: 17px !important;"> <?php echo "Author: " . "<strong>" . $row["author"] . "</strong>"?></p>
                    <p style="font-family: Arial; font-size: 17px !important;"> <?php echo "Publish Date: " . "<strong>" . date("d/m/Y", strtotime($row["publishDate"])) . "</strong>"?></p>
                </div>
                <div class="col col-sm-3">
                    <i class="fas fa-book" style="color: green; font-size: 20px; margin-left: 70px; margin-top: 30px;">
                        <?php
                        echo $row['quantity'];
                        ?>
                    </i> <br/>
                    <?php
                    if (!isset($_SESSION['admin'])) {
                        if (intval($row['quantity'] > 0)) {
                            ?>
                            <button class="btn borrow" type="submit" name="borrow" onclick="window.location.href = 'borrowView.php?bookID=<?php echo $row['bookID'] . '&cap='.$row['quantity'];?>';" formmethod="post">Borrow Book</button>
                            <?php
                        } else {
                            ?>
                            <button class="btn borrow over" type="submit" disabled="disabled" style="cursor: not-allowed;">Not Allowed</button>
                            <?php
                        }
                        ?>
                        <?php
                    } elseif (isset($_SESSION['admin'])) {
                        ?>
                        <button class="btn borrow" type="submit" name="update" onclick="window.location.href = 'update.php?bookID=<?php echo $row['bookID'];?>';" formmethod="post">Up Date</button>
                        <?php
                    }
                    ?>
                </div>
                <?php
                ?>
            </div>
            <?php
        }
    }
     if ((!isset($limitResult) && isset($_POST["search"])) || (isset($limitResult) && mysqli_num_rows($limitResult) == 0)) {
        ?>
        <div class="alert alert-danger alert-dismissible fade show" style="width: 15%; height: 50px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="fas fa-exclamation-triangle" style="color: red;">No result</i>
        </div>
        <?php
    }
     if (isset($_GET['name']) && !empty($_GET['name']) && isset($someResult)) {
         if ($someResult->num_rows > 0) {
             while ($some = mysqli_fetch_array($someResult)) {
                 ?>
                 <div class="row book">
                     <div class="col col-sm-2">
                         <a href="borrowView.php?bookID=<?php echo $some['bookID'];?>&cap=<?php echo $some['quantity']; ?>">
                             <img src="<?php echo '../image/' . $some['image'] . '.jpg'?>" class="image" width="150px" height="200px">
                         </a>
                     </div>
                     <div class="col-sm-7">
                         <a href="borrowView.php?bookID=<?php echo $some['bookID'];?>&cap=<?php echo $some['quantity']; ?>" class="a-custom">
                             <?php echo $some["name"] . "<br/>"; ?>
                             <?php echo $some["caption"]; ?>
                         </a> <br/> <br/>
                         <p style="font-family: Arial; font-size: 17px !important;"> <?php echo "Author: " . "<strong>" . $some["author"] . "</strong>"?></p>
                         <p style="font-family: Arial; font-size: 17px !important;"> <?php echo "Publish Date: " . "<strong>" . date("d/m/Y", strtotime($some["publishDate"])) . "</strong>"?></p>
                     </div>
                     <div class="col col-sm-3">
                         <i class="fas fa-book" style="color: green; font-size: 20px; margin-left: 70px; margin-top: 30px;">
                             <?php
                             echo $some['quantity'];
                             ?>
                         </i> <br/>
                         <?php
                         if (isset($_SESSION['student']['id'])) {
                             ?>
                             <button class="btn borrow" type="submit" name="borrow" onclick="window.location.href = 'borrowView.php?bookID=<?php echo $some['bookID'] . '&cap='.$some['quantity'];?>';" formmethod="post">Borrow Book</button>
                             <?php
                         } elseif (isset($_SESSION['admin'])) {
                             ?>
                             <button class="btn borrow" type="submit" name="update" onclick="window.location.href = 'update.php?bookID=<?php echo $some['bookID'];?>';" formmethod="post">Up Date</button>
                             <?php
                         }
                         ?>
                     </div>
                     <?php
                     ?>
                 </div>
    <?php
             }
         }
     }
    ?>
</div>
<?php
if (isset($limitResult) && mysqli_num_rows($limitResult) > 0) {
    ?>
    <nav aria-label="Page navigation" id="pagination">
        <ul class="pagination">
            <?php if(isset($currentPage) && isset($firstPage) && $currentPage != $firstPage) { ?>
                <li class="page-item">
                    <a class="page-link" href="?key=<?php echo $_SESSION['condition'];?>&page=<?php echo $firstPage ?>" tabindex="-1" aria-label="Previous">
                        <span aria-hidden="true">First</span>
                    </a>
                </li>
            <?php } ?>
            <?php if(isset($currentPage) && $currentPage >= 2) { ?>
                <li class="page-item"><a class="page-link" href="?key=<?php echo $_SESSION['condition'];?>&page=<?php echo $previousPage ?>"><?php echo $previousPage ?></a></li>
            <?php } ?>
            <li class="page-item active"><a class="page-link" href="?key=<?php echo $_SESSION['condition'];?>&page=<?php if (isset($currentPage))echo $currentPage ?>"><?php if (isset($currentPage)) echo $currentPage ?></a></li>
            <?php if(isset($currentPage) && $currentPage != $lastPage) { ?>
                <li class="page-item"><a class="page-link" href="?key=<?php echo $_SESSION['condition'];?>&page=<?php if (isset($nextPage)) echo$nextPage ?>"><?php if (isset($nextPage)) echo $nextPage ?></a></li>
                <li class="page-item">
                    <a class="page-link" href="?key=<?php echo $_SESSION['condition'];?>&page=<?php echo $lastPage ?>" aria-label="Next">
                        <span aria-hidden="true">Last</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </nav>
    <?php
}
?>

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
