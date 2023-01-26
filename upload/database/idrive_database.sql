#
# TABLE STRUCTURE FOR: tbl_accounts_payable
#

DROP TABLE IF EXISTS `tbl_accounts_payable`;

CREATE TABLE `tbl_accounts_payable` (
  `AP_ID` int(15) NOT NULL AUTO_INCREMENT,
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
  `isHide` varchar(10) DEFAULT '0',
  PRIMARY KEY (`AP_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_accounts_payable` (`AP_ID`, `supplier_id`, `branch_id`, `User_ID`, `billing_no`, `amount`, `ap_date`, `due_date`, `file`, `status`, `isRemoved`, `payment_method`, `description`, `isStatus`, `isHide`) VALUES (1, 3, 3, 7, 'BN-2022-001', '3431', '2022-12-09', '2022-12-09', 'invoice_22.jpg', 'active', 'no', 'Cash', 'Power Bill', 'Unpaid', '3');
INSERT INTO `tbl_accounts_payable` (`AP_ID`, `supplier_id`, `branch_id`, `User_ID`, `billing_no`, `amount`, `ap_date`, `due_date`, `file`, `status`, `isRemoved`, `payment_method`, `description`, `isStatus`, `isHide`) VALUES (2, 3, 2, 3, 'BN-2022-002', '1332', '2022-12-09', '2022-12-23', 'Purchase-Request-Mayors-Office-537-11-2020-101.jpg', 'active', 'no', 'Cheque', 'Water Bill', 'Paid', '3');
INSERT INTO `tbl_accounts_payable` (`AP_ID`, `supplier_id`, `branch_id`, `User_ID`, `billing_no`, `amount`, `ap_date`, `due_date`, `file`, `status`, `isRemoved`, `payment_method`, `description`, `isStatus`, `isHide`) VALUES (3, 4, 2, 3, 'BN-2022-003', '2,001', '2022-12-12', '2023-01-05', 'receipt-template-us-band-blue-750px.png', 'active', 'no', 'Cheque', 'Power Bill', 'Unpaid', '0');
INSERT INTO `tbl_accounts_payable` (`AP_ID`, `supplier_id`, `branch_id`, `User_ID`, `billing_no`, `amount`, `ap_date`, `due_date`, `file`, `status`, `isRemoved`, `payment_method`, `description`, `isStatus`, `isHide`) VALUES (4, 3, 2, 3, 'BN-2022-004', '2,001', '2022-12-12', '2023-01-18', 'receipt-template-us-band-blue-750px1.png', 'active', 'no', 'Cheque', 'Water Bill', 'Unpaid', '0');
INSERT INTO `tbl_accounts_payable` (`AP_ID`, `supplier_id`, `branch_id`, `User_ID`, `billing_no`, `amount`, `ap_date`, `due_date`, `file`, `status`, `isRemoved`, `payment_method`, `description`, `isStatus`, `isHide`) VALUES (5, 4, 2, 3, 'BN-2022-005', '5000', '2022-12-12', '2022-12-15', 'invoice_23.jpg', 'active', 'no', 'Cash', 'Power Bill', 'Unpaid', '0');


#
# TABLE STRUCTURE FOR: tbl_branch
#

DROP TABLE IF EXISTS `tbl_branch`;

CREATE TABLE `tbl_branch` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_branch` (`branch_id`, `branch_name`, `contact`, `street`, `city`, `barangay`, `province`, `status`, `created_at`, `updated_at`) VALUES (1, 'Koronadal', '09464003615', 'Balmores', 'Koronadal', 'GPS', 'South Cotabato', 'active', '2022-12-06 18:12:32', '2022-12-06 18:12:32');
INSERT INTO `tbl_branch` (`branch_id`, `branch_name`, `contact`, `street`, `city`, `barangay`, `province`, `status`, `created_at`, `updated_at`) VALUES (2, 'Gensan', '09464003615', 'Dandiangas', 'General Santos', 'Road 9', 'South Cotabato', 'active', '2022-12-06 18:14:52', '2022-12-06 18:14:52');
INSERT INTO `tbl_branch` (`branch_id`, `branch_name`, `contact`, `street`, `city`, `barangay`, `province`, `status`, `created_at`, `updated_at`) VALUES (3, 'Polomolok', '09464003644', 'Road 9', 'Polomolok', 'Cannery', 'South Cotabato', 'active', '2022-12-07 12:28:22', '2022-12-07 12:28:22');


#
# TABLE STRUCTURE FOR: tbl_invoice_id
#

DROP TABLE IF EXISTS `tbl_invoice_id`;

CREATE TABLE `tbl_invoice_id` (
  `invoice_id` int(15) NOT NULL AUTO_INCREMENT,
  `PI_ID` int(15) NOT NULL,
  `car_id` int(15) NOT NULL,
  `item_no` varchar(55) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `unit_price` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `purchase_invoice_no` (`PI_ID`),
  CONSTRAINT `tbl_invoice_id_ibfk_1` FOREIGN KEY (`PI_ID`) REFERENCES `tbl_purchase_invoice` (`PI_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_invoice_id` (`invoice_id`, `PI_ID`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_price`, `amount`) VALUES (1, 1, 0, '1', '2', 'piece', 'Headlight', '3457', '6914.00');
INSERT INTO `tbl_invoice_id` (`invoice_id`, `PI_ID`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_price`, `amount`) VALUES (2, 2, 3, '0', '10', 'Liters', 'Unleaded', '66.8', '668.00');
INSERT INTO `tbl_invoice_id` (`invoice_id`, `PI_ID`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_price`, `amount`) VALUES (3, 2, 4, '0', '45', 'Liters', 'Diesel', '75.75', '3408.75');
INSERT INTO `tbl_invoice_id` (`invoice_id`, `PI_ID`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_price`, `amount`) VALUES (4, 3, 1, '0', '12', 'Liters', 'Premium', '15', '180.00');
INSERT INTO `tbl_invoice_id` (`invoice_id`, `PI_ID`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_price`, `amount`) VALUES (5, 4, 0, '1', '2', 'piece', 'Enduro Tire', '673', '1346.00');
INSERT INTO `tbl_invoice_id` (`invoice_id`, `PI_ID`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_price`, `amount`) VALUES (6, 5, 1, '0', '12', 'Liters', 'Premium', '68', '816.00');
INSERT INTO `tbl_invoice_id` (`invoice_id`, `PI_ID`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_price`, `amount`) VALUES (7, 5, 2, '0', '15', 'Liters', 'Unleaded', '79', '1185.00');
INSERT INTO `tbl_invoice_id` (`invoice_id`, `PI_ID`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_price`, `amount`) VALUES (8, 6, 1, '0', '12', 'Liters', 'Unleaded', '78.90', '946.80');
INSERT INTO `tbl_invoice_id` (`invoice_id`, `PI_ID`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_price`, `amount`) VALUES (9, 7, 1, '0', '12', 'Liters', 'Premium', '54', '648.00');
INSERT INTO `tbl_invoice_id` (`invoice_id`, `PI_ID`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_price`, `amount`) VALUES (10, 8, 0, '1', '1', 'Piece', 'Battery', '4032', '4032.00');


#
# TABLE STRUCTURE FOR: tbl_ledger
#

DROP TABLE IF EXISTS `tbl_ledger`;

CREATE TABLE `tbl_ledger` (
  `ledger_id` int(15) NOT NULL AUTO_INCREMENT,
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
  `isStatus` varchar(55) NOT NULL DEFAULT 'Unpaid',
  PRIMARY KEY (`ledger_id`),
  KEY `PI_ID` (`PI_ID`),
  KEY `supplier_id` (`supplier_id`),
  KEY `AP_ID` (`AP_ID`),
  CONSTRAINT `tbl_ledger_ibfk_1` FOREIGN KEY (`AP_ID`) REFERENCES `tbl_accounts_payable` (`AP_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_ledger` (`ledger_id`, `AP_no`, `PI_ID`, `PV_ID`, `AP_ID`, `supplier_id`, `User_ID`, `balance`, `invoice_amount`, `branch_id`, `isReference`, `isDue_date`, `isStatus`) VALUES (1, 'AP-2022-001', 1, 'No Entry', NULL, 1, 7, '6,914', '6,914', 3, 'PI-2022-001', '2022-12-10', 'Unpaid');
INSERT INTO `tbl_ledger` (`ledger_id`, `AP_no`, `PI_ID`, `PV_ID`, `AP_ID`, `supplier_id`, `User_ID`, `balance`, `invoice_amount`, `branch_id`, `isReference`, `isDue_date`, `isStatus`) VALUES (2, 'AP-2022-002', 2, 'PV-2022-002', NULL, 2, 7, '0', '4,076.75', 3, 'PI-2022-002', '2022-12-13', 'Paid');
INSERT INTO `tbl_ledger` (`ledger_id`, `AP_no`, `PI_ID`, `PV_ID`, `AP_ID`, `supplier_id`, `User_ID`, `balance`, `invoice_amount`, `branch_id`, `isReference`, `isDue_date`, `isStatus`) VALUES (3, 'AP-2022-003', NULL, 'No Entry', 1, 3, 7, '3431', '3431', 3, 'BN-2022-001', '2022-12-09', 'Unpaid');
INSERT INTO `tbl_ledger` (`ledger_id`, `AP_no`, `PI_ID`, `PV_ID`, `AP_ID`, `supplier_id`, `User_ID`, `balance`, `invoice_amount`, `branch_id`, `isReference`, `isDue_date`, `isStatus`) VALUES (4, 'AP-2022-004', 3, 'PV-2022-003', NULL, 2, 3, '0', '180', 2, 'PI-2022-003', '2022-12-13', 'Paid');
INSERT INTO `tbl_ledger` (`ledger_id`, `AP_no`, `PI_ID`, `PV_ID`, `AP_ID`, `supplier_id`, `User_ID`, `balance`, `invoice_amount`, `branch_id`, `isReference`, `isDue_date`, `isStatus`) VALUES (5, 'AP-2022-005', NULL, 'PV-2022-004', 2, 3, 3, '0', '1332', 2, 'BN-2022-002', '2022-12-23', 'Paid');
INSERT INTO `tbl_ledger` (`ledger_id`, `AP_no`, `PI_ID`, `PV_ID`, `AP_ID`, `supplier_id`, `User_ID`, `balance`, `invoice_amount`, `branch_id`, `isReference`, `isDue_date`, `isStatus`) VALUES (6, 'AP-2022-006', 5, 'No Entry', NULL, 2, 3, '2,001', '2,001', 2, 'PI-2022-005', '2022-12-10', 'Unpaid');
INSERT INTO `tbl_ledger` (`ledger_id`, `AP_no`, `PI_ID`, `PV_ID`, `AP_ID`, `supplier_id`, `User_ID`, `balance`, `invoice_amount`, `branch_id`, `isReference`, `isDue_date`, `isStatus`) VALUES (7, 'AP-2022-007', 6, 'No Entry', NULL, 2, 3, '946.8', '946.8', 2, 'PI-2022-006', '2022-12-15', 'Unpaid');
INSERT INTO `tbl_ledger` (`ledger_id`, `AP_no`, `PI_ID`, `PV_ID`, `AP_ID`, `supplier_id`, `User_ID`, `balance`, `invoice_amount`, `branch_id`, `isReference`, `isDue_date`, `isStatus`) VALUES (8, 'AP-2022-008', 7, 'No Entry', NULL, 2, 3, '648', '648', 2, 'PI-2022-007', '2022-12-14', 'Unpaid');
INSERT INTO `tbl_ledger` (`ledger_id`, `AP_no`, `PI_ID`, `PV_ID`, `AP_ID`, `supplier_id`, `User_ID`, `balance`, `invoice_amount`, `branch_id`, `isReference`, `isDue_date`, `isStatus`) VALUES (9, 'AP-2022-009', 8, 'No Entry', NULL, 1, 3, '4,032', '4,032', 2, 'PI-2022-008', '2022-12-14', 'Unpaid');


#
# TABLE STRUCTURE FOR: tbl_pa_ledger
#

DROP TABLE IF EXISTS `tbl_pa_ledger`;

CREATE TABLE `tbl_pa_ledger` (
  `PA_ID` int(15) NOT NULL AUTO_INCREMENT,
  `PA_no` varchar(50) NOT NULL,
  `PV_ID` int(15) NOT NULL,
  `User_ID` int(15) NOT NULL,
  `reciept_id` int(15) NOT NULL,
  `paid_amount` float NOT NULL,
  PRIMARY KEY (`PA_ID`),
  KEY `PV_ID` (`PV_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_pa_ledger` (`PA_ID`, `PA_no`, `PV_ID`, `User_ID`, `reciept_id`, `paid_amount`) VALUES (1, 'PA-2022-001', 2, 7, 1, '4076');
INSERT INTO `tbl_pa_ledger` (`PA_ID`, `PA_no`, `PV_ID`, `User_ID`, `reciept_id`, `paid_amount`) VALUES (2, 'PA-2022-002', 4, 3, 2, '1332');
INSERT INTO `tbl_pa_ledger` (`PA_ID`, `PA_no`, `PV_ID`, `User_ID`, `reciept_id`, `paid_amount`) VALUES (3, 'PA-2022-003', 3, 3, 3, '180');


#
# TABLE STRUCTURE FOR: tbl_payment_schedule
#

DROP TABLE IF EXISTS `tbl_payment_schedule`;

CREATE TABLE `tbl_payment_schedule` (
  `payment_schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_type_id` int(15) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `total_amount` varchar(50) NOT NULL,
  `due_date` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Unpaid',
  `isRemoved` varchar(50) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`payment_schedule_id`),
  KEY `branch_id` (`branch_id`),
  KEY `billing_type_id` (`billing_type_id`),
  CONSTRAINT `tbl_payment_schedule_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `tbl_branch` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#
# TABLE STRUCTURE FOR: tbl_payment_voucher
#

DROP TABLE IF EXISTS `tbl_payment_voucher`;

CREATE TABLE `tbl_payment_voucher` (
  `PV_ID` int(15) NOT NULL AUTO_INCREMENT,
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
  `reason` text NOT NULL,
  PRIMARY KEY (`PV_ID`),
  KEY `supplier_id` (`supplier_id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `tbl_payment_voucher_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_supplier` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_payment_voucher_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `tbl_branch` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_payment_voucher` (`PV_ID`, `payment_voucher_no`, `branch_id`, `supplier_id`, `User_ID`, `AP_ID`, `voucher_date`, `total_amount`, `reciept`, `payment_method`, `isPending`, `isCancel`, `isPaid`, `date_updated`, `sent`, `hide`, `remarks`, `reason`) VALUES (1, 'PV-2022-001', 3, 1, 7, NULL, '2022-12-09', '6914', 'pending', 'Cash', 'approved', 'no', 'unpaid', '2022-12-09 22:30:37', '3', '1', '', '');
INSERT INTO `tbl_payment_voucher` (`PV_ID`, `payment_voucher_no`, `branch_id`, `supplier_id`, `User_ID`, `AP_ID`, `voucher_date`, `total_amount`, `reciept`, `payment_method`, `isPending`, `isCancel`, `isPaid`, `date_updated`, `sent`, `hide`, `remarks`, `reason`) VALUES (2, 'PV-2022-002', 3, 2, 7, NULL, '2022-12-09', '4076', 'RN-2022-001', 'Cheque', 'approved', 'no', 'paid', '2022-12-09 22:42:51', '3', '2', '', '');
INSERT INTO `tbl_payment_voucher` (`PV_ID`, `payment_voucher_no`, `branch_id`, `supplier_id`, `User_ID`, `AP_ID`, `voucher_date`, `total_amount`, `reciept`, `payment_method`, `isPending`, `isCancel`, `isPaid`, `date_updated`, `sent`, `hide`, `remarks`, `reason`) VALUES (3, 'PV-2022-003', 2, 2, 3, NULL, '2022-12-09', '180', 'RN-2022-003', 'Cash', 'approved', 'no', 'paid', '2022-12-09 23:16:00', '3', '2', '', '');
INSERT INTO `tbl_payment_voucher` (`PV_ID`, `payment_voucher_no`, `branch_id`, `supplier_id`, `User_ID`, `AP_ID`, `voucher_date`, `total_amount`, `reciept`, `payment_method`, `isPending`, `isCancel`, `isPaid`, `date_updated`, `sent`, `hide`, `remarks`, `reason`) VALUES (4, 'PV-2022-004', 2, 3, 3, 2, '2022-12-09', '1332', 'RN-2022-002', 'Cheque', 'approved', 'no', 'paid', '2022-12-09 23:15:27', '3', '2', 'For this month consumption', 'ok');
INSERT INTO `tbl_payment_voucher` (`PV_ID`, `payment_voucher_no`, `branch_id`, `supplier_id`, `User_ID`, `AP_ID`, `voucher_date`, `total_amount`, `reciept`, `payment_method`, `isPending`, `isCancel`, `isPaid`, `date_updated`, `sent`, `hide`, `remarks`, `reason`) VALUES (5, 'PV-2022-005', 3, 3, 7, 1, '2022-12-10', '3431', 'pending', 'Cash', 'pending', 'no', 'unpaid', '2022-12-10 00:23:37', '0', '0', '', '');
INSERT INTO `tbl_payment_voucher` (`PV_ID`, `payment_voucher_no`, `branch_id`, `supplier_id`, `User_ID`, `AP_ID`, `voucher_date`, `total_amount`, `reciept`, `payment_method`, `isPending`, `isCancel`, `isPaid`, `date_updated`, `sent`, `hide`, `remarks`, `reason`) VALUES (6, 'PV-2022-006', 2, 2, 3, NULL, '2022-12-12', '2001', 'pending', 'Cash', 'pending', 'no', 'unpaid', '2022-12-12 20:59:51', '3', '0', '', '');


#
# TABLE STRUCTURE FOR: tbl_purchase_invoice
#

DROP TABLE IF EXISTS `tbl_purchase_invoice`;

CREATE TABLE `tbl_purchase_invoice` (
  `PI_ID` int(15) NOT NULL AUTO_INCREMENT,
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
  `sent` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`PI_ID`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `tbl_purchase_invoice_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_supplier` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_purchase_invoice` (`PI_ID`, `purchase_invoice_no`, `PO_ID`, `User_ID`, `supplier_id`, `branch_id`, `total_amount`, `file`, `isRemoved`, `due_date`, `invoice_date`, `Reference`, `sent`) VALUES (1, 'PI-2022-001', 1, 7, 1, 3, '6,914', 'invoice_23.jpg', 'no', '2022-12-10', '2022-12-09', '2', '1');
INSERT INTO `tbl_purchase_invoice` (`PI_ID`, `purchase_invoice_no`, `PO_ID`, `User_ID`, `supplier_id`, `branch_id`, `total_amount`, `file`, `isRemoved`, `due_date`, `invoice_date`, `Reference`, `sent`) VALUES (2, 'PI-2022-002', 2, 7, 2, 3, '4,076', 'invoice_33.jpg', 'no', '2022-12-01', '2022-12-09', '2', '1');
INSERT INTO `tbl_purchase_invoice` (`PI_ID`, `purchase_invoice_no`, `PO_ID`, `User_ID`, `supplier_id`, `branch_id`, `total_amount`, `file`, `isRemoved`, `due_date`, `invoice_date`, `Reference`, `sent`) VALUES (3, 'PI-2022-003', 3, 3, 2, 2, '180', 'Purchase-Request-Mayors-Office-537-11-2020-101.jpg', 'no', '2022-12-13', '2022-12-09', '2', '1');
INSERT INTO `tbl_purchase_invoice` (`PI_ID`, `purchase_invoice_no`, `PO_ID`, `User_ID`, `supplier_id`, `branch_id`, `total_amount`, `file`, `isRemoved`, `due_date`, `invoice_date`, `Reference`, `sent`) VALUES (4, 'PI-2022-004', 6, 7, 1, 3, '1,346', 'invoice_24.jpg', 'no', '2022-11-10', '2022-12-10', '0', '0');
INSERT INTO `tbl_purchase_invoice` (`PI_ID`, `purchase_invoice_no`, `PO_ID`, `User_ID`, `supplier_id`, `branch_id`, `total_amount`, `file`, `isRemoved`, `due_date`, `invoice_date`, `Reference`, `sent`) VALUES (5, 'PI-2022-005', 4, 3, 2, 2, '2,001', 'purchase-invoice2.jpg', 'no', '2022-10-07', '2022-12-10', '2', '1');
INSERT INTO `tbl_purchase_invoice` (`PI_ID`, `purchase_invoice_no`, `PO_ID`, `User_ID`, `supplier_id`, `branch_id`, `total_amount`, `file`, `isRemoved`, `due_date`, `invoice_date`, `Reference`, `sent`) VALUES (6, 'PI-2022-006', 8, 3, 2, 2, '946.8', 'invoice_25.jpg', 'no', '2022-12-15', '2022-12-12', '0', '1');
INSERT INTO `tbl_purchase_invoice` (`PI_ID`, `purchase_invoice_no`, `PO_ID`, `User_ID`, `supplier_id`, `branch_id`, `total_amount`, `file`, `isRemoved`, `due_date`, `invoice_date`, `Reference`, `sent`) VALUES (7, 'PI-2022-007', 9, 3, 2, 2, '648', 'log.png', 'no', '2022-12-14', '2022-12-12', '0', '1');
INSERT INTO `tbl_purchase_invoice` (`PI_ID`, `purchase_invoice_no`, `PO_ID`, `User_ID`, `supplier_id`, `branch_id`, `total_amount`, `file`, `isRemoved`, `due_date`, `invoice_date`, `Reference`, `sent`) VALUES (8, 'PI-2022-008', 10, 3, 1, 2, '4,032', 'pic2.png', 'no', '2022-12-14', '2022-12-12', '0', '1');


#
# TABLE STRUCTURE FOR: tbl_purchase_no
#

DROP TABLE IF EXISTS `tbl_purchase_no`;

CREATE TABLE `tbl_purchase_no` (
  `purchase_request_id` int(15) NOT NULL AUTO_INCREMENT,
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
  `notif` varchar(15) NOT NULL DEFAULT '1',
  PRIMARY KEY (`purchase_request_id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `branch_id` (`branch_id`),
  KEY `User_ID` (`User_ID`),
  CONSTRAINT `tbl_purchase_no_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_supplier` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_purchase_no_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `tbl_branch` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_purchase_no_ibfk_3` FOREIGN KEY (`User_ID`) REFERENCES `tbl_user` (`User_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_purchase_no` (`purchase_request_id`, `purchase_request_no`, `supplier_id`, `User_ID`, `posting_date`, `branch_id`, `category`, `total_cost`, `purpose`, `reason`, `isPending`, `isCancel`, `isForwarded`, `isRead`, `date_updated`, `approved_by`, `pr_ref`, `request_by`, `forwarded_to`, `forwardedby`, `post`, `notif`) VALUES (1, 'PR-2022-001', 2, 2, '2022-12-09', 2, 'Gasoline', '1740.00', 'Today\'s service', '', 'approved', 'no', '0', 'seen', '2022-12-09 22:53:11', 'Nicolas Jeferson', 1, 'Manager', 'no', 2, '1', '1');
INSERT INTO `tbl_purchase_no` (`purchase_request_id`, `purchase_request_no`, `supplier_id`, `User_ID`, `posting_date`, `branch_id`, `category`, `total_cost`, `purpose`, `reason`, `isPending`, `isCancel`, `isForwarded`, `isRead`, `date_updated`, `approved_by`, `pr_ref`, `request_by`, `forwarded_to`, `forwardedby`, `post`, `notif`) VALUES (2, 'PR-2022-002', 1, 2, '2022-12-09', 2, 'Repair and Maintenance', '800.00', 'For the Unit MMX1123', 'Please Request another one', 'disapproved', 'no', '0', 'seen', '2022-12-09 21:54:50', 'Nicolas Jeferson', 0, 'Manager', 'no', 2, '1', '1');
INSERT INTO `tbl_purchase_no` (`purchase_request_id`, `purchase_request_no`, `supplier_id`, `User_ID`, `posting_date`, `branch_id`, `category`, `total_cost`, `purpose`, `reason`, `isPending`, `isCancel`, `isForwarded`, `isRead`, `date_updated`, `approved_by`, `pr_ref`, `request_by`, `forwarded_to`, `forwardedby`, `post`, `notif`) VALUES (3, 'PR-2022-003', 2, 4, '2022-12-09', 2, 'Gasoline', '1080.00', 'Service', '', 'approved', 'no', '0', 'seen', '2022-12-10 09:15:26', 'Nicolas Jeferson', 1, 'Driving Instructor', 'yes', 2, '1', '2');
INSERT INTO `tbl_purchase_no` (`purchase_request_id`, `purchase_request_no`, `supplier_id`, `User_ID`, `posting_date`, `branch_id`, `category`, `total_cost`, `purpose`, `reason`, `isPending`, `isCancel`, `isForwarded`, `isRead`, `date_updated`, `approved_by`, `pr_ref`, `request_by`, `forwarded_to`, `forwardedby`, `post`, `notif`) VALUES (4, 'PR-2022-004', 1, 4, '2022-12-09', 2, 'Repair and Maintenance', '890.00', 'Replacement for Unit KSK0018', '', 'disapproved', 'no', '0', 'seen', '2022-12-10 09:15:16', 'Nicolas Jeferson', 0, 'Driving Instructor', 'yes', 2, '1', '2');
INSERT INTO `tbl_purchase_no` (`purchase_request_id`, `purchase_request_no`, `supplier_id`, `User_ID`, `posting_date`, `branch_id`, `category`, `total_cost`, `purpose`, `reason`, `isPending`, `isCancel`, `isForwarded`, `isRead`, `date_updated`, `approved_by`, `pr_ref`, `request_by`, `forwarded_to`, `forwardedby`, `post`, `notif`) VALUES (5, 'PR-2022-005', 2, 6, '2022-12-09', 3, 'Gasoline', '4370.25', 'for driving lesson', 'No budget', 'disapproved', 'no', '0', 'seen', '2022-12-09 22:18:33', 'Nicolas Jeferson', 0, 'Manager', 'no', 6, '1', '1');
INSERT INTO `tbl_purchase_no` (`purchase_request_id`, `purchase_request_no`, `supplier_id`, `User_ID`, `posting_date`, `branch_id`, `category`, `total_cost`, `purpose`, `reason`, `isPending`, `isCancel`, `isForwarded`, `isRead`, `date_updated`, `approved_by`, `pr_ref`, `request_by`, `forwarded_to`, `forwardedby`, `post`, `notif`) VALUES (6, 'PR-2022-006', 1, 6, '2022-12-09', 3, 'Repair and Maintenance', '1980.00', 'Change tire and change oil', 'No budget', 'approved', 'no', '0', 'seen', '2022-12-10 00:21:27', 'Nicolas Jeferson', 1, 'Manager', 'no', 6, '1', '1');
INSERT INTO `tbl_purchase_no` (`purchase_request_id`, `purchase_request_no`, `supplier_id`, `User_ID`, `posting_date`, `branch_id`, `category`, `total_cost`, `purpose`, `reason`, `isPending`, `isCancel`, `isForwarded`, `isRead`, `date_updated`, `approved_by`, `pr_ref`, `request_by`, `forwarded_to`, `forwardedby`, `post`, `notif`) VALUES (7, 'PR-2022-007', 2, 8, '2022-12-09', 3, 'Gasoline', '4214.10', 'For driving lesson', '', 'approved', 'no', '0', 'seen', '2022-12-09 22:22:14', 'Nicolas Jeferson', 1, 'Driving Instructor', 'yes', 6, '1', '3');
INSERT INTO `tbl_purchase_no` (`purchase_request_id`, `purchase_request_no`, `supplier_id`, `User_ID`, `posting_date`, `branch_id`, `category`, `total_cost`, `purpose`, `reason`, `isPending`, `isCancel`, `isForwarded`, `isRead`, `date_updated`, `approved_by`, `pr_ref`, `request_by`, `forwarded_to`, `forwardedby`, `post`, `notif`) VALUES (8, 'PR-2022-008', 1, 8, '2022-12-09', 3, 'Repair and Maintenance', '9900.00', 'Replacement for the damaged unit', 'No budget for sidemirror', 'approved', 'no', '0', 'seen', '2022-12-09 22:22:07', 'Nicolas Jeferson', 1, 'Driving Instructor', 'yes', 6, '1', '3');
INSERT INTO `tbl_purchase_no` (`purchase_request_id`, `purchase_request_no`, `supplier_id`, `User_ID`, `posting_date`, `branch_id`, `category`, `total_cost`, `purpose`, `reason`, `isPending`, `isCancel`, `isForwarded`, `isRead`, `date_updated`, `approved_by`, `pr_ref`, `request_by`, `forwarded_to`, `forwardedby`, `post`, `notif`) VALUES (9, 'PR-2022-009', 2, 6, '2022-12-10', 3, 'Gasoline', '156.00', 'for driver lesson', '', 'approved', 'no', '0', 'yes', '2022-12-12 19:57:36', 'Nicolas Jeferson', 0, 'Manager', 'no', 6, '1', '1');
INSERT INTO `tbl_purchase_no` (`purchase_request_id`, `purchase_request_no`, `supplier_id`, `User_ID`, `posting_date`, `branch_id`, `category`, `total_cost`, `purpose`, `reason`, `isPending`, `isCancel`, `isForwarded`, `isRead`, `date_updated`, `approved_by`, `pr_ref`, `request_by`, `forwarded_to`, `forwardedby`, `post`, `notif`) VALUES (10, 'PR-2022-010', 1, 6, '2022-12-10', 3, 'Repair and Maintenance', '906.00', 'Change battery', '', 'approved', 'no', '0', 'seen', '2022-12-10 09:01:31', 'Nicolas Jeferson', 1, 'Manager', 'no', 6, '1', '1');
INSERT INTO `tbl_purchase_no` (`purchase_request_id`, `purchase_request_no`, `supplier_id`, `User_ID`, `posting_date`, `branch_id`, `category`, `total_cost`, `purpose`, `reason`, `isPending`, `isCancel`, `isForwarded`, `isRead`, `date_updated`, `approved_by`, `pr_ref`, `request_by`, `forwarded_to`, `forwardedby`, `post`, `notif`) VALUES (11, 'PR-2022-011', 1, 6, '2022-12-10', 3, 'Repair and Maintenance', '3040.00', 'today service', '', 'approved', 'no', '0', 'seen', '2022-12-10 09:02:51', 'Nicolas Jeferson', 1, 'Manager', 'no', 6, '1', '1');
INSERT INTO `tbl_purchase_no` (`purchase_request_id`, `purchase_request_no`, `supplier_id`, `User_ID`, `posting_date`, `branch_id`, `category`, `total_cost`, `purpose`, `reason`, `isPending`, `isCancel`, `isForwarded`, `isRead`, `date_updated`, `approved_by`, `pr_ref`, `request_by`, `forwarded_to`, `forwardedby`, `post`, `notif`) VALUES (12, 'PR-2022-012', 2, 2, '2022-12-10', 2, 'Gasoline', '816.00', 'Today\'s service', '', 'approved', 'no', '0', 'yes', '2022-12-10 09:15:02', 'Nicolas Jeferson', 1, 'Manager', 'no', 2, '1', '1');
INSERT INTO `tbl_purchase_no` (`purchase_request_id`, `purchase_request_no`, `supplier_id`, `User_ID`, `posting_date`, `branch_id`, `category`, `total_cost`, `purpose`, `reason`, `isPending`, `isCancel`, `isForwarded`, `isRead`, `date_updated`, `approved_by`, `pr_ref`, `request_by`, `forwarded_to`, `forwardedby`, `post`, `notif`) VALUES (13, 'PR-2022-013', 2, 2, '2022-12-12', 2, 'Gasoline', '816.00', 'Todays Service', '', 'approved', 'no', '0', 'yes', '2022-12-12 20:14:52', 'Nicolas Jeferson', 1, 'Manager', 'no', 2, '1', '1');
INSERT INTO `tbl_purchase_no` (`purchase_request_id`, `purchase_request_no`, `supplier_id`, `User_ID`, `posting_date`, `branch_id`, `category`, `total_cost`, `purpose`, `reason`, `isPending`, `isCancel`, `isForwarded`, `isRead`, `date_updated`, `approved_by`, `pr_ref`, `request_by`, `forwarded_to`, `forwardedby`, `post`, `notif`) VALUES (14, 'PR-2022-014', 1, 2, '2022-12-12', 2, 'Repair and Maintenance', '600.00', 'Replacement for unit TRQ1122', '', 'approved', 'no', '0', 'yes', '2022-12-12 20:16:10', 'Nicolas Jeferson', 1, 'Manager', 'no', 2, '1', '1');
INSERT INTO `tbl_purchase_no` (`purchase_request_id`, `purchase_request_no`, `supplier_id`, `User_ID`, `posting_date`, `branch_id`, `category`, `total_cost`, `purpose`, `reason`, `isPending`, `isCancel`, `isForwarded`, `isRead`, `date_updated`, `approved_by`, `pr_ref`, `request_by`, `forwarded_to`, `forwardedby`, `post`, `notif`) VALUES (15, 'PR-2022-015', 2, 2, '2022-12-12', 2, 'Gasoline', '233.61', 'For driving Lesson', NULL, 'pending', 'no', '0', 'no', '2022-12-12 19:59:58', '', 0, 'Manager', 'no', 2, '0', '1');
INSERT INTO `tbl_purchase_no` (`purchase_request_id`, `purchase_request_no`, `supplier_id`, `User_ID`, `posting_date`, `branch_id`, `category`, `total_cost`, `purpose`, `reason`, `isPending`, `isCancel`, `isForwarded`, `isRead`, `date_updated`, `approved_by`, `pr_ref`, `request_by`, `forwarded_to`, `forwardedby`, `post`, `notif`) VALUES (16, 'PR-2022-016', 1, 2, '2022-12-13', 2, 'Repair and Maintenance', '7383.00', 'Today', '', 'approved', 'no', '0', 'yes', '2022-12-13 00:38:45', 'Nicolas Jeferson', 1, 'Manager', 'no', 2, '1', '1');


#
# TABLE STRUCTURE FOR: tbl_purchase_order
#

DROP TABLE IF EXISTS `tbl_purchase_order`;

CREATE TABLE `tbl_purchase_order` (
  `PO_ID` int(15) NOT NULL AUTO_INCREMENT,
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
  `isReference` varchar(10) NOT NULL DEFAULT '0' COMMENT '1=Yes 0=No',
  PRIMARY KEY (`PO_ID`),
  KEY `purchase_request_id` (`purchase_request_id`),
  KEY `branch_id` (`branch_id`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `tbl_purchase_order_ibfk_1` FOREIGN KEY (`purchase_request_id`) REFERENCES `tbl_purchase_no` (`purchase_request_id`),
  CONSTRAINT `tbl_purchase_order_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `tbl_branch` (`branch_id`),
  CONSTRAINT `tbl_purchase_order_ibfk_3` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_supplier` (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_purchase_order` (`PO_ID`, `purchase_order_no`, `branch_id`, `purchase_request_id`, `supplier_id`, `User_ID`, `payment_method`, `total_amount`, `category`, `po_date`, `isCreated`, `isReference`) VALUES (1, 'PO-2022-001', 3, 8, 1, 8, 'cash', '6900', '', '2022-12-09', 1, '1');
INSERT INTO `tbl_purchase_order` (`PO_ID`, `purchase_order_no`, `branch_id`, `purchase_request_id`, `supplier_id`, `User_ID`, `payment_method`, `total_amount`, `category`, `po_date`, `isCreated`, `isReference`) VALUES (2, 'PO-2022-002', 3, 7, 2, 8, 'cheque', '4214.1', '', '2022-12-09', 1, '1');
INSERT INTO `tbl_purchase_order` (`PO_ID`, `purchase_order_no`, `branch_id`, `purchase_request_id`, `supplier_id`, `User_ID`, `payment_method`, `total_amount`, `category`, `po_date`, `isCreated`, `isReference`) VALUES (3, 'PO-2022-003', 2, 3, 2, 4, 'cash', '1080', '', '2022-12-09', 1, '1');
INSERT INTO `tbl_purchase_order` (`PO_ID`, `purchase_order_no`, `branch_id`, `purchase_request_id`, `supplier_id`, `User_ID`, `payment_method`, `total_amount`, `category`, `po_date`, `isCreated`, `isReference`) VALUES (4, 'PO-2022-004', 2, 1, 2, 2, 'cash', '1740', '', '2022-12-09', 1, '1');
INSERT INTO `tbl_purchase_order` (`PO_ID`, `purchase_order_no`, `branch_id`, `purchase_request_id`, `supplier_id`, `User_ID`, `payment_method`, `total_amount`, `category`, `po_date`, `isCreated`, `isReference`) VALUES (5, 'PO-2022-005', 3, 10, 1, 6, 'cash', '906', '', '2022-12-10', 1, '0');
INSERT INTO `tbl_purchase_order` (`PO_ID`, `purchase_order_no`, `branch_id`, `purchase_request_id`, `supplier_id`, `User_ID`, `payment_method`, `total_amount`, `category`, `po_date`, `isCreated`, `isReference`) VALUES (6, 'PO-2022-006', 3, 6, 1, 6, 'cash', '1480', '', '2022-12-10', 1, '1');
INSERT INTO `tbl_purchase_order` (`PO_ID`, `purchase_order_no`, `branch_id`, `purchase_request_id`, `supplier_id`, `User_ID`, `payment_method`, `total_amount`, `category`, `po_date`, `isCreated`, `isReference`) VALUES (7, 'PO-2022-007', 3, 11, 1, 6, 'cash', '2500', '', '2022-12-10', 1, '0');
INSERT INTO `tbl_purchase_order` (`PO_ID`, `purchase_order_no`, `branch_id`, `purchase_request_id`, `supplier_id`, `User_ID`, `payment_method`, `total_amount`, `category`, `po_date`, `isCreated`, `isReference`) VALUES (8, 'PO-2022-008', 2, 12, 2, 2, 'cash', '816', '', '2022-12-10', 1, '1');
INSERT INTO `tbl_purchase_order` (`PO_ID`, `purchase_order_no`, `branch_id`, `purchase_request_id`, `supplier_id`, `User_ID`, `payment_method`, `total_amount`, `category`, `po_date`, `isCreated`, `isReference`) VALUES (9, 'PO-2022-009', 2, 13, 2, 2, 'cash', '816', '', '2022-12-12', 1, '1');
INSERT INTO `tbl_purchase_order` (`PO_ID`, `purchase_order_no`, `branch_id`, `purchase_request_id`, `supplier_id`, `User_ID`, `payment_method`, `total_amount`, `category`, `po_date`, `isCreated`, `isReference`) VALUES (10, 'PO-2022-010', 2, 14, 1, 2, 'cash', '600', '', '2022-12-12', 1, '1');
INSERT INTO `tbl_purchase_order` (`PO_ID`, `purchase_order_no`, `branch_id`, `purchase_request_id`, `supplier_id`, `User_ID`, `payment_method`, `total_amount`, `category`, `po_date`, `isCreated`, `isReference`) VALUES (11, 'PO-2022-011', 2, 16, 1, 2, 'cash', '7383', '', '2022-12-13', 1, '0');


#
# TABLE STRUCTURE FOR: tbl_purchase_request
#

DROP TABLE IF EXISTS `tbl_purchase_request`;

CREATE TABLE `tbl_purchase_request` (
  `PR_ID` int(15) NOT NULL AUTO_INCREMENT,
  `purchase_request_no` int(15) NOT NULL,
  `car_id` int(15) NOT NULL,
  `item_no` varchar(55) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `unit_cost` varchar(55) NOT NULL,
  `estimated_cost` varchar(55) NOT NULL,
  `isStatus` varchar(20) NOT NULL DEFAULT '1' COMMENT '1=approved 0=disapproved',
  PRIMARY KEY (`PR_ID`),
  KEY `purchase_request_no` (`purchase_request_no`),
  KEY `car_id` (`car_id`),
  CONSTRAINT `tbl_purchase_request_ibfk_1` FOREIGN KEY (`purchase_request_no`) REFERENCES `tbl_purchase_no` (`purchase_request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (1, 1, 1, 'N/A', '12', 'Liters', 'Premium', '70', '840.00', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (2, 1, 2, 'N/A', '15', 'Liters', 'Unleaded', '60', '900.00', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (3, 2, 0, '1', '1', 'Piece', 'Battery', '800', '800.00', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (4, 3, 1, 'N/A', '12', 'Liters', 'Premium', '90', '1080.00', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (5, 4, 0, '1', '1', 'Piece', 'Side Mirror', '890', '890.00', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (6, 5, 3, 'N/A', '45', 'Liters', 'Premium', '78.45', '3530.25', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (7, 5, 4, 'N/A', '10', 'Liters', 'Diesel', '84', '840.00', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (8, 6, 0, '1', '2', 'piece', 'Enduro Tire', '740', '1480.00', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (9, 6, 0, '2', '1', 'piece', 'Delo Oil', '500', '500.00', '0');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (10, 7, 3, 'N/A', '10', 'Liters', 'Unleaded', '66.90', '669.00', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (11, 7, 4, 'N/A', '45', 'Liters', 'Diesel', '78.78', '3545.10', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (12, 8, 0, '1', '2', 'piece', 'Headlight', '3450', '6900.00', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (13, 8, 0, '2', '2', 'piece', 'Side Mirror', '1500', '3000.00', '0');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (14, 9, 3, 'N/A', '2', 'Liters', 'Unleaded', '78', '156.00', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (15, 10, 0, '1', '2', 'piece', 'Battery', '453', '906.00', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (16, 11, 0, '1', '5', 'piece', 'Battery', '500', '2500.00', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (17, 11, 0, '2', '2', 'piece', 'Delo Oil', '270', '540.00', '0');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (18, 12, 1, 'N/A', '12', 'Liters', 'Unleaded', '68', '816.00', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (19, 13, 1, 'N/A', '12', 'Liters', 'Premium', '68', '816.00', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (20, 14, 0, '1', '1', 'Piece', 'Battery', '600', '600.00', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (21, 15, 1, 'N/A', '3', 'Liters', 'Premium', '77.87', '233.61', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (22, 16, 0, '1', '1', 'piece', 'Battery', '649', '649.00', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (23, 16, 0, '2', '2', 'piece', 'Tire', '567', '1134.00', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (24, 16, 0, '3', '2', 'piece', 'Sidemirror', '250', '500.00', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (25, 16, 0, '4', '2', 'piece', 'Bolts', '50', '100.00', '1');
INSERT INTO `tbl_purchase_request` (`PR_ID`, `purchase_request_no`, `car_id`, `item_no`, `quantity`, `unit`, `description`, `unit_cost`, `estimated_cost`, `isStatus`) VALUES (26, 16, 0, '5', '1', 'piece', 'Headlight', '5000', '5000.00', '1');


#
# TABLE STRUCTURE FOR: tbl_pv_reference
#

DROP TABLE IF EXISTS `tbl_pv_reference`;

CREATE TABLE `tbl_pv_reference` (
  `PV_Reference_id` int(15) NOT NULL AUTO_INCREMENT,
  `PV_ID` int(15) NOT NULL,
  `PI_ID` int(15) NOT NULL,
  `quantity` int(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `unit_price` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  PRIMARY KEY (`PV_Reference_id`),
  KEY `PI_ID` (`PI_ID`),
  KEY `PV_ID` (`PV_ID`),
  CONSTRAINT `tbl_pv_reference_ibfk_1` FOREIGN KEY (`PI_ID`) REFERENCES `tbl_purchase_invoice` (`PI_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_pv_reference_ibfk_2` FOREIGN KEY (`PV_ID`) REFERENCES `tbl_payment_voucher` (`PV_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_pv_reference` (`PV_Reference_id`, `PV_ID`, `PI_ID`, `quantity`, `unit`, `description`, `unit_price`, `amount`) VALUES (1, 1, 1, 2, 'piece', 'Headlight', '3457', '6914.00');
INSERT INTO `tbl_pv_reference` (`PV_Reference_id`, `PV_ID`, `PI_ID`, `quantity`, `unit`, `description`, `unit_price`, `amount`) VALUES (2, 2, 2, 10, 'Liters', 'Unleaded', '66.8', '668.00');
INSERT INTO `tbl_pv_reference` (`PV_Reference_id`, `PV_ID`, `PI_ID`, `quantity`, `unit`, `description`, `unit_price`, `amount`) VALUES (3, 2, 2, 45, 'Liters', 'Diesel', '75.75', '3408.75');
INSERT INTO `tbl_pv_reference` (`PV_Reference_id`, `PV_ID`, `PI_ID`, `quantity`, `unit`, `description`, `unit_price`, `amount`) VALUES (4, 3, 3, 12, 'Liters', 'Premium', '15', '180.00');
INSERT INTO `tbl_pv_reference` (`PV_Reference_id`, `PV_ID`, `PI_ID`, `quantity`, `unit`, `description`, `unit_price`, `amount`) VALUES (5, 6, 5, 12, 'Liters', 'Premium', '68', '816.00');
INSERT INTO `tbl_pv_reference` (`PV_Reference_id`, `PV_ID`, `PI_ID`, `quantity`, `unit`, `description`, `unit_price`, `amount`) VALUES (6, 6, 5, 15, 'Liters', 'Unleaded', '79', '1185.00');


#
# TABLE STRUCTURE FOR: tbl_reciept
#

DROP TABLE IF EXISTS `tbl_reciept`;

CREATE TABLE `tbl_reciept` (
  `reciept_id` int(15) NOT NULL AUTO_INCREMENT,
  `reciept_no` varchar(50) NOT NULL,
  `PV_ID` int(15) NOT NULL,
  `branch_id` int(15) NOT NULL,
  `posting_date` date NOT NULL,
  `file` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`reciept_id`),
  KEY `PV_ID` (`PV_ID`),
  CONSTRAINT `tbl_reciept_ibfk_1` FOREIGN KEY (`PV_ID`) REFERENCES `tbl_payment_voucher` (`PV_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_reciept` (`reciept_id`, `reciept_no`, `PV_ID`, `branch_id`, `posting_date`, `file`, `status`) VALUES (1, 'RN-2022-001', 2, 3, '2022-12-09', 'invoice_24.jpg', 'yes');
INSERT INTO `tbl_reciept` (`reciept_id`, `reciept_no`, `PV_ID`, `branch_id`, `posting_date`, `file`, `status`) VALUES (2, 'RN-2022-002', 4, 2, '2022-12-09', 'receipt-template-us-band-blue-750px.png', 'yes');
INSERT INTO `tbl_reciept` (`reciept_id`, `reciept_no`, `PV_ID`, `branch_id`, `posting_date`, `file`, `status`) VALUES (3, 'RN-2022-003', 3, 2, '2022-12-09', 'receipt-template-us-band-blue-750px1.png', 'yes');


#
# TABLE STRUCTURE FOR: tbl_supplier
#

DROP TABLE IF EXISTS `tbl_supplier`;

CREATE TABLE `tbl_supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `street` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `payable_type` varchar(50) NOT NULL,
  `date_created` date NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`supplier_id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `tbl_supplier_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `tbl_branch` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_supplier` (`supplier_id`, `branch_id`, `supplier_name`, `contact`, `street`, `barangay`, `city`, `province`, `payable_type`, `date_created`, `status`) VALUES (1, 1, 'Auto Gear', '09123456789', 'Datu Piang', 'Zone 8', 'General Santos City', 'South Cotabato', 'Repair and Maintenance', '2022-12-09', 'active');
INSERT INTO `tbl_supplier` (`supplier_id`, `branch_id`, `supplier_name`, `contact`, `street`, `barangay`, `city`, `province`, `payable_type`, `date_created`, `status`) VALUES (2, 1, 'Shell-Dadiangas', '09123456789', 'Gensan Drive', 'Dadiangas', 'General Santos City', 'South Cotabato', 'Gasoline', '2022-12-09', 'active');
INSERT INTO `tbl_supplier` (`supplier_id`, `branch_id`, `supplier_name`, `contact`, `street`, `barangay`, `city`, `province`, `payable_type`, `date_created`, `status`) VALUES (3, 1, 'Water District', '09123456789', 'Datu Piang', 'Dadiangas', 'General Santos City', 'South Cotabato', 'Billing', '2022-12-09', 'active');
INSERT INTO `tbl_supplier` (`supplier_id`, `branch_id`, `supplier_name`, `contact`, `street`, `barangay`, `city`, `province`, `payable_type`, `date_created`, `status`) VALUES (4, 1, 'Socoteco I', '09438478501', 'Sueno', 'Zone V', 'Koronadal', 'South Cotabato', 'Billing', '2022-12-09', 'active');


#
# TABLE STRUCTURE FOR: tbl_user
#

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `User_ID` int(15) NOT NULL AUTO_INCREMENT,
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
  `Date_Updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`User_ID`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `tbl_branch` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_user` (`User_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `contact_no`, `Position`, `branch_id`, `Username`, `Password`, `Status`, `image`, `OTP`, `Date_Created`, `Date_Updated`) VALUES (1, 'Nicolas', 'E', 'Jeferson', '09464003615', 'General Manager', 1, 'general@gmail.com', '12345', 'active', '', '111111', '2022-12-06 18:13:28', '2022-12-06 23:49:17');
INSERT INTO `tbl_user` (`User_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `contact_no`, `Position`, `branch_id`, `Username`, `Password`, `Status`, `image`, `OTP`, `Date_Created`, `Date_Updated`) VALUES (2, 'Iner ', 'E', 'Tora', '09464003611', 'Manager', 2, 'manager@gmail.com', '12345', 'active', '', '961706', '2022-12-06 18:41:33', '2022-12-09 21:51:47');
INSERT INTO `tbl_user` (`User_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `contact_no`, `Position`, `branch_id`, `Username`, `Password`, `Status`, `image`, `OTP`, `Date_Created`, `Date_Updated`) VALUES (3, 'Nicole', 'F', 'Finance', '09464003612', 'Finance Clerk', 2, 'finance@gmail.com', '12345', 'active', '', '199913', '2022-12-06 18:42:11', '2022-12-06 18:42:11');
INSERT INTO `tbl_user` (`User_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `contact_no`, `Position`, `branch_id`, `Username`, `Password`, `Status`, `image`, `OTP`, `Date_Created`, `Date_Updated`) VALUES (4, 'Mik', 'K', 'Driver', '09123456789', 'Driving Instructor', 2, 'driver@gmail.com', '12345', 'active', '', '818075', '2022-12-06 18:42:57', '2022-12-09 21:46:00');
INSERT INTO `tbl_user` (`User_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `contact_no`, `Position`, `branch_id`, `Username`, `Password`, `Status`, `image`, `OTP`, `Date_Created`, `Date_Updated`) VALUES (5, 'Jethro', 'B', 'Finance', '9090909090', 'Finance Clerk', 1, 'finance_kor@gmail.com', '12345', 'active', '', '329731', '2022-12-06 19:42:09', '2022-12-06 19:42:09');
INSERT INTO `tbl_user` (`User_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `contact_no`, `Position`, `branch_id`, `Username`, `Password`, `Status`, `image`, `OTP`, `Date_Created`, `Date_Updated`) VALUES (6, 'Nicole', 'B', 'Billones', '09489906720', 'Manager', 3, 'manager_pol@gmail.com', '12345', 'active', '', '817626', '2022-12-07 12:29:36', '2022-12-07 12:29:36');
INSERT INTO `tbl_user` (`User_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `contact_no`, `Position`, `branch_id`, `Username`, `Password`, `Status`, `image`, `OTP`, `Date_Created`, `Date_Updated`) VALUES (7, 'Jethro', 'B', 'Hidalgo', '09467309181', 'Finance Clerk', 3, 'finance_pol@gmail.com', '12345', 'active', '', '320073', '2022-12-07 12:30:21', '2022-12-07 12:30:21');
INSERT INTO `tbl_user` (`User_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `contact_no`, `Position`, `branch_id`, `Username`, `Password`, `Status`, `image`, `OTP`, `Date_Created`, `Date_Updated`) VALUES (8, 'Michole', 'B', 'Jalbuna', '09464003699', 'Driving Instructor', 3, 'driver_pol@gmail.com', '12345', 'active', '', '114982', '2022-12-07 12:31:46', '2022-12-07 12:31:46');
INSERT INTO `tbl_user` (`User_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `contact_no`, `Position`, `branch_id`, `Username`, `Password`, `Status`, `image`, `OTP`, `Date_Created`, `Date_Updated`) VALUES (9, 'Mik', 'B', 'Jalbuna', '09087620084', 'Manager', 1, 'manager10@gmail.com', '12345', 'active', '', '164503', '2022-12-10 01:46:39', '2022-12-10 01:46:39');
INSERT INTO `tbl_user` (`User_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `contact_no`, `Position`, `branch_id`, `Username`, `Password`, `Status`, `image`, `OTP`, `Date_Created`, `Date_Updated`) VALUES (10, 'Nick', 'Bill', 'Bill', '09123455559', 'Manager', 2, 'skylie2121@gmail.com', '12345', 'active', '', '190891', '2022-12-12 00:58:33', '2022-12-12 00:58:33');


#
# TABLE STRUCTURE FOR: tbl_vehicles
#

DROP TABLE IF EXISTS `tbl_vehicles`;

CREATE TABLE `tbl_vehicles` (
  `car_id` int(15) NOT NULL AUTO_INCREMENT,
  `plate_no` varchar(55) NOT NULL,
  `branch_id` int(15) NOT NULL,
  `brand` varchar(55) NOT NULL,
  `color` varchar(55) NOT NULL,
  `chassis_no` varchar(55) NOT NULL,
  `status` varchar(55) NOT NULL DEFAULT 'active',
  `date_created` date NOT NULL,
  `Date_updated` date NOT NULL,
  PRIMARY KEY (`car_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_vehicles` (`car_id`, `plate_no`, `branch_id`, `brand`, `color`, `chassis_no`, `status`, `date_created`, `Date_updated`) VALUES (1, 'LSK9901', 2, 'Honda', 'Red', 'KAWOJFEIQWIQE1232', 'active', '2022-12-09', '0000-00-00');
INSERT INTO `tbl_vehicles` (`car_id`, `plate_no`, `branch_id`, `brand`, `color`, `chassis_no`, `status`, `date_created`, `Date_updated`) VALUES (2, 'ADL9201', 2, 'Mitsubishi', 'Blue', '122424AFAJAIFJAIE', 'active', '2022-12-09', '0000-00-00');
INSERT INTO `tbl_vehicles` (`car_id`, `plate_no`, `branch_id`, `brand`, `color`, `chassis_no`, `status`, `date_created`, `Date_updated`) VALUES (3, 'NG-58061', 3, 'Honda', 'Black', 'VHUKKNLMS221', 'active', '2022-12-09', '0000-00-00');
INSERT INTO `tbl_vehicles` (`car_id`, `plate_no`, `branch_id`, `brand`, `color`, `chassis_no`, `status`, `date_created`, `Date_updated`) VALUES (4, 'MTOP-4590', 3, 'Vios', 'Black', 'YEHDJPMORS', 'active', '2022-12-09', '0000-00-00');


