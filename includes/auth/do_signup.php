<?php
    $database = connectToDB();

    // 3: get data from form
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // 3.25: sql
    $sql = "SELECT * FROM users where email = :email";

    // 3.5: prepare
    $query = $database->prepare($sql);

    // 3.75: execute
    $query->execute(["email" => $email]);

    // 4: fetch
    $user = $query->fetch();

    // 5: check for error
    if ( $user ) {
        echo "The email provided already exists in our system. Please log in.";
    } else {
        if ( empty($name) || empty($email) || empty($password) || empty($confirm_password) ) {
            echo 'All fields required.';
        } else if ( $password !== $confirm_password ){
            echo 'Your passwords do not match.';
        } else {
    
             // 5.333: recipe (sql command)
             $sql = "INSERT INTO users (`name`, `email`, `password`) VALUES (:name, :email, :password)";
    
             // 5.666: prepare material (prepare sql query)
             $query = $database->prepare($sql);
     
             // 6: cook it (execute the sql query)
             $query->execute(["name" => $name, "email" => $email, "password" => password_hash($password, PASSWORD_DEFAULT)]);
             
             // 7: redirect user
            header("Location: login");  
            exit;
     
        };
    }
?>