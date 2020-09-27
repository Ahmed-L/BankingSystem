<?php
    require "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
.collapsible {
  background-color: #777;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active, .collapsible:hover {
  background-color: #555;
}

.content {
  padding: 10px 18px;
  display: none;
  overflow: hidden;
  background-color: #f1f1f1;
}
</style>
</head>
<body>
<button class="collapsible">Edit Customer</button>
    <div class="content">
        <form action="include/EditCustomer.php" method="post">
        <input type="number" name="CustomerID" placeholder="CustomerID">
        <input type="name" name="CustomerAddress" placeholder="CustomerAddress">
        <input type="name" name="CustomerFirstName" placeholder="CustomerFirstName">
        <input type="name" name="CustomerLastName" placeholder="CustomerLastName">
        <input type="name" name="City" placeholder="City">
        <input type="name" name="Nation" placeholder="Nation">
        <input type="name" name="EmailAddress" placeholder="EmailAddress">
        <input type="name" name="Phone" placeholder="Phone">
        <button type="submit" name="Edit">Edit Account</button>
        </form>
    </div>

    <button class="collapsible">Reset Customer's Password</button>
    <div class="content">
        <form action="include/EditCustomer.php" method="post">
        <input type="number" name="CustomerID_reset_pass" placeholder="CustomerID">
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="editpass">Reset Password?</button>
        </form>
    </div>


    <button class="collapsible">Change Account Type and Status</button>
    <div class="content">
        <form action="include/EditCustomer.php" method="post">
        <datalist id="type">
        <option value="1">
        <option value="2">
        <option value="3">
        </datalist>
        <input type="number" list="type" name="CustomerID_acc_sts" placeholder="CustomerID">
        <input type="number" list="type" name="AccountStatusTypeID" placeholder="AccountStatusTypeID">
        <input type="number" list="type" name="AccountTypeID" placeholder="AccountTypeID">
        <input type="number" list="type" name="InterestSavingsRateID" placeholder="InterestSavingsRateID">
        <button type="submit" name="change">Change</button>
        </form>
    </div>

    <button class="collapsible">Delete Customer Account</button>
    <div class="content">
        <form action="include/EditCustomer.php" method="post">
        <input type="number" name="CustomerID_del" placeholder="CustomerID">
        <input type="name" name="delete_text" placeholder="Please type in DELETE">
        <button type="submit" name="delete">Confirm Delete</button>
        </form>
    </div>

    <button class="collapsible">Delete Customer Account</button>
    <div class="content">
        <p>something for test</p>
</div>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
</body>
</html>


<?php
    require "footer.php";
?>