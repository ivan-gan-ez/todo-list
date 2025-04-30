<?php
    // backend code goes before html tag
    // connect to database here
    // 1: database info
    $host = "127.0.0.1";
    $database_name = "todolist";
    $database_user = "root";
    $database_password = "";

    // 2: connect PHP with the MySQL database
    // PDO (PHP Database Object)
    $database = new PDO(
        "mysql:host=$host;dbname=$database_name", //host and db name
        $database_user, //user
        $database_password //password
    );

    // 3: get data from form
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    //4: check for error
    if ( empty($name) || empty($email) || empty($password) || empty($confirm_password) ) {
        echo 'All fields required.';
    } else if ( $password !== $confirm_password ){
        echo 'Your passwords do not match.';
    } else {

         // 4.333: recipe (sql command)
         $sql = "INSERT INTO users (`name`, `email`, `password`) VALUES (:name, :email, :password)";

         // 4.666: prepare material (prepare sql query)
         $query = $database->prepare($sql);
 
         // 5: cook it (execute the sql query)
         $query->execute(["name" => $name, "email" => $email, "password" => password_hash($password, PASSWORD_DEFAULT)]);
         
         // 6: redirect user
        header("Location: login.php");  
        exit;
 
    };
?>