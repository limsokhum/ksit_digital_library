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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <!-- Google Font Family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@100;300;400;700;900&display=swap"
        rel="stylesheet">

    <!-- Default Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <!-- Custom Search Button Function -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
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
    <style>
    .swiper {
        width: 100%;
        height: 50%;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        width: 20rem;
        height: 24rem;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    </style>
    <title>Digital library management system for Kampong spue Institute of Technology</title>
</head>

<body style="background-color: #dedede;">
    <!-- Scroll to Top -->
    <div onclick="topFunction()" id="myBtn"><i class="fa-solid fa-circle-chevron-up"
            style="color: orange; font-size: 1.4rem;"></i></div>
    <!-- Start Section Top Bar -->
    <?php include('includes/topbar.php');?>
    <!-- Ent Section Top Bar -->

    <!-- Start Navigation Bar -->
    <?php include('includes/navbar.php');?>

    <!-- Ent Navigation Bar -->

    <!-- Start All Section Start Content -->
    <div class="container">
        <!-- Start Slide Show -->
        <div class="card mt-2" style="width: 100%; box-shadow: 0 6px 15px grey; outline:#242424;">
            <div class="row container-header">
                <div class="col-sm-6"
                    style="background-image: url('assets/images/banner-journal.png'); border-radius: 4px;">
                    <div class="card-body">
                        <p class="contanct-text text-light">សិក្សាបានគ្រប់ពេលវេលា និងគ្រប់ទីកន្លែង</p>
                        <h3 class="contanct-title">សូមស្វាគមន៍មកកាន់
                            ប្រព័ន្ធគ្រប់គ្រងបណ្ណាល័យឌីជីថលសម្រាប់វិទ្យាស្ថានបច្ចេកវិទ្យាកំពង់ស្ពឺ</h3>
                        <dl class="text-light">
                            <dt>និស្សិត និងអ្នកស្រាវជ្រាវទូទៅ ៖</dt>
                            <dd class="mt-1">- អាចធ្វើការស្វែងរកឯកសារឌីជីថលដូចជា E-Book, E-Project, E-Journal ដោយអាច
                                filter តាម metadata មួយចំនួនដូចជា ឆ្នាំបោះពុម្ភ ឈ្មោះអ្នកនិពន្ធ ចំណងជើង ប្រភេទអត្ថបទ
                                និងពាក្យគន្លឹះបាន។</dd>
                            <dd>- អាចទាញយកឯកសារ។</dd>
                        </dl>

                        <div class="col-sm-12">
                            <div class="containct-contact-us float-end">
                                <div class="contanct-title">
                                    Contact-us៖
                                </div>
                                <div class="email">
                                    <i class="fa-solid fa-envelope fs-5" style="color: #336666;"></i><a href=""
                                        class="text-decoration-none mx-2 text-light fw-bolder">info@ksit.edu.kh,
                                        bunhe@ksit.edu.kh</a>
                                </div>
                                <div class="phone d-flex">
                                    <i class="fa-solid fa-phone-volume fs-5" style="color: #336666;"></i>
                                    <p class="mx-2 fw-bolder text-light">+855 97 222 0 829</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 d-flex justify-content-center align-items-center banner-ebook">
                    <div class="section-right-coner">

                        <!-- Swiper -->
                        <div class="swiper mySwiper mt-3">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="assets/images/cover_book_01.png" alt=""
                                        style="width: 100%; height: 100%;">
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/images/cover_book_01.png" alt=""
                                        style="width: 100%; height: 100%;">
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/images/cover_book_01.png" alt=""
                                        style="width: 100%; height: 100%;">
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/images/cover_book_01.png" alt=""
                                        style="width: 100%; height: 100%;">
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/images/cover_book_01.png" alt=""
                                        style="width: 100%; height: 100%;">
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/images/cover_book_01.png" alt=""
                                        style="width: 100%; height: 100%;">
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/images/cover_book_01.png" alt=""
                                        style="width: 100%; height: 100%;">
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/images/cover_book_01.png" alt=""
                                        style="width: 100%; height: 100%;">
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/images/cover_book_01.png" alt=""
                                        style="width: 100%; height: 100%;">
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>

                        <img class="mt-3" src="assets/images/table.png" style="width: 100%;">

                    </div>
                </div>
            </div>
        </div>
        <!-- End slide Show -->

        <!-- Start Content Computer -->
        <div class="section-computer my-2">

            <div class="title d-flex">
                <div class="computer">
                    <h5>កម្រងអត្ថបទ</h5>
                </div>
                <div class="rows"></div>
            </div>

            <div class="card" style="width: 100%;">

                <div class="container row my-4">
                    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                        <div id="myTable" class="card mb-2" style="width: 100%;">
                            <?php
                            if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                            $page_no = $_GET['page_no'];
                            } else {
                            $page_no = 1;
                            }

                            $total_records_per_page = 3;
                            $offset = ($page_no-1) * $total_records_per_page;

                            $previous_page = $page_no - 1;
                            $next_page = $page_no + 1;
                            $adjacents = "2";

                            $result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM
                            `digitalbook_tb` WHERE status=1");
                            $total_records = mysqli_fetch_array($result_count);
                            $total_records = $total_records['total_records'];
                            $total_no_of_pages = ceil($total_records / $total_records_per_page);
                            $second_last = $total_no_of_pages - 1; // total page minus 1

                            $result = mysqli_query($conn,"SELECT * FROM `digitalbook_tb` WHERE status=1 && digital_book='e-project' LIMIT $offset,
                            $total_records_per_page");
                            while($row = mysqli_fetch_array($result)){
                            ?>

                            <div class="card-body news-announcements">
                                <div class="img-news">
                                    <?php
                                    if($row["image_one"]==''){
                                        ?>
                                    <img src="" alt="Null Cover E-Project">
                                    <?php
                                    }else{
                                        foreach (json_decode($row["image_one"]) as $image) : ?>
                                    <img src="../admin_dashboard_library/uploads/<?php echo $image; ?>">
                                    <?php endforeach;
                                    }
                     ?>
                                </div>
                                <div class="detail-news">
                                    <h6 class="research-title"><span class="defult-title">ប្រធានបទ </span> ៖
                                        ​<?php echo $row['title']?></h6>

                                    <small class="research-title"><span class="defult-title">អ្នកស្រាវជ្រាវ </span> ៖
                                        <?php echo $row['name_auther']?> <span class="defult-title">, ប្រភេទសៀវភៅ
                                        </span> ៖
                                        <?php echo $row['digital_book']?> <span class="defult-title">, បោះពុម្ភ
                                        </span> ៖
                                        <?php echo $row['date']?>
                                    </small>
                                    <p class="research-text"><?php
                    
                    $content=$row['abstract'];
                    $string= strip_tags($content);
                    if(strlen($string) >600):
                    $stringCut= substr($string,0,600);
                    $endPoint=strrpos($stringCut,' ');
                    $string= $endPoint?substr($stringCut,0,$endPoint): substr($stringCut,0);
                    $string .= '...<a class="text-danger fw-bolder" href="digital-page.php?id=' . $row['id'] . '">អានបន្ថែម</a>';
                    endif;
                    echo $string;
                    
                    ?></p>
                                </div>
                            </div>

                            <?php
                        }
                        mysqli_close($conn);
                        ?>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                        <?php include('includes/department.php');?>
                    </div>
                    <div style="color: #336666; font-family: 'Noto Serif Khmer', serif;">
                        <small>ទំព័រទី <?php echo $page_no." សរុប ".$total_no_of_pages; ?></small>
                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>

                            <li <?php if($page_no <= 1){ echo "class='disabled page-item'"; } ?>>
                                <a class="page-link "
                                    <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
                            </li>

                            <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
				}else{
           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
				}else{
           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li class='page-item'><a class='page-link'>...</a></li>";
		echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
		echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
		echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
        echo "<li class='page-item'><a class='page-link'>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
				}else{
           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li class='page-item'><a class='page-link'>...</a></li>";
	   echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
	   echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
		echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
        echo "<li class='page-item'><a class='page-link'>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='page-item active'><a>$counter</a></li>";	
				}else{
           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>

                            <li <?php if($page_no >= $total_no_of_pages){ echo "class='page-item disabled'"; } ?>>
                                <a class='page-link'
                                    <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
                            </li>
                            <?php if($page_no < $total_no_of_pages){
		echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
		} ?>
                        </ul>
                    </nav>
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

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 7,
        freeMode: true,
        autoplay: {
            delay: 2000,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        // setTimeout(Swiper, 2000);
    });
    // setTimeout(swiper - slide, 2000);
    </script>

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