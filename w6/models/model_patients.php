<?php
include (__DIR__ . '/../models/db.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

function getPatients() {
    global $db;
    $results = [];

    $stmt = $db->prepare("SELECT * FROM patients ORDER BY patientLastName, patientFirstName, patientBirthDate DESC"); 
    
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $results;
}

function getPatient($id) {
    global $db;
    
    $result = [];

    $stmt = $db->prepare("SELECT * FROM  patients WHERE id = :i");
    
    $binds = array(
        ":i" => $id,
    );

    if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return ($result);
}

function addPatient($pFirstName, $pLastName, $pMarried, $pBirthDate) {
    global $db;
    $result = "";
    $pMarried = ($pMarried === 'yes') ? 1 : 0;

    $sql = "INSERT INTO patients (patientFirstName, patientLastName, patientMarried, patientBirthDate)
            VALUES (:f, :l, :m, :b)";
    $stmt = $db->prepare($sql);

    $binds = array(
        ":f" => $pFirstName,
        ":l" => $pLastName,
        ":m" => $pMarried,
        ":b" => $pBirthDate,
        
        
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $result = 'Data Added';
    }
    
    return ($result);
}

function updatePatient($id, $pFirstName, $pLastName, $pMarried, $pBirthDate) {
    global $db;
    $pMarried = ($pMarried === 'yes') ? 1 : 0;

    $result = "";
    $sql = "UPDATE patients SET patientFirstName = :f, patientLastName = :l, patientMarried = :m, patientBirthDate = :b WHERE id = :id";
    $stmt = $db->prepare($sql);

    $binds = array(
        ":f" => $pFirstName,
        ":l" => $pLastName,
        ":m" => $pMarried,
        ":b" => $pBirthDate,
        ":id" => $id,
    );
    
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $result = 'Data Updated';
        header('Location: patients.view.php');
        exit;
    } else {
        $result = 'Update failed: ' . $stmt->errorInfo()[2];
    }
    
    return $result;
}

function deletePatient($id) {
    global $db;
    
    $results = "Data was not deleted";
    $stmt = $db->prepare("DELETE FROM patients WHERE id=:id");
    
    $stmt->bindValue(':id', $id);
        
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = 'Data Deleted';
    }
    
    return ($results);
}

function searchPatients($firstName, $lastName, $isMarried) {
    global $db;
    $binds = array();

    $sql = "SELECT * FROM patients WHERE 0=0";

    if ($firstName != "") {
        $sql .= " AND patientFirstName LIKE :firstName";
        $binds['firstName'] = '%' . $firstName . '%';
    }

    if ($lastName != "") {
        $sql .= " AND patientLastName LIKE :lastName";
        $binds['lastName'] = '%' . $lastName . '%';
    }

    if ($isMarried !== '') {
        $sql .= " AND patientMarried = :isMarried";
        $binds['isMarried'] = $isMarried;
    }

    $sql .= " ORDER BY patientLastName, patientFirstName";

    $results = array();
    $stmt = $db->prepare($sql);

    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $results;
}

function login($username, $password){
    global $db;
    
    $result = [];
    $stmt = $db->prepare("SELECT * FROM users WHERE username=:username AND password=sha1(:password)");
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $password);
   
    if ($stmt->execute() && $stmt->rowCount() > 0 ) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
     
    return ($result);
}
?>
