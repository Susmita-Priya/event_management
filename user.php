<?php
include('includes/auth.php');
check_login();

// Code for deleting user
if (isset($_GET['delId'])) {
    if (!check_permission('user_delete')) {
        echo "<script>alert('You do not have permission to delete users');</script>";
        exit();
      }
    $id = intval($_GET['delId']);
    $sql = "delete from user where id =:id";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
  echo "<script>alert('User deleted');</script>";
  echo "<script>window.location.href = 'user.php'</script>";
}

// Code for updating user
if (isset($_POST['update'])) {
    if (!check_permission('user_edit')) {
        echo "<script>alert('You do not have permission to edit users');</script>";
        exit();
      }
  $id = intval($_GET['id']);
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $role_id = $_POST['role_id'];

  $sql = "UPDATE user SET firstName=:firstName, lastName=:lastName, email=:email, phone=:phone, role_id=:role_id WHERE id=:id";
  $query = $pdo->prepare($sql);
  $query->bindParam(':firstName', $firstName, PDO::PARAM_STR);
  $query->bindParam(':lastName', $lastName, PDO::PARAM_STR);
  $query->bindParam(':email', $email, PDO::PARAM_STR);
  $query->bindParam(':phone', $phone, PDO::PARAM_STR);
  $query->bindParam(':role_id', $role_id, PDO::PARAM_STR);
  $query->bindParam(':id', $id, PDO::PARAM_STR);
  $query->execute();

  echo "<script>alert('User updated successfully');</script>";
  echo "<script>window.location.href = 'user.php'</script>";
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
                  <h3 class="modal-title" style="float: left;">Manage Users</h3>
                  <div class="card-tools" style="float: right;">
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addUser"><i class="fas fa-plus"></i> Add User
                    </button>
                  </div>
                </div>

                <!-- User add modal -->
                <div class="modal fade" id="addUser">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Add New User</h4>

                        <?php if (check_permission('user_add')) { ?>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        <?php } ?>

                      </div>
                      <div class="modal-body">
                        <?php @include("newUser.php"); ?>
                      </div>
                      <div class="modal-footer">
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
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th class="text-center" style="width: 20%;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "SELECT u.*, r.role_name FROM user u JOIN roles r ON u.role_id = r.role_id ORDER BY u.id DESC";
                      $query = $pdo->prepare($sql);
                      $query->execute();
                      $users = $query->fetchAll(PDO::FETCH_OBJ);
                      $cnt = 1;
                      if ($query->rowCount() > 0) {
                        foreach ($users as $user) { ?>
                          <tr>
                            <td class="text-center"><?php echo htmlentities($cnt); ?></td>
                            <td><?php echo htmlentities($user->firstName); ?></td>
                            <td><?php echo htmlentities($user->lastName); ?></td>
                            <td><?php echo htmlentities($user->email); ?></td>
                            <td><?php echo htmlentities($user->phone); ?></td>
                            <td><?php echo htmlentities($user->role_name); ?></td>
                            <td class="text-center">

                              <!-- View User -->
                              <?php if (check_permission('user_view')) { ?>
                              <a href="#" class="rounded btn btn-info btn-sm" data-toggle="modal" data-target="#viewUser<?php echo ($user->id); ?>" title="View"><i class="mdi mdi-eye"></i></a>
                              <?php } ?>
                              <div class="modal fade" id="viewUser<?php echo ($user->id); ?>">
                                <div class="modal-dialog modal-md">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">View User</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                      <p><strong>First Name:</strong> <?php echo htmlentities($user->firstName); ?></p>
                                      <p><strong>Last Name:</strong> <?php echo htmlentities($user->lastName); ?></p>
                                      <p><strong>Email:</strong> <?php echo htmlentities($user->email); ?></p>
                                      <p><strong>Phone:</strong> <?php echo htmlentities($user->phone); ?></p>
                                      <p><strong>Role:</strong> <?php echo htmlentities($user->role_name); ?></p>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <!-- Update User -->
                              <?php if (check_permission('user_edit')) { ?>
                              <button type="button" class="rounded btn btn-sm btn-success" data-toggle="modal" data-target="#updateUser<?php echo $user->id; ?>" title="Edit"><i class="mdi mdi-pencil"></i></button>
                              <?php } ?>
                              <div class="modal fade" id="updateUser<?php echo ($user->id); ?>">
                                <div class="modal-dialog modal-md">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Update User</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="POST" action="user.php?id=<?php echo $user->id; ?>">
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="firstName">First Name</label>
                                              <input type="text" name="firstName" class="form-control" id="firstName" value="<?php echo htmlentities($user->firstName); ?>" required>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="lastName">Last Name</label>
                                              <input type="text" name="lastName" class="form-control" id="lastName" value="<?php echo htmlentities($user->lastName); ?>" required>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="email">Email</label>
                                              <input type="email" name="email" class="form-control" id="email" value="<?php echo htmlentities($user->email); ?>" required>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="phone">Phone</label>
                                              <input type="text" name="phone" class="form-control" id="phone" value="<?php echo htmlentities($user->phone); ?>" max="13">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="role_id">Role</label>
                                              <select name="role_id" class="form-control" id="role_id" required>
                                                <?php
                                                $role_sql = "SELECT * FROM roles";
                                                $role_query = $pdo->prepare($role_sql);
                                                $role_query->execute();
                                                $roles = $role_query->fetchAll(PDO::FETCH_OBJ);
                                                foreach ($roles as $role) {
                                                  $selected = ($role->role_id == $user->role_id) ? 'selected' : '';
                                                  echo "<option value='$role->role_id' $selected>$role->role_name</option>";
                                                }
                                                ?>
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

                              <!-- Delete User -->
                              <?php if (check_permission('user_delete')) { ?>
                              <a href="user.php?delId=<?php echo ($user->id); ?>" onclick="return confirm('Do you really want to Delete?');" class="rounded btn btn-danger btn-sm" title="Delete"><i class="mdi mdi-delete"></i></a>
                              <?php } ?>
                            </td>
                          </tr>
                      <?php $cnt++;
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
    </div>
  </div>
  <?php @include("includes/footer.php"); ?>
  </div>
  <?php @include("includes/foot.php"); ?>
</body>

</html>