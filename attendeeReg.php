<?php
include('includes/checklogin.php');
check_login();

if (isset($_POST['submit'])) {
  $id = $_GET['id'];
  $bookingId = mt_rand(100000000, 999999999);
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $eventId = $_POST['eventId'];
  $guestNo = $_POST['guestNo'];
  $payment = $_POST['payment'];
  $info = $_POST['info'];
  $status = 'Active';

  // Check if guestNo exceeds event capacity
  $sql = "SELECT capacity FROM event WHERE id = :eventId";
  $query = $pdo->prepare($sql);
  $query->bindParam(':eventId', $eventId, PDO::PARAM_INT);
  $query->execute();
  $event = $query->fetch(PDO::FETCH_OBJ);

  if ($guestNo > $event->capacity) {
    echo '<script>alert("Number of guests exceeds event capacity. Please reduce the number of guests.")</script>';
  } else {
    $sql = "INSERT INTO booking(bookingId, name, phone, email, eventId, guestNo, payment, info, status) VALUES(:bookingId, :name, :phone, :email, :eventId, :guestNo, :payment, :info, :status)";
    $query = $pdo->prepare($sql);
    $query->bindParam(':bookingId', $bookingId, PDO::PARAM_STR);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':phone', $phone, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':eventId', $eventId, PDO::PARAM_INT);
    $query->bindParam(':guestNo', $guestNo, PDO::PARAM_INT);
    $query->bindParam(':payment', $payment, PDO::PARAM_STR);
    $query->bindParam(':info', $info, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);

    $query->execute();
    $LastInsertId = $pdo->lastInsertId();
    if ($LastInsertId > 0) {
      echo '<script>alert("Attendee Registration Successful.")</script>';
      echo "<script>window.location.href ='attendeeReg.php'</script>";
    } else {
      echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
  }
}

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
                <div class="card-header">
                  <h5 class="card-title">New Registration</h5>
                </div>
                <div class="card-body">
                  <form method="POST" id="contactForm" name="contactForm" class="contactForm">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="label" for="name">Full Name</label>
                          <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="label" for="email">Email Address</label>
                          <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="label" for="phone">Contact No</label>
                          <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone No">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="label" for="eventId">Event</label>
                          <select class="form-control" name="eventId" required="true">
                            <option value="">Choose Event</option>
                            <?php
                            $sql2 = "SELECT * from event";
                            $query2 = $pdo->prepare($sql2);
                            $query2->execute();
                            $events = $query2->fetchAll(PDO::FETCH_OBJ);
                            foreach ($events as $event) { ?>
                              <option value="<?php echo htmlentities($event->id); ?>"><?php echo htmlentities($event->event_name . ' ' . '(' . $event->start_date . ')'); ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="label" for="guestNo">No of Guests</label>
                            <input type="number" class="form-control" name="guestNo" id="guestNo" placeholder="No of Guests" min="1" max="<?php echo $event->capacity; ?>" required>
                          </div>
                        </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="label" for="payment">Payment</label>
                          <input type="text" class="form-control" name="payment" id="payment" placeholder="Payment">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="label" for="info">Additional Information</label>
                          <textarea name="info" class="form-control" id="info" cols="30" rows="4" placeholder=""></textarea>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-info">Register</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>



        </div>
      </div>
    </div>
  </div>


  <?php @include("includes/foot.php"); ?>

</body>

</html>