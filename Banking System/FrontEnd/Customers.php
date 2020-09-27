<?php
    require "header.php";
?>

<main>
<head>
<link rel="stylesheet" href="include/formstyle.css">
</head>
    <section class="container">
        <h1>View All Customers</h1>
        <form action="Include/ViewCustomers.php"method="post">
        <button type="submit" class="registerbtn" name="view">View</button>
        </form>
        <h1>Find Customer by ID</h1>
        <form action="include/ViewCustomers.php" method="post">
        <input type="number" name="CustomerID" placeholder="CustomerID">
        <button type="submit" class="registerbtn" name="find">Find</button>
        </form>
        <h1>Find Customer Account Details</h1>
        <form action="include/ViewCustomers.php" method="post">
        <input type="number" name="CustomerID_acc_sts" placeholder="CustomerID">
        <button type="submit" class="registerbtn" name="find_acc_sts">Find</button>
        </form>
        <h3>Edit Customer Account</h3>
        <a href="EditCustomerAccount.php" class="az">Edit Here</a>
        </form>
    </section>
    

</main>

<?php
    //require "footer.php";
?>