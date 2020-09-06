<?php
if(isset($_POST['employee_create']))
{
    require 'db_handler.php';
    $EmployeeID=$_POST['EmployeeID'];
    $FirstName=$_POST['FirstName'];
    $LastName=$_POST['LastName'];
    $Employee_Password=$_POST['Employee_Password'];
    $BitZero=0;

    if(empty($EmployeeID)||empty($FirstName)||empty($LastName)||empty($Employee_Password))
    {
        header("Location: ManagerOptions.php?error=emptyfields");
        exit();
    }
    else
    {
        $sql="SELECT EmployeeID FROM employee WHERE EmployeeID=?";
        $pstatement=mysqli_stmt_init($connect);
        if(!mysqli_stmt_prepare($pstatement,$sql))
        {
            header("Location: ../ManagerOptions.php?errorr=sqlerror=AddEmployee.php_first_del");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($pstatement, "i", $EmployeeID);
            mysqli_stmt_execute($pstatement);
            //error handling
            mysqli_stmt_store_result($pstatement);
            $resultCheck=mysqli_stmt_num_rows($pstatement);
            if($resultCheck>0)
            {
                header("Location: ../ManagerOptions.php?error=EmployeeIDexists&EmployeeID=".$EmployeeID);
                echo "Employee with the following ID already exists.";
                exit();
            }
            else
            {
                //SQL QUERY-----------------------------------------------------------------------------------------------------------
                $sql="INSERT INTO employee VALUES(?,?,?,?,?)";
                $pstatement=mysqli_stmt_init($connect);
                if(!mysqli_stmt_prepare($pstatement, $sql))
                {
                    header("Location: ../ManagerOptions.php?error=sqlerror=3rd_del");
                    echo "SQL ERROR.";
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($pstatement, "issis",$EmployeeID,$FirstName,$LastName,$BitZero,$Employee_Password);
                    mysqli_stmt_execute($pstatement);
                    header("Location: ../Manager.php?addnewemployee=success");
                    exit();
                }
            }

        }
    }
}
else if(isset($_POST['employee_edit']))
{
    require 'db_handler.php';
    $EmployeeID=$_POST['_EmployeeID'];
    $FirstName=$_POST['_FirstName'];
    $LastName=$_POST['_LastName'];
    $Employee_Password=$_POST['_Employee_Password'];

    if(empty($EmployeeID)||empty($FirstName)||empty($LastName)||empty($Employee_Password))
    {
        header("Location: ManagerOptions.php?error=emptyfields");
        exit();
    }
    else
    {
        $sql="SELECT EmployeeID FROM employee WHERE EmployeeID=?";
        $pstatement=mysqli_stmt_init($connect);
        if(!mysqli_stmt_prepare($pstatement,$sql))
        {
            header("Location: ../ManagerOptions.php?errorr=sqlerror=AddEmployee.php_first_del");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($pstatement, "i", $EmployeeID);
            mysqli_stmt_execute($pstatement);
            //error handling
            mysqli_stmt_store_result($pstatement);
            $resultCheck=mysqli_stmt_num_rows($pstatement);
            if(!$resultCheck>0)
            {
                header("Location: ../ManagerOptions.php?error=EmployeeIDdoesntexist&EmployeeID=".$EmployeeID);
                echo "Employee with the following ID does not exist.";
                exit();
            }
            else
            {
                //SQL QUERY-----------------------------------------------------------------------------------------------------------
                $sql="UPDATE employee SET FirstName=?,LastName=?,Employee_Password=? WHERE EmployeeID=$EmployeeID";
                $pstatement=mysqli_stmt_init($connect);
                if(!mysqli_stmt_prepare($pstatement, $sql))
                {
                    header("Location: ../ManagerOptions.php?error=sqlerror=3rd_del");
                    echo "SQL ERROR.";
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($pstatement, "sss",$FirstName,$LastName,$Employee_Password);
                    mysqli_stmt_execute($pstatement);
                    header("Location: ../Manager.php?updateemployee=success");
                    exit();
                }
            }

        }
    }
    mysqli_stmt_close($pstatement);
    mysqli_close($connect);
}
else if(isset($_POST['employee_delete']))
{
    require 'db_handler.php';
    $EmployeeID=$_POST['_EmployeeID_'];

    if(empty($EmployeeID))
    {
        header("Location: ManagerOptions.php?=EmptyID");
        exit();
    }
    else
    {
        $sql="SELECT EmployeeID FROM employee WHERE EmployeeID=?";
        $pstatement=mysqli_stmt_init($connect);
        if(!mysqli_stmt_prepare($pstatement,$sql))
        {
            header("Location: ../ManagerOptions.php?errorr=sqlerror=AddEmployee.php_third_del");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($pstatement, "i", $EmployeeID);
            mysqli_stmt_execute($pstatement);
            //error handling
            mysqli_stmt_store_result($pstatement);
            $resultCheck=mysqli_stmt_num_rows($pstatement);
            if(!$resultCheck>0)
            {
                header("Location: ../ManagerOptions.php?error=EmployeeIDdoesntexist&EmployeeID=".$EmployeeID);
                echo "Employee with the following ID does not exist.";
                exit();
            }
            else
            {
                //SQL QUERY-----------------------------------------------------------------------------------------------------------
                $sql="DELETE FROM employee WHERE EmployeeID=$EmployeeID";
                $pstatement=mysqli_stmt_init($connect);
                if(!mysqli_stmt_prepare($pstatement, $sql))
                {
                    header("Location: ../ManagerOptions.php?error=sqlerror=delerror");
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($pstatement, "i",$EmployeeID);
                    mysqli_stmt_execute($pstatement);
                    header("Location: ManagerOptions.php?EmployeeRemoved=true");
                    exit();
                }
            }

        }
        
    }
    mysqli_stmt_close($pstatement);
    mysqli_close($connect);

}
else
{
    echo"Critical Error";
}