<?php
    $database = connectToDB();

    $task_id = $_POST["task_id"];

    // Get data from database
    // 2.333: recipe (sql command)
    $sql = "DELETE FROM todos WHERE id = :id";

    // 2.666: prepare material (prepare sql query)
    $query = $database->prepare($sql);

    // 3: cook it (execute the sql query)
    $query->execute(["id" => $task_id]);

    // 4: redirect user
    header("Location: /");  
    exit;
?>