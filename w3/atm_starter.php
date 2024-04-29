<?php
    include __DIR__ . '/checking.php';
    include __DIR__ . '/savings.php';
    
    $checkings = new CheckingAccount('C123', 1000, '03-20-2020');
    $savings = new SavingsAccount('S123', 5000, '03-20-2020');
    
    session_start();
    $_SESSION['checkings'] = $checkings;
    $_SESSION['savings'] = $savings;
    $checkings = $_SESSION['checkings'];
    $savings = $_SESSION['savings'];

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['withdrawChecking'])) {
            $amount = $_POST['checkingWithdrawAmount'];
            if ($checkings->withdrawal($amount)) {
                echo "Withdrawal from checking account successful.";
            } else {
                echo "invalid amount.";
            }
        } elseif (isset($_POST['depositChecking'])) {
            $amount = $_POST['checkingDepositAmount'];
            if ($amount > 0) {
                $checkings->deposit($amount);
                echo "Deposit to checking account successful.";
            } else {
                echo "Invalid amount.";
            }
        } elseif (isset($_POST['withdrawSavings'])) {
            $amount = $_POST['savingsWithdrawAmount'];
            if ($savings->withdrawal($amount)) {
                echo "Withdrawal from savings account successful.";
            } else {
                echo "invalid amount.";
            }
        } elseif (isset($_POST['depositSavings'])) {
            $amount = $_POST['savingsDepositAmount'];
            if ($amount > 0) {
                $savings->deposit($amount);
                echo "Deposit to savings account successful.";
            } else {
                echo " Invalid amount.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATM</title>
    <style type="text/css">
        body {
            margin-left: 120px;
            margin-top: 50px;
        }
       .wrapper {
            display: grid;
            grid-template-columns: 300px 300px;
        }
        .account {
            border: 1px solid black;
            padding: 10px;
        }
        .label {
            text-align: right;
            padding-right: 10px;
            margin-bottom: 5px;
        }
        label {
           font-weight: bold;
        }
        input[type=text] {width: 80px;}
        .error {color: red;}
        .accountInner {
            margin-left:10px;margin-top:10px;
        }
    </style>

</head>
<body>

    <form method="post">
               
    <h1>ATM</h1>
        <div class="wrapper">
            
            <div class="account">
              
                    
                    <div class="accountInner">
                        <p><span style="font-weight: 900;">Account ID</span><?= $checkings->getAccountId(); ?></p>
                        <p><span style="font-weight: 900;">Balance:</span><?= $checkings->getBalance(); ?></p>
                        <p><span style="font-weight: 900;">Account Opened:</span><?= $checkings->getStartDate(); ?></p>
                        <input type="text" name="checkingWithdrawAmount" value="" />
                        <input type="submit" name="withdrawChecking" value="Withdraw" />
                    </div>
                    <div class="accountInner">
                        <input type="text" name="checkingDepositAmount" value="" />
                        <input type="submit" name="depositChecking" value="Deposit" /><br />
                    </div>
            
            </div>

            <div class="account">
               
                    
                    <div class="accountInner">
                        <p><span style="font-weight: 900;">Account ID</span><?= $savings->getAccountId(); ?></p>
                        <p><span style="font-weight: 900;">Balance:</span><?= $savings->getBalance(); ?></p>
                        <p><span style="font-weight: 900;">Account Opened:</span><?= $savings->getStartDate(); ?></p>
                        <input type="text" name="savingsWithdrawAmount" value="" />
                        <input type="submit" name="withdrawSavings" value="Withdraw" />
                    </div>
                    <div class="accountInner">
                        <input type="text" name="savingsDepositAmount" value="" />
                        <input type="submit" name="depositSavings" value="Deposit" /><br />
                    </div>
            
            </div>
            
        </div>
    </form>
</body>
</html>
