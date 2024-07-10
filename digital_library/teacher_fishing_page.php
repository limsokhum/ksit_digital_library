<?php
include ('../config/conn_db.php');
?>
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
                    <h5>វិទ្យាសាស្រ្តជលផល</h5>
                </div>
                <div class="rows"></div>
            </div>

            <div class="card" style="width: 100%;">

                <div class="container row my-4">
                    <div class="col-sm-8">
                        <div class="container">

                            <?php
                             $select_represiontative ="SELECT member.id, member.member_id, member.firstname, member.lastname, member.email,  member.email, member.phone, member.select_major, member.specialty, member.select_role, member.image, member.detail,major_tb.major_title,major_tb.creationdate
                             FROM member INNER JOIN major_tb ON member.select_major=major_tb.id  WHERE (major_title = 'វិទ្យាសាស្រ្តជលផល') AND (select_role='បុគ្គលិកដំណាងដេប៉ាតឺម៉ង់')";
                            // $select_represiontative = "SELECT teacher_tb.id, teacher_tb.teacher_id,teacher_tb.firstname,
                            // teacher_tb.lastname,teacher_tb.teacher_mail,teacher_tb.phone,teacher_tb.select_major,
                            // teacher_tb.specialty,teacher_tb.select_role,teacher_tb.image,teacher_tb.teacher_detials,
                            // teacher_tb.teacher_status,major_tb.major_title FROM teacher_tb INNER JOIN major_tb ON teacher_tb.select_major = major_tb.id WHERE (major_title = 'វិទ្យាសាស្រ្តជលផល') AND (select_role='បុគ្គលិកដំណាងដេប៉ាតឺម៉ង់')";
                            $result_select_represiotative = $conn->query($select_represiontative);
                            if($result_select_represiotative->num_rows>0){
                                while($row_select_represiontative = $result_select_represiotative->fetch_assoc()){
                                    ?>
                            <div class="card my-2" style="width: 100%; border-color: orange;">
                                <a
                                    href="view-teacher-repre-fisheries.php?id=<?php echo $row_select_represiontative['id']?>">
                                    <div class="container">
                                        <div class="card-body">
                                            <h5 class="staff-title">ប្រធាន</h5>
                                            <div class="rowses"></div>
                                            <div class="control-profile row my-2">
                                                <div class="col-sm-4 staff-profile">
                                                    <div class="bg-profile">
                                                        <?php
                                                        foreach (json_decode($row_select_represiontative["image"]) as $image) : ?>
                                                        <img
                                                            src="../admin_dashboard_library/uploads/<?php echo $image; ?>">
                                                        <?php endforeach; ?>

                                                    </div>
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
                                                                        class="detail-staf mx-2"><?php echo $row_select_represiontative['firstname']?>
                                                                        <?php echo $row_select_represiontative['lastname']?></span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <span class="list-staf fw-bolder">អត្ថលេខ</span>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <span class="text-warning fw-bolder"> :*</span>
                                                                    <span
                                                                        class="detail-staf mx-2"><?php echo $row_select_represiontative['member_id']?></span>
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
                                                                        class="detail-staf mx-2"><?php echo $row_select_represiontative['email']?></span>
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
                                                                        class="detail-staf mx-2"><?php echo $row_select_represiontative['phone']?></span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>


                            </div>
                            <?php
                                }
                            }
                            ?>

                            <div class="card my-2" style="width: 100%; border-color: orange;">

                                <div class="container">
                                    <div class="card-body">
                                        <h5 class="staff-title">សមាជិក</h5>
                                        <div class="rowses"></div>
                                        <div class="control-profile my-2">
                                            <?php
                                            $select_teacher_staff ="SELECT member.id, member.member_id, member.firstname, member.lastname, member.email,  member.email, member.phone, member.select_major, member.specialty, member.select_role, member.image, member.detail,major_tb.major_title,major_tb.creationdate
                                            FROM member INNER JOIN major_tb ON member.select_major=major_tb.id  WHERE (major_title = 'វិទ្យាសាស្រ្តជលផល') AND (select_role='គ្រូបង្រៀន')";
                                            // $select_teacher_staff = "SELECT teacher_tb.id, teacher_tb.teacher_id,teacher_tb.firstname,
                                            // teacher_tb.lastname,teacher_tb.teacher_mail,teacher_tb.phone,teacher_tb.select_major,
                                            // teacher_tb.specialty,teacher_tb.select_role,teacher_tb.image,teacher_tb.teacher_detials,
                                            // teacher_tb.teacher_status,major_tb.major_title FROM teacher_tb INNER JOIN major_tb ON teacher_tb.select_major = major_tb.id WHERE (major_title = 'វិទ្យាសាស្រ្តជលផល') AND (select_role='គ្រូបង្រៀន')";
                                            $result_teacher_staff = $conn->query($select_teacher_staff);
                                            if($result_teacher_staff->num_rows>0){
                                                while($row_teacher_staff = $result_teacher_staff->fetch_assoc()){
                                                    ?>
                                            <div class="staff-profile">
                                                <div class="bg-profile">
                                                    <?php
                                                        foreach (json_decode($row_teacher_staff["image"]) as $image) : ?>
                                                    <img src="../admin_dashboard_library/uploads/<?php echo $image; ?>">
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="staff-name text-center mt-2">
                                                    <h6 class="staff-name list-staf mt-3">
                                                        <?php echo $row_teacher_staff['firstname']?>
                                                        <?php echo $row_teacher_staff['lastname']?>
                                                    </h6>
                                                </div>
                                            </div>
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
                        <?php include('includes/teacher_department.php');?>
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
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop >
            20) {
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