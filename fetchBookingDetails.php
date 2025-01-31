<?php
session_start();
error_reporting(0);
include('config/db.php');

if (strlen($_SESSION['id']) == 0) {
  header('location:logout.php');
} else {
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['bookingId'])) {
  $id = $_POST['bookingId'];
  $sql = "SELECT booking.bookingId as BookingID, booking.name as Name, booking.phone as MobileNumber, booking.email as Email, booking.gender, booking.guestNo, booking.payment, event.event_name as EventName, event.pincode, event.venue, event.category_name, event.start_date , event.start_time, event.end_date, event.end_time from booking join event on booking.eventId=event.id where booking.id=:id";
  $query = $pdo->prepare($sql);
  $query->bindParam(':id', $id, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);

  if ($query->rowCount() > 0) {
    foreach ($results as $row) {
      ?>
      
      <div class="card">
        <div class="table-responsive p-3">
          <table border="1" class="table align-items-center table-hover">
            <tr>
              <th colspan="5" style="text-align: center;color: Blue;font-size: 20px">Booking Number: <?php echo $row->BookingID; ?></th>
            </tr>
            <tr>
              <th>Name of Client</th>
              <td><?php echo $row->Name; ?></td>
              <th>Mobile Number</th>
              <td><?php echo $row->MobileNumber; ?></td>
            </tr>
            <tr>
              <th>Email</th>
              <td><?php echo $row->Email; ?></td>
              <th>Gender</th>
              <td><?php echo $row->gender; ?></td>
            </tr>
            <tr>
              <th>Number of Guests</th>
              <td><?php echo $row->guestNo; ?></td>
              <th>Payment</th>
              <td><?php echo $row->payment; ?> TK</td>
            </tr>
            <tr>
              <th>Event Name</th>
              <td><?php echo $row->EventName; ?></td>
              <th>Event Pincode</th>
              <td><?php echo $row->pincode; ?></td>
            </tr>
            <tr>
              <th>Event Category</th>
              <td><?php echo $row->category_name; ?></td>
              <th>Event Venue</th>
              <td><?php echo $row->venue; ?></td>
            </tr>
            <tr>
              <th>Event Start Date</th>
              <td><?php echo $row->start_date; ?></td>
              <th>Event End Date</th>
              <td><?php echo $row->end_date; ?></td>
            </tr>
            <tr>
              <th>Event Start Time</th>
              <td><?php echo $row->start_time; ?></td>
              <th>Event End Time</th>
              <td><?php echo $row->end_time; ?></td>
            </tr>
            <tr>
              
            </tr>
          </table>
        </div>
      </div>
      <?php
    }
  }
}
}
?>
