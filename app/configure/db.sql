/* DROP */
DROP TABLE if exists `app_expenses`;
DROP TABLE if exists `app_expenses_categories`;
DROP TABLE if exists `app_notifications_users`;
DROP TABLE if exists `app_notifications`;
DROP TABLE if exists `app_purchases`;
DROP TABLE if exists `app_purchases_invoices`;
DROP TABLE if exists `app_sales`;
DROP TABLE if exists `app_sales_invoices`;
DROP TABLE if exists `app_clients`;
DROP TABLE if exists `app_suppliers`;
DROP TABLE if exists `app_products`;
DROP TABLE if exists `app_products_warehouses`;
DROP TABLE if exists `app_products_categories`;
DROP TABLE if exists `app_units`;
DROP TABLE if exists `app_base_units`;
DROP TABLE if exists `app_users_profile`;
DROP TABLE if exists `app_permissions_users`;
DROP TABLE if exists `app_users`;
DROP TABLE if exists `app_permissions_groups`;
DROP TABLE if exists `app_groups`;
DROP TABLE if exists `app_permissions`;

/* Create Table App_Permissions */
CREATE TABLE `app_permissions` (
  `PermissionId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(40) NOT NULL,
  `Permission` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`PermissionId`),
  UNIQUE KEY `Name` (`Name`),
  UNIQUE KEY `Permission` (`Permission`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/* Create Table App_Groups */
CREATE TABLE `app_groups` (
  `GroupId` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(15) NOT NULL,
  PRIMARY KEY (`GroupId`),
  UNIQUE KEY `GroupName` (`GroupName`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `app_groups` SET `GroupId` = '1', `GroupName` = 'Admin' ;

/* Create Table App_Permissions_Groups */
CREATE TABLE `app_permissions_groups` (
  `PermissionGroupId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `GroupId` tinyint(2) unsigned NOT NULL,
  `PermissionId` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`PermissionGroupId`),
  KEY `PermissionId` (`PermissionId`),
  KEY `GroupId` (`GroupId`),
  CONSTRAINT `app_permissions_groups_ibfk_1` FOREIGN KEY (`PermissionId`) REFERENCES `app_permissions` (`PermissionId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `app_permissions_groups_ibfk_2` FOREIGN KEY (`GroupId`) REFERENCES `app_groups` (`GroupId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/* Create Table App_Users */
CREATE TABLE `app_users` (
  `UserId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(15) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Phone` varchar(16) DEFAULT NULL,
  `Registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `LastLogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Sex` tinyint(1) unsigned NOT NULL,
  `IpAddress` varchar(15) DEFAULT NULL,
  `GroupId` tinyint(2) unsigned NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `Phone` (`Phone`),
  KEY `GroupId` (`GroupId`),
  CONSTRAINT `app_users_ibfk_1` FOREIGN KEY (`GroupId`) REFERENCES `app_groups` (`GroupId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `app_users` SET `UserId` = '1', `Username` = 'Admin_1', `Email` = 'user@Admin.com', `Password` = 'aa7b6fd1dfc6676b4b74a87860e0ba9a9e5f5fc2', `Phone` = '0638816350', `Registered` = now(), `LastLogin` = '0', `Sex` = '2', `GroupId` = '1', `Status` = '1' ;

/* Create Table App_Permissions_Users */
CREATE TABLE `app_permissions_users` (
  `PermissionUserId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `UserId` int(10) unsigned NOT NULL,
  `PermissionId` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`PermissionUserId`),
  KEY `PermissionId` (`PermissionId`),
  KEY `UserId` (`UserId`),
  CONSTRAINT `app_permissions_users_ibfk_1` FOREIGN KEY (`PermissionId`) REFERENCES `app_permissions` (`PermissionId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `app_permissions_users_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `app_users` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;

/* Create Table App_Users_Profile */
CREATE TABLE `app_users_profile` (
  `UserId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(15) DEFAULT NULL,
  `LastName` varchar(20) DEFAULT NULL,
  `Address` varchar(120) DEFAULT NULL,
  `Image` varchar(250) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  PRIMARY KEY (`UserId`),
  CONSTRAINT `app_users_profile_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `app_users` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/* Create Table App_Base_Units */
CREATE TABLE `app_base_units` (
  `BaseUnitId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Code` varchar(6) NOT NULL,
  `Name` varchar(30) NOT NULL,
  PRIMARY KEY (`BaseUnitId`),
  UNIQUE KEY `Code` (`Code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/* Create Table App_Units */
CREATE TABLE `app_units` (
  `UnitId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Code` varchar(6) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `BaseUnit` tinyint(3) unsigned DEFAULT NULL,
  `Operator` varchar(1) NOT NULL,
  `OperationValue` int(10) unsigned NOT NULL,
  PRIMARY KEY (`UnitId`),
  UNIQUE KEY `Code` (`Code`),
  KEY `BaseUnit` (`BaseUnit`),
  CONSTRAINT `app_units_ibfk_1` FOREIGN KEY (`BaseUnit`) REFERENCES `app_base_units` (`BaseUnitId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/* Create Table App_Products_Categories */
CREATE TABLE `app_products_categories` (
  `ProductCategoryId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(40) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`ProductCategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/* Create Table App_Products_Warehouses */
CREATE TABLE `app_products_warehouses` (
  `ProductWarehouseId` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Name` varchar(40) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`ProductWarehouseId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Create Table App_Products */
CREATE TABLE `app_products` (
  `ProductId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kod` varchar(255) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Tax` varchar(25) NOT NULL DEFAULT '0',
  `MadeCountry` varchar(40) NOT NULL,
  `AddedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AddedName` varchar(255) NOT NULL,
  `ModifyDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifyName` varchar(255) NOT NULL,
  `UnitId` tinyint(3) UNSIGNED NOT NULL,
  `NotificationQuantity` decimal(22,6) DEFAULT NULL,
  `CategoryId` tinyint(3) UNSIGNED NOT NULL,
  `SubCategoryId` tinyint(3) UNSIGNED NOT NULL,
  `WarehouseId` tinyint(3) UNSIGNED NOT NULL,
  `Quantity` decimal(22,6) NOT NULL,
  `QuantityOrder` decimal(22,6) NOT NULL,
  `QuantityReservation` decimal(22,6) DEFAULT NULL,
  `Barcode` varchar(45) NOT NULL,
  `SellPrice` decimal(24,8) NOT NULL,
  `BuyPrice` decimal(24,8) NOT NULL,
  `PromoPrice` decimal(24,8) NOT NULL,
  `Comment` VARCHAR(1000) NOT NULL,
  `StatusId` tinyint(3) UNSIGNED NOT NULL,
  `WwwId` tinyint(3) UNSIGNED NOT NULL,
  `TypeId` tinyint(3) UNSIGNED NOT NULL,
  `YearId` tinyint(3) UNSIGNED NOT NULL,
  `RimsId` tinyint(3) UNSIGNED NOT NULL,
  `FrameId` tinyint(3) UNSIGNED NOT NULL,
  `ReservationId` tinyint(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`ProductId`),
  UNIQUE KEY `Barcode` (`Barcode`),
  KEY `kod` (`kod`) USING BTREE,
  KEY `CategoryId` (`CategoryId`, `SubCategoryId`),
  KEY `WarehouseId` (`WarehouseId`) USING BTREE,
  KEY `UnitId` (`UnitId`),
  CONSTRAINT `app_products_ibfk_1` FOREIGN KEY (`CategoryId`) REFERENCES `app_products_categories` (`ProductCategoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `app_products_ibfk_1` FOREIGN KEY (`WarehouseId`) REFERENCES `app_products_warehouses` (`ProductWarehouseId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `app_products_ibfk_2` FOREIGN KEY (`UnitId`) REFERENCES `app_units` (`UnitId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Create Table App_Suppliers */
CREATE TABLE `app_suppliers` (
  `SupplierId` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(15) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Email` varchar(40) DEFAULT NULL,
  `Phone` varchar(16) NOT NULL,
  `Address` varchar(120) NOT NULL,
  PRIMARY KEY (`SupplierId`),
  UNIQUE KEY `Phone` (`Phone`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/* Create Table App_Clients */
CREATE TABLE `app_clients` (
  `ClientId` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(15) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Email` varchar(40) DEFAULT NULL,
  `Phone` varchar(16) NOT NULL,
  `Address` varchar(120) NOT NULL,
  PRIMARY KEY (`ClientId`),
  UNIQUE KEY `Phone` (`Phone`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/* Create Table App_Sales_Invoices */
CREATE TABLE `app_sales_invoices` (
  `InvoiceId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PaymentType` varchar(15) NOT NULL,
  `PaymentStatus` tinyint(1) NOT NULL DEFAULT '0',
  `CreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Discount` varchar(25) NOT NULL,
  `ClientId` smallint(5) unsigned NOT NULL,
  `UserId` int(10) unsigned NOT NULL,
  `ModifyDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifyUser` varchar(255) NOT NULL,
  PRIMARY KEY (`InvoiceId`),
  KEY `UserId` (`UserId`),
  KEY `ClientId` (`ClientId`),
  CONSTRAINT `app_sales_invoices_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `app_users` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `app_sales_invoices_ibfk_2` FOREIGN KEY (`ClientId`) REFERENCES `app_clients` (`ClientId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/* Create Table App_Sales */
CREATE TABLE `app_sales` (
  `SaleId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ProductId` int(10) unsigned NOT NULL,
  `SellPrice` decimal(24,8) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `QuantitySales` decimal(22,6) NOT NULL,
  `InvoiceId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`SaleId`),
  KEY `InvoiceId` (`InvoiceId`),
  KEY `ProductId` (`ProductId`),
  CONSTRAINT `app_sales_ibfk_1` FOREIGN KEY (`InvoiceId`) REFERENCES `app_sales_invoices` (`InvoiceId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `app_sales_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `app_products` (`ProductId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=utf8;

/* Create Table App_Purchases_Invoices */
CREATE TABLE `app_purchases_invoices` (
  `InvoiceId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `PaymentType` varchar(15) NOT NULL,
  `PaymentStatus` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `OrderDelivered` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `CreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifyDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Discount` varchar(25) NOT NULL,
  `SupplierId` smallint(5) UNSIGNED NOT NULL,
  `UserId` int(10) UNSIGNED NOT NULL,
  `ModifyUser` varchar(255) NOT NULL,
  `Comment` varchar(1000) NOT NULL,
  PRIMARY KEY (`InvoiceId`),
  KEY `SupplierId` (`SupplierId`),
  KEY `UserId` (`UserId`),
  CONSTRAINT `app_purchases_invoices_ibfk_1` FOREIGN KEY (`SupplierId`) REFERENCES `app_suppliers` (`SupplierId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `app_purchases_invoices_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `app_users` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Create Table App_Purchases */
CREATE TABLE `app_purchases` (
  `PurchaseId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PurchasePrice` decimal(24,8) DEFAULT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `QuantityPurchases` decimal(22,6) DEFAULT NULL,
  `ProductId` int(10) unsigned NOT NULL,
  `InvoiceId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`PurchaseId`),
  KEY `ProductId` (`ProductId`),
  KEY `InvoiceId` (`InvoiceId`),
  CONSTRAINT `app_purchases_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `app_products` (`ProductId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `app_purchases_ibfk_2` FOREIGN KEY (`InvoiceId`) REFERENCES `app_purchases_invoices` (`InvoiceId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Create Table App_Notifications */
CREATE TABLE `app_notifications` (
  `NotificationId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(80) NOT NULL,
  `Content` varchar(150) NOT NULL,
  `Link` varchar(80) DEFAULT NULL,
  `Type` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY (`NotificationId`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

/* Create Table App_Notifications_Users */
CREATE TABLE `app_notifications_users` (
  `NotificationUserId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NotificationId` int(10) unsigned NOT NULL,
  `UserId` int(10) unsigned DEFAULT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ViewedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Showed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`NotificationUserId`),
  KEY `UserId` (`UserId`),
  KEY `NotificationId` (`NotificationId`),
  CONSTRAINT `app_notifications_users_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `app_users` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `app_notifications_users_ibfk_2` FOREIGN KEY (`NotificationId`) REFERENCES `app_notifications` (`NotificationId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

/* Create Table App_Expenses_Categories */
CREATE TABLE `app_expenses_categories` (
  `ExpenseCategoryId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Type` varchar(15) DEFAULT NULL,
  `FixedPayment` decimal(24,8) DEFAULT NULL,
  PRIMARY KEY (`ExpenseCategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/* Create Table App_Expenses */
CREATE TABLE `app_expenses` (
  `ExpenseId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Payment` decimal(24,8) NOT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UserId` int(10) unsigned NOT NULL,
  `CategoryId` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`ExpenseId`),
  KEY `UserId` (`UserId`),
  KEY `CategoryId` (`CategoryId`),
  CONSTRAINT `app_expenses_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `app_users` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `app_expenses_ibfk_2` FOREIGN KEY (`CategoryId`) REFERENCES `app_expenses_categories` (`ExpenseCategoryId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/* End */
