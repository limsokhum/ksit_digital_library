 <!-- Sidebar -->
 <ul class="navbar-nav rounded bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index-teacher.php">
         <img src="img/logo-ksit.png" alt="" style="width: 100%;">
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
         <a class="nav-link" href="index-teacher.php">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
             aria-controls="collapseTwo">
             <i class="fas fa-fw fa-folder"></i>
             <span>Researchers</span>
         </a>
         <!-- <a class="nav-link collapsed" href="#">
             <i class="fas fa-fw fa-folder"></i>
             <span>Researchers</span>
         </a> -->
         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="py-2 collapse-inner rounded" style="background-color: white;">
                 <h6 class="collapse-header">e-researchers:</h6>
                 <a class="collapse-item" href="list-teacher-digital-ebook.php"><i class="fa-solid fa-minus mx-2"
                         style=" font-size: 0.5rem;"></i>e-Books</a>
                 <a class="collapse-item" href="list-teacher-digital-eproject.php"><i class="fa-solid fa-minus mx-2"
                         style=" font-size: 0.5rem;"></i>e-Projects</a>
                 <a class="collapse-item" href="list-teacher-digital-ejournal.php"><i class="fa-solid fa-minus mx-2"
                         style=" font-size: 0.5rem;"></i>e-Journals</a>
             </div>
         </div>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
             aria-expanded="true" aria-controls="collapseUtilities">
             <i class="fas fa-fw fa-user"></i>
             <span>Department/Major</span>
         </a>
         <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Department/Major</h6>
                 <a class="collapse-item" href="list-department-teacher.php"><i class="fa-solid fa-minus mx-2"
                         style="color: grey; font-size: 0.5rem;"></i>Department</a>
                 <a class="collapse-item" href="list-major-teacher.php"><i class="fa-solid fa-minus mx-2"
                         style="color: grey; font-size: 0.5rem;"></i>Major</a>
             </div>
         </div>

     </li>

     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         contage
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
             aria-controls="collapsePages">
             <i class="fas fa-fw fa-list"></i>
             <span>Email</span>
         </a>
         <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Contage Email:</h6>
                 <a class="collapse-item" href="list-major-teacher.php"><i class="fa-solid fa-minus mx-2"
                         style="color: grey; font-size: 0.5rem;"></i>Email</a>
             </div>
         </div>
     </li>

     <!-- Divider -->
     <!-- <hr class="sidebar-divider d-none d-md-block"> -->

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
 <!-- End of Sidebar -->