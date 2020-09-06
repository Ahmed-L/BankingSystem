<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
    <div class='header-logout'>
            <?php
                if(isset($_SESSION['FirstName']))
                {
                    echo '<form action="include/logout.php" method="post">
                    <button type="submit" name="logout-submit">Logout</button>
                    </form>';
                }
                else
                {
                    header("Location: index.php?login=0");
                }
            ?>
        </div>
        <nav>
            <a href='#'>
                <img src="icon.png" alt="icon">
            </a>
        <ul>
            <li> <a href="Menu.php">Menu</a></li>
            <li> <a href="Customers.php">Customers</a></li>
            <li> <a href="CreateCustomer.php">New Customer Account</a> </li>
            <li> <a href="Manager.php">Manager</a></li>
            <li> <a href="#">Transaction Log</a></li>
        </ul>
        
        <!--
        <div>
            <form action="include/Accountlogin.php" method="post">
                <input type="name" name="username_login" placeholder="Username">
                <input type="password" name="password_login" placeholder="Password">
                <button type="submit" name="Account_Login_btn">Login</button>
            </form>
        </div>
        -->
    </nav>
    </header>

            
</body>
</html>