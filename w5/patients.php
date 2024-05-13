<?php
    include __DIR__ . '/models/model_patients.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients</title>
</head>
<body>
    

<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $error = "";
    
    $action = filter_input(INPUT_GET, 'action') ?? 'add';
    $id = filter_input(INPUT_GET, 'id');


    if (isset($_GET['action'])) {
        $action = filter_input(INPUT_GET, 'action');
        $id = filter_input(INPUT_GET, 'id');

        if($action == 'edit'){
            $patient = getPatient($id);
            $firstName = $firstName['patientFirstName'];
            $lastName = $lastName['patientLastName'];
            $married = $married['patientMarried'];
            $birthDate = $birthDate['patientBirthDate'];
        }else{
            $firstName = "";
            $lastName = "";
            $married = "";
            $birthDate = "";

        }
    } 






    $firstName = '';
    $lastName = '';
    $married = '';
    $birthDate = '';
    $heightFt = '';
    $heightInch = '';
    $weight = '';
    
    if (isset($_POST["storePatient"])) {
        $firstName = filter_input(INPUT_POST, 'firstName' );
        $lastName = filter_input(INPUT_POST, 'lastName');
        $married = filter_input(INPUT_POST, 'married' );
        $birthDate = filter_input(INPUT_POST, 'birthDate');
        $heightFt = filter_input(INPUT_POST, 'heightFt');
        $heightInch = filter_input(INPUT_POST, 'heightInch');
        $weight = filter_input(INPUT_POST, 'weight');

        if ($firstName == "") $error .= "<li>Please provide first name</li>";
        if ($lastName == "") $error .= "<li>Please provide last name</li>";
        if ($married == "") $error .= "<li>Please provide marital status</li>";
        if ($birthDate == "") $error .= "<li>Please provide birth date</li>";
        if ($heightFt == "") $error .= "<li>Please provide height (feet)</li>";
        if ($heightInch == "") $error .= "<li>Please provide height (inches)</li>";
        if ($weight == "") $error .= "<li>Please provide weight</li>";
    }

    if (isset($_POST['storePatient']) && $error == "" && $action == 'add'){
        addTeam ($firstName, $lastName, $married, $birthDate);
        header('Location: ../patient.view.php');
        exit;
    }

    if (isset($_POST['storePatient']) && $error == "" && $action == 'edit'){
        updateTeam ($id, $firstName, $lastName, $married, $birthDate);
        header('Location: ../patient.view.php');
        exit;
    }

    if(isset($_POST['deletePatient'])){
        deleteTeam($id);
        header('Location: ../patient.view.php');
        exit;
    }

?>

<style type="text/css">
       .wrapper {
            display: grid;
            grid-template-columns: 180px 400px;
        }
        .label {
            text-align: right;
            padding-right: 10px;
            margin-bottom: 5px;
        }
        label {
           font-weight: bold;
        }
        input[type=text] {width: 200px;}
        .error {color: red;}
        div {margin-top: 5px;}
    </style>

<?php
        if (isset($_POST['storePatient']) && $error == ""):
            $result = addPatient($firstName, $lastName, $married, $birthDate);
    ?>

<h2>New patient<?php echo " $firstName"; ?> was added</h2>
        
        <a href="patients.view.php">View All patients</a>
    <?php
            exit;
        endif;
    ?>

    <h2>New patient</h2>

    <form name="patients" method="post">
        <?php
            if ($error != ""):
        ?>
                
        <div class="error">
            <p>Please fix the following and resubmit</p>
            <ul>
                <?php echo $error; ?>
            </ul>
        </div>
        <?php
            endif;
        ?>

<div class="wrapper">
    <div class="label">
        <label>First Name:</label>
    </div>
    <div>
        <input type="text" name="firstName" value="<?= $firstName; ?>" />
    </div>
    <div class="label">
        <label>Last Name:</label>
    </div>
    <div>
        <input type="text" name="lastName" value="<?= $lastName; ?>" />
    </div>
    <div class="label">
        <label>Married:</label>
    </div>
    <div>
        <input type="text" name="married" value="<?= $married; ?>" />
    </div>
    <div class="label">
        <label>Birth Date:</label>
    </div>
    <div>
        <input type="date" name="birthDate" value="<?= $birthDate; ?>" />
    </div>
    <div class="label">
        <label>Height (Feet):</label>
    </div>
    <div>
        <input type="text" name="heightFt" value="<?= $heightFt; ?>" />
    </div>
    <div class="label">
        <label>Height (Inches):</label>
    </div>
    <div>
        <input type="text" name="heightInch" value="<?= $heightInch; ?>" />
    </div>
    <div class="label">
        <label>Weight:</label>
    </div>
    <div>
        <input type="text" name="weight" value="<?= $weight; ?>" />
    </div>
    <div>
        &nbsp;
    </div>
    <div>
        <input class="<?= $action == 'edit' ? 'btn btn-info' : 'btn btn-success'; ?>" type="submit" name="storePatient" value="<?= ucfirst($action); ?> Patient Information" />
    </div>  
    <div>
        &nbsp;
    </div>             
    <div>
        <?php if($action == 'edit'): ?><input class="btn btn-danger" type="submit" name="deletePatient" value="DELETE Patient" /><?php endif; ?>
    </div>

    
    <a href="patients.view.php">View All patients</a>

</div>


</form>
<p>

</p>
    </body>
</html>