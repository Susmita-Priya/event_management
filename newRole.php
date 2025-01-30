<?php
session_start();
error_reporting(0);
include('config/db.php');

if (strlen($_SESSION['id']) == 0) {
  header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $role_name = $_POST['role_name'];
        $permissions = $_POST['permissions'] ?? [];

        // Insert role
        $sql = "INSERT INTO roles (role_name) VALUES (:role_name)";
        $query = $pdo->prepare($sql);
        $query->bindParam(':role_name', $role_name, PDO::PARAM_STR);
        $query->execute();
        $role_id = $pdo->lastInsertId();

        // Insert permissions for the role
        foreach ($permissions as $permission_id) {
            $sql = "INSERT INTO role_permissions (role_id, permission_id) VALUES (:role_id, :permission_id)";
            $query = $pdo->prepare($sql);
            $query->bindParam(':role_id', $role_id, PDO::PARAM_STR);
            $query->bindParam(':permission_id', $permission_id, PDO::PARAM_STR);
            $query->execute();
        }

        echo "<script>alert('Role added successfully');</script>";
        echo "<script>window.location.href = 'role.php'</script>";
    }
}
?>
<form class="forms-sample" method="post" onsubmit="return validateForm()">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="role_name">Role Name</label>
                <input type="text" name="role_name" class="form-control" id="role_name" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="permissions">Permissions</label>
                <?php
                $sql = "SELECT * FROM permission";
                $query = $pdo->prepare($sql);
                $query->execute();
                $permissions = $query->fetchAll(PDO::FETCH_OBJ);
                foreach ($permissions as $permission) {
                    echo "<div class='form-check' style='margin-left: 40px;'>
                  <input type='checkbox' name='permissions[]' value='$permission->permission_id' class='form-check-input' id='permission_$permission->permission_id'>
                  <label class='form-check-label' for='permission_$permission->permission_id'>$permission->permission_name</label>
                </div>";
                }
                ?>
            </div>
        </div>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Add Role</button>
</form>