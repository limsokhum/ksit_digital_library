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
                    <h5>បច្ចេកវិទ្យាកុំព្យូទ័រ</h5>
                </div>
                <div class="rows"></div>
            </div>

            <div class="card" style="width: 100%;">
                <?php
                $select_department = "SELECT major_tb.id,major_tb.major_code, major_tb.image, major_tb.major_title, major_tb.select_department,major_tb.major_detials,major_tb.status,major_tb.creationdate,department_tb.department_title
                FROM major_tb INNER JOIN department_tb ON major_tb.select_department=department_tb.id WHERE major_title='បច្ចេកវិទ្យាកុំព្យូទ័រ'";
                $result_select_department = $conn->query($select_department);
                if($result_select_department->num_rows>0){
                    while($row_select_department= $result_select_department->fetch_assoc()){
                        ?>

                <div class="container row my-4">
                    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                        <div class="card mb-2" style="width: 100%;">
                            <div class="card-body detail-department">
                                <div class="detail-new" style="font-family: Hanuman !important;">
                                    <?php echo $row_select_department['major_detials'] ?>
                                </div>

                            </div>
                        </div>
                        <div id="myTable" class="card mb-2" style="width: 100%;">
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
                            `digitalbook_tb` WHERE select_major='បច្ចេកវិទ្យាកុំព្យូទ័រ'");
                            $total_records = mysqli_fetch_array($result_count);
                            $total_records = $total_records['total_records'];
                            $total_no_of_pages = ceil($total_records / $total_records_per_page);
                            $second_last = $total_no_of_pages - 1; // total page minus 1

                            $result = mysqli_query($conn,"SELECT * FROM `digitalbook_tb` WHERE select_major='បច្ចេកវិទ្យាកុំព្យូទ័រ' LIMIT $offset,
                            $total_records_per_page");
                            while($row = mysqli_fetch_array($result)){
                            ?>

                                <div class="card-body news-announcements">
                                    <div class="img-news">
                                        <?php
                    foreach (json_decode($row["image_one"]) as $image) : ?>
                                        <img src="../admin_dashboard_library/uploads/<?php echo $image; ?>">
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="detail-news">
                                        <h6 class="research-title"><span class="defult-title">ប្រធានបទ </span> ៖
                                            ​<?php echo $row['title']?></h6>

                                        <small class="research-title"><span class="defult-title">អ្នកស្រាវជ្រាវ </span>
                                            ៖
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
                    $string.='...<a class="text-danger fw-bolder" href="digital-page.php?id=' . $row['id'] . '">អានបន្ថែម</a>';

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
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">

                        <div class="card" style="width: 100%;">
                            <div class="card-body content-activities">
                                <div class="details-images">
                                    <?php
                                    foreach (json_decode($row_select_department["image"]) as $image) : ?>
                                    <img src="../admin_dashboard_library/uploads/<?php echo $image; ?>" width=200>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

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
                                <a class=' page-link'
                                    <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
                            </li>
                            <?php if($page_no < $total_no_of_pages){
		echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
		} ?>
                        </ul>
                    </nav>
                </div>
                <?php
                    }
                }
                ?>

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