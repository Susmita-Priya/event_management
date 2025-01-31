<?php
session_start();
error_reporting(0);
include('includes/auth.php');
check_login();


if (strlen($_SESSION['id']) == 0) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $id = $_SESSION['id'];
    $currentPassword = $_POST['currentPassword'];

    // Fetch current password
    $sql = "SELECT password FROM user WHERE id=:id";
    $query = $pdo->prepare($sql);
      
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);

    // Verify current password
    if ($result && password_verify($currentPassword, $result->password)) {
      $newPassword = $_POST['newPassword'];

      // Check if new password is the same as the current password
      if (password_verify($newPassword, $result->password)) {
        echo '<script>alert("New password cannot be the same as the current password.")</script>';
      } else {
        $hashed_newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update password
        $con = "UPDATE user SET password=:hashed_newPassword WHERE id=:id";
        $chngpwd1 = $pdo->prepare($con);
        $chngpwd1->bindParam(':id', $id, PDO::PARAM_STR);
        $chngpwd1->bindParam(':hashed_newPassword', $hashed_newPassword, PDO::PARAM_STR); // Correct placeholder
        $chngpwd1->execute();

        echo '<script>alert("Your password has been successfully changed.")</script>';
        echo "<script>window.location.href ='dashboard.php'</script>";
      }
    } else {
      echo '<script>alert("Your current password is incorrect.")</script>';
    }
  
  }
?>
<!DOCTYPE html>
<html lang="en">
<script type="text/javascript">
// Function to check if passwords match
function checkpass() {
  if (document.changePassword.newPassword.value != document.changePassword.confirmPassword.value) {
    alert('New Password and Confirm Password fields do not match');
    document.changePassword.confirmPassword.focus();
    return false;
  }
  return true;
}
</script>

<?php @include("includes/head.php"); ?>

<body>
  <div class="container-scroller">
    <?php @include("includes/header.php"); ?>
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <form method="post" onsubmit="return checkpass();" name="changePassword">
                    <div class="form-group row">
                      <label class="col-12" for="currentPassword">Current Password:</label>
                      <div class="col-12">
                        <input type="password" class="form-control" name="currentPassword" id="currentPassword" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-12" for="newPassword">New Password:</label>
                      <div class="col-12">
                        <input type="password" class="form-control" name="newPassword" minlength="4" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-12" for="confirmPassword">Confirm Password:</label>
                      <div class="col-12">
                        <input type="password" class="form-control" name="confirmPassword" id="confirmpassword" minlength="4" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-12">
                        <button type="submit" class="btn btn-info" name="submit">
                          <i class="fa fa-plus"></i> Change
                        </button>
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
    <?php @include("includes/footer.php"); ?>
  </div>

  <?php @include("includes/foot.php"); ?>
</body>
</html>
<?php } ?>
