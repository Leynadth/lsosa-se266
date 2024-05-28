<?php 

session_start();
        include __DIR__ . '/models/model_reviews.php';
        
        include __DIR__ . '/functions.php';

        session_unset(); 
        session_destroy(); 

        header('Location: reviews.view.php');
        ?>