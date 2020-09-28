<head>
<link rel="stylesheet" href="fetchstyle.css">
</head?>
<?php
    if(isset($_POST['view']))
    {
        require 'db_handler.php';

        $sql="SELECT * FROM customeraccount";
        $result=mysqli_query($connect,$sql);
        $resultCheck=mysqli_num_rows($result);

        if($resultCheck>0)
        {
            while($row = mysqli_fetch_assoc($result))
            {   
                echo "<p>CustomerID: ".$row['CustomerID']."     AccountID: ".$row['AccountID']."</p>";
                //echo "CustomerID: ".$row['CustomerID']."     AccountID: ".$row['AccountID'];
                //echo '<p></p>';
                
            }
        }
        else
        {
            echo "0 results";
        }
    }
    else if(isset($_POST['find']))
    {
        require 'db_handler.php';
        $CustomerID=$_POST['CustomerID'];

        $sql="SELECT * FROM customer WHERE CustomerID = $CustomerID";
        $result=mysqli_query($connect,$sql);
        $resultCheck=mysqli_num_rows($result);

        if($resultCheck>0)
        {
            while($row = mysqli_fetch_assoc($result))
            {   
                echo "<p>CustomerID: ".$row['CustomerID']." AccountID: ".$row['AccountID']." CustomerAddress: ".$row['CustomerAddress']." Name: ".$row['CustomerFirstName']." ".$row['CustomerLastName'].
                " Country,City:  ".$row['Nation'].",".$row['City']." Email: ".$row['EmailAddress']." Phone: ".$row['Phone']." Username: ".$row['Username'].'</p>';
                //echo '<p></p>';
            }
        }
        else
        {
            echo "0 results";
        }
    }
    else if(isset($_POST['find_acc_sts']))
    {
        require 'db_handler.php';
        $CustomerID=$_POST['CustomerID_acc_sts'];

        $sql="SELECT  *
        from account
        where account.AccountID=(select AccountID from customer where CustomerID=$CustomerID);";
        $result=mysqli_query($connect,$sql);
        $resultCheck=mysqli_num_rows($result);

        if($resultCheck>0)
        {
            while($row = mysqli_fetch_assoc($result))
            {   
                echo "CustomerID: $CustomerID  AccountID: ".$row['AccountID']." CurrentBalance: ".$row['CurrentBalance']." AccountTypeID: ".$row['AccountTypeID'].
                " AccountStatusTypeID:  ".$row['AccountStatusTypeID']." InterestSavingsRateID: ".$row['InterestSavingsRateID'];
                echo '<p></p>';
                
            }
        }
        else
        {
            echo "0 results";
        }
    }
    else
    {
        echo "not pressed";
    }
    