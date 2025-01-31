<?php
session_start();
error_reporting(0);
include('config/db.php');
function check_login()
{
	if(strlen($_SESSION['id'])==0)
	{	
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="login.php";		
		$_SESSION["id"]="";
		header("Location: http://$host$uri/$extra");
	}
}
function check_permission($permission) {
    global $pdo;

    if (!isset($_SESSION)) {
        session_start();
    }

    $id = $_SESSION['id']; // Assuming you store user ID in session
    $sql = "SELECT role_id FROM user WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        return false; // User not found
    }

    $role_id = $user['role_id'];

    // Check if the role has the required permission
    $sql = "SELECT p.permission_name 
            FROM permissions p
            JOIN role_permissions rp ON p.permission_id = rp.permission_id
            WHERE rp.role_id = :role_id AND p.permission_name = :permission";
    $query = $pdo->prepare($sql);
    $query->bindParam(':role_id', $role_id, PDO::PARAM_INT);
    $query->bindParam(':permission', $permission, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result !== false; // Return true if permission is found
}

?>