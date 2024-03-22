<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="./assets/app.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<?php
session_start();
if ($_SESSION["isLoggedin"] == false) {
    header('location:/index.php');
}
require $_SERVER['DOCUMENT_ROOT'] . "/assets/php/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";

$branchcount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as count FROM branch"))['count'];

$employeecount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as count FROM employees"))['count'];
$clerkcount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as count FROM employees WHERE EmployeeRole='clerk'"))['count'];
$managercount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as count FROM employees WHERE EmployeeRole='manager'"))['count'];

$customercount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as count FROM customers"))['count'];
$activeCustomerCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as count FROM customers WHERE Status='ACTIVE'"))['count'];
$inactiveCustomerCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as count FROM customers WHERE Status='INACTIVE'"))['count'];
$loanDetails = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(LoanAmount) as totalLoanAmount, SUM(LoanPaid) as totalLoanRecovered FROM loanapp"));
$totalTransactionAmount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(TransactionAmount) as totalTransactionAmount FROM transactions"))['totalTransactionAmount'];
?>

<body>
    <nav class="navbar">
        <div class="profile-nav">
            <div class="logo">
                <div>
                    <img src="/images/logo.jpg" alt="">
                </div>
                <p>Bank of Bhadrak</p>
            </div>
            <div class="profile">
                <h4>
                    Welcome ADMIN 👋
                </h4>
                <div class="dropdown">
                    <img src="/images/admin.jpg" class="users" alt="">
                    <div class="items">
                        <a href="/assets/php/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="bottom-nav">
        <div class="s1">
            <ul>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="user_modify.php">User modify</a></li>
                <li><a href="branch_modify.php">Branch modify</a></li>
                <li><a href="announcement_modify.php">Modify announcements</a></li>
                <li><a href="enquiry.php">Enquiries</a></li>
            </ul>
        </div>
        <div>
            <div class="tooltip">
                <a href=""> <button>
                        <i class="fa-solid fa-arrows-rotate"></i>
                    </button>
                </a>
            </div>
        </div>
    </div>
    <main>
        <div class="dashboard-section">
            <div class="container">
                <div class="box">
                    <div class="title">
                        <h4>No. of branches</h4>
                    </div>
                    <div class="content">
                        <p><?php echo $branchcount; ?> Nos</p>
                    </div>
                </div>
                <div class="box">
                    <div class="title">
                        <h4>No. of users</h4>
                    </div>
                    <div class="content">
                        <p><?php echo $employeecount; ?> Nos</p>
                    </div>
                </div>
                <div class="box">
                    <div class="title">
                        <h4>No. of clerks</h4>
                    </div>
                    <div class="content">
                        <p><?php echo $clerkcount; ?> Nos</p>
                    </div>
                </div>
                <div class="box">
                    <div class="title">
                        <h4>No. of managers</h4>
                    </div>
                    <div class="content">
                        <p><?php echo $managercount ?> Nos</p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="box">
                    <div class="title">
                        <h4>Total customers:</h4>
                    </div>
                    <div class="content">
                        <p><?php echo $customercount; ?> Nos</p>
                    </div>
                </div>
                <div class="box">
                    <div class="title">
                        <h4>Total active customers:</h4>
                    </div>
                    <div class="content">
                        <p><?php echo $activeCustomerCount; ?> Nos</p>
                    </div>
                </div>
                <div class="box">
                    <div class="title">
                        <h4>Total inactive customers:</h4>
                    </div>
                    <div class="content">
                        <p><?php echo $inactiveCustomerCount; ?> Nos</p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="box">
                    <div class="title">
                        <h4>Total transactions done:</h4>
                    </div>
                    <div class="content">
                        <p>Rs <?php echo $totalTransactionAmount; ?> </p>
                    </div>
                </div>
                <div class="box">
                    <div class="title">
                        <h4>Total loans sanctioned :</h4>
                    </div>
                    <div class="content">
                        <p>Rs <?php echo $loanDetails['totalLoanAmount']; ?></p>
                    </div>
                </div>
                <div class="box">
                    <div class="title">
                        <h4>Total loans recovered :</h4>
                    </div>
                    <div class="content">
                        <p>Rs <?php echo $loanDetails['totalLoanRecovered']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="center">
            <h3> Transaction's Details: </h3>
        </div>

        <div class="chart-section">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">Pie Chart</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart">
                                <canvas id="pie_chart" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">Doughnut Chart</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart">
                                <canvas id="doughnut_chart"  height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">Bar Chart</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart">
                                <canvas id="bar_chart"  height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="center">
            <h3> Employee Details <small>(Total Employees :<?php echo $employeecount ?>)</small> </h3>
        </div>

        <div class="chart-section">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">Pie Chart</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart">
                                <canvas id="employee_pie_chart"  height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">Doughnut Chart</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart">
                                <canvas id="employee_doughnut_chart"  height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">Bar Chart</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart">
                                <canvas id="employee_bar_chart"  height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="center">
            <h3> Customers Details <small>(Total Customers :<?php echo $customercount ?>)</small></h3>
        </div>

        <div class="chart-section">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">Pie Chart</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart">
                                <canvas id="customer_pie_chart"  height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">Doughnut Chart</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart">
                                <canvas id="customer_doughnut_chart"  height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">Bar Chart</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart">
                                <canvas id="customer_bar_chart"  height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>
    <footer>
        <p>&copy; 2024 Bank of Bhadrak. All rights reserved.
        </p>
    </footer>
