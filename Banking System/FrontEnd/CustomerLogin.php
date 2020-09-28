
<?php
session_start();
?>


<main>
<?php
if(isset($_SESSION['username']))
{
    header("Location: CustomerHome.php?login=1");
    exit();
}
else
{
    echo '<p>Please Log in</p>';
}
?>
</main>

<?php
    //require "footer.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="include/styles.css">
</head>
<body>
    <header>
        <nav>
            <a href='#'>
                <img src="icon.png" alt="icon">
            </a>
        <div>
            <form action="include/CustomerLoginCheck.php" method="post">
                <input type="name" name="username" placeholder="username">
                <input type="password" name="Password" placeholder="Password">
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </nav>
    </header>


</body>
</html>
