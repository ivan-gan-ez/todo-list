<?php
    $database = connectToDB();

    $task_id = $_POST["task_id"];
    $completion = $_POST["completion"];

    // Get data from database
        // 2.333: recipe (sql command)
        if ($completion == 0){
            $sql = "UPDATE todos SET completed = 1 WHERE id = :id";
        } else {
            $sql = "UPDATE todos SET completed = 0 WHERE id = :id";
        }
        
        // 2.666: prepare material (prepare sql query)
        $query = $database->prepare($sql);
        
        // 3: cook it (execute the sql query)
        $query->execute(["id" => $task_id]);
        
        // 4: redirect user
        header("Location: /");  
        exit;


?>