<?php
session_start();
include __DIR__ . '/models/model_reviews.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$error = "";
$bookId = '';
$title = '';
$author = '';
$review = '';
$rating = '';

$action = filter_input(INPUT_GET, 'action') ?? 'add';
$id = filter_input(INPUT_GET, 'id');

if (isset($_GET['action'])) {
    $action = filter_input(INPUT_GET, 'action');
    $id = filter_input(INPUT_GET, 'id');

    if ($action == 'edit') {
        $reviewData = getReview($id);
        $bookId = isset($reviewData['book_id']) ? $reviewData['book_id'] : "";
        $title = isset($reviewData['book_title']) ? $reviewData['book_title'] : "";
        $author = isset($reviewData['author']) ? $reviewData['author'] : "";
        $review = isset($reviewData['review']) ? $reviewData['review'] : "";
        $rating = isset($reviewData['rating']) ? $reviewData['rating'] : "";
    } else {
        $bookId = "";
        $title = "";
        $author = "";
        $review = "";
        $rating = "";
    }
}

if (isset($_POST["storeReview"])) {
    $bookId = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);
    $title = filter_input(INPUT_POST, 'title');
    $author = filter_input(INPUT_POST, 'author');
    $review = filter_input(INPUT_POST, 'review');
    $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);

    if ($bookId === false || $bookId == "") $error .= "<li>Please provide the book ID</li>";
    if ($title == "") $error .= "<li>Please provide the book title</li>";
    if ($author == "") $error .= "<li>Please provide the author</li>";
    if ($review == "") $error .= "<li>Please provide the review</li>";
    if ($rating === false || $rating < 1 || $rating > 5) $error .= "<li>Please provide a rating between 1 and 5</li>";
}

if (isset($_POST['storeReview']) && $error == "" && $action == 'add') {
    if (isset($_SESSION['user_id'])) {
        $result = addReview($_SESSION['user_id'], $bookId, $title, $author, $review, $rating);
        if ($result === 'Review Added') {
            header('Location: reviews.view.php');
            exit;
        } else {
            $error .= "<li>$result</li>";
        }
    } else {
        $error .= "<li>Please Log in to add review.</li>";
    }
}

if (isset($_POST['storeReview']) && $error == "" && $action == 'edit') {
    $result = updateReview($id, $title, $author, $review, $rating);
    if ($result === 'Review Updated') {
        header('Location: reviews.view.php');
        exit;
    } else {
        $error .= "<li>$result</li>";
    }
}

if (isset($_POST['deleteReview'])) {
    $result = deleteReview($id);
    if ($result === 'Review Deleted') {
        header('Location: reviews.view.php');
        exit;
    } else {
        $error .= "<li>$result</li>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Reviews</title>
</head>
<body>

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
    input[type=text], input[type=number], textarea {
        width: 200px;
    }
    .error {
        color: red;
    }
    div {
        margin-top: 5px;
    }
</style>

<?php if ($error != ""): ?>
    <div class="error">
        <p>Please fix the following and resubmit</p>
        <ul>
            <?php echo $error; ?>
        </ul>
    </div>
<?php endif; ?>

<h2><?php echo ucfirst($action); ?> Review</h2>

<form name="reviews" method="post">
    <div class="wrapper">
        <div class="label">
            <label>Book ID:</label>
        </div>
        <div>
            <input type="text" name="book_id" value="<?= htmlspecialchars($bookId); ?>" />
        </div>
        <div class="label">
            <label>Book Title:</label>
        </div>
        <div>
            <input type="text" name="title" value="<?= htmlspecialchars($title); ?>" />
        </div>
        <div class="label">
            <label>Author:</label>
        </div>
        <div>
            <input type="text" name="author" value="<?= htmlspecialchars($author); ?>" />
        </div>
        <div class="label">
            <label>Review:</label>
        </div>
        <div>
            <textarea name="review"><?= htmlspecialchars($review); ?></textarea>
        </div>
        <div class="label">
            <label>Rating (1-5):</label>
        </div>
        <div>
            <input type="number" name="rating" min="1" max="5" value="<?= htmlspecialchars($rating); ?>" />
        </div>
        <div>
            &nbsp;
        </div>
        <div>
            <input class="<?= $action == 'edit' ? 'btn btn-info' : 'btn btn-success'; ?>" type="submit" name="storeReview" value="<?= ucfirst($action); ?> Review" />
        </div>  
        <div>
            &nbsp;
        </div>             
        <div>
            <?php if ($action == 'edit'): ?><input class="btn btn-danger" type="submit" name="deleteReview" value="DELETE Review" /><?php endif; ?>
        </div>
        <div>
            <a href="reviews.view.php">View All Reviews</a>
        </div>
    </div>
</form>

</body>
</html>
