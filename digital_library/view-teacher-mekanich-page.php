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
                    <h5>ប្រធាន</h5>
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
                                    $teacher_representative = $_GET['id'];
                                    ?>
                                <div class="container">
                                    <?php
                                    $select_representative ="SELECT * FROM member WHERE 	select_role='បុគ្គលិកដំណាងដេប៉ាតឺម៉ង់' && id=$teacher_representative";
                                    $result_representative = $conn->query($select_representative);
                                    if($result_representative->num_rows>0){
                                        while($row_representative = $result_representative->fetch_assoc()){
                                            $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
                                                unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                                                $desc = strtr(html_entity_decode($row_representative['detail']),$trans);
                                                $desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
                                            ?>
                                    <div class="card-body">
                                        <h5 class="staff-title">នាយក</h5>
                                        <div class="rowses"></div>
                                        <div class="control-profile row my-2">
                                            <div class="col-sm-4 staff-profile">
                                                <div class="bg-profile">
                                                    <?php
                                                        foreach (json_decode($row_representative["image"]) as $image) : ?>
                                                    <img src="../admin_dashboard_library/uploads/<?php echo $image; ?>">
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
                                                                    class="detail-staf mx-2"><?php echo $row_representative['firstname']. $row_representative['lastname']?></span>
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
                                                                <span class="detail-staf mx-2">ប្រុស</span>
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
                                                                    class="detail-staf mx-2"><?php echo $row_representative['email']?></span>
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
                                                                    class="detail-staf mx-2"><?php echo $row_representative['phone']?></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="conten-show-more">
                                            <div class="title-about-staf my-3">
                                                <span class="list-staf fw-bolder">អំពីរប្រធាន៖</span>
                                            </div>

                                            <div class="descript">
                                                <?php echo $desc;?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php
                                }
                                ?>




                            </div>
                            <div class="card my-2" style="width: 100%; border-color: orange;">

                                <div class="container">
                                    <div class="card-body">
                                        <h5 class="staff-title">សមាជិក</h5>
                                        <div class="rowses"></div>
                                        <div class="control-profile my-2">
                                            <?php
                                             $select_teacher ="SELECT member.id, member.member_id, member.firstname, member.lastname, member.email,  member.email, member.phone, member.select_major, member.specialty, member.select_role, member.image, member.detail,major_tb.major_title,major_tb.creationdate
                                             FROM member INNER JOIN major_tb ON member.select_major=major_tb.id  WHERE (major_title = 'បច្ចេកវិទ្យាមេកានិច') AND (select_role='គ្រូបង្រៀន')";
                                            // $select_teacher="SELECT teacher_tb.id, teacher_tb.teacher_id,teacher_tb.firstname,
                                            // teacher_tb.lastname,teacher_tb.teacher_mail,teacher_tb.phone,teacher_tb.select_major,
                                            // teacher_tb.specialty,teacher_tb.select_role,teacher_tb.image,teacher_tb.teacher_detials,
                                            // teacher_tb.teacher_status,major_tb.major_title FROM teacher_tb INNER JOIN major_tb ON teacher_tb.select_major = major_tb.id WHERE (major_title = 'បច្ចេកវិទ្យាមេកានិច') AND (select_role='គ្រូបង្រៀន')";
                                            $result_teacher = $conn->query($select_teacher);
                                            if($result_teacher->num_rows>0){
                                                while($row_teacher = $result_teacher->fetch_assoc()){
                                                    ?>
                                            <a href="view-teacher-staff-page.php?=<?php echo $row_teacher['id']?>"
                                                class="text-dark text-decoration-none">
                                                <div class="staff-profile">
                                                    <div class="bg-profile">
                                                        <?php
                                                        foreach (json_decode($row_teacher["image"]) as $image) : ?>
                                                        <img
                                                            src="../admin_dashboard_library/uploads/<?php echo $image; ?>">
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <div class="staff-name text-center mt-2">
                                                        <h6 class="staff-name"
                                                            style="font-family: 'Noto Serif Khmer', serif;">
                                                            <?php echo $row_teacher['firstname']. $row_teacher['lastname']?>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                            <?php
                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>

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