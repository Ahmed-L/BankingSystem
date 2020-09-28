<?php
    require "login_header.php";
    //echo '<script>alert("Welcome to Geeks for Geeks")</script>';
?>

<main>
<?php
if(isset($_SESSION['FirstName']))
{
    header("Location: Menu.php?login=1");
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