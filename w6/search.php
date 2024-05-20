<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <title>Search Patients</title>
</head>
<body>
    
    <div class="container">
        <div class="col-sm-12">
            <h1>Patients</h1>
            <a href="patients.view.php">View All Patients</a>

            <?php
            include __DIR__ . '/models/model_patients.php';


            if (!isset($_SESSION['user'])) {
                header('Location: restricted.php');
                exit();
            }

            if (isset($_POST['search'])) {
                $firstName = filter_input(INPUT_POST, 'first_name');
                $lastName = filter_input(INPUT_POST, 'last_name');
                $married = isset($_POST['is_married']) ? '1' : '0';
            } else {
                $firstName = '';
                $lastName = '';
                $married = '';
            }

            $patients = searchPatients($firstName, $lastName, $married);
            ?>

            <form method="POST" name="search_patients">
                <div class="wrapper">
                    <div class="label" style="color:black">
                        <label>First Name:</label>
                    </div>
                    <div>
                        <input type="text" name="first_name" value="<?= htmlspecialchars($firstName); ?>" />
                    </div>
                    <div class="label" style="color:black">
                        <label>Last Name:</label>
                    </div>
                    <div>
                        <input type="text" name="last_name" value="<?= htmlspecialchars($lastName); ?>" />
                    </div>
                    <div class="label" style="color:black">
                        <label>Married (check if yes):</label>
                    </div>
                    <div>
                        <input type="checkbox" name="is_married" <?= $married == '1' ? 'checked' : ''; ?> />
                    </div>

                    <div>&nbsp;</div>
                    <div>
                        <input type="submit" name="search" value="Search" />
                    </div>
                </div>
            </form>
  
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Marital Status</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td><?= $patient['id']; ?></td>
                        <td><?= $patient['patientFirstName']; ?></td>
                        <td><?= $patient['patientLastName']; ?></td>
                        <td><?= $patient['patientMarried']; ?></td>
                        <td>
                            <a href="patients.php?action=edit&id=<?= $patient['id']; ?>" class="btn btn-info" style="text-decoration: none;">Edit</a>
                        </td>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
