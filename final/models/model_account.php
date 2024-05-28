<?php
include (__DIR__ . '/../models/db.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);


function getUser($userId) {
    global $db;
    try {
        $query = 'SELECT * FROM users WHERE user_id = :user_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $userId);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $user;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        exit();
    }
}

function updatePassword($userId, $password) {
    global $db;
    try {
        $query = 'UPDATE users SET password = :password WHERE user_id = :user_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':password', sha1($password));
        $statement->bindValue(':user_id', $userId);
        $statement->execute();
        $statement->closeCursor();
        return 'Password Updated';
    } catch (PDOException $e) {
        return 'Error: ' . $e->getMessage();
    }
}

function deleteUser($userId) {
    global $db;
    try {
        $query = 'DELETE FROM users WHERE user_id = :user_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $userId);
        $statement->execute();
        $statement->closeCursor();
        return 'User Deleted';
    } catch (PDOException $e) {
        return 'Error: ' . $e->getMessage();
    }
}
?>