<?php
function updateTransaction($sendersAccountNo, $receiversAccountNo, $amount, $remark)
{
    require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
    $senders_info = mysqli_query($conn, "SELECT * FROM customers WHERE AccountNo='$sendersAccountNo'");
    $receivers_info = mysqli_query($conn, "SELECT * FROM customers WHERE AccountNo='$receiversAccountNo'");
    $sender_data = mysqli_fetch_assoc($senders_info);
    $receiver_data = mysqli_fetch_assoc($receivers_info);
    if (mysqli_num_rows($receivers_info) > 0) {
        $new_senders_balance = $sender_data['Balance'] - $amount;
        $new_receivers_balance = $receiver_data['Balance'] + $amount;
        mysqli_query($conn, "UPDATE customers SET Balance='$new_senders_balance' WHERE AccountNo='$sendersAccountNo'");
        mysqli_query($conn, "UPDATE customers SET Balance='$new_receivers_balance' WHERE AccountNo='$receiversAccountNo'");
        mysqli_query($conn, "INSERT INTO `transactions`(`TransactionAmount`, `Sender`, `Receiver`,`Actions`, `Remark`,`SenderBalance`, `ReceiverBalance`) VALUES ('$amount','$sendersAccountNo','$receiversAccountNo','Transfer','$remark',$new_senders_balance,$new_receivers_balance);");
        $today = date('Y-m-d H:i:s');
        $senderNotification = "A/c debited Rs.$amount on $today to $receiversAccountNo. Total Bal : Rs.$new_senders_balance";
        $receiverNotification = "Your A/c is credited by Rs.$amount , Total Bal : Rs.$new_receivers_balance as on: $today";

        mysqli_query($conn, "INSERT INTO `notifications`(`Actions`, `AccountNo`, `Message`) VALUES ('debit', $sendersAccountNo, '$senderNotification')");
        mysqli_query($conn, "INSERT INTO `notifications`(`Actions`, `AccountNo`, `Message`) VALUES ('credit', $receiversAccountNo, '$receiverNotification')");
        echo "<script>alert('Fund transfer successful'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
    } else {
        echo "<script>var err = document.getElementsByClassName('error-text')[0];
        err.innerText = 'Receiver account not found';
        err.style.display='block';
        </script>";
    }
}


function calculateInterest($principal, $days, $tanure)
{
    if ($days >= 7 && $days <= 14) {
        $interestRate = 2.80;
    } elseif ($days >= 15 && $days <= 29) {
        $interestRate = 2.80;
    } elseif ($days >= 30 && $days <= 45) {
        $interestRate = 3.00;
    } elseif ($days >= 46 && $days <= 90) {
        $interestRate = 3.25;
    } elseif ($days >= 91 && $days <= 120) {
        $interestRate = 3.50;
    } elseif ($days >= 121 && $days <= 180) {
        $interestRate = 3.85;
    } elseif ($days >= 181 && $days < 270) {
        $interestRate = 4.50;
    } elseif ($days >= 270 && $days < 365) {
        $interestRate = 4.75;
    } elseif ($days == 365) {
        $interestRate = 6.10;
    } elseif ($days > 365 && $days < 730) {
        $interestRate = 6.30;
    } elseif ($days >= 730 && $days < 1095) {
        $interestRate = 6.70;
    } elseif ($days >= 1095 && $days < 1825) {
        $interestRate = 6.25;
    } elseif ($days == 1825) {
        $interestRate = 6.25;
    } elseif ($days > 1825) {
        $interestRate = 6.10;
    } else {
        return "Invalid number of days.";
    }
    $tanure = $tanure / 12;
    $interest = ($principal * $interestRate * $tanure) / 100;
    $totalAmount = $principal + $interest;
    $data = array("principal" => $principal, "interestRate" => $interestRate, "interest" => $interest, "totalAmount" => $totalAmount);
    return $data;
}

