<?php
include('includes/auth.php');
check_login();

if (isset($_POST['submit'])) {
    $id = $_SESSION['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $sql = "update user set firstName=:firstName,lastName=:lastName,phone=:phone,email=:email where id=:id";
    $query = $pdo->prepare($sql);
    $query->bindParam(':firstName', $firstName, PDO::PARAM_STR);
    $query->bindParam(':lastName', $lastName, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':phone', $phone, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    echo '<script>alert("Profile has been updated")</script>';
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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    $id = $_SESSION['id'];
                                    $sql = "SELECT * from  user where id=:id";
                                    $query = $pdo->prepare($sql);
                                    $query->bindParam(':id', $id, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) {
                                    ?>
                                        <form method="post">
                                                <div class="form-group row">
                                                    <label class="col-12" for="register1-email">First Name:
                                                    </label>
                                                    <div class="col-12">
                                                        <input type="text" class="form-control" name="firstName" value="<?php echo $row->firstName; ?>" required='true'>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12" for="register1-email">Last Name:</label>
                                                    <div class="col-12">
                                                        <input type="text" class="form-control" name="lastName" value="<?php echo $row->lastName; ?>" required='true'>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12" for="register1-password">Email:</label>
                                                    <div class="col-12">
                                                        <input type="email" class="form-control" name="email" value="<?php echo $row->email; ?>" required='true' readonly="true">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12" for="register1-password">Contact Number:</label>
                                                    <div class="col-12">
                                                        <input type="text" class="form-control" name="phone" value="<?php echo $row->phone; ?>" required='true' maxlength='11'>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12" for="register1-password">Registration Date:</label>
                                                    <div class="col-12">
                                                        <input type="text" class="form-control" name="createDate" value="<?php echo $row->created_at; ?>" readonly="true">
                                                    </div>
                                                </div>
                                                <br>
                                                <button type="submit" name="submit" class="btn btn-primary btn-fw mr-2" style="float: left;">update</button>
                                        </form>
                                </div>
                                     <?php }
                                    } ?>
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