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

    // Get data from database
    // 2.25: recipe (sql command)
    $sql = "SELECT * FROM todos";

    // 2.5: prepare material (prepare sql query)
    $query = $database->prepare($sql);

    // 2.75: cook it (execute the sql query)
    $query->execute();

    // 3: eat (fetch all results from the query)
    $tasks = $query->fetchAll();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>TODO App</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #f1f1f1;
      }
    </style>
  </head>
  <body>
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <ul class="list-group">

        <?php foreach ($tasks as $i => $task){?>

        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <form method="POST" action="update_task.php">
                    <input type="hidden" name="task_id" value=<?= $tasks[$i]["id"];?> />
                    <input type="hidden" name="completion" value=<?= $tasks[$i]["completed"];?> />

                        <?php if ($tasks[$i]["completed"] === 1){ ?>
                            <button class="btn btn-sm btn-success">
                            <i class='bi bi-check-square'></i>
                            </button>
                            <span class="ms-2 text-decoration-line-through"><?= $tasks[$i]["label"]?></span>
                            </form>
                        <?php } else { ?>
                            <button class="btn btn-sm btn-light">
                            <i class='bi bi-square'></i>
                            </button>
                            <span class="ms-2"><?= $tasks[$i]["label"]?></span>
                            </form>
                        <?php } ?>
            </div>
            <div>
                <form method="POST" action="delete_task.php">
                <input type="hidden" name="task_id" value="<?= $tasks[$i]["id"];?>" />
                <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                </form>
            </div>
            
        </li>
        
        <?php } ?>

        </ul>
        <div class="mt-4">
          <form class="d-flex justify-content-between align-items-center" method="POST" action="add_task.php">
            <input
              type="text"
              class="form-control"
              placeholder="Add new item..."
              name="task"
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
