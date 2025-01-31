<div id="page">
</div>
<div class="bg-white topbar">
  <div class="row">
    <div class="col-md-12 ">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo " href="dashboard.php"><img class="img-avatar" style="height: 60px; width: auto;" src="assets/images/logo.svg" alt=""></a>
      </div>
      <h5 class="text-center">Event Management System</h5>
    </div>
  </div>
  <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 d-flex flex-row">
    <div class="navbar-menu-wrapper d-flex align-items-stretch w-100">
      <ul class="navbar-nav navbar-nav-left">
        <li class="nav-item dropdown">
          <a class="nav-link" href="dashboard.php">Dashboard</a>
        </li>
        <?php if (check_permission('event_management')) { ?>
        <li class="nav-item dropdown">
          <a class="nav-link" href="manageEvent.php">Manage Events</a>
        </li>
        <?php } ?>
        <?php if (check_permission('attendee_reg')) { ?>
        <li class="nav-item dropdown">
          <a class="nav-link" href="attendeeReg.php">Attendee Registration</a>
        </li>
        <?php } ?>
        <?php if (check_permission('reports')) { ?>
        <li class="nav-item dropdown">
          <a class="nav-link" href="report.php">Reports</a>
        </li>
        <?php } ?>
        <?php if (check_permission('management user')) { ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User management</a>
            <div class="dropdown-menu  navbar-dropdown" aria-labelledby="dropdown05">
              <?php if (check_permission('user_management')) { ?>
              <a class="dropdown-item" href="user.php">Manage users</a>
              <?php } ?>
              <?php if (check_permission('role_management')) { ?>
              <a class="dropdown-item" href="role.php">Manage Roles </a>
              <?php } ?>
              <?php if (check_permission('permission_management')) { ?>
              <a class="dropdown-item" href="permission.php">Manage Permissions</a>
              <?php } ?>
            </div>
        </li>
        <?php } ?>
      </ul>
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-profile dropdown">
          <?php
          $id = $_SESSION['id'];
          $sql = "SELECT * from user where id=:id";
          $query = $pdo->prepare($sql);
          $query->bindParam(':id', $id, PDO::PARAM_STR);
          $query->execute();
          if ($query->rowCount() > 0) {
            $results = $query->fetchAll(PDO::FETCH_OBJ);

            foreach ($results as $row) {
          ?>
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                </div>
                <div class="nav-profile-text ">
                  <p class="mb-1 text-light"><?php echo $row->firstName; ?> <?php echo $row->lastName; ?></p>
                </div>
              </a>
          <?php
            }
          } ?>

          <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
          <?php if (check_permission('profile_edit')) { ?>
            <a class="dropdown-item" href="profile.php">
              <i class="mdi mdi-account mr-2 text-success"></i> Profile </a>

            <div class="dropdown-divider"></div>
            <?php } ?>
            <?php if (check_permission('change_password')) { ?>
            <a class="dropdown-item" href="changePassword.php"><i class="mdi mdi-key mr-2 text-success"></i> Change Password </a>
            <div class="dropdown-divider"></div>
            <?php } ?>
            <a class="dropdown-item" href="logout.php">
              <i class="mdi mdi-logout mr-2 text-danger"></i> Signout </a>
          </div>
        </li>
      </ul>

    </div>
  </nav>


  <script>
    $(window).scroll(function() {
      console.log($(window).scrollTop())
      if ($(window).scrollTop() > 63) {
        $('.navbar').addClass('navbar-fixed');
      }
      if ($(window).scrollTop() < 64) {
        $('.navbar').removeClass('navbar-fixed');
      }
    });
  </script>
  <style>
    .navbar-fixed {
      top: 0;
      z-index: 100;
      position: fixed;
      width: 100%;
    }
  </style>