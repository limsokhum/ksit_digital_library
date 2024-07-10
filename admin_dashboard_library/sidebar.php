 <!-- Sidebar -->
 <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #336666;">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
         <img src="img/logo-ksit.png" alt="" style="width: 100%;">
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
         <a class="nav-link" href="index.php">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Interface
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
             aria-controls="collapseTwo">
             <i class="fas fa-fw fa-folder"></i>
             <span>Researchers</span>
         </a>
         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">e-Researchers:</h6>
                 <a class="collapse-item" href="e-books.php"><i class="fa-solid fa-minus mx-2"
                         style="color: grey; font-size: 0.5rem;"></i>e-Books</a>
                 <a class="collapse-item" href="e-project.php"><i class="fa-solid fa-minus mx-2"
                         style="color: grey; font-size: 0.5rem;"></i>e-Projects</a>
                 <a class="collapse-item" href="e-journal.php"><i class="fa-solid fa-minus mx-2"
                         style="color: grey; font-size: 0.5rem;"></i>e-Journals</a>
             </div>
         </div>
     </li>

     <!-- Nav Item - Utilities Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
             aria-expanded="true" aria-controls="collapseUtilities">
             <i class="fas fa-fw fa-user"></i>
             <span>Control People</span>
         </a>
         <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Control People</h6>
                 <!-- <a class="collapse-item" href="list_admin.php"><i class="fa-solid fa-minus mx-2"
                         style="color: grey; font-size: 0.5rem;"></i>Admin</a> -->
                 <a class="collapse-item" href="list-representative.php"><i class="fa-solid fa-minus mx-2"
                         style="color: grey; font-size: 0.5rem;"></i>List Representative</a>
                 <a class="collapse-item" href="list-teacher.php"><i class="fa-solid fa-minus mx-2"
                         style="color: grey; font-size: 0.5rem;"></i>Teachers</a>
                 <a class="collapse-item" href="list_staff.php"><i class="fa-solid fa-minus mx-2"
                         style="color: grey; font-size: 0.5rem;"></i>Staff</a>
                 <a class="collapse-item" href="list_user.php"><i class="fa-solid fa-minus mx-2"
                         style="color: grey; font-size: 0.5rem;"></i>User</a>
             </div>
         </div>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Addons
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
             aria-controls="collapsePages">
             <i class="fas fa-fw fa-list"></i>
             <span>Department</span>
         </a>
         <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Custom Department:</h6>
                 <a class="collapse-item" href="list-department.php"><i class="fa-solid fa-minus mx-2"
                         style="color: grey; font-size: 0.5rem;"></i>List Department</a>
                 <a class="collapse-item" href="list-major.php"><i class="fa-solid fa-minus mx-2"
                         style="color: grey; font-size: 0.5rem;"></i>List Major</a>
             </div>
         </div>
     </li>

     <!-- Nav Item - Charts -->

     <!-- <li class="nav-item">
         <a class="nav-link" href="list-teacher.php">
             <i class="fas fa-fw fa-user"></i>
             <span>School Management</span></a>
     </li> -->

     <!-- Nav Item - Tables -->
     <li class="nav-item">
         <a class="nav-link" href="tables.php">
             <i class="fas fa-fw fa-cog"></i>
             <span>Setting</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
 <!-- End of Sidebar -->