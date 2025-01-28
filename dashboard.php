<?php
include('includes/auth.php');
check_login();
?>

<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php"); ?>

<body>

  <div class="container-scroller">

    <?php @include("includes/header.php"); ?>

    <div class="container-fluid page-body-wrapper">
      <div class="main-panel"><br>
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4 stretch-card grid-margin">
                  <div class="card bg-gradient-success card-img-holder text-white" style="height: 130px;">
                    <div class="card-body">
                      <h4 class="font-weight-normal mb-3">Total Events
                      </h4>
                      <?php
                      $sql = "SELECT id from event ";
                      $query = $pdo->prepare($sql);
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);
                      $totalEvents = $query->rowCount();
                      ?>
                      <h2 class="mb-5"><?php echo htmlentities($totalEvents); ?></h2>
                    </div>
                  </div>
                </div>

                <div class="col-md-4 stretch-card grid-margin">
                  <div class="card bg-gradient-info card-img-holder text-white" style="height: 130px;">
                    <div class="card-body">
                        <h4 class="font-weight-normal mb-3">Upcoming Events
                        </h4>
                        <?php
                        $sql = "SELECT id FROM event WHERE start_date >= CURDATE()";
                        $query = $pdo->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $upcomingEvents = $query->rowCount();
                        ?>
                        <h2 class="mb-5"><?php echo htmlentities($upcomingEvents); ?></h2>
                    </div>
                  </div>
                </div>
           
                <div class="col-md-4 stretch-card grid-margin">
                  <div class="card bg-gradient-warning card-img-holder text-white" style="height: 130px;">
                    <div class="card-body">
                      <h4 class="font-weight-normal mb-3">Total Booking
                      </h4>
                      <?php
                      $sql = "SELECT id from booking ";
                      $query = $pdo->prepare($sql);
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);
                      $totalBooking = $query->rowCount();
                      ?>
                      <h2 class="mb-5"><?php echo htmlentities($totalBooking); ?></h2>
                    </div>
                  </div>
               </div>
              </div>
            </div> 
          </div>
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="modal-header">
                <h3 class="modal-title" style="float: left;">Upcoming Events</h3>
              </div>

              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                  <thead>
                    <tr>
                     
                      <th>No.</th>
                      <th class="d-none d-sm-table-cell">Event</th>
                      <th class="d-none d-sm-table-cell">Venue</th>
                      <th class="d-none d-sm-table-cell">Capacity</th>
                      <th class="d-none d-sm-table-cell">Total Booking</th>
                      <th class="d-none d-sm-table-cell">Availability</th>
                      <th class="d-none d-sm-table-cell">Start Date & Time</th>
                      <th class="d-none d-sm-table-cell">End Date & Time</th>
                      <th class="d-none d-sm-table-cell">Status</th>

                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    $sql = "SELECT * FROM event WHERE start_date >= CURDATE() ORDER BY start_date ASC";
                    $query = $pdo->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                      foreach ($results as $event) { ?>
                      <tr>
                      <td class="text-center"><?php echo htmlentities($cnt); ?></td>
                      <td><?php echo htmlentities($event->event_name); ?> - <?php echo htmlentities($event->pincode); ?></td>
                            <td><?php echo htmlentities($event->venue); ?></td>
                            <td><?php echo htmlentities($event->capacity); ?></td>
                            <td><?php echo htmlentities($event->capacity - $event->availability); ?></td>
                            <td><?php echo htmlentities($event->availability); ?></td>
                            <td><?php echo htmlentities($event->start_date); ?>, <?php echo htmlentities($event->start_time); ?></td>
                            <td><?php echo htmlentities($event->end_date); ?>, <?php echo htmlentities($event->end_time); ?></td>
                      <td class="d-none d-sm-table-cell">
                        <span class="badge badge-info">Upcoming</span>
                      </td>
                      </tr>
                    <?php
                      $cnt = $cnt + 1;
                      }
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  
    </div>
  <?php @include("includes/footer.php"); ?>
  </div>

  </div>

  <?php @include("includes/foot.php"); ?>

</body>

</html>