function fdCreate($accountNo, $principal,$currentDate, $tanure, $endDate, $interestRate, $interest, $finalAmount, $balance)
{
    require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
    $strFDNo = '9124' . rand(100000, 999999);
    $FDno = (int)$strFDNo;
    mysqli_query($conn, "INSERT INTO `fd`(`customerAccountNo`, `FDAccountNo`, `Principal`, `Tanure`, `InterestRate`,`Interest`, `FinalAmount`,`current_value`,`FDOpeningDate`, `FDBreakDate`, `Status`) VALUES ($accountNo,$FDno,$principal,$tanure,$interestRate,$interest,$finalAmount,$principal,'" . $currentDate->format('Y-m-d') . "','" . $endDate->format('Y-m-d') . "','ONGOING')");
    $today = $currentDate->format('Y-m-d');
    $years = (int)($tanure / 12);
    $months = $tanure % 12;
    $notification = "Rs $principal of FD is created on $today for $years years and $months months";
    mysqli_query($conn, "INSERT INTO `notifications`( `Actions`, `AccountNo`, `Message`) VALUES ('FDCreated',$accountNo,'$notification')");

    $bankBalance = $balance - $principal;
    mysqli_query($conn, "UPDATE customers SET Balance=$bankBalance WHERE AccountNo=$accountNo");

    mysqli_query($conn, "INSERT INTO `transactions`(`TransactionAmount`,`Sender`, `Actions`,`Remark`,`SenderBalance`) VALUES ('$principal','$accountNo','fd_booked','$FDno',$bankBalance);");
}

function fdBreak($accountNo, $fdNo, $balance, $fdAmount)
{
    require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
    $bankBalance = $fdAmount + $balance;
    mysqli_query($conn, "DELETE FROM fd WHERE FDAccountNo=$fdNo");
    mysqli_query($conn, "UPDATE customers SET Balance=$bankBalance WHERE AccountNo=$accountNo");

    $notification = "Rs $fdAmount of FD is breaked and money transferred to your accountno $accountNo successfully";
    mysqli_query($conn, "INSERT INTO `notifications`( `Actions`, `AccountNo`, `Message`) VALUES ('FDBreaked',$accountNo,'$notification')");

    mysqli_query($conn, "INSERT INTO `transactions`(`TransactionAmount`,`Receiver`,`Actions`,`Remark`,`ReceiverBalance`) VALUES ('$fdAmount','$accountNo','fd_breaked','$fdNo',$bankBalance);");
}


function applyLoan($accountNo, $amount, $loanType, $ifsc,$name)
{
    require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
    $strLoanNo = '2024' . rand(1000, 9999);
    $loanNo = (int)$strLoanNo;

    mysqli_query($conn, "INSERT INTO `loanapp`(`LoanAccountNo`, `customerAccountNo`,`customerBranch`,`customerName`, `LoanAmount`, `LoanType`) VALUES ($loanNo,$accountNo,'$ifsc','$name',$amount,'$loanType')");
    echo "<script>alert('Your loan application is received. wait for approval.'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
}

function paydue($accountno,$loanNo,$payamount){
    require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
    $account=mysqli_query($conn,"SELECT * FROM customers WHERE AccountNo=$accountno");
    $loan=mysqli_query($conn,"SELECT * FROM loanapp WHERE LoanAccountNo=$loanNo");
    $account_data=mysqli_fetch_assoc($account);
    $loan_data=mysqli_fetch_assoc($loan);
    if($payamount>$loan_data['LoanDue']){
        echo "<script>alert('You are over paying your due. Transaction aborted !!');</script>";
    }else{
        $bankBalance=$account_data['Balance']-$payamount;
        $remainingDue=$loan_data['LoanDue']-$payamount;
        $totalPaid=$loan_data['LoanPaid']+$payamount;
        mysqli_query($conn,"UPDATE customers SET Balance=$bankBalance WHERE AccountNo=$accountno");
        if($remainingDue == 0){
            mysqli_query($conn,"UPDATE loanapp SET LoanPaid=$totalPaid,LoanDue=$remainingDue,Status='FULLY PAID' WHERE LoanAccountNo=$loanNo");
            echo "<script>alert('Fully paid your due for Loan A/c: $loanNo'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
        }else{
            mysqli_query($conn,"UPDATE loanapp SET LoanPaid=$totalPaid,LoanDue=$remainingDue,Status='PARTIAL PAYMENT DONE' WHERE LoanAccountNo=$loanNo");
            echo "<script>alert('Payment successful . remaining amount. $remainingDue'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
        }

        mysqli_query($conn, "INSERT INTO `transactions`(`TransactionAmount`,`Sender`, `Actions`,`Remark`,`SenderBalance`) VALUES ('$payamount','$accountno','loan_due_paid','$loanNo',$bankBalance);");

        $notification = "you paid Rs $payamount and remaining due is : Rs $remainingDue";
        mysqli_query($conn, "INSERT INTO `notifications`( `Actions`, `AccountNo`, `Message`) VALUES ('loanPaid',$accountno,'$notification')");

        echo "<script>alert('Payment Successful') window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
    }

}

?>