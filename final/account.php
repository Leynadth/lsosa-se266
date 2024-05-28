<?php
session_start();
include __DIR__ . '/models/model_account.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$error = "";
$username = '';
$password = '';

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $userData = getUser($userId);
    $username = isset($userData['username']) ? $userData['username'] : "";
} else {
    header('Location: login.php');
    exit;
}

if (isset($_POST['updatePassword'])) {
    $password = filter_input(INPUT_POST, 'password');
    
    if ($password == "") {
        $error .= "<li>Please provide a new password</li>";
    }

    if ($error == "") {
        $result = updatePassword($userId, $password);
        if ($result === 'Password Updated') {
            header('Location: reviews.view.php');
            exit;
        } else {
            $error .= "<li>$result</li>";
        }
    }
}

if (isset($_POST['deleteAccount'])) {
    $result = deleteUser($userId);
    if ($result === 'User Deleted') {
        session_destroy();
        header('Location: login.php');
        exit;
    } else {
        $error .= "<li>$result</li>";
    }
}
?>

</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChapterChat</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        
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
    input[type=text], input[type=password] {
        width: 200px;
    }
    .error {
        color: red;
    }
    div {
        margin-top: 5px;
    }
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
            
<?php if ($error != ""): ?>
    <div class="error">
        <p>Please fix the following and resubmit</p>
        <ul>
            <?php echo $error; ?>
        </ul>
    </div>
<?php endif; ?>

<h2>User Profile</h2>

<form name="userProfile" method="post">
    <div class="wrapper">
        <div class="label">
            <label>Username:</label>
        </div>
        <div>
            <input type="text" name="username" value="<?= htmlspecialchars($username); ?>" readonly />
        </div>
        <div class="label">
            <label>New Password:</label>
        </div>
        <div>
            <input type="password" name="password" value="<?= htmlspecialchars($password); ?>" />
        </div>
        <div>
            &nbsp;
        </div>
        <div>
            <input class="btn btn-info" type="submit" name="updatePassword" value="Update Password" />
        </div>  
        <div>
            &nbsp;
        </div>             
        <div>
            <input class="btn btn-danger" type="submit" name="deleteAccount" value="DELETE Account" />
        </div>
        <div>
            <a href="reviews.view.php">View All Reviews</a>
        </div>
    </div>
</form>
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