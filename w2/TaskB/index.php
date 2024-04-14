<?php
require 'functions.php';

$firstName = '';
$lastName = '';
$married = '';
$birthDate = '';
$heightFt = '';
$heightInch = '';
$weight = '';

if (isset($_POST["patient_intake_submit"])) {
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $married = filter_input(INPUT_POST, 'married', FILTER_SANITIZE_STRING);
    $birthDate = filter_input(INPUT_POST, 'birthDate', FILTER_SANITIZE_STRING);
    $heightFt = filter_input(INPUT_POST, 'heightFt', FILTER_VALIDATE_INT);
    $heightInch = filter_input(INPUT_POST, 'heightInch', FILTER_VALIDATE_INT);
    $weight = filter_input(INPUT_POST, 'weight', FILTER_VALIDATE_FLOAT);
}

require 'index.view.php';
?>
