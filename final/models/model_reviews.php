<?php
include (__DIR__ . '/../models/db.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

function getReviews() {
    global $db;
    $results = [];

    $stmt = $db->prepare("SELECT * FROM reviews ORDER BY book_title, author");
    
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $results;
}

function getReview($id) {
    global $db;
    $result = [];

    $stmt = $db->prepare("SELECT * FROM Reviews WHERE review_id = :id");
    $stmt->bindValue(':id', $id);

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return $result;
}

function addReview($userId, $bookId, $title, $author, $review, $rating) {
    global $db;
    $result = "";

    $sql = "INSERT INTO reviews (user_id, book_id, book_title, author, review, rating)
            VALUES (:user_id, :book_id, :title, :author, :review, :rating)";
    $stmt = $db->prepare($sql);

    $binds = array(
        ":user_id" => $userId,
        ":book_id" => $bookId,
        ":title" => $title,
        ":author" => $author,
        ":review" => $review,
        ":rating" => $rating,
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $result = 'Review Added';
    } else {
        $result = 'Error: ' . $stmt->errorInfo()[2];
    }

    return $result;
}

function updateReview($id, $title, $author, $review, $rating) {
    global $db;
    $result = "";

    $sql = "UPDATE reviews SET book_title = :title, author = :author, review = :review, rating = :rating WHERE review_id = :id";
    $stmt = $db->prepare($sql);

    $binds = array(
        ":title" => $title,
        ":author" => $author,
        ":review" => $review,
        ":rating" => $rating,
        ":id" => $id,
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $result = 'Review Updated';
    } else {
        $result = 'Update failed: ' . $stmt->errorInfo()[2];
    }

    return $result;
}

function deleteReview($id) {
    global $db;
    $result = "Review not deleted";

    $stmt = $db->prepare("DELETE FROM reviews WHERE review_id = :id");
    $stmt->bindValue(':id', $id);

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $result = 'Review Deleted';
    }

    return $result;
}

function searchReviews($title, $author) {
    global $db;
    $binds = [];

    $sql = "SELECT * FROM reviews WHERE 0=0";

    if ($title != "") {
        $sql .= " AND book_title LIKE :title";
        $binds[':title'] = '%' . $title . '%';
    }

    if ($author != "") {
        $sql .= " AND author LIKE :author";
        $binds[':author'] = '%' . $author . '%';
    }

    $results = [];
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
