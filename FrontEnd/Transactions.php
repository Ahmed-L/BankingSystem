<?php
    require 'header.php';
?>
<main>
    <head>
    <link rel="stylesheet" href="include/formstyle.css">
    </head>
<?php
if(isset($_SESSION['EmployeeIsManager']))
{
    $isManager=$_SESSION['EmployeeIsManager'];
    if(!$isManager)
    {
        header("Location: Menu.php?not_manager");
        exit();
        echo 'You do not have permission to enter this page';
    }
    else
    {
        
    }
}
else
{
    echo '<p>Please Log in</p>';
}
?>
</main>

    <div class="container">
        <h2>Search for Transaction Log</h2>
        <form action="include/TransactionLog.php" method="post">
        <input type="number" name="TransactionID" placeholder="TransactionID">
        <button type="submit" class="registerbtn" name="search">Add</button>
        </form>
    </div>

    <div class="container">
        <h2>Carry out Transaction</h2>
        <form action="include/TransactionPush.php" method="post">
        <input type="number" name="TransactionTypeID" placeholder="TransactionTypeID">
        <input type="number" name="TransactionAmount" placeholder="TransactionAmount">
        <input type="number" name="AccountID" placeholder="AccountID">
        <input type="number" name="EmployeeID" placeholder="EmployeeID">
        <button type="submit" class="registerbtn" name="push">Execute</button>
        </form>
    </div>

<?php
    //require "footer.php";
?>