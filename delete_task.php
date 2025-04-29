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

    $task_id = $_POST["task_id"];

    // Get data from database
    // 2.333: recipe (sql command)
    $sql = "DELETE FROM todos WHERE id = :id";

    // 2.666: prepare material (prepare sql query)
    $query = $database->prepare($sql);

    // 3: cook it (execute the sql query)
    $query->execute(["id" => $task_id]);

    // 4: redirect user
    header("Location: index.php");  
    exit;
?>