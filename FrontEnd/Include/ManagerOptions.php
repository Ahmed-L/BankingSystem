<?php
    //require '../header.php';

?>

<main>
    <head>
    <link rel="stylesheet" href="formstyle.css">
</head>
    <div>
        <h2>Add a new Employee</h2>
        <form action="AddEmployee.php" method="post">
        <input type="number" name="EmployeeID" placeholder="EmployeeID">
        <input type="name" name="FirstName" placeholder="First Name">
        <input type="name" name="LastName" placeholder="Last Name">
        <input type="password" name="Employee_Password" placeholder="Password">
        <button type="submit" class="registerbtn" name="employee_create">Add</button>
        </form>
    </div>


    <div>
        <h2>Edit an existing Employee</h2>
        <form action="AddEmployee.php" method="post">
        <input type="number" name="_EmployeeID" placeholder="EmployeeID">
        <input type="name" name="_FirstName" placeholder="First Name">
        <input type="name" name="_LastName" placeholder="Last Name">
        <input type="password" name="_Employee_Password" placeholder="Password">
        <button type="submit" class="registerbtn" name="employee_edit">Edit</button>
        </form>
    </div>

    <div>
        <h2>Remove an Employee</h2>
        <form action="AddEmployee.php" method="post">
        <input type="number" name="_EmployeeID_" placeholder="EmployeeID">
        <button type="submit" class="registerbtn" name="employee_delete">Remove</button>
        </form>
    </div>
</main>

