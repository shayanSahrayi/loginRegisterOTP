<?php
require_once("../config/loader.php");
if (isset($_POST['login'])) {


    try {
        // Data
        $key = $_POST['key'];
        $password = $_POST['password'];

        // Query

        $query = "SELECT * FROM users WHERE (username=:key OR email = :key OR mobile = :key) AND (password=:password) LIMIT 1";
        
        // stmt
        $stmt=$pdo->prepare($query);
        
        // Bind Values
        $stmt->bindValue(':key',$key);
        $stmt->bindValue(':password',$password);
        $stmt->execute();
        $result=$stmt->rowCount();
        
        
        if($result==1){
            header('Location:../index.php?is_login');
            die();
        }
        else{
            header('Location:../index.php?not_login');
            die();
        }
        
    } catch (PDOException $e) {
        echo "sql has Error => " . $e->getMessage();
    }
}
