<?php
session_start();
error_reporting(0);
include('includes/auth.php');
check_login();
?>
<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php");?>
<body>
  <div class="container-scroller">
    
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row" id="pdf">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                
                <div class="table-responsive p-3">
                  <?php
                  $id=$_GET['id'];
                  $sql="SELECT booking.bookingId as BookingID, booking.name as Name, booking.phone as MobileNumber, booking.email as Email, booking.gender, booking.guestNo, booking.payment, event.event_name as EventName, event.pincode, event.venue, event.category_name, event.start_date , event.start_time, event.end_date, event.end_time from booking join event on booking.eventId=event.id where booking.id=:id";
                  $query = $pdo -> prepare($sql);
                  $query-> bindParam(':id', $id, PDO::PARAM_STR);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);

                  if($query->rowCount() > 0)
                  {
                    foreach($results as $row)
                    { 
                      ?>
                      <table border="1" class="table align-items-center table-bordered table-hover">
                        <tr>
                          <th colspan="5" style="text-align: center;color: blue;font-size: 20px">Booking Number: <?php  echo $row->BookingID;?></th>
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
                      
                      <?php } } ?>

                  </table> 
                  <p style="margin-top:1%" align="center">
                    <i class="mdi mdi-printer fa-2x" style="cursor: pointer; font-size: 30px; "  OnClick="CallPrint(this.value)" ></i>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
     
    </div>
  </div>
  
  <?php @include("includes/foot.php");?>
  
  <script>
    function CallPrint(strid) {
      var prtContent = document.getElementById("pdf");
      var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
      WinPrint.document.write(prtContent.innerHTML);
      WinPrint.document.close();
      WinPrint.focus();
      WinPrint.print();
      WinPrint.close();
    }
  </script>
</body>
</html>