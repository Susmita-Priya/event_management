 <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">
         <li class="nav-item nav-profile">
             <a href="#" class="nav-link">
                 <div class="nav-profile-image">
                     <img class="img-avatar" src="assets/images/logo.svg" alt="">
                 </div>
                 <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="dashboard.php">
                 <span class="menu-title">Dashboard</span>
                 <i class="mdi mdi-home menu-icon"></i>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="manageEvent.php">
                 <span class="menu-title">Manage Events</span>
                 <i class="mdi mdi-steering menu-icon"></i>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="attendeeReg.php">
                 <span class="menu-title">Attendee Registration</span>
                 <i class="mdi mdi-account-plus menu-icon"></i>
             </a>
         </li>

         <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#companymanagement" aria-expanded="false" aria-controls="general-pages">
                 <span class="menu-title">Company management</span>
                 <i class="menu-arrow"></i>
                 <i class="mdi mdi-bank menu-icon"></i>
             </a>
             <div class="collapse" id="companymanagement">

                 <ul class="nav flex-column sub-menu">
                     <li class="nav-item"> <a class="nav-link" href="companyprofile.php">Company profile </a></li>
                 </ul>
             </div>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="ui-basic">
                 <span class="menu-title">Reports</span>
                 <i class="menu-arrow"></i>
                 <i class="mdi mdi-database menu-icon"></i>
             </a>
             <div class="collapse" id="reports">
                 <ul class="nav flex-column sub-menu">
                     <li class="nav-item"> <a class="nav-link" href="booking_report.php">Booking reports</a></li>
                     <li class="nav-item"> <a class="nav-link" href="btndates_report.php">Btndates Reports</a></li>
                 </ul>
             </div>
         </li>
     </ul>
 </nav>

 