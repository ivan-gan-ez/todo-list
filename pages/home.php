<?php
    $database = connectToDB();
    
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

<?php require "parts/header.php"?>

    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <ul class="list-group">

        <?php if ( isset($_SESSION["user"]["name"]) ) { ?>

        <?php foreach ($tasks as $i => $task){?>

        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <form method="POST" action="/task/update">
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
                <form method="POST" action="/task/delete">
                <input type="hidden" name="task_id" value="<?= $tasks[$i]["id"];?>" />
                <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                </form>
            </div>
            
        </li>
        
        <?php } ?>

        </ul>
        <div class="mt-4">
          <form class="d-flex justify-content-between align-items-center" method="POST" action="/task/add">
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

        <div class="text-center">
          <a href="/logout">Logout</a>
        </div>

        <?php } else { ?>
          <a href="/login">Login</a>
          <a href="/signup">Sign Up</a>
          </div>
        </div>
        <?php } ?>

<?php require "parts/footer.php"?>