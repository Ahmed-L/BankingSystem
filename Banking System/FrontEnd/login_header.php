<php?
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
        <nav>
            <a href='#'>
                <img src="icon.png" alt="icon">
            </a>
        <div>
            <form action="include/Accountlogin.php" method="post">
                <input type="number" name="EmployeeID" placeholder="EmployeeID">
                <input type="password" name="Password" placeholder="Password">
                <button type="submit" name="Account_Login_btn">Login</button>
            </form>
        </div>
    </nav>
    </header>

            
</body>
</html>