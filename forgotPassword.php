
<?php
session_start();
error_reporting(0);
include('config/db.php');

if(isset($_POST['submit']))
  { 
    $password1=($_POST['newPassword']); 
    $password2=($_POST['confirmPassword']); 
   if($password1 != $password2)
    {
      echo "<script>alert('Password and Confirm Password Field do not match  !!');</script>";
    }else
    {
      $email=$_POST['email'];
      $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
      $sql ="SELECT email FROM user WHERE email=:email";
      $query= $pdo -> prepare($sql);
      $query-> bindParam(':email', $email, PDO::PARAM_STR);
      $query-> execute();
      $results = $query -> fetchAll(PDO::FETCH_OBJ);
      if($query -> rowCount() > 0)
      {
      $con="update user set password=:newPassword where email=:email";
      $chngpwd1 = $pdo->prepare($con);
      $chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
      $chngpwd1-> bindParam(':newPassword', $newPassword, PDO::PARAM_STR);
      $chngpwd1->execute();
      echo "<script>alert('Your Password succesfully changed');</script>";
      echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
      }
      else {
      echo "<script>alert('Email id is invalid');</script>"; 
      }
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
  <?php @include("includes/head.php");?>
  <body>
    
    <div class="container-scroller">
    <div class="col-md-12 ">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo " href="dashboard.php"><img class="img-avatar" style="height: 60px; width: auto;" src="assets/images/logo.svg" alt=""></a>
      </div>
      <h5 class="text-center">Event Management System</h5>
    </div>
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        
        <div class="content-wrapper d-flex align-items-center auth">
          
          <div class="row flex-grow">
            
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-dark text-left p-5">
                
                <h3 class="font-weight-dark text-center">Please enter below detail</h3>
                
                <form class="js-validation-signin px-30" method="post" name="chngpwd" onSubmit="return valid();">
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating"> 
                              <label for="email">Email Address</label>
                              <input type="email" class="form-control" required="true" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <label for="password">New Password</label>
                                <input class="form-control" type="password" name="newPassword" required="true"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <label for="cpassword">Confirm Password</label>
                                <input class="form-control" type="password" name="confirmPassword" required="true"/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                    <button name="submit" type="submit" class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn">Reset</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Have Account? <a href="login.php" class="text-info">Click here</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    
  </body>
</html>