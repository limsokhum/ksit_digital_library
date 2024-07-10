<?php
$query_user_prifile="SELECT * FROM member WHERE ((select_role='អ្នកប្រើប្រាស់') AND (email = '$email'))";
// WHERE email = '$email'
$result_user_profile = $conn->query($query_user_prifile);
if($result_user_profile ->num_rows>0){
    while($row_user_profile = $result_user_profile->fetch_assoc()){
        ?><div class="container-fluid  shadow" style="background-color: grey;">
    <div class="container">
        <nav class="navbar navbar-expand-lg ">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fa-solid fa-bars text-light"></i>
            </button>
            <div class="nav-bar collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index-user.php">ទំព័រដើម</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            ឯកសារស្រាវជ្រាវ
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: grey;">
                            <li><a class="dropdown-item" href="ebook-user-page.php">E-Book</a></li>
                            <li><a class="dropdown-item" href="eproject-user-page.php">E-Project</a></li>
                            <li><a class="dropdown-item" href="ejournal-user-page.php">E-Journal</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user-teacher-plant.php">បុគ្គលិកបង្រៀន</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user-admin-page.php">គណៈគ្រប់គ្រង</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            ដេប៉ាតឺម៉ង់
                        </a>
                        <ul class="dropdown-menu mt-" aria-labelledby="navbarDropdown" style="background-color: grey;">
                            <li><a class="dropdown-item" href="user-deparment-plant.php">វិទ្យាសាស្ដ្រដំណាំ</a>
                            </li>
                            <li><a class="dropdown-item" href="user-department-animal.php">វិទ្យាសាស្រសត្វ</a></li>
                            <li><a class="dropdown-item" href="user-department-fishing.php">វិទ្យាសាស្រ្តជលផល</a></li>
                            <li><a class="dropdown-item" href="user-deparment-business.php">កុំព្យូទ័រធុរកិច្ច</a></li>
                            <li><a class="dropdown-item" href="user-department-computer.php">បច្ចេកវិទ្យាកុំព្យូទ័រ</a>
                            </li>
                            <li><a class="dropdown-item" href="user-department-foot.php">បច្ចេកវិទ្យាអាហារ</a></li>
                            <li><a class="dropdown-item" href="#">បច្ចេកវិទ្យាមេកានិច</a></li>
                            <li><a class="dropdown-item" href="#">បច្ចេកទេសវិជ្ជាជីវៈកម្រិត៣
                                    "បសុវប្បកម្ម"</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <!-- <li class="nav-item user-profile">
                        <img src="https://z-p3-scontent.fpnh5-5.fna.fbcdn.net/v/t39.30808-6/419924472_340841872236454_8869775567620289744_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=efb6e6&_nc_eui2=AeFRHTMjLdG5N4rtxuVUG6iejOJ78cTv_dSM4nvxxO_91AGGvTu-_iI4gGcoyHpdCsLEmQFlI_3S0i710aObp487&_nc_ohc=TQ3wGgqZkAEAX9PrGwR&_nc_zt=23&_nc_ht=z-p3-scontent.fpnh5-5.fna&oh=00_AfDJ4Ja9Bx24HFdwkHCPdKg1j3PRm1sbhcpUYu201p2G5g&oe=65AE3698"
                            alt="">
                    </li> -->
                    <li class="nav-item dropdown">
                        <?php
                        if($row_user_profile['image']==NULL){?>

                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false" href="#"><img src="assets/images/user-profile.png" alt=""
                                style="width: 3rem; height: 3rem; border-radius: 50%;"></a>


                        <?php
                    }elseif($row_user_profile['image']==TRUE){
                    foreach (json_decode($row_user_profile["image"]) as $image) : ?>
                        <img class="img-profile dropdown-toggle shadow" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            src="../admin_dashboard_library/uploads/<?php echo $image; ?>">
                        <?php endforeach;
                        }
                         ?>
                        <ul class="dropdown-menu mt-" aria-labelledby="navbarDropdown" style="background-color: grey;">
                            <li><a data-bs-toggle="modal" data-bs-target="#exampleModal" class="dropdown-item"
                                    href="user-deparment-plant.php">ប្ដូប្រូហ្វាល</a>
                            </li>
                            <li><a class="dropdown-item" href="logout.php">ចាកចេញ</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<?php
    }
}
?>