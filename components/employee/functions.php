<?php

function deposit($accountno, $amount, $balance)
{
    require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
    $balance = $balance + $amount;
    mysqli_query($conn, "UPDATE customers SET Balance=$balance WHERE AccountNo=$accountno");
    echo "<script>alert('New Account Balance : " . $balance . "');</script>";
    $notification = "Amount of Rs. $amount has been deposited to your A/c: $accountno. Total Bal : Rs.$balance";
    mysqli_query($conn, "INSERT INTO `notifications`( `Actions`, `AccountNo`, `Message`) VALUES ('credit',$accountno,'$notification')");

    mysqli_query($conn, "INSERT INTO `transactions`(`TransactionAmount`, `Receiver`, `Actions`,`ReceiverBalance`) VALUES ('$amount','$accountno','deposit',$balance);");
}
function withdraw($accountno, $amount, $balance)
{
    require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
    $balance = $balance - $amount;
    mysqli_query($conn, "UPDATE customers SET Balance=$balance WHERE AccountNo=$accountno");
    echo "<script>alert('New Account Balance : " . $balance . "');</script>";
    $notification = "Amount of Rs. $amount has been withdrawn from your A/c: $accountno. Total Bal : Rs. $balance";
    mysqli_query($conn, "INSERT INTO `notifications`( `Actions`, `AccountNo`, `Message`) VALUES ('debit',$accountno,'$notification')");

    mysqli_query($conn, "INSERT INTO `transactions`(`TransactionAmount`, `Sender`, `Actions`,`SenderBalance`) VALUES ('$amount','$accountno','withdraw',$balance);");
}

function fundTransfer($sendersAccountNo, $receiversAccountNo, $senderBalance, $receiverBalance, $amount, $remark)
{
    require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
    $senderBalance = $senderBalance - $amount;
    $receiverBalance = $receiverBalance + $amount;
    mysqli_query($conn, "UPDATE customers SET Balance=$senderBalance WHERE AccountNo=$sendersAccountNo;");
    mysqli_query($conn, "UPDATE customers SET Balance=$receiverBalance WHERE AccountNo=$receiversAccountNo;");
    mysqli_query($conn, "INSERT INTO `transactions`(`TransactionAmount`, `Sender`, `Receiver`,`Actions`, `Remark`,`SenderBalance`,`ReceiverBalance`) VALUES ('$amount','$sendersAccountNo','$receiversAccountNo','Transfer','$remark',$senderBalance,$receiverBalance);");

    $today = Date('Y-m-d H:i:s');
    $senderNotification = "A/c debited Rs.$amount on $today to $receiversAccountNo. Total Bal : Rs.$senderBalance";
    $receiverNotification = "Your A/c is credited by Rs.$amount from $sendersAccountNo, Total Bal : Rs.$receiverBalance as on: $today";

    mysqli_query($conn, "INSERT INTO `notifications`(`Actions`, `AccountNo`, `Message`) VALUES ('debit', $sendersAccountNo, '$senderNotification')");
    mysqli_query($conn, "INSERT INTO `notifications`(`Actions`, `AccountNo`, `Message`) VALUES ('credit', $receiversAccountNo, '$receiverNotification')");
}

function approve($email, $crn, $accountno, $ifsc)
{
    require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
    $currentDate = date('Y:m:d');
    $time = date("Y-m-d H:i:s");
    if (mysqli_query($conn, "UPDATE customers SET CRN = $crn , AccountNo = $accountno , DateOfOpening='$currentDate', Status = 'Active' , IFSC = '$ifsc', LastLogin='$time' WHERE Email='$email'")) {
        echo "<script>alert('Account Created');</script>";
        if ($result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM customers WHERE Email='$email'"))) {
            echo "<script>alert('Account no : " . $result['AccountNo'] . "');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
        }
    }
}

function loanApprove($loanNo, $loanAmount, $accountno)
{
    require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
    $loan_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM loanapp WHERE LoanAccountNo=$loanNo"));
    $loanType = $loan_data['LoanType'];
    $tanure = 5;
    if ($loanType == 'personal') {
        $interestRate = 12.75;
    } elseif ($loanType == 'home') {
        $interestRate = 8.35;
    } elseif ($loanType == 'study') {
        $interestRate = 6.50;
    } elseif ($loanType == 'business') {
        $interestRate = 14.25;
    } elseif ($loanType == 'car') {
        $interestRate = 9.75;
    }
    $interest = ($loanAmount * $interestRate * $tanure) / 100;
    $totalAmount = $loanAmount + $interest;

    $sanctionDate = date('Y-m-d');
    mysqli_query($conn, "UPDATE loanapp SET Status='SANCTIONED', LoanDue=$totalAmount , SanctionDate='$sanctionDate' WHERE LoanAccountNo=$loanNo");

    $result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM customers WHERE AccountNo=$accountno"));
    $newBalance = $loanAmount + $result['Balance'];
    mysqli_query($conn, "UPDATE customers SET Balance=$newBalance WHERE AccountNo=$accountno");

    $notification = "You loan for Rs $loanAmount vide LoanAccountNo. $loanNo is sanctioned. ";
    mysqli_query($conn, "INSERT INTO `notifications`( `Actions`, `AccountNo`, `Message`) VALUES ('loanSanctioned',$accountno,'$notification')");

    mysqli_query($conn, "INSERT INTO `transactions`(`TransactionAmount`,`Receiver`, `Actions`,`Remark`,`ReceiverBalance`) VALUES ('$loanAmount','$accountno','loan_sanctioned','$loanNo',$newBalance);");
}
function loanReject($loanNo, $accountno)
{
    require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
    mysqli_query($conn, "DELETE FROM loanApp WHERE LoanAccountNo=$loanNo");
    $notification = "You loan application vide LoanAccountNo. $loanNo is rejected. ";
    mysqli_query($conn, "INSERT INTO `notifications`( `Actions`, `AccountNo`, `Message`) VALUES ('loanRejected',$accountno,'$notification')");
}
