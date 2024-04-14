<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="form-wrapper">
    <form name="patient" method="post">
    
        <div class="form-control">
            <label for="firstName">First Name:</label><br />
            <input type="text" name="firstName" value="<?= $firstName; ?>">
        </div>

        <div class="form-control">
            <label for="lastName">Last Name:</label><br />
            <input type="text" name="lastName" value="<?= $lastName; ?>">
        </div>

        <div class="form-control">
            <label for="married">Married:</label><br />
            <select id="married" name="married">
                <option value="">Select</option>
                <option value="yes" <?= ($married == 'yes') ? 'selected' : ''; ?>>Yes</option>
                <option value="no" <?= ($married == 'no') ? 'selected' : ''; ?>>No</option>
            </select>
        </div>

        <div class="form-control">
            <label for="birthDate">birthday</label><br />
            <input type="date" name="birthDate" value="<?= $birthDate; ?>">
        </div>

        <div class="form-control">
            <label for="heightFt">Height feet</label><br />
            <input type="text" name="heightFt" value="<?= $heightFt; ?>">
        </div>

        <div class="form-control">
            <label for="heightInch">Height Inch</label><br />
            <input type="text" name="heightInch" value="<?= $heightInch; ?>">
        </div>

        <div class="form-control">
            <label for="weight">weight</label><br />
            <input type="text" name="weight" value="<?= $weight; ?>">
        </div>

       
        <div class="form-submit">
            <input type="submit" name="patient_intake_submit" value="Submit">
        </div>
    </form>
</div>
<?php if (isset($_POST["patient_intake_submit"])) : ?>

<?php

$bmi = BMI($heightFt, $heightInch, $weight);

$age = age($birthDate);
?>
<hr />
<h2>Patient Information</h2>
<p><span class="result-label">First Name:</span> <?= $firstName; ?></p>
<p><span class="result-label">Last Name:</span> <?= $lastName; ?></p>
<p><span class="result-label">Married:</span> <?= $married; ?></p>
<p><span class="result-label">Birth Date:</span> <?= $birthDate; ?></p>
<p><span class="result-label">Height:</span> <?= $heightFt . "'" . $heightInch . "''"; ?></p>
<p><span class="result-label">Weight:</span> <?= $weight; ?></p>
<p><span class="result-label">Age:</span> <?= $age; ?></p>
<p><span class="result-label">BMI:</span> <?= number_format($bmi, 1); ?></p>
<p><span class="result-label">Classification:</span> <?= bmiDescription($bmi); ?></p>

<?php endif; ?>

</body>
</html>
