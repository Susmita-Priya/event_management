<?php
session_start();
error_reporting(0);
include('config/db.php');

if (isset($_POST['register'])) {
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];

    // Check if the password and confirm password match
    if ($password == $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // Query to insert the user details into the database
        $sql = "INSERT INTO user (firstName, lastName, email, phone, password) VALUES (:firstName, :lastName, :email, :phone, :password)";
        $query = $pdo->prepare($sql);
        $query->bindParam(':firstName', $first_name, PDO::PARAM_STR);
        $query->bindParam(':lastName', $last_name, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':phone', $phone, PDO::PARAM_STR);
        $query->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        $query->execute();

        if ($query) {
            echo "<script>alert('Registration successful');</script>";
            // Redirect to the dashboard
            echo "<script type='text/javascript'> document.location ='login.php'; </script>";
        } else {
            // Registration failed
            echo "<script>alert('Something went wrong. Please try again');</script>";
        }
    } else {
        // Passwords do not match
        echo "<script>alert('Passwords do not match');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php"); ?>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth p-0">
                <div class="row flex-grow">

                    <div class="col-md-8 p-0">

                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="assets/images/slider1.jpeg" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="assets/images/slider2.jpg" alt="Second slide">
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
                            <div class="text-center navbar-brand-wrapper d-flex flex-column align-items-center justify-content-center">
                                <a class="navbar-brand brand-logo" href="dashboard.php">
                                    <img class="img-avatar" style="height: 60px; width: auto;" src="assets/images/logo.svg" alt="Ollyo">
                                </a>
                                <h4 class="text-center mt-2">Event Management System</h4>
                            </div>
                            <div class="brand-logo" align="center" style="margin-top: 20px;">
                                <h3 class="text-muted mt-4">
                                    Registration Form
                                </h3>
                            </div>
                            <form role="form" method="post" enctype="multipart/form-data" class="" onsubmit="return validateForm()">
                                <div class="form-group first">
                                    <input type="text" class="form-control form-control-lg" name="firstName" placeholder="First Name" required>
                                </div>
                                <div class="form-group first">
                                    <input type="text" class="form-control form-control-lg" name="lastName" placeholder="Last Name" required>
                                </div>
                                <div class="form-group first">
                                    <input type="email" class="form-control form-control-lg" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group last">
                                    <input type="text" class="form-control form-control-lg" name="phone" placeholder="Phone" maxlength="13" required>
                                </div>
                                <div class="form-group last">
                                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" minlength="4" required>
                                </div>
                                <div class="form-group last">
                                    <input type="password" name="confirmPassword" class="form-control form-control-lg" placeholder="Confirm Password" minlength="4" required>
                                </div>
                                <div class="mt-3">
                                    <button name="register" class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn">REGISTER</button>
                                </div>
                                <div class="text-muted text-center mt-4 font-weight-light">
                                    Already have an account?
                                    <a href="login.php" class="text-secondary">
                                        <strong style="color: blue;">Sign In</strong>
                                    </a>
                                </div>
                            </form>

                            <script>
                                function validateForm() {
                                    var password = document.forms[0]["password"].value;
                                    var confirmPassword = document.forms[0]["confirmPassword"].value;
                                    if (password != confirmPassword) {
                                        alert("Passwords do not match");
                                        return false;
                                    }
                                    return true;
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php @include("includes/foot.php"); ?>
</body>

</html>