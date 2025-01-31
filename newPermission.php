<?php
session_start();
error_reporting(0);
include('config/db.php');

if (strlen($_SESSION['id']) == 0) {
        header('location:logout.php');
} else {

    if (isset($_POST['submit'])) {
        $permission_name = $_POST['permission_name'];
        echo "<script>console.log('Permission Name: " . $permission_name . "');</script>";

        // Insert permission
        $sql = "INSERT INTO permissions (permission_name) VALUES (:permission_name)";
        $query = $pdo->prepare($sql);
        $query->bindParam(':permission_name', $permission_name, PDO::PARAM_STR);
        $query->execute();
        $permission_id = $pdo->lastInsertId();
        echo "<script>alert('Permission added successfully');</script>";
        echo "<script>window.location.href = 'permission.php'</script>";
     }
}
?>

<form class="forms-sample" method="post">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="permission_name">Permission Name</label>
                <input type="text" name="permission_name" class="form-control" id="permission_name" required>
            </div>
        </div>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Add Permission</button>
</form>