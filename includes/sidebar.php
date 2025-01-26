 <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
           
                    <a href="#" class="nav-link">
                        <div class="nav-profile-image">
                       
                                <img class="img-avatar" src="assets/img/avatars/avatar15.jpg" alt="">
                                
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
            <a class="nav-link" href="manage_event.php">
                <span class="menu-title">Manage Events</span>
                <i class="mdi mdi-steering menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="manage_service.php">
                <span class="menu-title">Manage Service</span>
                <i class="mdi mdi-subway menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Booking management</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-archive menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="new_bookings.php">New Bookings</a></li>
                    <li class="nav-item"> <a class="nav-link" href="approved_bookings.php">Approved Bookings</a></li>
                    <li class="nav-item"> <a class="nav-link" href="cancelled_bookings.php">Cancelled Bookings</a></li>
                </ul>
            </div>
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