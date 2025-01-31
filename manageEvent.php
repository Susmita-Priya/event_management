<?php
include('includes/auth.php');
check_login();

// Code for deleting product from cart
if (isset($_GET['delId'])) {
  if (!check_permission('event_delete')) {
    echo "<script>alert('You do not have permission to delete events');</script>";
    exit();
  }
  $id = intval($_GET['delId']);
  $sql = "delete from event where id =:id";
  $query = $pdo->prepare($sql);
  $query->bindParam(':id', $id, PDO::PARAM_STR);
  $query->execute();
  echo "<script>alert('Event deleted');</script>";
  echo "<script>window.location.href = 'manageEvent.php'</script>";
}

// Code for updating event
if (isset($_POST['update'])) {
  if (!check_permission('event_edit')) {
    echo "<script>alert('You do not have permission to edit events');</script>";
    exit();
  }
  $id = intval($_GET['id']);
  $event_name = $_POST['event_name'];
  $category_name = $_POST['category_name'];
  $venue = $_POST['venue'];
  $pincode = $_POST['pincode'];
  $capacity = $_POST['capacity'];
  $availability = $_POST['availability'];
  $payment = $_POST['payment'];
  $start_date = $_POST['start_date'];
  $start_time = $_POST['start_time'];
  $end_date = $_POST['end_date'];
  $end_time = $_POST['end_time'];
  $description = $_POST['description'];
  $status = $_POST['status'];

  $sql = "UPDATE event SET event_name=:event_name, category_name=:category_name, venue=:venue, pincode=:pincode, capacity=:capacity, availability=:availability, payment=:payment, start_date=:start_date, start_time=:start_time, end_date=:end_date, end_time=:end_time, description=:description, status=:status WHERE id=:id";
  $query = $pdo->prepare($sql);
  $query->bindParam(':event_name', $event_name, PDO::PARAM_STR);
  $query->bindParam(':category_name', $category_name, PDO::PARAM_STR);
  $query->bindParam(':venue', $venue, PDO::PARAM_STR);
  $query->bindParam(':pincode', $pincode, PDO::PARAM_STR);
  $query->bindParam(':capacity', $capacity, PDO::PARAM_STR);
  $query->bindParam(':availability', $availability, PDO::PARAM_STR);
  $query->bindParam(':payment', $payment, PDO::PARAM_STR);
  $query->bindParam(':start_date', $start_date, PDO::PARAM_STR);
  $query->bindParam(':start_time', $start_time, PDO::PARAM_STR);
  $query->bindParam(':end_date', $end_date, PDO::PARAM_STR);
  $query->bindParam(':end_time', $end_time, PDO::PARAM_STR);
  $query->bindParam(':description', $description, PDO::PARAM_STR);
  $query->bindParam(':status', $status, PDO::PARAM_STR);
  $query->bindParam(':id', $id, PDO::PARAM_STR);
  $query->execute();

  echo "<script>alert('Event updated successfully');</script>";
  echo "<script>window.location.href = 'manageEvent.php'</script>";
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
                <div class="modal-header">
                  <h3 class="modal-title" style="float: left;">Manage Event</h3>
                  <div class="card-tools" style="float: right;">

                    <?php if (check_permission('event_add')) { ?>
                      <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addsector"><i class="fas fa-plus"></i> Add Event
                      </button>
                    <?php } ?>

                  </div>
                </div>

                <!-- event add modal-->
                <div class="modal fade" id="addsector">
                  <div class="modal-dialog modal-md  ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Add New Event</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <?php @include("newEvent.php"); ?>
                      </div>
                      <div class="modal-footer ">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-body table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead>
                      <tr>
                        <th class="text-center">No.</th>
                        <th>Event</th>
                        <th>Venue</th>
                        <th>Capacity</th>
                        <th>Availability</th>
                        <th>Start Date & Time</th>
                        <th>End Date & Time</th>
                        <th>Status</th>
                        <th class="text-center" style="width: 20%;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "SELECT * FROM event ORDER BY id DESC";
                      $query = $pdo->prepare($sql);
                      $query->execute();
                      $events = $query->fetchAll(PDO::FETCH_OBJ);
                      $cnt = 1;
                      if ($query->rowCount() > 0) {
                        foreach ($events as $event) { ?>
                          <tr>
                            <td class="text-center"><?php echo htmlentities($cnt); ?></td>
                            <td><?php echo htmlentities($event->event_name); ?> - <?php echo htmlentities($event->pincode); ?></td>
                            <td><?php echo htmlentities($event->venue); ?></td>
                            <td><?php echo htmlentities($event->capacity); ?></td>
                            <td><?php echo htmlentities($event->availability); ?></td>
                            <td><?php echo htmlentities($event->start_date); ?> <?php echo htmlentities($event->start_time); ?></td>
                            <td><?php echo htmlentities($event->end_date); ?> <?php echo htmlentities($event->end_time); ?></td>
                            <td>
                              <label class="badge <?php echo ($event->status == 'Active') ? 'badge-success' : 'badge-danger'; ?>">
                                <?php echo htmlentities($event->status); ?>
                              </label>
                            </td>

                            <td class="text-center">

                              <!--  View Event -->
                              <?php if (check_permission('event_view')) { ?>
                                <a href="#" class="rounded btn btn-info btn-sm" data-toggle="modal" data-target="#viewEvent<?php echo ($event->id); ?>" title="View"><i class="mdi mdi-eye"></i></a>
                              <?php } ?>
                              <div class="modal fade" id="viewEvent<?php echo ($event->id); ?>">
                                <div class="modal-dialog modal-md"></div>
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">View Event</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <div class="modal-body">
                                    <p><strong>Event Name:</strong> <?php echo htmlentities($event->event_name); ?></p>
                                    <p><strong>Category:</strong> <?php echo htmlentities($event->category_name); ?></p>
                                    <p><strong>Venue:</strong> <?php echo htmlentities($event->venue); ?></p>
                                    <p><strong>Pincode:</strong> <?php echo htmlentities($event->pincode); ?></p>
                                    <p><strong>Capacity:</strong> <?php echo htmlentities($event->capacity); ?></p>
                                    <p><strong>Availability:</strong> <?php echo htmlentities($event->availability); ?></p>
                                    <p><strong>Payment:</strong> <?php echo htmlentities($event->payment); ?> TK</p>
                                    <p><strong>Start Date & Time:</strong> <?php echo htmlentities($event->start_date); ?>, <?php echo htmlentities($event->start_time); ?></p>
                                    <p><strong>End Date & Time:</strong> <?php echo htmlentities($event->end_date); ?>, <?php echo htmlentities($event->end_time); ?></p>
                                    <p><strong>Description:</strong> <?php echo htmlentities($event->description ?? 'N/A'); ?></p>
                                    <p><strong>Status:</strong> <?php echo ($event->status == 'Active') ? 'Active' : 'Inactive'; ?></p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>

                              <!--  Update Event -->
                              <?php if (check_permission('event_edit')) { ?>
                                <button type="button" class="rounded btn btn-sm btn-success" data-toggle="modal" data-target="#updateEvent<?php echo $event->id; ?>" title="Edit"><i class="mdi mdi-pencil"></i></button>
                              <?php } ?>
                              <div class="modal fade" id="updateEvent<?php echo ($event->id); ?>">
                                <div class="modal-dialog modal-md">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Update Event</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="POST" action="manageEvent.php?id=<?php echo $event->id; ?>">
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="event_name">Event Name</label>
                                              <input type="text" name="event_name" class="form-control" id="event_name" value="<?php echo htmlentities($event->event_name); ?>" required>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="category_name">Category Name</label>
                                              <select name="category_name" class="form-control" id="category_name" required>
                                                <option value="">Select Category</option>
                                                <option value="Public Event" <?php if ($event->category_name == 'Public Event') echo 'selected'; ?>>Public Event</option>
                                                <option value="Private Event" <?php if ($event->category_name == 'Private Event') echo 'selected'; ?>>Private Event</option>
                                              </select>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="venue">Venue</label>
                                              <input type="text" name="venue" class="form-control" id="venue" value="<?php echo htmlentities($event->venue); ?>" required>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="pincode">Pincode</label>
                                              <input type="text" name="pincode" class="form-control" id="pincode" value="<?php echo htmlentities($event->pincode); ?>" required>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="capacity">Capacity</label>
                                              <input type="number" name="capacity" class="form-control" id="capacity" value="<?php echo htmlentities($event->capacity); ?>" required>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="availability">Availability</label>
                                              <input type="number" name="availability" class="form-control" id="availability" value="<?php echo htmlentities($event->availability); ?>" required>
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="payment">Payment</label>
                                              <input type="number" name="payment" class="form-control" id="payment" value="<?php echo htmlentities($event->payment); ?>" required>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="start_date">Start Date</label>
                                              <input type="date" name="start_date" class="form-control" id="start_date" value="<?php echo htmlentities($event->start_date); ?>" required>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="start_time">Start Time</label>
                                              <input type="time" name="start_time" class="form-control" id="start_time" value="<?php echo htmlentities($event->start_time); ?>" required>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="end_date">End Date</label>
                                              <input type="date" name="end_date" class="form-control" id="end_date" value="<?php echo htmlentities($event->end_date); ?>" required>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="end_time">End Time</label>
                                              <input type="time" name="end_time" class="form-control" id="end_time" value="<?php echo htmlentities($event->end_time); ?>" required>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="description">Description</label>
                                              <textarea name="description" class="form-control" id="description" rows="4"><?php echo htmlentities($event->description); ?></textarea>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="status">Status</label>
                                              <select name="status" class="form-control" id="status" required>
                                                <option value="">Select Status</option>
                                                <option value="Active" <?php if ($event->status == 'Active') echo 'selected'; ?>>Active</option>
                                                <option value="Inactive" <?php if ($event->status == 'Inactive') echo 'selected'; ?>>Inactive</option>
                                              </select>
                                            </div>
                                          </div>
                                        </div>
                                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                                      </form>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <!--  Delete Event -->
                              <?php if (check_permission('event_delete')) { ?>
                                <a href="manageEvent.php?delId=<?php echo ($event->id); ?>" onclick="return confirm('Do you really want to Delete?');" class="rounded btn btn-danger btn-sm" title="Delete"><i class="mdi mdi-delete"></i></a>
                              <?php } ?>

                            </td>
                          </tr>
                          <?php $cnt++;
                        }
                      }   ?>
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php @include("includes/footer.php"); ?>
  <?php @include("includes/foot.php"); ?>
</body>
</html>