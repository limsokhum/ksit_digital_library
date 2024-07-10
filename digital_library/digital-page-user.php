<?php
require_once('controllerUserData.php');

$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM member WHERE ((select_role='អ្នកប្រើប្រាស់') AND (email = '$email'))";
    $run_Sql = mysqli_query($conn, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status']; 
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: index.php');
        }
    }
}else{
    header('Location: index.php');
}
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <!-- Google Font Family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Default Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <!-- Custom Search Button Function -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable .card-body").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);

            });

        });

    });
    </script>

    <title>Digital library management system for Kampong spue Institute of Technology</title>
</head>

<body style="background-color: #dedede;">

    <!-- Scroll to Top -->
    <div onclick="topFunction()" id="myBtn"><i class="fa-solid fa-circle-chevron-up"
            style="color: orange; font-size: 1.4rem;"></i></div>

    <!-- Start Section Top Bar -->
    <?php include('includes/user-topbar.php');?>
    <!-- Ent Section Top Bar -->

    <!-- Start Navigation Bar -->
    <?php include('includes/navbar-user.php');?>
    <!-- Ent Navigation Bar -->

    <?php
    if(isset($_GET['id'])){
        $digital_page_id = $_GET['id'];
        $query_digital = "SELECT * FROM digitalbook_tb WHERE id = $digital_page_id";
        $result_digital = $conn->query($query_digital);
        if($result_digital->num_rows>0){
            while($row_digital = $result_digital->fetch_assoc()){
                $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
                                                unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                                                $desc = strtr(html_entity_decode($row_digital['abstract']),$trans);
                                                $desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
                ?>
    <!-- Start All Section Start Content -->
    <div class="container">
        <!-- Start Content Computer -->
        <div class="section-computer mt-2">

            <div class="title d-flex">
                <div class="computer">
                    <h5><?php echo $row_digital['select_major']?>/<span style="color: white;">
                            <?php if($row_digital['digital_book']=='e-book'){
                                echo "E-Book";
                            }elseif($row_digital['digital_book']=='e-journal'){
                                echo "E-Journal";
                            }elseif($row_digital['digital_book']=='e-project'){
                                echo "E-Project";
                            }
                                ?></span>
                    </h5>

                </div>
                <div class="rows"></div>
            </div>

            <!-- Start view image -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #dedede;">

                            <button type="button" class="btn-close bg-light" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex align-items-center justify-content-center"
                            style="background-color: #dedede;">
                            <?php foreach (json_decode($row_digital["image_one"]) as $image) : ?>
                            <img src="../admin_dashboard_library/uploads/<?php echo $image; ?>" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End view imag -->



            <div class="card" style="width: 100%;">

                <div class="container row my-4">
                    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                        <div class="card mb-2" style="width: 100%;">
                            <div class="card-body detail-department">
                                <div class="img-cover">
                                    <?php foreach (json_decode($row_digital["image_one"]) as $image) : ?>
                                    <img src="../admin_dashboard_library/uploads/<?php echo $image; ?>"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <?php endforeach; ?>
                                </div>
                                <div class="detail-news my-3">
                                    <h6 class="research-title">
                                        <span style="color: #336666;">ប្រធានបទ</span> ៖
                                        <?php echo $row_digital['title']?>
                                    </h6>
                                    <small class="research-title">
                                        <span style="color: #336666;">អ្នកស្រាវជ្រាវ</span> ៖
                                        <?php echo $row_digital['name_auther']?>
                                    </small>
                                    <small class="research-title">
                                        <span style="color: #336666;">, ប្រភេទសៀវភៅ</span> ៖
                                        <?php echo $row_digital['digital_book']?>
                                    </small>
                                    <small class="research-title">
                                        <span style="color: #336666;">, View</span> =
                                        <?php echo $row_digital['view']?>
                                    </small>
                                    <small class="research-title">
                                        <span style="color: #336666;">, Download</span> =
                                        <?php echo $row_digital['downloads']?>
                                    </small>

                                    <div class="d-flex">
                                        <div class="button-download my-3">
                                            <a href="view-file.php?id=<?php echo $row_digital['id']?>" target="_blank"
                                                class="btn btn-success"><i class="fa-solid fa-eye"></i> មើល</a>
                                        </div>
                                        <div class="button-download my-3 mx-3">
                                            <a href="download-file.php?id=<?php echo $row_digital['id']?>"
                                                class="btn btn-success"><i class="fa-solid fa-download"></i> ទាញយក</a>
                                        </div>
                                    </div>


                                    <div class="description" style="text-align: justify; line-height: 1.7;">
                                        <p><?php echo $desc;?></p>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">

                        <div class="card" style="width: 100%;">
                            <div class="card-body content-activities">
                                <div class="details-images">
                                    <?php foreach (json_decode($row_digital["image_two"]) as $image) : ?>
                                    <img src="../admin_dashboard_library/uploads/<?php echo $image; ?>">
                                    <?php endforeach; ?>
                                </div>
                                <?php
                                    $select_digital_book = "SELECT * FROM digitalbook_tb WHERE status=1";
                                    $query_digital_book = $conn->query($select_digital_book);
                                    if($query_digital_book -> num_rows>0){
                                        while($row_digital_book = $query_digital_book->fetch_assoc()){
                                            ?>
                                <div class="card-body  my-3 news-announcementses">

                                    <div class="detail-newseses">
                                        <h6 class="research-title"><span class="defult-title">ប្រធានបទ </span> ៖
                                            <?php echo $row_digital_book['title']?></h6>

                                        <!-- <small class="research-title"><span class="defult-title">អ្នកស្រាវជ្រាវ </span>
                                            ៖
                                            <?php echo $row_digital_book['name_auther']?> <span class="defult-title">,
                                                ប្រភេទសៀវភៅ
                                            </span> ៖
                                            <?php echo $row_digital_book['digital_book']?> <span class="defult-title">,
                                                បោះពុម្ភ
                                            </span> ៖
                                            <?php echo $row_digital_book['date']?>
                                        </small> -->
                                        <div class="research-text">
                                            <small class="research-text">
                                                <p class="research-text"><?php
                    
                    $content=$row_digital_book['abstract'];
                    $string= strip_tags($content);
                    if(strlen($string) >600):
                    $stringCut= substr($string,0,600);
                    $endPoint=strrpos($stringCut,' ');
                    $string= $endPoint?substr($stringCut,0,$endPoint): substr($stringCut,0);
                    $string.='...<a class="text-danger fw-bolder" href="digital-page.php?id=' . $row_digital_book['id'] . '">អានបន្ថែម</a>';
                    endif;
                    echo $string;
                    
                    ?></p>
                                            </small>
                                        </div>

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

    </div>
    <!-- Ent Content Computer -->

    </div>
    <!-- Ent All Section Start Content -->
    <?php
            }
        }
    }
    ?>






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