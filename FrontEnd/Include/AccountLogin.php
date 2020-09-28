<?php

if(isset($_POST['Account_Login_btn']))
{
    require 'db_handler.php';
    $EmployeeID=$_POST['EmployeeID'];
    $Password=$_POST['Password'];

    if(empty($EmployeeID)||empty($Password))
    {
        header("Location: ../index.php?emptyfields");
        exit();
    }
    else
    {
        
        //-------------------------------------------------------------------------------
        /*$sql="Select * FROM Employee";
        $result=mysqli_query($connect,$sql);
        $resultCheck=mysqli_num_rows($result);

        if($resultCheck>0)
        {
            while($row = mysqli_fetch_assoc($result))
            {   
                echo "\t".$row['EmployeeID']."\t".$row['Employee_Password']."\n";
                
            }
        }
        else
        {
            echo "0 results";
        }*/


        //-------------------------------------------------------------------------------

        
        $sql="SELECT * FROM employee WHERE EmployeeID=?";
        $pstatement=mysqli_stmt_init($connect);
        if(!mysqli_stmt_prepare($pstatement,$sql))
        {
            header("Location ../index.php?error=sqlerror");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($pstatement,"i",$EmployeeID);
            mysqli_stmt_execute($pstatement);
            $result=mysqli_stmt_get_result($pstatement);
            if($row=mysqli_fetch_assoc($result))
            {
                if($Password==$row['Employee_Password'])
                {
                    session_start();
                    $_SESSION['EmployeeID']=$row['EmployeeID'];
                    $_SESSION['FirstName']=$row['FirstName'];
                    $_SESSION['EmployeeIsManager']=$row['EmployeeIsManager'];
                    header("Location: ../Menu.php?login=1");
                    exit();
                }
                else
                {
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }
            }
            else
            {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
        
    }
}
else
{
    header("Location: ../index.php?login=error");
    exit();
}