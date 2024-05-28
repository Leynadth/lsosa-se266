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
    <title>Search Book Reviews</title>
</head>
<body>
    
    <div class="container">
        <div class="col-sm-12">
            <h1>Book Reviews</h1>
            <a href="reviews.view.php">View All Reviews</a>

            <?php
            include __DIR__ . '/models/model_reviews.php';

            if (!isset($_SESSION['user'])) {
                header('Location: restricted.php');
                exit();
            }

            if (isset($_POST['search'])) {
                $title = filter_input(INPUT_POST, 'title');
                $author = filter_input(INPUT_POST, 'author');
            } else {
                $title = '';
                $author = '';
            }

            $reviews = searchReviews($title, $author);
            ?>

            <form method="POST" name="search_reviews">
                <div class="wrapper">
                    <div class="label" style="color:black">
                        <label>Book Title:</label>
                    </div>
                    <div>
                        <input type="text" name="title" value="<?= htmlspecialchars($title); ?>" />
                    </div>
                    <div class="label" style="color:black">
                        <label>Author:</label>
                    </div>
                    <div>
                        <input type="text" name="author" value="<?= htmlspecialchars($author); ?>" />
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
                        <th>Book Title</th>
                        <th>Author</th>
                        <th>Review</th>
                        <th>Rating</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($reviews as $review): ?>
                    <tr>
                        <td><?= $review['review_id']; ?></td>
                        <td><?= $review['book_title']; ?></td>
                        <td><?= $review['author']; ?></td>
                        <td><?= $review['review']; ?></td>
                        <td><?= $review['rating']; ?></td>
                        <td>
                            <a href="reviews.php?action=edit&id=<?= $review['review_id']; ?>" class="btn btn-info" style="text-decoration: none;">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
