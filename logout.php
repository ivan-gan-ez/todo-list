<?php

    //for logout

    // 0: start session (necessary when you want to use $_SESSION in a page)
    session_start();

    // 1: remove user session
    unset( $_SESSION["user"] );

    // 2: redirect user
    header("Location: index.php");
    exit;
?>