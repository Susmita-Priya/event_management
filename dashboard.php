<?php
include('includes/checklogin.php');
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
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6 stretch-card grid-margin">
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
           
                <div class="col-md-6 stretch-card grid-margin">
                  <div class="card bg-gradient-info card-img-holder text-white" style="height: 130px;">
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
                <h5 class="modal-title" style="float: left;">New Bookings</h5>
              </div>

              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                  <thead>
                    <tr>
                      <th class="text-center"></th>
                      <th>Booking ID</th>
                      <th class="d-none d-sm-table-cell">Cutomer Name</th>
                      <th class="d-none d-sm-table-cell">Mobile Number</th>
                      <th class="d-none d-sm-table-cell">Email</th>
                      <th class="d-none d-sm-table-cell">Booking Date</th>
                      <th class="d-none d-sm-table-cell">Status</th>

                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    $sql = "SELECT * from booking where Status='Active' order by id desc";
                    $query = $pdo->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                      foreach ($results as $row) {
                        $eventId = $row->eventId;
                        $sqlEvent = "SELECT start_date FROM event WHERE id = :eventId";
                        $queryEvent = $pdo->prepare($sqlEvent);
                        $queryEvent->bindParam(':eventId', $eventId, PDO::PARAM_INT);
                        $queryEvent->execute();
                        $event = $queryEvent->fetch(PDO::FETCH_OBJ);

                        if ($event && strtotime($event->start_date) >= strtotime(date('Y-m-d'))) { ?>
                          <tr>
                            <td class="text-center"><?php echo htmlentities($cnt); ?></td>
                            <td class="font-w600"><?php echo htmlentities($row->bookingId); ?></td>
                            <td class="font-w600"><?php echo htmlentities($row->name); ?></td>
                            <td class="font-w600">0<?php echo htmlentities($row->phone); ?></td>
                            <td class="font-w600"><?php echo htmlentities($row->email); ?></td>
                            <td class="font-w600"><?php echo htmlentities($event->start_date); ?></td>
                            <td class="d-none d-sm-table-cell">
                              <span class="badge badge-success"><?php echo htmlentities($row->status); ?></span>
                            </td>
                          </tr>
                    <?php
                          $cnt = $cnt + 1;
                        }
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