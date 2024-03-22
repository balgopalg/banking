-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 09:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mybank`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `AnnouncementID` int(11) NOT NULL,
  `AnnouncementDate` date NOT NULL DEFAULT current_timestamp(),
  `Subject` varchar(100) NOT NULL,
  `AnnouncementMessage` varchar(500) NOT NULL,
  `Link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`AnnouncementID`, `AnnouncementDate`, `Subject`, `AnnouncementMessage`, `Link`) VALUES
(1, '2024-02-28', 'Open Account', 'Open a new account now <a href=\'/bms/openaccount.php\'>click here</a>. To start your journey.', '/bms/openaccount.php'),
(9, '2024-03-05', '🚨 ALERT: ALIEN DETECTED 🚨', 'Attention all citizens,\r\n\r\nWe regret to inform you that an unidentified extraterrestrial presence has been detected within the vicinity. For safety reasons, the authorities have ordered the immediate closure of all banks until further notice.\r\n\r\nPlease remain calm and cooperate with the instructions provided by law enforcement personnel. Avoid unnecessary panic and stay indoors until the situation is under control.\r\n\r\nYour safety is our utmost priority. We will provide updates as the situation d', '/bms/components/announcements/announcements.php');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `ID` int(11) NOT NULL,
  `BranchName` varchar(100) NOT NULL,
  `BranchManager` varchar(100) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `District` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `Pincode` bigint(20) NOT NULL,
  `IFSC` varchar(20) NOT NULL,
  `WorkingHours` varchar(100) NOT NULL DEFAULT '10:00 AM To 04:00 PM',
  `NonWorkingDays` varchar(1000) NOT NULL DEFAULT 'Sundays, Public Holidays, 2nd and 4th Saturday Of Every Month',
  `Classification` varchar(100) NOT NULL,
  `Phone` bigint(15) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`ID`, `BranchName`, `BranchManager`, `Address`, `District`, `State`, `Pincode`, `IFSC`, `WorkingHours`, `NonWorkingDays`, `Classification`, `Phone`, `Email`) VALUES
(1, 'BHADRAK', 'G. Bal Gopal', 'balgopal@bdk.com', 'BHADRAK', 'ODISHA', 756100, 'BDK000B001', '10:00 AM To 04:00 PM', 'Sundays, Public Holidays, 2nd and 4th Saturday Of Every Month', 'urban', 8260429141, 'balgopal@manager.com'),
(2, 'BHADRAK COLLEGE', 'DEEPANKAR SINGHA', 'BHADRAK COLLEGE', 'BHADRAK', 'ODISHA', 756100, 'BDK000B002', '10:00 AM To 04:00 PM', 'Sundays, Public Holidays, 2nd and 4th Saturday Of Every Month', 'urban', 7606994417, 'deepankar@bdkclg.com');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(1000) NOT NULL,
  `phoneno` bigint(11) NOT NULL,
  `message` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `ID` int(11) NOT NULL,
  `CRN` bigint(20) NOT NULL,
  `AccountNo` bigint(20) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Balance` decimal(11,2) NOT NULL,
  `PhoneNo` bigint(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `Address` varchar(500) NOT NULL,
  `District` varchar(100) NOT NULL,
  `State` varchar(100) NOT NULL,
  `Pincode` int(11) NOT NULL,
  `AadhaarNo` bigint(20) NOT NULL,
  `IFSC` varchar(20) NOT NULL,
  `img` varchar(255) NOT NULL,
  `DateOfOpening` date NOT NULL,
  `lastInterestDate` date NOT NULL DEFAULT current_timestamp(),
  `LastLogin` varchar(50) NOT NULL,
  `Status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `EmployeeID` bigint(20) NOT NULL,
  `EmployeeName` varchar(100) NOT NULL,
  `EmployeeEmail` varchar(100) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `EmployeeIFSC` varchar(20) NOT NULL,
  `EmployeeBranch` int(11) NOT NULL,
  `EmployeeRole` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EmployeeID`, `EmployeeName`, `EmployeeEmail`, `UserName`, `Password`, `EmployeeIFSC`, `EmployeeBranch`, `EmployeeRole`) VALUES
(45, 'KIRAN MURMU', 'kiran@clerk.com', 'kiran', 'kiran', 'BDK000B002', 2, 'clerk'),
(61, 'Deepankar', 'deepankar@manager.com', 'deepankar', 'deepankar', 'BDK000B002', 2, 'manager'),
(62, 'balgopal', 'balgopal@manager.com', 'balgopal', 'balgopal', 'BDK000B001', 1, 'manager'),
(63, 'sourav', 'sourav@clerk.com', 'sourav', 'sourav', 'BDK000B001', 1, 'clerk');

-- --------------------------------------------------------

--
-- Table structure for table `fd`
--

CREATE TABLE `fd` (
  `ID` int(11) NOT NULL,
  `customerAccountNo` bigint(20) NOT NULL,
  `FDAccountNo` bigint(20) NOT NULL,
  `Principal` decimal(11,2) NOT NULL,
  `Tanure` int(11) NOT NULL,
  `InterestRate` decimal(10,2) NOT NULL,
  `Interest` decimal(10,2) NOT NULL,
  `FinalAmount` decimal(11,2) NOT NULL,
  `current_value` decimal(10,2) NOT NULL,
  `lastIntCreditDate` date NOT NULL DEFAULT current_timestamp(),
  `FDOpeningDate` date NOT NULL DEFAULT current_timestamp(),
  `FDBreakDate` date NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'ONGOING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loanapp`
