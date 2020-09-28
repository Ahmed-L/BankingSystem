<?php
if(isset($_POST['ratechange']))
{
    require 'db_handler.php';
    $InterestSavingsRateID=$_POST['InterestSavingsRateID'];
    $InterestRateValue=$_POST['InterestRateValue'];
    $InterestRateDescription=$_POST['InterestRateDescription'];
    if(empty($InterestSavingsRateID)||empty($InterestRateDescription)||empty($InterestRateValue))
    {
        echo "Empty Fields\n";
    }
    else
    {
        $sql="SELECT InterestSavingsRateID FROM SavingsInterestRates WHERE InterestSavingsRateID=?";
        $pstatement=mysqli_stmt_init($connect);

        if(!mysqli_stmt_prepare($pstatement,$sql))
        {
            header("Location: ../Manager.php?errorr=sqlerror=1st");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($pstatement, "i", $InterestSavingsRateID);
            mysqli_stmt_execute($pstatement);
            //error handling
            mysqli_stmt_store_result($pstatement); //store db result
            $resultCheck=mysqli_stmt_num_rows($pstatement); //check rows
            if(!$resultCheck>0)
            {
                header("Location: ../Manager.php?error=AccountIDnotFound&AccountID=".$AccountID);
                exit();
            }
            else
            {
                //$AccountID,$CurrentBalance,$AccountTypeID,$AccountStatusTypeID,$InterestSavingsRateID
                $sql="UPDATE SavingsInterestRates SET InterestRateValue=?, InterestRateDescription=? WHERE InterestSavingsRateID=$InterestSavingsRateID";
                $pstatement=mysqli_stmt_init($connect);
                if(!mysqli_stmt_prepare($pstatement, $sql))
                {
                    header("Location: ../Manager.php?error=sqlerror=2nd");
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($pstatement, "is",$InterestRateValue,$InterestRateDescription);
                    mysqli_stmt_execute($pstatement);
                    header("Location: ../Manager.php?createAccount=success");
                    exit();
                }

        }
    }
    mysqli_stmt_close($pstatement);
    mysqli_close($connect);
}
}
else
{
    header("Location: ../Manager.php?change=check1");
    exit();
}

