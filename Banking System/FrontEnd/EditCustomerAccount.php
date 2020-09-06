<?php
    require "header.php";
?>

<main>

    <section class="section-default">
        
        <h3>Edit Customer Details</h3>
        <form action="include/EditCustomer.php" method="post">
        <input type="number" name="CustomerID" placeholder="CustomerID">
        <input type="name" name="CustomerAddress" placeholder="CustomerAddress">
        <input type="name" name="CustomerFirstName" placeholder="CustomerFirstName">
        <input type="name" name="CustomerLastName" placeholder="CustomerLastName">
        <input type="name" name="City" placeholder="City">
        <input type="name" name="Nation" placeholder="Nation">
        <input type="name" name="EmailAddress" placeholder="EmailAddress">
        <input type="name" name="Phone" placeholder="Phone">
        <!--
        <h3>Edit Customer Account Information</h3>
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password"> -->
        <button type="submit" name="Edit">Edit Account</button>
        </form>
        <h3>Reset Customer's Password</h3>
        <form action="include/EditCustomer.php" method="post">
        <input type="number" name="CustomerID_reset_pass" placeholder="CustomerID">
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="editpass">Reset Password?</button>
        </form>
        </form>
        <h3>Change Account Type and Status</h3>
        <form action="include/EditCustomer.php" method="post">
        <input type="number" name="CustomerID_acc_sts" placeholder="CustomerID">
        <input type="number" name="AccountStatusTypeID" placeholder="AccountStatusTypeID">
        <input type="number" name="AccountTypeID" placeholder="AccountTypeID">
        <input type="number" name="InterestSavingsRateID" placeholder="InterestSavingsRateID">
        <button type="submit" name="change">Change</button>
        </form>
        <div>
        <h3>Delete Customer Account</h3>
        <form action="include/EditCustomer.php" method="post">
        <input type="number" name="CustomerID_del" placeholder="CustomerID">
        <input type="name" name="delete_text" placeholder="Please type in DELETE">
        <button type="submit" name="delete">Confirm Delete</button>
        </form>
        </div>


    </section>
    

</main>

<?php
    require "footer.php";
?>