--

CREATE TABLE `loanapp` (
  `LoanID` int(11) NOT NULL,
  `LoanAccountNo` bigint(20) NOT NULL,
  `customerAccountNo` bigint(20) NOT NULL,
  `customerBranch` varchar(255) NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `LoanAmount` decimal(10,2) NOT NULL,
  `LoanType` varchar(255) NOT NULL,
  `LoanPaid` decimal(10,2) NOT NULL,
  `LoanDue` decimal(10,2) NOT NULL,
  `Status` varchar(255) DEFAULT 'NOT SANCTIONED',
  `SanctionDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `Time` datetime NOT NULL DEFAULT current_timestamp(),
  `Actions` varchar(255) NOT NULL,
  `AccountNo` bigint(20) NOT NULL,
  `Message` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payee`
--

CREATE TABLE `payee` (
  `ID` int(11) NOT NULL,
  `customerAccNo` bigint(20) NOT NULL,
  `payeeAccountNo` bigint(20) NOT NULL,
  `payeeName` varchar(255) NOT NULL,
  `payeeNickname` varchar(255) NOT NULL,
  `payeeIFSC` varchar(255) NOT NULL,
  `LastTransactionAmount` decimal(10,2) NOT NULL,
  `LastTransactionDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `ID` int(11) NOT NULL,
  `reqID` int(11) NOT NULL,
  `accountno` bigint(20) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `message` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rmrequest`
--

CREATE TABLE `rmrequest` (
  `ID` int(11) NOT NULL,
  `requestDate` date NOT NULL DEFAULT current_timestamp(),
  `customerAccountNo` bigint(20) NOT NULL,
  `customerBranch` varchar(255) NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `message` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `TransactionID` bigint(20) NOT NULL,
  `TransactionDate` datetime NOT NULL DEFAULT current_timestamp(),
  `TransactionAmount` decimal(20,2) NOT NULL,
  `Sender` bigint(20) NOT NULL,
  `Receiver` bigint(20) NOT NULL,
  `SenderBalance` decimal(10,2) NOT NULL,
  `ReceiverBalance` decimal(10,2) NOT NULL,
  `Actions` varchar(200) NOT NULL,
  `Remark` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`AnnouncementID`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `IFSC` (`IFSC`) USING BTREE,
  ADD UNIQUE KEY `unique_branch` (`BranchName`),
  ADD UNIQUE KEY `unique_branch_mail` (`Email`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `unique_email` (`Email`),
  ADD UNIQUE KEY `unique_username` (`UserName`),
  ADD KEY `fk_customer_branch` (`IFSC`),
  ADD KEY `AccountNo` (`AccountNo`) USING BTREE;

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD UNIQUE KEY `EmployeeEmail` (`EmployeeEmail`),
  ADD UNIQUE KEY `UserName` (`UserName`),
  ADD KEY `fk_employee_branch` (`EmployeeBranch`),
  ADD KEY `fk_employee_ifsc` (`EmployeeIFSC`);

--
-- Indexes for table `fd`
--
ALTER TABLE `fd`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FD_customerAccountNo` (`customerAccountNo`);

--
-- Indexes for table `loanapp`
--
ALTER TABLE `loanapp`
  ADD PRIMARY KEY (`LoanID`),
  ADD KEY `loan_customerAccountNo` (`customerAccountNo`),
  ADD KEY `loan_customer_branch` (`customerBranch`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `notification_AccountNo` (`AccountNo`);

--
-- Indexes for table `payee`
--
ALTER TABLE `payee`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Payee_customerAccountNo` (`customerAccNo`),
  ADD KEY `payee_AccountNo` (`payeeAccountNo`),
  ADD KEY `payee_ifsc` (`payeeIFSC`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `replies_customerAccountNo` (`accountno`),
  ADD KEY `fk_customer_reqid` (`reqID`);

--
-- Indexes for table `rmrequest`
--
ALTER TABLE `rmrequest`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `customerAccountNo` (`customerAccountNo`),
  ADD KEY `rm_customer_branch` (`customerBranch`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`TransactionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `AnnouncementID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `EmployeeID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `fd`
--
ALTER TABLE `fd`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `loanapp`
--
ALTER TABLE `loanapp`
  MODIFY `LoanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT for table `payee`
--
ALTER TABLE `payee`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `rmrequest`
--
ALTER TABLE `rmrequest`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `TransactionID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `fk_customer_branch` FOREIGN KEY (`IFSC`) REFERENCES `branch` (`IFSC`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `fk_employee_branch` FOREIGN KEY (`EmployeeBranch`) REFERENCES `branch` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_employee_ifsc` FOREIGN KEY (`EmployeeIFSC`) REFERENCES `branch` (`IFSC`) ON DELETE CASCADE;

--
-- Constraints for table `fd`
--
ALTER TABLE `fd`
  ADD CONSTRAINT `FD_customerAccountNo` FOREIGN KEY (`customerAccountNo`) REFERENCES `customers` (`AccountNo`) ON DELETE CASCADE;

--
-- Constraints for table `loanapp`
--
ALTER TABLE `loanapp`
  ADD CONSTRAINT `loan_customerAccountNo` FOREIGN KEY (`customerAccountNo`) REFERENCES `customers` (`AccountNo`) ON DELETE CASCADE,
  ADD CONSTRAINT `loan_customer_branch` FOREIGN KEY (`customerBranch`) REFERENCES `branch` (`IFSC`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notification_AccountNo` FOREIGN KEY (`AccountNo`) REFERENCES `customers` (`AccountNo`) ON DELETE CASCADE;

--
-- Constraints for table `payee`
--
ALTER TABLE `payee`
  ADD CONSTRAINT `Payee_customerAccountNo` FOREIGN KEY (`customerAccNo`) REFERENCES `customers` (`AccountNo`) ON DELETE CASCADE,
  ADD CONSTRAINT `payee_AccountNo` FOREIGN KEY (`payeeAccountNo`) REFERENCES `customers` (`AccountNo`) ON DELETE CASCADE,
  ADD CONSTRAINT `payee_ifsc` FOREIGN KEY (`payeeIFSC`) REFERENCES `branch` (`IFSC`) ON DELETE CASCADE;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `fk_customer_reqid` FOREIGN KEY (`reqID`) REFERENCES `rmrequest` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `replies_customerAccountNo` FOREIGN KEY (`accountno`) REFERENCES `customers` (`AccountNo`) ON DELETE CASCADE;

--
-- Constraints for table `rmrequest`
--
ALTER TABLE `rmrequest`
  ADD CONSTRAINT `customerAccountNo` FOREIGN KEY (`customerAccountNo`) REFERENCES `customers` (`AccountNo`) ON DELETE CASCADE,
  ADD CONSTRAINT `rm_customer_branch` FOREIGN KEY (`customerBranch`) REFERENCES `branch` (`IFSC`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
