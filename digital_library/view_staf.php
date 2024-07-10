<?php include('../config/conn_db.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Custom CSS3 -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Icon Favicon -->
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Font Family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Default Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <title>Digital library management system for Kampong spue Institute of Technology</title>
</head>

<body style="background-color: #dedede;">
    <!-- Scroll to Top -->
    <div onclick="topFunction()" id="myBtn"><i class="fa-solid fa-circle-chevron-up"
            style="color: orange; font-size: 1.4rem;"></i>
    </div>

    <!-- Start Section Top Bar -->
    <?php include('includes/topbar.php');?>

    <!-- Ent Section Top Bar -->

    <!-- Start Navigation Bar -->
    <?php include('includes/navbar.php');?>

    <!-- Ent Navigation Bar -->

    <!-- Start All Section Start Content -->
    <div class="container">
        <!-- Start Content Computer -->
        <div class="section-computer mt-2">

            <div class="title d-flex">
                <div class="computer">
                    <h5>គណៈគ្រប់គ្រង</h5>
                </div>
                <div class="rows"></div>
            </div>

            <div class="card" style="width: 100%;">

                <div class="container row my-4">
                    <div class="col-sm-8">
                        <div class="container">

                            <div class="card my-2" style="width: 100%; border-color: orange;">



                                <?php
                                if(isset($_GET['id'])){
                                    $staff_id = $_GET['id'];
                                    $query_staff = "SELECT * FROM member WHERE select_role='នាយករង' && id=$staff_id";
                                    $result_query = $conn->query($query_staff);
                                    if($result_query->num_rows>0){
                                        while($row_staffs = $result_query->fetch_assoc()){
                                            $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
                                                unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                                                $desc = strtr(html_entity_decode($row_staffs['detail']),$trans);
                                                $desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
                                            ?>

                                <!-- Start view image -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #dedede;">

                                                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body d-flex align-items-center justify-content-center"
                                                style="background-color: #dedede;">
                                                <?php foreach (json_decode($row_staffs["image"]) as $image) : ?>
                                                <img src="../admin_dashboard_library/uploads/<?php echo $image; ?>"
                                                    style="width: 100%;">
                                                <?php endforeach; ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- End view imag -->

                                <div class="container">
                                    <div class="card-body">
                                        <h5 class="staff-title">នាយករង</h5>
                                        <div class="rowses"></div>
                                        <div class="control-profile row my-2">
                                            <div class="col-sm-4 staff-profile">
                                                <div class="bg-profile">
                                                    <?php
                                                        foreach (json_decode($row_staffs["image"]) as $image) : ?>
                                                    <img src="../admin_dashboard_library/uploads/<?php echo $image; ?>"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <?php endforeach; ?>
                                                </div>
                                                <!-- <div class="staff-name text-center mt-2">
                                                        <h6 class="staff-name">Name: SOKHUM</h6>
                                                    </div> -->
                                            </div>
                                            <div class="col-sm-8">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <span class="list-staf fw-bolder">ឈ្មោះ</span>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <span class="text-warning fw-bolder"> :*</span>
                                                                <span
                                                                    class="detail-staf mx-2"><?php echo $row_staffs['firstname']. $row_staffs['lastname']?></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <span class="list-staf fw-bolder">ភេទ</span>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <span class="text-warning fw-bolder"> :*</span>
                                                                <span class="detail-staf mx-2">
                                                                    <?php echo $row_staffs['sex']?></span>
                                                            </div>
                                                        </div>

                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <span class="list-staf fw-bolder">អ៊ីម៊ែល</span>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <span class="text-warning fw-bolder"> :*</span>
                                                                <span
                                                                    class="detail-staf mx-2"><?php echo $row_staffs['email']?>
                                                                </span>
                                                            </div>
                                                        </div>

                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <span class="list-staf fw-bolder">ទូរស័ព្ទ</span>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <span class="text-warning fw-bolder"> :*</span>
                                                                <span
                                                                    class="detail-staf mx-2"><?php echo $row_staffs['phone']?></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="conten-show-more">
                                            <div class="title-about-staf my-3">
                                                <span class="list-staf fw-bolder">អំពីរនាយករង៖</span>
                                            </div>

                                            <?php echo $desc;?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                        }
                                    }
                                }
                                ?>






                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card-body major-study">
                            <h6 class="major-title">បុគ្គលិកបង្រៀន</h6>
                            <ul>
                                <li class="d-flex align-items-center"><i class="fa-solid fa-angle-right fa-sm me-2"
                                        style="color: #336666;"></i><a href=""
                                        class="text-decoration-none text-dark">ជំនាញវិទ្យាសាស្រ្តដំណាំ</a></li>
                                <li class="d-flex align-items-center"><i class="fa-solid fa-angle-right fa-sm me-2"
                                        style="color: #336666;"></i><a href=""
                                        class="text-decoration-none text-dark">ជំនាញវិទ្យាសាស្រ្តសត្វ</a></li>
                                <li class="d-flex align-items-center"><i class="fa-solid fa-angle-right fa-sm me-2"
                                        style="color: #336666;"></i><a href=""
                                        class="text-decoration-none text-dark">ជំនាញវិទ្យាសាស្រ្តជលផល</a></li>
                                <li class="d-flex align-items-center"><i class="fa-solid fa-angle-right fa-sm me-2"
                                        style="color: #336666;"></i><a href=""
                                        class="text-decoration-none text-dark">ជំនាញកុំព្យូទ័រធុរកិច្ច</a></li>
                                <li class="d-flex align-items-center"><i class="fa-solid fa-angle-right fa-sm me-2"
                                        style="color: #336666;"></i><a href=""
                                        class="text-decoration-none text-dark">ជំនាញបច្ចេកវិទ្យាកុំព្យូទ័រ</a></li>
                                <li class="d-flex align-items-center"><i class="fa-solid fa-angle-right fa-sm me-2"
                                        style="color: #336666;"></i><a href=""
                                        class="text-decoration-none text-dark">ជំនាញបច្ចេកវិទ្យាមេកានិច</a></li>
                                <li class="d-flex align-items-center"><i class="fa-solid fa-angle-right fa-sm me-2"
                                        style="color: #336666;"></i><a href=""
                                        class="text-decoration-none text-dark">ជំនាញបច្ចេកវិទ្យាអាហារ</a></li>
                                <li class="d-flex align-items-center"><i class="fa-solid fa-angle-right fa-sm me-2"
                                        style="color: #336666;"></i><a href=""
                                        class="text-decoration-none text-dark">ផ្នែកអប់រំបច្ចេកទេសវិជ្ជាជីវៈកម្រិត៣
                                        "បសុវប្បកម្ម"</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Ent Content Computer -->

    </div>
    <!-- Ent All Section Start Content -->
    <!-- Start Bottom Footer -->
    <?php include('includes/footer.php');?>

    <!-- Start Bottom Footer -->
    <!-- Start Bottom Footer Copyright -->
    <?php include('includes/bottom.php');?>

    <!-- Ent Bottom Footer Copyright -->
    <script>
    const currentLocation = location.href;
    const menuItem = document.querySelectorAll('.nav-link');
    const menuLength = menuItem.length;

    for (let i = 0; i < menuLength; i++) {
        if (menuItem[i].href === currentLocation) {
            menuItem[i].classList.add("active");
        }
    }
    // Get the button
    let mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
    </script>
    <!-- Script Js Default Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>