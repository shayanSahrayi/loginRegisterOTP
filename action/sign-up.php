<?php
require_once("../config/loader.php");

if (isset($_POST['signup'])) {
 
    try {
        // Data
        $userName=$_POST['username'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $password=$_POST['password'];

        // Databse And Insert Query

     
        $query="INSERT INTO users SET username=?,email=?,mobile=?,password=?";

        // Statemnt
        $stmt=$pdo->prepare($query);
        // Bind Value
        $stmt->bindValue(1,$userName);
        $stmt->bindValue(2,$email);
        $stmt->bindValue(3,$phone);
        $stmt->bindValue(4,$password);
        $stmt->execute();
        header("Location:http://localhost/miniproject/LoginRegisterOTP/");
        die();

    } catch (PDOException $e) {
        echo "sql hasas Error : => " . $e->getMessage();
    }
}
