<?php
    include __DIR__ . '/models/model_patients.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <title>Patients</title>
</head>
<body>

    <div class="container">
                
        <div class="col-sm-12">
            <h1>Patients</h1>
            <a href="patients.php">Add New Patient</a>

        <?php 
        $patients = getPatients();
        ?>
    
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Married</th>
                        <th>D.O.B</th>


                    </tr>
                </thead>
                <tbody>
            
                <?php foreach ($patients as $p): ?>
                    <tr>
                        <td><?= $p['patientFirstName']; ?></td>
                        <td><?= $p['patientLastName']; ?></td>
                        <td><?= $p['patientMarried']; ?></td> 
                        <td><?= $p['patientBirthDate']; ?></td> 
                        <td><a class="btn btn-info" href="patients.php?action=edit&id=<?= $t['id'] ?>" style="text-decoration: none;">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        
            <br />
            <a class="btn btn-success" href="patients.php">Add New patient</a>
        </div>
    </div>
</body>
</html>