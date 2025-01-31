<?php
include('includes/auth.php');
check_login();

// Code for deleting role
if (isset($_GET['delId'])) {
  if (!check_permission('role_delete')) {
    echo "<script>alert('You do not have permission to delete roles');</script>";
    exit();
  }
  $id = intval($_GET['delId']);
  $sql = "DELETE FROM roles WHERE role_id = :id";
  $query = $pdo->prepare($sql);
  $query->bindParam(':id', $id, PDO::PARAM_STR);
  $query->execute();
  echo "<script>alert('Role deleted');</script>";
  echo "<script>window.location.href = 'role.php'</script>";
}

// Code for updating role
if (isset($_POST['update'])) {
  if (!check_permission('role_edit')) {
    echo "<script>alert('You do not have permission to edit roles');</script>";
    exit();
  }
  $id = intval($_GET['id']);
  $role_name = $_POST['role_name'];
  $permissions = $_POST['permissions'] ?? [];

  // Update role name
  $sql = "UPDATE roles SET role_name = :role_name WHERE role_id = :id";
  $query = $pdo->prepare($sql);
  $query->bindParam(':role_name', $role_name, PDO::PARAM_STR);
  $query->bindParam(':id', $id, PDO::PARAM_STR);
  $query->execute();

  // Delete existing permissions for the role
  $sql = "DELETE FROM role_permissions WHERE role_id = :id";
  $query = $pdo->prepare($sql);
  $query->bindParam(':id', $id, PDO::PARAM_STR);
  $query->execute();

  // Insert new permissions for the role
  foreach ($permissions as $permission_id) {
    $sql = "INSERT INTO role_permissions (role_id, permission_id) VALUES (:role_id, :permission_id)";
    $query = $pdo->prepare($sql);
    $query->bindParam(':role_id', $id, PDO::PARAM_STR);
    $query->bindParam(':permission_id', $permission_id, PDO::PARAM_STR);
    $query->execute();
  }

  echo "<script>alert('Role updated successfully');</script>";
  echo "<script>window.location.href = 'role.php'</script>";
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
                  <h3 class="modal-title" style="float: left;">Manage Roles</h3>
                  <div class="card-tools" style="float: right;">
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addRole"><i class="fas fa-plus"></i> Add Role
                    </button>
                  </div>
                </div>

                <!-- Role add modal -->
                <div class="modal fade" id="addRole">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Add New Role</h4>

                        <?php if (check_permission('role_add')) { ?>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <?php } ?>

                      </div>
                      <div class="modal-body">
                        <?php @include("newRole.php"); ?>
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
                        <th>Role Name</th>
                        <th class="text-center" style="width: 20%;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "SELECT * FROM roles ORDER BY role_id DESC";
                      $query = $pdo->prepare($sql);
                      $query->execute();
                      $roles = $query->fetchAll(PDO::FETCH_OBJ);
                      $cnt = 1;
                      if ($query->rowCount() > 0) {
                        foreach ($roles as $role) { ?>
                          <tr>
                            <td class="text-center"><?php echo htmlentities($cnt); ?></td>
                            <td><?php echo htmlentities($role->role_name); ?></td>
                            <td class="text-left">

                              <!-- View Role -->
                              <?php if (check_permission('role_view')) { ?>
                              <a href="#" class="rounded btn btn-info btn-sm" data-toggle="modal" data-target="#viewRole<?php echo ($role->role_id); ?>" title="View"><i class="mdi mdi-eye"></i></a>
                              <?php } ?>
                              <div class="modal fade" id="viewRole<?php echo ($role->role_id); ?>">
                                <div class="modal-dialog modal-md">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">View Role</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                      <p><strong>Role Name:</strong> <?php echo htmlentities($role->role_name); ?></p>
                                      <p><strong>Permissions:</strong></p>
                                      <ul>
                                        <?php
                                        $sql = "SELECT p.permission_name FROM role_permissions rp JOIN permissions p ON rp.permission_id = p.permission_id WHERE rp.role_id = :role_id";
                                        $query = $pdo->prepare($sql);
                                        $query->bindParam(':role_id', $role->role_id, PDO::PARAM_STR);
                                        $query->execute();
                                        $permissions = $query->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($permissions as $permission) {
                                          echo "<li>" . htmlentities($permission->permission_name) . "</li>";
                                        }
                                        ?>
                                      </ul>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <!-- Update Role -->
                              <?php if (check_permission('role_edit')) { ?>
                              <button type="button" class="rounded btn btn-sm btn-success" data-toggle="modal" data-target="#updateRole<?php echo $role->role_id; ?>" title="Edit"><i class="mdi mdi-pencil"></i></button>
                              <?php } ?>
                              <div class="modal fade" id="updateRole<?php echo ($role->role_id); ?>">
                                <div class="modal-dialog modal-md">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Update Role</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="POST" action="role.php?id=<?php echo $role->role_id; ?>">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="role_name">Role Name</label>
                                              <input type="text" name="role_name" class="form-control" id="role_name" value="<?php echo htmlentities($role->role_name); ?>" required>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="permissions">Permissions</label>
                                              <?php
                                              $sql = "SELECT * FROM permissions";
                                              $query = $pdo->prepare($sql);
                                              $query->execute();
                                              $permissions = $query->fetchAll(PDO::FETCH_OBJ);
                                              foreach ($permissions as $permission) {
                                                $checked = false;
                                                $sql = "SELECT * FROM role_permissions WHERE role_id = :role_id AND permission_id = :permission_id";
                                                $check_query = $pdo->prepare($sql);
                                                $check_query->bindParam(':role_id', $role->role_id, PDO::PARAM_STR);
                                                $check_query->bindParam(':permission_id', $permission->permission_id, PDO::PARAM_STR);
                                                $check_query->execute();
                                                if ($check_query->rowCount() > 0) {
                                                  $checked = true;
                                                }
                                                echo "<div class='form-check' style='margin-left: 40px;'>
                                                        <input type='checkbox' name='permissions[]' value='$permission->permission_id' class='form-check-input' id='permission_$permission->permission_id' " . ($checked ? 'checked' : '') . ">
                                                        <label class='form-check-label' for='permission_$permission->permission_id'>$permission->permission_name</label>
                                                      </div>";
                                              }
                                              ?>
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

                              <!-- Delete Role -->
                              <?php if (check_permission('role_delete')) { ?>
                              <a href="role.php?delId=<?php echo ($role->role_id); ?>" onclick="return confirm('Do you really want to Delete?');" class="rounded btn btn-danger btn-sm" title="Delete"><i class="mdi mdi-delete"></i></a>
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
  <?php @include("includes/foot.php"); ?>
</body>

</html>