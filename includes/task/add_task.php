<?php
    $database = connectToDB();

    $task = $_POST["task"];

    if (empty($task)){
        header("Location: index.php");  
        exit;
    } else {
        // Get data from database
        // 2.333: recipe (sql command)
        $sql = "INSERT INTO todos (`label`) VALUES (:task)";

        // 2.666: prepare material (prepare sql query)
        $query = $database->prepare($sql);

        // 3: cook it (execute the sql query)
        $query->execute(["task" => $task]);

        // 4: redirect user
        header("Location: /");  
        exit;
    }
?>