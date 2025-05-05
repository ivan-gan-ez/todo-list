<?php

// 0: start session (necessary when you want to use $_SESSION in a page)
session_start();

require "includes/functions.php";

// decide stuff because that's the entire point of a router

// localhost:9000/ -> home.php
// localhost:9000/login -> login.php
// localhost:9000/signup -> signup.php
// localhost:9000/logout -> logout.php

// global variable $_SERVER

$path = $_SERVER["REQUEST_URI"];

switch ($path) {

  case '/login':
    require "pages/login.php";
    break;

  case '/signup':
    require "pages/signup.php";
    break;

  case '/logout':
    require "pages/logout.php";
    break;

  case '/login':
    require "pages/login.php";
    break;
    
  case '/auth/login':
    require "includes/auth/do_login.php";
    break;

  case '/auth/signup':
    require "includes/auth/signup.php";
    break;

  case '/task/add':
    require "includes/task/add_task.php";
    break;

  case '/task/delete':
    require "includes/task/delete_task.php";
    break;
    
  case '/task/update':
    require "includes/task/update_task.php";
    break;
  
  default:
    require "pages/home.php";
    break;
};

?>