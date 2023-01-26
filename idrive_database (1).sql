-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2022 at 01:24 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idrive_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accounts_payable`
--

CREATE TABLE `tbl_accounts_payable` (
  `AP_ID` int(15) NOT NULL,
  `supplier_id` int(15) NOT NULL,
  `branch_id` int(15) NOT NULL,
  `User_ID` int(15) NOT NULL,
  `billing_no` varchar(50) NOT NULL,
  `amount` varchar(55) NOT NULL,
  `ap_date` date NOT NULL,
  `due_date` date NOT NULL,
  `file` text NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `isRemoved` varchar(10) NOT NULL DEFAULT 'no',
  `payment_method` varchar(20) NOT NULL,
  `description` varchar(55) NOT NULL,
  `isStatus` varchar(20) NOT NULL DEFAULT 'Unpaid',
  `isHide` varchar(10) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_accounts_payable`
--

INSERT INTO `tbl_accounts_payable` (`AP_ID`, `supplier_id`, `branch_id`, `User_ID`, `billing_no`, `amount`, `ap_date`, `due_date`, `file`, `status`, `isRemoved`, `payment_method`, `description`, `isStatus`, `isHide`) VALUES
(1, 4, 2, 3, 'BN-2022-001', '2500', '2022-12-21', '2022-12-24', 'bill.png', 'active', 'no', 'Cash', 'Water Bills', 'Paid', '3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_branch`
--

CREATE TABLE `tbl_branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_branch`
--

INSERT INTO `tbl_branch` (`branch_id`, `branch_name`, `contact`, `street`, `city`, `barangay`, `province`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Koronadal', '09464003615', 'Balmores', 'Koronadal City', 'GPS', 'South Cotabato', 'active', '2022-12-21 08:37:33', '2022-12-21 08:37:33'),
(2, 'Gensan', '09464003616', 'Olympog Road', 'General Santos', 'Conel', 'South Cotabato', 'active', '2022-12-21 08:50:25', '2022-12-21 08:50:25'),
(3, 'Polomolok', '09467309184', 'Azucena St', 'Polomolok', 'Cannery Site', 'South Cotabato', 'active', '2022-12-21 08:52:28', '2022-12-21 08:52:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_id`
--

CREATE TABLE `tbl_invoice_id` (
  `invoice_id` int(15) NOT NULL,
  `PI_ID` int(15) NOT NULL,
  `car_id` int(15) NOT NULL,
  `item_no` varchar(55) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `unit_price` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_invoice_id`
--

INSERT INTO `tbl_invoice_id` (`invoice_id`, `PI_ID`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_price`, `amount`) VALUES
(1, 1, 1, '0', '10', 'Liters', 'Premium', '62', '620.00'),
(2, 1, 2, '0', '2', 'Liters', 'Diesel', '75', '150.00'),
(3, 2, 0, '1', '2', 'piece', 'Tire', '750', '1500.00'),
(4, 3, 0, '1', '1', 'piece', 'Battery', '1200', '1200.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ledger`
--

CREATE TABLE `tbl_ledger` (
  `ledger_id` int(15) NOT NULL,
  `AP_no` varchar(50) NOT NULL,
  `PI_ID` int(15) DEFAULT NULL,
  `PV_ID` varchar(50) DEFAULT 'No Entry',
  `AP_ID` int(15) DEFAULT NULL,
  `supplier_id` int(15) NOT NULL,
  `User_ID` int(15) NOT NULL,
  `balance` varchar(50) NOT NULL,
  `invoice_amount` varchar(50) NOT NULL,
  `branch_id` int(15) NOT NULL,
  `isReference` varchar(55) NOT NULL,
  `isDue_date` date NOT NULL,
  `isStatus` varchar(55) NOT NULL DEFAULT 'Unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ledger`
--

INSERT INTO `tbl_ledger` (`ledger_id`, `AP_no`, `PI_ID`, `PV_ID`, `AP_ID`, `supplier_id`, `User_ID`, `balance`, `invoice_amount`, `branch_id`, `isReference`, `isDue_date`, `isStatus`) VALUES
(1, 'AP-2022-001', 3, 'No Entry', NULL, 3, 3, '1,200', '1,200', 2, 'PI-2022-003', '2022-12-24', 'Unpaid'),
(2, 'AP-2022-002', 2, 'No Entry', NULL, 3, 3, '1,500', '1,500', 2, 'PI-2022-002', '2022-12-24', 'Unpaid'),
(3, 'AP-2022-003', 1, 'No Entry', NULL, 1, 3, '770', '770', 2, 'PI-2022-001', '2022-12-30', 'Unpaid'),
(4, 'AP-2022-004', NULL, 'PV-2022-001', 1, 4, 3, '0', '2500', 2, 'BN-2022-001', '2022-12-24', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_schedule`
--

CREATE TABLE `tbl_payment_schedule` (
  `payment_schedule_id` int(11) NOT NULL,
  `billing_type_id` int(15) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `total_amount` varchar(50) NOT NULL,
  `due_date` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Unpaid',
  `isRemoved` varchar(50) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_voucher`
--

CREATE TABLE `tbl_payment_voucher` (
  `PV_ID` int(15) NOT NULL,
  `payment_voucher_no` varchar(50) NOT NULL,
  `branch_id` int(15) NOT NULL,
  `supplier_id` int(15) NOT NULL,
  `User_ID` int(15) NOT NULL,
  `AP_ID` int(15) DEFAULT NULL,
  `voucher_date` date NOT NULL,
  `total_amount` varchar(50) NOT NULL,
  `reciept` varchar(20) NOT NULL DEFAULT 'pending',
  `payment_method` varchar(50) NOT NULL,
  `isPending` varchar(20) NOT NULL DEFAULT 'pending',
  `isCancel` varchar(20) NOT NULL DEFAULT 'no',
  `isPaid` varchar(20) NOT NULL DEFAULT 'unpaid',
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sent` varchar(10) NOT NULL DEFAULT '0',
  `hide` varchar(10) NOT NULL DEFAULT '0',
  `remarks` text NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payment_voucher`
--

INSERT INTO `tbl_payment_voucher` (`PV_ID`, `payment_voucher_no`, `branch_id`, `supplier_id`, `User_ID`, `AP_ID`, `voucher_date`, `total_amount`, `reciept`, `payment_method`, `isPending`, `isCancel`, `isPaid`, `date_updated`, `sent`, `hide`, `remarks`, `reason`) VALUES
(1, 'PV-2022-001', 2, 4, 3, 1, '2022-12-21', '2500', 'RN-2022-001', 'Cash', 'approved', 'no', 'paid', '2022-12-21 12:09:01', '3', '2', '', ''),
(2, 'PV-2022-002', 2, 1, 3, NULL, '2022-12-21', '770', 'pending', 'Cash', 'pending', 'no', 'unpaid', '2022-12-21 12:09:08', '3', '0', '', ''),
(3, 'PV-2022-003', 2, 3, 3, NULL, '2022-12-21', '1200', 'pending', 'Cheque', 'approved', 'no', 'unpaid', '2022-12-21 12:07:57', '1', '1', '', ''),
(4, 'PV-2022-004', 2, 3, 3, NULL, '2022-12-21', '1500', 'pending', 'Cash', 'approved', 'no', 'unpaid', '2022-12-21 12:07:49', '1', '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pa_ledger`
--

CREATE TABLE `tbl_pa_ledger` (
  `PA_ID` int(15) NOT NULL,
  `PA_no` varchar(50) NOT NULL,
  `PV_ID` int(15) NOT NULL,
  `User_ID` int(15) NOT NULL,
  `reciept_id` int(15) NOT NULL,
  `paid_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pa_ledger`
--

INSERT INTO `tbl_pa_ledger` (`PA_ID`, `PA_no`, `PV_ID`, `User_ID`, `reciept_id`, `paid_amount`) VALUES
(1, 'PA-2022-001', 1, 3, 1, 2500);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_invoice`
--

CREATE TABLE `tbl_purchase_invoice` (
  `PI_ID` int(15) NOT NULL,
  `purchase_invoice_no` varchar(50) NOT NULL,
  `PO_ID` int(15) NOT NULL,
  `User_ID` int(15) NOT NULL,
  `supplier_id` int(15) NOT NULL,
  `branch_id` int(15) NOT NULL,
  `total_amount` varchar(50) NOT NULL,
  `file` text NOT NULL,
  `isRemoved` varchar(20) NOT NULL DEFAULT 'no',
  `due_date` date NOT NULL,
  `invoice_date` date NOT NULL,
  `Reference` varchar(50) NOT NULL DEFAULT '0',
  `sent` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_purchase_invoice`
--

INSERT INTO `tbl_purchase_invoice` (`PI_ID`, `purchase_invoice_no`, `PO_ID`, `User_ID`, `supplier_id`, `branch_id`, `total_amount`, `file`, `isRemoved`, `due_date`, `invoice_date`, `Reference`, `sent`) VALUES
(1, 'PI-2022-001', 1, 3, 1, 2, '770', 'invoice.png', 'no', '2022-12-30', '2022-12-21', '2', '1'),
(2, 'PI-2022-002', 3, 3, 3, 2, '1,500', 'invoice1.png', 'no', '2022-12-24', '2022-12-21', '2', '1'),
(3, 'PI-2022-003', 2, 3, 3, 2, '1,200', 'invoice2.png', 'no', '2022-12-24', '2022-12-21', '2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_no`
--

CREATE TABLE `tbl_purchase_no` (
  `purchase_request_id` int(15) NOT NULL,
  `purchase_request_no` varchar(50) NOT NULL,
  `supplier_id` int(15) NOT NULL,
  `User_ID` int(15) NOT NULL,
  `posting_date` date NOT NULL,
  `branch_id` int(15) NOT NULL,
  `category` varchar(50) NOT NULL,
  `total_cost` varchar(55) NOT NULL,
  `purpose` text NOT NULL,
  `reason` text DEFAULT NULL,
  `isPending` varchar(50) NOT NULL DEFAULT 'pending',
  `isCancel` varchar(50) NOT NULL DEFAULT 'no',
  `isForwarded` varchar(12) NOT NULL COMMENT '0=false 1=true',
  `isRead` varchar(10) NOT NULL DEFAULT 'no',
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `approved_by` varchar(50) NOT NULL,
  `pr_ref` tinyint(1) NOT NULL COMMENT '0=false 1=true',
  `request_by` varchar(55) NOT NULL,
  `forwarded_to` varchar(55) NOT NULL DEFAULT 'no',
  `forwardedby` int(15) NOT NULL,
  `post` varchar(15) NOT NULL DEFAULT '0' COMMENT '0=not post 1=post',
  `notif` varchar(15) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_purchase_no`
--

INSERT INTO `tbl_purchase_no` (`purchase_request_id`, `purchase_request_no`, `supplier_id`, `User_ID`, `posting_date`, `branch_id`, `category`, `total_cost`, `purpose`, `reason`, `isPending`, `isCancel`, `isForwarded`, `isRead`, `date_updated`, `approved_by`, `pr_ref`, `request_by`, `forwarded_to`, `forwardedby`, `post`, `notif`) VALUES
(1, 'PR-2022-001', 1, 4, '2022-12-21', 2, 'Gasoline', '760.00', 'for driving lesson', '', 'approved', 'no', '0', 'seen', '2022-12-21 09:58:16', 'Jeferson Nicolas', 1, 'Driving Instructor', 'yes', 2, '1', '3'),
(2, 'PR-2022-002', 3, 4, '2022-12-21', 2, 'Repair and Maintenance', '1200.00', 'Repair', '', 'approved', 'no', '0', 'seen', '2022-12-21 09:58:22', 'Jeferson Nicolas', 1, 'Driving Instructor', 'yes', 2, '1', '2'),
(3, 'PR-2022-003', 2, 2, '2022-12-21', 2, 'Gasoline', '878.90', 'driving lesson', '', 'disapproved', 'no', '0', 'seen', '2022-12-21 10:15:14', 'Jeferson Nicolas', 0, 'Manager', 'no', 2, '1', '1'),
(4, 'PR-2022-004', 3, 2, '2022-12-21', 2, 'Repair and Maintenance', '1500.00', 'change tire', '', 'approved', 'no', '0', 'seen', '2022-12-21 10:15:34', 'Jeferson Nicolas', 1, 'Manager', 'no', 2, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_order`
--

CREATE TABLE `tbl_purchase_order` (
  `PO_ID` int(15) NOT NULL,
  `purchase_order_no` varchar(50) NOT NULL,
  `branch_id` int(15) NOT NULL,
  `purchase_request_id` int(15) NOT NULL,
  `supplier_id` int(15) NOT NULL,
  `User_ID` int(15) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `total_amount` varchar(55) NOT NULL,
  `category` varchar(50) NOT NULL,
  `po_date` date NOT NULL,
  `isCreated` tinyint(1) NOT NULL COMMENT '0 = false 1=true',
  `isReference` varchar(10) NOT NULL DEFAULT '0' COMMENT '1=Yes 0=No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_purchase_order`
--

INSERT INTO `tbl_purchase_order` (`PO_ID`, `purchase_order_no`, `branch_id`, `purchase_request_id`, `supplier_id`, `User_ID`, `payment_method`, `total_amount`, `category`, `po_date`, `isCreated`, `isReference`) VALUES
(1, 'PO-2022-001', 2, 1, 1, 4, 'cash', '760', '', '2022-12-21', 1, '1'),
(2, 'PO-2022-002', 2, 2, 3, 4, 'cheque', '1200', '', '2022-12-21', 1, '1'),
(3, 'PO-2022-003', 2, 4, 3, 2, 'cash', '1500', '', '2022-12-21', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_request`
--

CREATE TABLE `tbl_purchase_request` (
  `PR_ID` int(15) NOT NULL,
  `purchase_request_no` int(15) NOT NULL,
  `car_id` int(15) NOT NULL,
  `item_no` varchar(55) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `unit_cost` varchar(55) NOT NULL,
  `estimated_cost` varchar(55) NOT NULL,
  `isStatus` varchar(20) NOT NULL DEFAULT '1' COMMENT '1=approved 0=disapproved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_purchase_request`
--

INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES
(1, 1, 1, 'N/A', '10', 'Liters', 'Premium', '61', '610.00', '1'),
(2, 1, 2, 'N/A', '2', 'Liters', 'Diesel', '75', '150.00', '1'),
(3, 2, 0, '1', '1', 'piece', 'Battery', '1200', '1200.00', '1'),
(4, 3, 3, 'N/A', '10', 'Liters', 'Unleaded', '87.89', '878.90', '1'),
(5, 4, 0, '1', '2', 'piece', 'Tire', '750', '1500.00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pv_reference`
--

CREATE TABLE `tbl_pv_reference` (
  `PV_Reference_id` int(15) NOT NULL,
  `PV_ID` int(15) NOT NULL,
  `PI_ID` int(15) NOT NULL,
  `quantity` int(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `unit_price` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pv_reference`
--

INSERT INTO `tbl_pv_reference` (`PV_Reference_id`, `PV_ID`, `PI_ID`, `quantity`, `unit`, `description`, `unit_price`, `amount`) VALUES
(1, 2, 1, 10, 'Liters', 'Premium', '62', '620.00'),
(2, 2, 1, 2, 'Liters', 'Diesel', '75', '150.00'),
(3, 3, 3, 1, 'piece', 'Battery', '1200', '1200.00'),
(4, 4, 2, 2, 'piece', 'Tire', '750', '1500.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reciept`
--

CREATE TABLE `tbl_reciept` (
  `reciept_id` int(15) NOT NULL,
  `reciept_no` varchar(50) NOT NULL,
  `PV_ID` int(15) NOT NULL,
  `branch_id` int(15) NOT NULL,
  `posting_date` date NOT NULL,
  `file` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_reciept`
--

INSERT INTO `tbl_reciept` (`reciept_id`, `reciept_no`, `PV_ID`, `branch_id`, `posting_date`, `file`, `status`) VALUES
(1, 'RN-2022-001', 1, 2, '2022-12-21', 'bill.png', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `supplier_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `street` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `payable_type` varchar(50) NOT NULL,
  `date_created` date NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplier_id`, `branch_id`, `supplier_name`, `contact`, `street`, `barangay`, `city`, `province`, `payable_type`, `date_created`, `status`) VALUES
(1, 1, 'Shell Gasoline Station', '09464003615', 'Road 9', 'Paraiso', 'Polomolok', 'South Cotabato', 'Gasoline', '2022-12-21', 'active'),
(2, 1, 'Toto Alba Gasoline', '09464003615', 'Osita Sub', 'Poblacion', 'General Santos', 'South Cotabato', 'Gasoline', '2022-12-21', 'active'),
(3, 1, 'Maxins', '09464003612', 'Morales', 'GPS', 'Koronadal City', 'South Cotabato', 'Repair and Maintenance', '2022-12-21', 'active'),
(4, 1, 'Water District', '09464003612', 'Road 9', 'Gensan Road', 'Polomolok', 'South Cotabato', 'Billing', '2022-12-21', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `User_ID` int(15) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Middle_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `Position` varchar(50) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `Username` varchar(225) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Status` varchar(50) NOT NULL DEFAULT 'active',
  `image` text NOT NULL,
  `OTP` varchar(50) NOT NULL,
  `Date_Created` timestamp NOT NULL DEFAULT current_timestamp(),
  `Date_Updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`User_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `contact_no`, `Position`, `branch_id`, `Username`, `Password`, `Status`, `image`, `OTP`, `Date_Created`, `Date_Updated`) VALUES
(1, 'Jeferson', 'B', 'Nicolas', '09464003615', 'General Manager', 1, 'mjtura23@gmail.com', '123', 'active', '', '111111', '2022-12-21 08:38:21', '2022-12-21 08:38:21'),
(2, 'Nicole Jhan', 'B', 'Billones', '09464003612', 'Manager', 2, 'billones@gmail.com', '12345', 'active', '', '931492', '2022-12-21 08:56:22', '2022-12-21 08:56:22'),
(3, 'Ayner', 'E', 'Tora', '09464003617', 'Finance Clerk', 2, 'ayner@gmail.com', '12345', 'active', '', '551183', '2022-12-21 09:01:20', '2022-12-21 09:01:20'),
(4, 'Jethro ', 'B', 'Hidalgo', '09464003611', 'Driving Instructor', 2, 'jethro@gmail.com', '12345', 'active', '', '193700', '2022-12-21 09:25:18', '2022-12-21 09:25:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicles`
--

CREATE TABLE `tbl_vehicles` (
  `car_id` int(15) NOT NULL,
  `plate_no` varchar(55) NOT NULL,
  `branch_id` int(15) NOT NULL,
  `brand` varchar(55) NOT NULL,
  `color` varchar(55) NOT NULL,
  `chassis_no` varchar(55) NOT NULL,
  `status` varchar(55) NOT NULL DEFAULT 'active',
  `date_created` date NOT NULL,
  `Date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_vehicles`
--

INSERT INTO `tbl_vehicles` (`car_id`, `plate_no`, `branch_id`, `brand`, `color`, `chassis_no`, `status`, `date_created`, `Date_updated`) VALUES
(1, '8JBU181', 2, 'Toyota', 'Black', 'JTMZD33V186071656', 'active', '2022-12-21', '0000-00-00'),
(2, '2M14M5', 2, 'Nissan', 'Black', '1N4AA6AP6HC415954', 'active', '2022-12-21', '0000-00-00'),
(3, 'AOW1025', 2, 'Forester L', 'White', 'JF1SF635XYH721463', 'active', '2022-12-21', '0000-00-00'),
(4, '4PFK534', 3, 'Toyota', 'Black', 'JT3GN86R5Y0174599', 'active', '2022-12-21', '0000-00-00'),
(5, 'IWL775', 3, 'Bmw', 'Black', 'WBAJE7C5XJG892012', 'active', '2022-12-21', '0000-00-00'),
(6, '8DQR424', 3, 'Hyundai', 'Black', '5NMZU4LA6JH079859', 'active', '2022-12-21', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accounts_payable`
--
ALTER TABLE `tbl_accounts_payable`
  ADD PRIMARY KEY (`AP_ID`);

--
-- Indexes for table `tbl_branch`
--
ALTER TABLE `tbl_branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `tbl_invoice_id`
--
ALTER TABLE `tbl_invoice_id`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `purchase_invoice_no` (`PI_ID`);

--
-- Indexes for table `tbl_ledger`
--
ALTER TABLE `tbl_ledger`
  ADD PRIMARY KEY (`ledger_id`),
  ADD KEY `PI_ID` (`PI_ID`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `AP_ID` (`AP_ID`);

--
-- Indexes for table `tbl_payment_schedule`
--
ALTER TABLE `tbl_payment_schedule`
  ADD PRIMARY KEY (`payment_schedule_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `billing_type_id` (`billing_type_id`);

--
-- Indexes for table `tbl_payment_voucher`
--
ALTER TABLE `tbl_payment_voucher`
  ADD PRIMARY KEY (`PV_ID`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_pa_ledger`
--
ALTER TABLE `tbl_pa_ledger`
  ADD PRIMARY KEY (`PA_ID`),
  ADD KEY `PV_ID` (`PV_ID`);

--
-- Indexes for table `tbl_purchase_invoice`
--
ALTER TABLE `tbl_purchase_invoice`
  ADD PRIMARY KEY (`PI_ID`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `tbl_purchase_no`
--
ALTER TABLE `tbl_purchase_no`
  ADD PRIMARY KEY (`purchase_request_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `tbl_purchase_order`
--
ALTER TABLE `tbl_purchase_order`
  ADD PRIMARY KEY (`PO_ID`),
  ADD KEY `purchase_request_id` (`purchase_request_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `tbl_purchase_request`
--
ALTER TABLE `tbl_purchase_request`
  ADD PRIMARY KEY (`PR_ID`),
  ADD KEY `purchase_request_no` (`purchase_request_no`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `tbl_pv_reference`
--
ALTER TABLE `tbl_pv_reference`
  ADD PRIMARY KEY (`PV_Reference_id`),
  ADD KEY `PI_ID` (`PI_ID`),
  ADD KEY `PV_ID` (`PV_ID`);

--
-- Indexes for table `tbl_reciept`
--
ALTER TABLE `tbl_reciept`
  ADD PRIMARY KEY (`reciept_id`),
  ADD KEY `PV_ID` (`PV_ID`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`User_ID`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `tbl_vehicles`
--
ALTER TABLE `tbl_vehicles`
  ADD PRIMARY KEY (`car_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accounts_payable`
--
ALTER TABLE `tbl_accounts_payable`
  MODIFY `AP_ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_branch`
--
ALTER TABLE `tbl_branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_invoice_id`
--
ALTER TABLE `tbl_invoice_id`
  MODIFY `invoice_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_ledger`
--
ALTER TABLE `tbl_ledger`
  MODIFY `ledger_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_payment_schedule`
--
ALTER TABLE `tbl_payment_schedule`
  MODIFY `payment_schedule_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment_voucher`
--
ALTER TABLE `tbl_payment_voucher`
  MODIFY `PV_ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_pa_ledger`
--
ALTER TABLE `tbl_pa_ledger`
  MODIFY `PA_ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_purchase_invoice`
--
ALTER TABLE `tbl_purchase_invoice`
  MODIFY `PI_ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_purchase_no`
--
ALTER TABLE `tbl_purchase_no`
  MODIFY `purchase_request_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_purchase_order`
--
ALTER TABLE `tbl_purchase_order`
  MODIFY `PO_ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_purchase_request`
--
ALTER TABLE `tbl_purchase_request`
  MODIFY `PR_ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_pv_reference`
--
ALTER TABLE `tbl_pv_reference`
  MODIFY `PV_Reference_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_reciept`
--
ALTER TABLE `tbl_reciept`
  MODIFY `reciept_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `User_ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_vehicles`
--
ALTER TABLE `tbl_vehicles`
  MODIFY `car_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_invoice_id`
--
ALTER TABLE `tbl_invoice_id`
  ADD CONSTRAINT `tbl_invoice_id_ibfk_1` FOREIGN KEY (`PI_ID`) REFERENCES `tbl_purchase_invoice` (`PI_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_ledger`
--
ALTER TABLE `tbl_ledger`
  ADD CONSTRAINT `tbl_ledger_ibfk_1` FOREIGN KEY (`AP_ID`) REFERENCES `tbl_accounts_payable` (`AP_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_payment_schedule`
--
ALTER TABLE `tbl_payment_schedule`
  ADD CONSTRAINT `tbl_payment_schedule_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `tbl_branch` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_payment_voucher`
--
ALTER TABLE `tbl_payment_voucher`
  ADD CONSTRAINT `tbl_payment_voucher_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_supplier` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_payment_voucher_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `tbl_branch` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_purchase_invoice`
--
ALTER TABLE `tbl_purchase_invoice`
  ADD CONSTRAINT `tbl_purchase_invoice_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_supplier` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_purchase_no`
--
ALTER TABLE `tbl_purchase_no`
  ADD CONSTRAINT `tbl_purchase_no_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_supplier` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_purchase_no_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `tbl_branch` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_purchase_no_ibfk_3` FOREIGN KEY (`User_ID`) REFERENCES `tbl_user` (`User_ID`);

--
-- Constraints for table `tbl_purchase_order`
--
ALTER TABLE `tbl_purchase_order`
  ADD CONSTRAINT `tbl_purchase_order_ibfk_1` FOREIGN KEY (`purchase_request_id`) REFERENCES `tbl_purchase_no` (`purchase_request_id`),
  ADD CONSTRAINT `tbl_purchase_order_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `tbl_branch` (`branch_id`),
  ADD CONSTRAINT `tbl_purchase_order_ibfk_3` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_supplier` (`supplier_id`);

--
-- Constraints for table `tbl_purchase_request`
--
ALTER TABLE `tbl_purchase_request`
  ADD CONSTRAINT `tbl_purchase_request_ibfk_1` FOREIGN KEY (`purchase_request_no`) REFERENCES `tbl_purchase_no` (`purchase_request_id`);

--
-- Constraints for table `tbl_pv_reference`
--
ALTER TABLE `tbl_pv_reference`
  ADD CONSTRAINT `tbl_pv_reference_ibfk_1` FOREIGN KEY (`PI_ID`) REFERENCES `tbl_purchase_invoice` (`PI_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pv_reference_ibfk_2` FOREIGN KEY (`PV_ID`) REFERENCES `tbl_payment_voucher` (`PV_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_reciept`
--
ALTER TABLE `tbl_reciept`
  ADD CONSTRAINT `tbl_reciept_ibfk_1` FOREIGN KEY (`PV_ID`) REFERENCES `tbl_payment_voucher` (`PV_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD CONSTRAINT `tbl_supplier_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `tbl_branch` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `tbl_branch` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