</body>

</html>

<script>
    $(document).ready(function() {
        makechart();

        function makechart() {
            $.ajax({
                url: "data.php",
                method: "POST",
                data: {
                    getTransactions: 'fetch'
                },
                dataType: "JSON",
                success: function(data) {
                    var Actions = [];
                    var total = [];
                    var amount = [];
                    var color = [];

                    for (var count = 0; count < data.length; count++) {
                        Actions.push(data[count].Actions);
                        total.push(data[count].total);
                        amount.push(data[count].amount);
                        color.push(data[count].color);
                    }

                    var chart_data = {
                        labels: Actions,
                        datasets: [{
                            label: 'Actions',
                            backgroundColor: color,
                            color: '#fff',
                            data: amount
                        }]
                    };

                    var options = {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0
                                }
                            }]
                        }
                    };

                    var group_chart1 = $('#pie_chart');

                    var graph1 = new Chart(group_chart1, {
                        type: "pie",
                        data: chart_data
                    });

                    var group_chart2 = $('#doughnut_chart');

                    var graph2 = new Chart(group_chart2, {
                        type: "doughnut",
                        data: chart_data
                    });

                    var group_chart3 = $('#bar_chart');

                    var graph3 = new Chart(group_chart3, {
                        type: 'bar',
                        data: chart_data,
                        options: options
                    });
                }
            })
        }
    });


    $(document).ready(function() {
        makechart();

        function makechart() {
            $.ajax({
                url: "data.php",
                method: "POST",
                data: {
                    getEmployees: 'fetch'
                },
                dataType: "JSON",
                success: function(data) {
                    var Role = [];
                    var total = [];
                    var color = [];

                    for (var count = 0; count < data.length; count++) {
                        Role.push(data[count].Role);
                        total.push(data[count].total);
                        color.push(data[count].color);
                    }

                    var chart_data = {
                        labels: Role,
                        datasets: [{
                            label: 'Role',
                            backgroundColor: color,
                            color: '#fff',
                            data: total
                        }]
                    };

                    var options = {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0
                                }
                            }]
                        }
                    };

                    var group_chart1 = $('#employee_pie_chart');
                    var graph1 = new Chart(group_chart1, {
                        type: "pie",
                        data: chart_data
                    });

                    var group_chart2 = $('#employee_doughnut_chart');
                    var graph2 = new Chart(group_chart2, {
                        type: "doughnut",
                        data: chart_data
                    });

                    var group_chart3 = $('#employee_bar_chart');
                    var graph3 = new Chart(group_chart3, {
                        type: 'bar',
                        data: chart_data,
                        options: options
                    });
                }
            })
        }
    });

    $(document).ready(function() {
        makechart();

        function makechart() {
            $.ajax({
                url: "data.php",
                method: "POST",
                data: {
                    getCustomers: 'fetch'
                },
                dataType: "JSON",
                success: function(data) {
                    var Status = [];
                    var total = [];
                    var color = [];

                    for (var count = 0; count < data.length; count++) {
                        Status.push(data[count].Status);
                        total.push(data[count].total);
                        color.push(data[count].color);
                    }

                    var chart_data = {
                        labels: Status,
                        datasets: [{
                            label: 'Status',
                            backgroundColor: color,
                            color: '#fff',
                            data: total
                        }]
                    };

                    var options = {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0
                                }
                            }]
                        }
                    };

                    var group_chart1 = $('#customer_pie_chart');
                    var graph1 = new Chart(group_chart1, {
                        type: "pie",
                        data: chart_data
                    });

                    var group_chart2 = $('#customer_doughnut_chart');
                    var graph2 = new Chart(group_chart2, {
                        type: "doughnut",
                        data: chart_data
                    });

                    var group_chart3 = $('#customer_bar_chart');
                    var graph3 = new Chart(group_chart3, {
                        type: 'bar',
                        data: chart_data,
                        options: options
                    });
                }
            })
        }
    });
</script>