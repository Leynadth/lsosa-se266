<?php 

session_start();
        include __DIR__ . '/models/model_patients.php';
        
        include __DIR__ . '/functions.php';

        session_unset(); 
        session_destroy(); 

        header('Location: patients.view.php');
        ?>