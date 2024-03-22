<?php
$connect = mysqli_connect('localhost', 'root', '', 'mybank');

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["getTransactions"]) && $_POST["getTransactions"] == 'fetch') {
    $query = "SELECT Actions, COUNT(*) AS total, SUM(TransactionAmount) AS amount 
              FROM transactions 
              WHERE Actions IN ('deposit', 'fd_booked', 'fd_breaked', 'loan_due_paid', 'loan_sanctioned', 'Quick Transfer', 'withdraw', 'Transfer')
              GROUP BY Actions";

    $result = mysqli_query($connect, $query);
    $data = array();

    // $actions = array('Deposit', 'FD Book', 'FD Break', 'Loan Due Payment', 'Loan Sanctioned', 'Quick Transfer', 'Withdraw', 'Transfer');
    $actions=array();


    $colors = array(
        '#f535aa',
        '#18e6f9',
        '#39ff14',
        '#effd5f',
        '#ff7f00',
        '#bf00ff',
        '#ff073a',
        '#00ffff'
    );

    if ($result) {
        $num_rows = mysqli_num_rows($result);
        for ($i = 0; $i < $num_rows; $i++) {
            $row = mysqli_fetch_assoc($result);
            array_push($actions,$row['Actions']);
            $data[] = array(
                'Actions' => $actions[$i],
                'total' => $row["total"],
                'amount' => $row["amount"],
                'color' => $colors[$i]
            );
        }
        mysqli_free_result($result);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }

    echo json_encode($data);
}

if (isset($_POST["getEmployees"]) && $_POST["getEmployees"] == 'fetch') {
    $query = "SELECT EmployeeRole, COUNT(*) AS total FROM employees WHERE EmployeeRole IN ('manager','clerk') GROUP BY EmployeeRole ORDER BY EmployeeRole asc;";

    $result = mysqli_query($connect, $query);
    $data = array();

    $employees = array();

    $colors = array(
        '#f535aa',
        '#18e6f9',
    );

    if ($result) {
        $num_rows = mysqli_num_rows($result);
        for ($i = 0; $i < $num_rows; $i++) {
            $row = mysqli_fetch_assoc($result);
            array_push($employees,$row['EmployeeRole']);
            $data[] = array(
                'Role' => $employees[$i],
                'total' => $row["total"],
                'color' => $colors[$i]
            );
        }
        mysqli_free_result($result);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }

    echo json_encode($data);
}

if (isset($_POST["getCustomers"]) && $_POST["getCustomers"] == 'fetch') {
    $query = "select Status , count(*) as total
    from customers 
    where Status IN ('Active','Inactive','Pending')
    GROUP by Status
    ORDER BY Status asc;";

    $result = mysqli_query($connect, $query);
    $data = array();

    $accountStatus = array();

    $colors = array(
        '#f535aa',
        '#18e6f9',
        '#ff073a'
    );

    if ($result) {
        $num_rows = mysqli_num_rows($result);
        for ($i = 0; $i < $num_rows; $i++) {
            $row = mysqli_fetch_assoc($result);
            array_push($accountStatus, $row['Status']);
            $data[] = array(
                'Status' => $accountStatus[$i],
                'total' => $row["total"],
                'color' => $colors[$i]
            );
        }
        mysqli_free_result($result);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }

    echo json_encode($data);
}

mysqli_close($connect);
