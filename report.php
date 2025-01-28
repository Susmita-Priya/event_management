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
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="modal-header">
                  <h5 class="modal-title float-left">Event Attendees Report</h5>
                </div>
                <div class="col-md-12">
                  <form class="forms-sample" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="label" for="eventId">Event</label>
                          <select class="form-control" name="eventId" id="eventId" required>
                            <option value="">Choose Event</option>
                            <?php
                            $sql2 = "SELECT * FROM event";
                            $query2 = $pdo->prepare($sql2);
                            $query2->execute();
                            $events = $query2->fetchAll(PDO::FETCH_OBJ);
                            foreach ($events as $event) { ?>
                                <option value="<?php echo htmlentities($event->id); ?>" <?php if(isset($_POST['eventId']) && $_POST['eventId'] == $event->id) echo 'selected'; ?>>
                                <?php echo htmlentities($event->event_name .' - '. $event->pincode. ' (' . $event->start_date . ', ' . $event->start_time . ')'); ?>
                                </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <button type="submit" name="search" class="btn btn-info btn-sm mb-4">Search</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <?php
          if (isset($_POST['search'])) {
            $eventId = $_POST['eventId'];
            ?>
            <div class="table-responsive p-3">
                <h4 align="center" style="color:blue">Attendee List for <?php echo htmlentities($events[array_search($eventId, array_column($events, 'id'))]->event_name); ?> - <?php echo htmlentities($events[array_search($eventId, array_column($events, 'id'))]->pincode); ?></h4>
                <p align="center">
              Event Venue: <?php echo htmlentities($events[array_search($eventId, array_column($events, 'id'))]->venue); ?><br>
            Start: <?php echo htmlentities($events[array_search($eventId, array_column($events, 'id'))]->start_date); ?>,
            <?php echo htmlentities($events[array_search($eventId, array_column($events, 'id'))]->start_time); ?><br>
            End:<?php echo htmlentities($events[array_search($eventId, array_column($events, 'id'))]->end_date); ?>,
            <?php echo htmlentities($events[array_search($eventId, array_column($events, 'id'))]->end_time); ?><br>
              <hr />
              <table class="table align-items-center table-flush table-hover table-bordered" id="dataTableHover">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Booking ID</th>
                    <th>Attendee Name</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>No of Guests</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM booking WHERE eventId=:eventId";
                  $query = $pdo->prepare($sql);
                  $query->bindParam(':eventId', $eventId, PDO::PARAM_INT);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                  $cnt = 1;
                  if ($query->rowCount() > 0) {
                    foreach ($results as $row) { ?>
                      <tr>
                        <td class="text-center"><?php echo htmlentities($cnt); ?></td>
                        <td><?php echo htmlentities($row->bookingId); ?></td>
                        <td><?php echo htmlentities($row->name); ?></td>
                        <td><?php echo htmlentities($row->phone); ?></td>
                        <td><?php echo htmlentities($row->email); ?></td>
                        <td><?php echo htmlentities($row->gender); ?></td>
                        <td><?php echo htmlentities($row->guestNo); ?></td>
                        <td><?php echo htmlentities($row->payment); ?></td>
                        <td>
                          <span class="badge badge-info"><?php echo htmlentities($row->status); ?></span>
                        </td>
                        <td class="text-center">
                          <a href="invoiceGenerating.php?id=<?php echo htmlentities($row->id); ?>"><i class="mdi mdi-printer" aria-hidden="true"></i></a>
                        </td>
                      </tr>
                      <?php $cnt++; 
                    } 
                  } else { ?>
                    <tr>
                      <td colspan="10" class="text-center">No attendees found for this event.</td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              <form method="post" action="downloadCSV.php">
                <input type="hidden" name="eventId" value="<?php echo htmlentities($eventId); ?>">
                <button type="submit" class="btn btn-success mt-4">Download CSV</button>
              </form>
            </div>
            <?php
          }
          ?>
        </div>
      </div>
     
    </div> <?php @include("includes/footer.php"); ?>
  </div>
  <?php @include("includes/foot.php"); ?>
</body>
</html>
