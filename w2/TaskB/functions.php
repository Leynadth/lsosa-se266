<?php

function age ($birthDate) {
    $date = new DateTime($birthDate);
    $now = new DateTime();
    $interval = $now->diff($date);
    return $interval->y;
 }
 
 
 function isDate($dt) {
    $date_arr  = explode('-', $dob);
    return checkdate($date_arr[1], $date_arr[2], $date_arr[0]);
 }

 function bmi ($heightFt, $heightInch, $weight)
 {
    $heightInch = ($heightFt * 12) + $heightInch;

    $heightMeter = $heightInch * 0.0254;

    $weightKg = $weight / 2.20462;

    $bmi = $weightKg / ($heightMeter * $heightMeter);

    return $bmi;
}


 
 function bmiDescription ($bmi) {
    if ($bmi < 18.5) {
        return "Underweight";
    } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
        return "Normal weight";
    } elseif ($bmi >= 25 && $bmi <= 29.9) {
        return "Overweight";
    } else {
        return "Obesity";
    }
 }




?>