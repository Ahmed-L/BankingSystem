<?php
session_start();

if(isset($_POST['Edit']))
{
    require 'db_handler.php';
    $CustomerID=$_POST['CustomerID'];
    $CustomerAddress=$_POST['CustomerAddress'];
    $CustomerFirstName=$_POST['CustomerFirstName'];
    $CustomerLastName=$_POST['CustomerLastName'];
    $City=$_POST['City'];
    $Nation=$_POST['Nation'];
    $EmailAddress=$_POST['EmailAddress'];
    $Phone=$_POST['Phone'];

    if(empty($CustomerAddress)||empty($CustomerFirstName)||empty( $CustomerLastName)||empty($City)||empty($Nation)||empty($EmailAddress)||empty($Phone))
    {
        header("Location: ../EditCustomerAccount.php?error=emptyfields");
        exit();
    }
    else
    {
        //-----------------------------------------------------------------------------------------------------------------------------------------
        $sql="SELECT CustomerID FROM customer WHERE CustomerID=?";
        $pstatement=mysqli_stmt_init($connect);
        if(!mysqli_stmt_prepare($pstatement,$sql))
        {
            header("Location: ../EditCustomerAccount.php?errorr=sqlerror=EditCustomer.php_first");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($pstatement, "i", $CustomerID);
            mysqli_stmt_execute($pstatement);
            //error handling
            mysqli_stmt_store_result($pstatement);
            $resultCheck=mysqli_stmt_num_rows($pstatement);
            if(!$resultCheck>0)
            {
                header("Location: ../EditCustomerAccount.php?error=CustomerIDdoesntexist&CustomerID=".$CustomerID);
                exit();
            }
            else
            {
                //SQL QUERY-----------------------------------------------------------------------------------------------------------
                $sql="UPDATE customer SET CustomerAddress=?,CustomerFirstName=?, CustomerLastName=?, City=?, Nation=?, EmailAddress=?, Phone=? WHERE CustomerID=$CustomerID";
                $pstatement=mysqli_stmt_init($connect);
                if(!mysqli_stmt_prepare($pstatement, $sql))
                {
                    header("Location: ../EditCustomerAccount.php?error=sqlerror=3rd");
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($pstatement, "sssssss",$CustomerAddress,$CustomerFirstName,$CustomerLastName,$City,$Nation,$EmailAddress,$Phone);
                    mysqli_stmt_execute($pstatement);
                    header("Location: ../EditCustomerAccount.php?UpdateAccount=success");
                    exit();
                }
            }

        }
    }
    mysqli_stmt_close($pstatement);
    mysqli_close($connect);
}
else if(isset($_POST['editpass']))
{
    require 'db_handler.php';

    $CustomerID=$_POST['CustomerID_reset_pass'];
    $password=$_POST['password'];

    if(empty($CustomerID||empty($password)))
    {
        header("Location: ../EditCustomerAccount.php?EmptyCustomerIDorPasswordforRESET");
        exit();
    }
    else
    {
        $sql="UPDATE UserLogins SET UserPassword=? where AccountID = (SELECT AccountID FROM customeraccount WHERE CustomerID=$CustomerID)";
                $pstatement=mysqli_stmt_init($connect);
                if(!mysqli_stmt_prepare($pstatement, $sql))
                {
                    header("Location: ../EditCustomerAccount.php?error=CustomerIDnotfound");
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($pstatement, "s",$password);
                    mysqli_stmt_execute($pstatement);
                    header("Location: ../EditCustomerAccount.php?PasswordReset=success");
                    exit();
                }   
    }
}
else if(isset($_POST['change']))
{
    require 'db_handler.php';

    $CustomerID=$_POST['CustomerID_acc_sts'];
    $AccountStatusTypeID=$_POST['AccountStatusTypeID'];
    $AccountTypeID=$_POST['AccountTypeID'];
    $InterestSavingsRateID=$_POST['InterestSavingsRateID'];

    if(empty($CustomerID)||empty($AccountStatusTypeID)||empty($AccountTypeID)||empty($InterestSavingsRateID))
    {
        header("Location: ../EditCustomerAccount.php?error=Account_stat_emptyfields");
        exit();
    }
    else
    {
            //-----------ACCOUNT STATUS TYPE -----------------------------------
                $sql="UPDATE Account SET AccountStatusTypeID=? where AccountID = (SELECT AccountID FROM customeraccount WHERE CustomerID=$CustomerID)";
                $pstatement=mysqli_stmt_init($connect);
                if(!mysqli_stmt_prepare($pstatement, $sql))
                {
                    header("Location: ../EditCustomerAccount.php?error=CustomerIDnotfound");
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($pstatement, "i",$AccountStatusTypeID);
                    mysqli_stmt_execute($pstatement);
                }
            //----------ACCOUNT TYPE --------------------------------------------
                $sql="UPDATE Account SET AccountTypeID=? where AccountID = (SELECT AccountID FROM customeraccount WHERE CustomerID=$CustomerID)";
                $pstatement=mysqli_stmt_init($connect);
                if(!mysqli_stmt_prepare($pstatement, $sql))
                {
                    header("Location: ../EditCustomerAccount.php?error=CustomerIDnotfound");
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($pstatement, "i",$AccountTypeID);
                    mysqli_stmt_execute($pstatement);
                }
            //--------------INTEREST SAVINGS RATE ------------------------------
                $sql="UPDATE Account SET InterestSavingsRateID=? where AccountID = (SELECT AccountID FROM customeraccount WHERE CustomerID=$CustomerID)";
                $pstatement=mysqli_stmt_init($connect);
                if(!mysqli_stmt_prepare($pstatement, $sql))
                {
                    header("Location: ../EditCustomerAccount.php?error=CustomerIDnotfound");
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($pstatement, "i",$InterestSavingsRateID);
                    mysqli_stmt_execute($pstatement);
                    header("Location: ../EditCustomerAccount.php?Acc_sts_change=updated");
                    exit();
                }       
    }
}
else if(isset($_POST['delete']))
{
    require 'db_handler.php';

    $CustomerID=$_POST['CustomerID_del'];
    $Delete=$_POST['delete_text'];


    if(empty($CustomerID)&&!($Delete=='DELETE'))
    {
        header("Location: ../EditCustomerAccount.php?errorindeleting=emptyfields");
        exit();
    }
    else
    {
        //-----------------------------------------------------------------------------------------------------------------------------------------
        $sql="SELECT CustomerID FROM customer WHERE CustomerID=?";
        $pstatement=mysqli_stmt_init($connect);
        if(!mysqli_stmt_prepare($pstatement,$sql))
        {
            header("Location: ../EditCustomerAccount.php?errorr=sqlerror=EditCustomer.php_first_del");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($pstatement, "i", $CustomerID);
            mysqli_stmt_execute($pstatement);
            //error handling
            mysqli_stmt_store_result($pstatement);
            $resultCheck=mysqli_stmt_num_rows($pstatement);
            if(!$resultCheck>0)
            {
                header("Location: ../EditCustomerAccount.php?error=CustomerIDdoesntexist&CustomerID=".$CustomerID);
                exit();
            }
            else
            {
                //SQL QUERY-----------------------------------------------------------------------------------------------------------
                $sql="delete from account where AccountID = (Select AccountID from customeraccount where CustomerID=?)";
                $pstatement=mysqli_stmt_init($connect);
                if(!mysqli_stmt_prepare($pstatement, $sql))
                {
                    header("Location: ../EditCustomerAccount.php?error=sqlerror=3rd_del");
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($pstatement, "i",$CustomerID);
                    mysqli_stmt_execute($pstatement);
                    header("Location: ../EditCustomerAccount.php?DeleteAccount=success");
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
    header("Location: ../EditCustomerAccount.php?error=CriticalError");
                    exit();
}