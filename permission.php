<?php
include('includes/auth.php');
check_login();

// Code for deleting permission
if (isset($_GET['delId'])) {
    if (!check_permission('permission_delete')) {
        echo "<script>alert('You do not have permission to delete permissions');</script>";
        exit();
      }
  $id = intval($_GET['delId']);
  $sql = "DELETE FROM permissions WHERE permission_id = :id";
  $query = $pdo->prepare($sql);
  $query->bindParam(':id', $id, PDO::PARAM_STR);
  $query->execute();
  echo "<script>alert('permission deleted');</script>";
  echo "<script>window.location.href = 'permission.php'</script>";
}

// Code for updating permission
if (isset($_POST['update'])) {
    if (!check_permission('permission_edit')) {
        echo "<script>alert('You do not have permission to edit permissions');</script>";
        exit();
      }
  $id = intval($_GET['id']);
  $permission_name = $_POST['permission_name'];

  // Update permission name
  $sql = "UPDATE permissions SET permission_name = :permission_name WHERE permission_id = :id";
  $query = $pdo->prepare($sql);
  $query->bindParam(':permission_name', $permission_name, PDO::PARAM_STR);
  $query->bindParam(':id', $id, PDO::PARAM_STR);
  $query->execute();

  echo "<script>alert('permission updated successfully');</script>";
  echo "<script>window.location.href = 'permission.php'</script>";
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
                  <h3 class="modal-title" style="float: left;">Manage permissions</h3>
                  <div class="card-tools" style="float: right;">
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addpermission"><i class="fas fa-plus"></i> Add permission
                    </button>
                  </div>
                </div>

                <!-- permission add modal -->
                <div class="modal fade" id="addpermission">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Add New permission</h4>
                        <?php if (check_permission('permission_add')) { ?>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <?php } ?>
                      </div>
                      <div class="modal-body">
                        <?php @include("newpermission.php"); ?>
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
                        <th>Permission Name</th>
                        <th class="text-center" style="width: 20%;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "SELECT * FROM permissions ORDER BY permission_id DESC";
                      $query = $pdo->prepare($sql);
                      $query->execute();
                      $permissions = $query->fetchAll(PDO::FETCH_OBJ);
                      $cnt = 1;
                      if ($query->rowCount() > 0) {
                        foreach ($permissions as $permission) { ?>
                          <tr>
                            <td class="text-center"><?php echo htmlentities($cnt); ?></td>
                            <td><?php echo htmlentities($permission->permission_name); ?></td>
                            <td class="text-center">

                              <!-- Update permission -->
                              <?php if (check_permission('permission_edit')) { ?>
                              <button type="button" class="rounded btn btn-sm btn-success" data-toggle="modal" data-target="#updatepermission<?php echo $permission->permission_id; ?>" title="Edit"><i class="mdi mdi-pencil"></i></button>
                              <?php } ?>
                              <div class="modal fade" id="updatepermission<?php echo ($permission->permission_id); ?>">
                                <div class="modal-dialog modal-md">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Update permission</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="POST" action="permission.php?id=<?php echo $permission->permission_id; ?>">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="permission_name">permission Name</label>
                                              <input type="text" name="permission_name" class="form-control" id="permission_name" value="<?php echo htmlentities($permission->permission_name); ?>" required>
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

                            <!-- Delete permission -->
                            <?php if (check_permission('permission_delete')) { ?>
                            <a href="permission.php?delId=<?php echo ($permission->permission_id); ?>" onclick="return confirm('Do you really want to Delete?');" class="rounded btn btn-danger btn-sm" title="Delete"><i class="mdi mdi-delete"></i></a>
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