<?php
    require 'header.php';
?>

<main>
<?php
if(isset($_SESSION['EmployeeIsManager']))
{
    $isManager=$_SESSION['EmployeeIsManager'];
    if(!$isManager)
    {
        header("Location: Menu.php?not Manager!");
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

<section>
<form action="include/ManagerOptions.php" method="post">
<ul>
    <li><a href="include/ManagerOptions.php">Create or Edit Employee Information</a></li>
    <li><a href="#">Customize Interest Rates(incomplete)</a></li>
    
</ul>
</form>
</section>

<?php
    //require "footer.php";
?>