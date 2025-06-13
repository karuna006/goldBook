<?php
    if(!isset($_SESSION['user_details'])) {
        header('Location: ./login');
        exit();
    } else {
        header('Location: ./view/home');
        exit();
    }
?>