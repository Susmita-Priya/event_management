<?php
session_start();
error_reporting(0);
include('config/db.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the email exists
    $sql = "SELECT * FROM user WHERE email = :email";
    $query = $pdo->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    // Check if a user with the provided email exists
    if ($query->rowCount() > 0) {
        $result = $query->fetch(PDO::FETCH_OBJ); // Fetch the user record

        // Verify the entered password with the hashed password
        if (password_verify($password, $result->password)) {
            // Set session variables
            $_SESSION['id'] = $result->id;          
            $_SESSION['login'] = $result->email;  

            // echo "<script>alert('Login successful');</script>";
            // Redirect to the dashboard
            echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
        } else {
            // If the password doesn't match
            echo "<script>alert('Invalid password. Please try again.');</script>";
        }
    } else {
        // If the email doesn't exist in the database
        echo "<script>alert('Invalid email. Please try again.');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php");?>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth p-0">
                <div class="row flex-grow">
                   
                    <div class="col-md-8 p-0">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="assets/images/slider2.jpg" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="assets/images/slider1.jpeg" alt="Second slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 p-0">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo" align="center">
                         
        <div class="text-center navbar-brand-wrapper d-flex flex-column align-items-center justify-content-center">
            <!-- <a class="navbar-brand brand-logo" href="dashboard.php">
                <img class="img-avatar" style="height: 60px; width: auto;" src="assets/images/logo.svg" alt="Ollyo">
            </a> -->
            <h4 class="text-center mt-2">Event Management System</h4>
        </div>
        <div class="brand-logo" align="center" style="margin-top: 60px;">
                                <h3 class="text-muted mt-4">
                                    Login Here
                                </h3>
                            </div>
                            <form role="form" id="" method="post" enctype="multipart/form-data" class="">
                                <div class="form-group first">
                                    <input type="email" class="form-control form-control-lg" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group last">
                                    <input type="password" name="password" class="form-control form-control-lg" minlength="4" placeholder="Password" required>
                                </div>
                                <div class="mt-3">
                                    <button name="login" class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    <a href="forgot_password.php" class="text-secondary">
                                        Forgot Password
                                    </a>
                                </div>
                                <div class="text-center text-muted mt-4 font-weight-light">
                                    Haven't an account?&nbsp;&nbsp;
                                    <a href="registration.php" class="text-secondary">
                                    <strong style="color: blue;">Registration</strong>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php @include("includes/foot.php");?>
</body>
</html>
