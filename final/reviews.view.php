<?php
session_start();

include __DIR__ . '/models/model_reviews.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChapterChat</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        table {
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            background-color: #FFFFFF;
            color: black;
            padding: 10px;
            display: flex;
        }
        .nav {
            display: flex;
            justify-content: space-around;
            width: 50%;
            margin-left: 20%;
            padding-top: 50px;
        }
        .footer {
            background-color: #D9D9D9;
            color: black;
            padding: 10px;
            display: flex;
        }
        #main {
            display: flex;
            background-color: #BBBBBB;
            padding: 20px;
            justify-content: space-between;
        }
        .maincontent {
            padding: 30px;
            background-color: #FFFFFF;
            display: flex;
        }
        .nav {
            display: flex;
            gap: 20px;
        }
        .nav .button, .additional-links .button {
            text-decoration: none;
            color: #000;
            background-color: #ccc;
            padding: 10px 20px;
            border-radius: 25px;
            transition: background-color 0.3s ease;
            width: 120px; 
            text-align: center; 
        }
        .additional-links{
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 10px;}
        .nav .button:hover, .additional-links .button:hover {
            background-color: #e0e0e0;
        }
        .social-icons img {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <header>
        <div class="header">
            <div>            
                <img style="width: 120px;" src="images/logo.webp" alt="ChapterChat Logo">
            </div>
            <div style="padding-top: 20px;">
                <h1>ChapterChat</h1>
            </div>
            <div class="nav">
                <a href="reviews.view.php" class="button">Home</a>
                <a href="https://www.amazon.com/amz-books/book-deals" class="button">Buy Books</a>
                <a href="login.php" class="button">Login</a>
            </div>
        </div>
    </header>
    <main id="main">
        <div class="col-sm-8 maincontent">
            <h1>Book Reviews</h1>
            <?php
            if (isset($_POST['deleteReview'])) {
                $id = filter_input(INPUT_POST, 'reviewId');
                deleteReview($id);
            }

            $reviews = getReviews();
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Author</th>
                        <th>Review</th>
                        <th>Rating</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reviews as $review): ?>
                    <tr>
                        <td><?= htmlspecialchars($review['book_title']); ?></td>
                        <td><?= htmlspecialchars($review['author']); ?></td>
                        <td><?= htmlspecialchars($review['review']); ?></td>
                        <td><?= htmlspecialchars($review['rating']); ?></td>
                        <td>
                            <a class="btn btn-info" href="reviews.php?action=edit&id=<?= $review['review_id'] ?>" style="text-decoration: none;">Edit</a>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="reviewId" value="<?= $review['review_id']; ?>">
                                <input type="submit" name="deleteReview" value="Delete" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <br />
        </div>
        <br>
        <div class="col-sm-4 maincontent" style="padding: 6px; background-color: #FFFFFF; margin: 0 auto; text-align: center; width: 60%; margin-left:10px;">
            <h1> </h1>
            <?php if(isset($_SESSION['user'])): ?>
            <h4>Welcome <?= htmlspecialchars($_SESSION['user']); ?></h4><br>
            <div class="additional-links">
                <a href="reviews.php" class="button">Add New Review</a><br>
                <a href="search.php" class="button">Search Reviews</a><br>
                <a href="logout.php" class="button">Logout</a><br>
                <a href="account.php" class="button">Update Password</a><br>
            </div>
            <?php else: ?>
            <div class="additional-links">
                <a href="login.php" class="button">Login</a><br>
            </div>
            <?php endif; ?>
        </div>
    </main>
    <footer>
        <div class="footer" style="display:flex; justify-content: space-between;">
            <div>
                <p>&copy;2024 Leynadth, Inc. All Rights Reserved</p>
            </div>
            <div class="social-icons" style="display:flex; margin-top:17px; margin-right:10px;">
                <a href="#"><img class="social-icons" src="images/instagram.jpg" alt="Instagram"></a>
                <a href="#"><img class="social-icons" src="images/twitter (1).jpg" alt="Twitter"></a>
                <a href="#"><img class="social-icons" src="images/facebook.jpg" alt="Facebook"></a>
            </div>
        </div>
    </footer>
</body>
</html>
