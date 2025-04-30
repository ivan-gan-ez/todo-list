<?php

    // 0: start session (necessary when you want to use $_SESSION in a page)
    session_start();

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

    // 3: get data from login page
    $email = $_POST["email"];
    $password = $_POST["password"];

    // 4: check for error
    if ( empty($email) || empty($password) ) {
        echo 'All fields required.';
    } else {
        // 4.25: sql
        $sql = "SELECT * FROM users where email = :email";

        // 4.5: prepare
        $query = $database->prepare($sql);

        // 4.75: execute
        $query->execute(["email" => $email]);

        // 5: fetch
        $user = $query->fetch();

        // 6: check if user exists
        if ( $user ) {

            // 7: check if password matches
            if ( password_verify( $password, $user["password"] ) ){

                // 8: store user data in session
                $_SESSION["user"] = $user;

                // 9: redirect user back to main page
                header("Location: index.php");
                exit;

            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "Invalid email.";
        }
    };
?>