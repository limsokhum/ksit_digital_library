<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <title>Digital library management system for Kampong spue Institute of Technology</title>

    <!-- Link Favicon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Link Favicon -->
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <!-- Link Custom style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Link Skitter CSS -->
    <link rel="stylesheet" href="assets/css/skitter.css">
    <!-- Skitter JS -->
    <script type="text/javascript" language="javascript" src="assets/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" language="javascript" src="assets/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" language="javascript" src="assets/css/jquery.skitter.min.js"></script>

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- Swiper -->
    <link rel="stylesheet" href="assets/js/package.json">
    <link rel="stylesheet" href="assets/js/sandbox.config.json">
    <link rel="stylesheet" href="assets/js/yarn.lock">
</head>

<body class="d-flex vw-100 vh-100 align-items-center justify-content-center" style="background-color: #336666;">
    <div class="container">
        <div class=" control-box row">
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="skitter-large-box">
                    <div class="skitter skitter-large rounded">
                        <ul>
                            <li><a href="#cube"><img src="assets/images/poster_1.png"
                                        class="cubeHide w-100 h-100" /></a>
                            </li>
                            <li><a href="#cubeRandom"><img src="assets/images/poster_2.png" class="cubeSize" /></a>
                            </li>
                            <li><a href="#block"><img src="assets/images/poster_1.png"
                                        class="cubeShow w-100 h-100" /></a>
                            </li>
                            <li><a href="#cube"><img src="assets/images/poster_2.png" class="cube w-100 h-100" /></a>
                            </li>
                            <li><a href="#cubeRandom"><img src="assets/images/poster_1.png"
                                        class="cube w-100 h-100" /></a>
                            </li>
                            <li><a href="#block"><img src="assets/images/poster_2.png" class="cube w-100 h-100" /></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6" style="background-color:;">
                <div class="card-body text-light">
                    <h4 class="contanct-title text-center">យើងខ្ញុំសូមអរគុណដែលអ្នកបានចុះឈ្មោះជាសមាជិក
                        "ប្រព័ន្ធគ្រប់គ្រងបណ្ណាល័យឌីជីថលវិទ្យាស្ថានបច្ចេកវិទ្យាកំពង់ស្ពឺ"</h4>
                    <dl>
                        <dt>បទបញ្ញាតិសម្រាប់អ្នកដែលបានចុះឈ្មោះរួចរាល់ ៖</dt>
                        <dd class="mt-1">-
                            អ្នកត្រូវរងចាំការអនុញ្ញាតិអំពីរគ្រូជំនួយការរបស់អ្នកដើម្បីឱ្យការចុះឈ្មោះរបស់អ្នកទទួលបានជោគជ័យ
                        </dd>
                        <dd>- អ្នកអាចបោះពុម្ភឯកសារ E-Book, E-Journal, E-Project របស់អ្នកលើប្រព័ន្ធបាន។</dd>
                    </dl>
                    <a href="index.php" class="text-decoration-none"> <button
                            class="btn btn-primary welcome-bnt">ទំព័រដើម <i
                                class="fa-solid fa-arrow-right"></i></button></a>

                    <!-- <div class="col-sm-12">
                        <div class="containct-contact-us float-end">
                            <div class="contanct-title">
                                Contact-us៖
                            </div>
                            <div class="email">
                                <i class="fa-solid fa-envelope fs-5" style="color: #336666;"></i><a href=""
                                    class="text-decoration-none mx-2 text-dark fw-bolder">info@ksit.edu.kh,
                                    bunhe@ksit.edu.kh</a>
                            </div>
                            <div class="phone d-flex">
                                <i class="fa-solid fa-phone-volume fs-5" style="color: #336666;"></i>
                                <p class="mx-2 fw-bolder">+855 97 222 0 829</p>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js">
    </script>
    <script>
    // Start Init Skitter
    $(document).ready(function() {
        $('.skitter-large').skitter({
            numbers: true,
            dots: false
        });
    });

    function NavBarFunction() {
        document.getElementById("navbar").style = "display: block";
        document.getElementById("menu_navbar").style = "display: none";
        document.getElementById("remove_navbar").style = "display: block";
    }

    function RemoveNavBarFunction() {
        document.getElementById("navbar").style = "display: none";
    }
    // Ent Init Skitter
    </script>

</body>

</html>