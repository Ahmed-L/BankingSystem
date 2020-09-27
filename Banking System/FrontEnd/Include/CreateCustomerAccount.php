<?php
if(isset($_POST['create']))
{
    require 'db_handler.php';

    $username=$_POST['username'];
    $password=$_POST['password'];
    $AccountID=$_POST['AccountID'];
    $AccountStatusTypeID=$_POST['AccountStatusTypeID'];
    $AccountTypeID=$_POST['AccountTypeID'];
    $CurrentBalance=$_POST['CurrentBalance'];
    $InterestSavingsRateID=$_POST['InterestSavingsRateID'];
    $CustomerID=$_POST['CustomerID'];
    $CustomerAddress=$_POST['CustomerAddress'];
    $CustomerFirstName=$_POST['CustomerFirstName'];
    $CustomerLastName=$_POST['CustomerLastName'];
    $City=$_POST['City'];
    $Nation=$_POST['Nation'];
    $EmailAddress=$_POST['EmailAddress'];
    $Phone=$_POST['Phone'];

    //||empty($CustomerID)||empty($CustomerAddress)||(empty($Phone)
    if(empty($username)||empty($password)||empty($AccountID)||empty($AccountTypeID)||empty($AccountStatusTypeID)||empty($InterestSavingsRateID||empty($CustomerID)))
    {
        header("Location: ../CreateCustomer.php?error=emptyfields");
        //||empty($password)||empty($AccountID)||empty($AccountTypeID)||empty($AccountStatusTypeID)||empty($InterestSavingsRateID)
        //header("Location: ../CreateCustomer.php?error=emptyfields&username=".$username."&AccountID=".$AccountID."&AccountTypeID=".$AccountTypeID."&AccountStatusTypeID=".$AccountStatusTypeID."&InterestSavingsRate=".$InterestSavingsRate);
        exit();
    }
    else
    {
        $sql="SELECT AccountID FROM Account WHERE AccountID=?";
        $pstatement=mysqli_stmt_init($connect);

        if(!mysqli_stmt_prepare($pstatement,$sql))
        {
            header("Location: ../CreateCustomer.php?errorr=sqlerror=1st");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($pstatement, "i", $AccountID);
            mysqli_stmt_execute($pstatement);
            //error handling
            mysqli_stmt_store_result($pstatement); //store db result
            $resultCheck=mysqli_stmt_num_rows($pstatement); //check rows
            if($resultCheck>0)
            {
                header("Location: ../CreateCustomer.php?error=AccountIDexists&AccountID=".$AccountID);
                exit();
            }
            else
            {
                //$AccountID,$CurrentBalance,$AccountTypeID,$AccountStatusTypeID,$InterestSavingsRateID
                $sql="INSERT INTO Account(AccountID, CurrentBalance, AccountTypeID, AccountStatusTypeID, InterestSavingsRateID) VALUES (?, ?, ?, ?, ?)";
                $pstatement=mysqli_stmt_init($connect);
                if(!mysqli_stmt_prepare($pstatement, $sql))
                {
                    header("Location: ../CreateCustomer.php?error=sqlerror=2nd");
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($pstatement, "iiiii",$AccountID,$CurrentBalance,$AccountTypeID,$AccountStatusTypeID,$InterestSavingsRateID);
                    mysqli_stmt_execute($pstatement);
                    //header("Location: ../CreateCustomer.php?createAccount=success");
                    //exit();
                }

                $sql="INSERT INTO UserLogins(Username, UserPassword, AccountID) VALUES (?, ?, ?)";
                $pstatement=mysqli_stmt_init($connect);
                if(!mysqli_stmt_prepare($pstatement, $sql))
                {
                    header("Location: ../CreateCustomer.php?error=sqlerror=3rd");
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($pstatement, "ssi",$username,$password,$AccountID);
                    mysqli_stmt_execute($pstatement);
                    //header("Location: ../CreateCustomer.php?createAccount=success");
                    //exit();
                }


                $sql="INSERT INTO Customer(CustomerID,AccountID, CustomerAddress, CustomerFirstName, CustomerLastName, City,Nation,EmailAddress,Phone,Username) VALUES (?,?,?,?,?,?,?,?,?,?)";
                $pstatement=mysqli_stmt_init($connect);
                if(!mysqli_stmt_prepare($pstatement, $sql))
                {
                    header("Location: ../CreateCustomer.php?error=sqlerror=4th");
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($pstatement, "iissssssss",$CustomerID,$AccountID,$CustomerAddress,$CustomerFirstName,$CustomerLastName,$City,$Nation,$EmailAddress,$Phone,$username);
                    mysqli_stmt_execute($pstatement);
                    //header("Location: ../CreateCustomer.php?createAccount=success");
                    //exit();
                }

                $sql="INSERT INTO CustomerAccount(AccountID,CustomerID) VALUES (?,?)";
                $pstatement=mysqli_stmt_init($connect);
                if(!mysqli_stmt_prepare($pstatement, $sql))
                {
                    header("Location: ../CreateCustomer.php?error=sqlerror=5th");
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($pstatement, "ii",$AccountID,$CustomerID);
                    mysqli_stmt_execute($pstatement);
                    header("Location: ../CreateCustomer.php?createAccount=success");
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
    header("Location: ../CreateCustomer.php?create=check1");
    exit();
}
