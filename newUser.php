<?php
session_start();
error_reporting(0);
include('config/db.php');

if (strlen($_SESSION['id']) == 0) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $first_name = $_POST['firstName'];
  $last_name = $_POST['lastName'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $role_id = $_POST['role_id'];
  $password = $_POST['password']; 
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  $sql = "INSERT INTO user (firstName, lastName, email, phone, password, role_id) VALUES (:firstName, :lastName, :email, :phone, :password, :role_id)";
  $query = $pdo->prepare($sql);
  $query->bindParam(':firstName', $first_name, PDO::PARAM_STR);
  $query->bindParam(':lastName', $last_name, PDO::PARAM_STR);
  $query->bindParam(':email', $email, PDO::PARAM_STR);
  $query->bindParam(':phone', $phone, PDO::PARAM_STR);
  $query->bindParam(':password', $hashed_password, PDO::PARAM_STR);
  $query->bindParam(':role_id', $role_id, PDO::PARAM_INT);
  $query->execute();

  if ($query) {
    echo "<script>alert('User added successfully');</script>";
    echo "<script>window.location.href = 'user.php'</script>";
} else {
    // Registration failed
    echo "<script>alert('Something went wrong. Please try again');</script>";
}

}
}
?>

<!-- newUser.php -->
<form class="forms-sample" method="post" onsubmit="return validateForm()">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="firstName" class="form-control" id="firstName" required>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="lastName" class="form-control" id="lastName" required>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" id="email" required>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" class="form-control" id="phone" required>
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
            echo "<option value='$role->role_id'>$role->role_name</option>";
          }
          ?>
        </select>
      </div>
    </div>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Add User</button>
</form>