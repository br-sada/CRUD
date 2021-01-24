<?php
    session_start();
    if(!$_SESSION['nome']) {
        session_destroy();
        header('location: ../../index.html');
        exit();
    }
?>