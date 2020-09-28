<?php
if(isset($_POST['push']))
{
    require 'db_handler.php';

    $CustomerID;
    $OldBalance;
    $NewBalance;
    $TransactionID;
    $TransactionTypeID=$_POST['TransactionTypeID'];
    $TransactionAmount=$_POST['TransactionAmount'];
    $AccountID=$_POST['AccountID'];
    $EmployeeID=$_POST['EmployeeID'];
    $TransactionDate=(string)date("d-m-Y");


    $sql="SELECT MAX(TransactionID) FROM TransactionLog";
    $result=mysqli_query($connect,$sql);
    $resultCheck=mysqli_num_rows($result);
        if($resultCheck>0)
        {
            while($row = mysqli_fetch_row($result))
            {   
                $TransactionID=(int)($row[0] +1);
            }
        }
    
    $sql="SELECT CurrentBalance FROM Account WHERE AccountID = $AccountID";
    $result=mysqli_query($connect,$sql);
     $resultCheck=mysqli_num_rows($result);
            if($resultCheck>0)
            {
                while($row = mysqli_fetch_row($result))
                {   
                    $OldBalance=(double)$row[0];
                }
            }  
    
            //----------------------
    
    if($TransactionTypeID==1)
    {
        $NewBalance=(double)($OldBalance+$TransactionAmount);
        $sql="UPDATE Account SET CurrentBalance=? WHERE AccountID = $AccountID";
        $pstatement=mysqli_stmt_init($connect);
                if(!mysqli_stmt_prepare($pstatement, $sql))
                {
                    header("Location: ../Transactions.php?error=IDnotfound");
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($pstatement, "i",$NewBalance);
                    mysqli_stmt_execute($pstatement);
                }

    }
    else if($TransactionTypeID==2)
    {
        $NewBalance=(double)($OldBalance-$TransactionAmount-50);
        $sql="UPDATE Account SET CurrentBalance=? WHERE AccountID = $AccountID";
        $pstatement=mysqli_stmt_init($connect);
        if(!mysqli_stmt_prepare($pstatement, $sql))
        {
            header("Location: ../Transactions.php?error=IDnotfound");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($pstatement, "i",$NewBalance);
            mysqli_stmt_execute($pstatement);
        }

    }
    else
    {
        $NewBalance=($OldBalance+$TransactionAmount-150);
        $sql="UPDATE Account SET CurrentBalance=? WHERE AccountID = $AccountID";
        $pstatement=mysqli_stmt_init($connect);
        if(!mysqli_stmt_prepare($pstatement, $sql))
        {
            header("Location: ../Transactions.php?error=IDnotfound");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($pstatement, "i",$NewBalance);
            mysqli_stmt_execute($pstatement);
        }
    }

    //----


    if(empty($EmployeeID)||empty($TransactionAmount)||empty($TransactionTypeID)||empty($AccountID))
    {
        header("Location: ../Transactions.php?error=emptyfields");
        exit();
    }
    else
    {
        $sql="SELECT CustomerID from CustomerAccount WHERE AccountID = $AccountID";
        $result=mysqli_query($connect,$sql);
        $resultCheck=mysqli_num_rows($result);
        if($resultCheck>0)
        {
            while($row = mysqli_fetch_row($result))
            {   
                $CustomerID=$row[0];
            }
        }


        $sql="SELECT TransactionID FROM TransactionLog WHERE TransactionID=?";
        $pstatement=mysqli_stmt_init($connect);
        if(!mysqli_stmt_prepare($pstatement,$sql))
        {
            header("Location: ../Transactions.php?errorr=sqlerror=TransactionID_error_select_sql_TRANSACTONPUSH");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($pstatement, "i", $TransactionID);
            mysqli_stmt_execute($pstatement);
            //---------------------------------
            mysqli_stmt_store_result($pstatement);
            $resultCheck=mysqli_stmt_num_rows($pstatement);
            if($resultCheck>0)
            {
                header("Location: ../Transactions.php?error=TransactionIDdoesnotExist");
                //echo "TransactionID with the following ID does exist.";
                exit();
            }
            else
            {
                //SQL QUERY-----------------------------------------------------------------------------------------------------------
                $sql="INSERT INTO TransactionLog VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
                $pstatement=mysqli_stmt_init($connect);
                if(!mysqli_stmt_prepare($pstatement, $sql))
                {
                    header("Location: ../Transactions.php?error=sqlerror=3rd_del");
                    echo "SQL ERROR.";
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($pstatement, "isiidiii",$TransactionID,$TransactionDate,$TransactionTypeID,$TransactionAmount,$NewBalance,$AccountID,$CustomerID,$EmployeeID);
                    mysqli_stmt_execute($pstatement);
                    header("Location: ../Transactions.php?addnewemployee=success");
                    exit();
                }
            }
    }

} 
}