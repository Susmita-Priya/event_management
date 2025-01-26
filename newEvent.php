<?php
session_start();
error_reporting(0);
include('includes/db.php');
if (isset($_POST['submit'])) {
    // Collect form data
    $event_name = $_POST['event_name'];
    $category_name = $_POST['category_name'];
    $venue = $_POST['venue'];
    $pincode = $_POST['pincode'];
    $capacity = $_POST['capacity'];
    $payment = $_POST['payment'];
    $start_date = $_POST['start_date'];
    $start_time = $_POST['start_time'];
    $end_date = $_POST['end_date'];
    $end_time = $_POST['end_time'];
    $description = $_POST['description'];
    $status = 'Active';

    // Prepare the SQL query
    $sql = "INSERT INTO event (event_name, category_name, venue, pincode, capacity, payment, start_date, start_time, end_date, end_time, description, status) 
        VALUES (:event_name, :category_name, :venue, :pincode, :capacity, :payment, :start_date, :start_time, :end_date, :end_time, :description, :status)";

    // Prepare the statement
    $query = $pdo->prepare($sql);

    // Bind parameters
    $query->bindParam(':event_name', $event_name, PDO::PARAM_STR);
    $query->bindParam(':category_name', $category_name, PDO::PARAM_STR);
    $query->bindParam(':venue', $venue, PDO::PARAM_STR);
    $query->bindParam(':pincode', $pincode, PDO::PARAM_STR);
    $query->bindParam(':capacity', $capacity, PDO::PARAM_STR);
    $query->bindParam(':payment', $payment, PDO::PARAM_STR);
    $query->bindParam(':start_date', $start_date, PDO::PARAM_STR);
    $query->bindParam(':start_time', $start_time, PDO::PARAM_STR);
    $query->bindParam(':end_date', $end_date, PDO::PARAM_STR);
    $query->bindParam(':end_time', $end_time, PDO::PARAM_STR);
    $query->bindParam(':description', $description, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);

    // Execute the query
    if ($query->execute()) {
        echo '<script>alert("Event has been added successfully.")</script>';
    } else {
        echo '<script>alert("Something went wrong. Please try again.")</script>';
    }
}
?>
<div class="card-body">
  <form class="forms-sample" method="post" onsubmit="return validateForm()">
    <div class="row">
      <!-- Event Name -->
      <div class="col-md-6">
      <div class="form-group">
        <label for="event_name">Event Name</label>
        <input type="text" name="event_name" class="form-control" id="event_name" placeholder="Event Name" required>
      </div>
      </div>

      <!-- Category Name -->
      <div class="col-md-6">
      <div class="form-group">
        <label for="category_name">Category Name</label>
        <select name="category_name" class="form-control" id="category_name" required>
        <option value="">Select Category</option>
        <option value="Public Event">Public Event</option>
        <option value="Private Event">Private Event</option>
        </select>
      </div>
      </div>
    </div>

    <div class="row">
      <!-- Venue -->
      <div class="col-md-6">
      <div class="form-group">
        <label for="venue">Venue</label>
        <input type="text" name="venue" class="form-control" id="venue" placeholder="Venue" required>
      </div>
      </div>

      <!-- Pincode -->
      <div class="col-md-6">
      <div class="form-group">
        <label for="pincode">Pincode</label>
        <input type="text" name="pincode" class="form-control" id="pincode" placeholder="Pincode" minlength="4" required>
      </div>
      </div>
    </div>

    <div class="row">
      <!-- Capacity -->
      <div class="col-md-6">
      <div class="form-group">
        <label for="capacity">Capacity</label>
        <input type="number" name="capacity" class="form-control" id="capacity" placeholder="Capacity" required>
      </div>
      </div>

      <!-- Payment -->
      <div class="col-md-6">
      <div class="form-group">
        <label for="payment">Payment</label>
        <input type="number" name="payment" class="form-control" id="payment" placeholder="Payment Amount" step="0.01" required>
      </div>
      </div>
    </div>

    <div class="row">
      <!-- Start Date -->
      <div class="col-md-6">
      <div class="form-group">
        <label for="start_date">Start Date</label>
        <input type="date" name="start_date" class="form-control" id="start_date" required min="<?php echo date('Y-m-d'); ?>">
      </div>
      </div>

      <!-- Start Time -->
      <div class="col-md-6">
      <div class="form-group">
        <label for="start_time">Start Time</label>
        <input type="time" name="start_time" class="form-control" id="start_time" required >
      </div>
      </div>
    </div>

    <div class="row">
      <!-- End Date -->
      <div class="col-md-6">
      <div class="form-group">
        <label for="end_date">End Date</label>
        <input type="date" name="end_date" class="form-control" id="end_date" required min="<?php echo date('Y-m-d'); ?>"> 
      </div>
      </div>

      <!-- End Time -->
      <div class="col-md-6">
      <div class="form-group">
        <label for="end_time">End Time</label>
        <input type="time" name="end_time" class="form-control" id="end_time" required>
      </div>
      </div>
    </div>

    <div class="row">
      <!-- Description -->
      <div class="col-md-12">
      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" id="description" rows="4" placeholder="Event Description"></textarea>
      </div>
      </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" name="submit" class="btn btn-primary btn-fw">Submit</button>
    </form>

  <script>
  function validateForm() {
    var event_name = document.getElementById('event_name').value;
    var category_name = document.getElementById('category_name').value;
    var venue = document.getElementById('venue').value;
    var pincode = document.getElementById('pincode').value;
    var capacity = document.getElementById('capacity').value;
    var payment = document.getElementById('payment').value;
    var start_date = document.getElementById('start_date').value;
    var start_time = document.getElementById('start_time').value;
    var end_date = document.getElementById('end_date').value;
    var end_time = document.getElementById('end_time').value;

    if (event_name == "" || category_name == "" || venue == "" || pincode == "" || capacity == "" || payment == "" || start_date == "" || start_time == "" || end_date == "" || end_time == "") {
      alert("All fields except description must be filled out");
      return false;
    }
    return true;
  }
  </script>
</div>
