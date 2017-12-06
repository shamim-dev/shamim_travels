-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2017 at 08:44 AM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.6.23-1+deprecated+dontuse+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `travels_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent_info`
--

CREATE TABLE IF NOT EXISTS `agent_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `agent_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `first_mobile_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `second_mobile_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `second_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attendence_statuses`
--

CREATE TABLE IF NOT EXISTS `attendence_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attend_status` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `as_short_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `attendence_statuses`
--

INSERT INTO `attendence_statuses` (`id`, `deleted_at`, `created_at`, `updated_at`, `attend_status`, `as_short_code`) VALUES
(1, NULL, '2017-04-02 08:23:42', '2017-04-02 08:23:42', 'Present', ''),
(2, NULL, '2017-04-02 08:23:54', '2017-04-02 08:23:54', 'Absent', ''),
(3, NULL, '2017-04-02 08:24:10', '2017-04-02 08:24:10', 'Delay', ''),
(4, NULL, '2017-04-02 08:26:59', '2017-04-02 08:26:59', 'Leave', ''),
(5, NULL, '2017-04-02 08:27:23', '2017-04-02 08:27:23', 'Movement', '');

-- --------------------------------------------------------

--
-- Table structure for table `backups`
--

CREATE TABLE IF NOT EXISTS `backups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `file_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `backup_size` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `backups_name_unique` (`name`),
  UNIQUE KEY `backups_file_name_unique` (`file_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE IF NOT EXISTS `banks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `bank_short_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_address` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_cell_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `banks_bank_name_unique` (`bank_name`),
  UNIQUE KEY `banks_bank_cell_no_unique` (`bank_cell_no`),
  UNIQUE KEY `banks_bank_mobile_unique` (`bank_mobile`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `deleted_at`, `created_at`, `updated_at`, `bank_name`, `bank_short_name`, `bank_address`, `bank_cell_no`, `bank_mobile`, `bank_email`, `bank_website`) VALUES
(1, NULL, '2017-03-11 10:50:08', '2017-03-11 10:50:08', 'Trust Bank Ltd.', 'TBL', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `emp_id` int(10) unsigned NOT NULL DEFAULT '1',
  `bank_acc_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `bank_acc_no` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `bank_id` int(10) unsigned NOT NULL DEFAULT '1',
  `bank_branch` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `bank_branch_address` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_accounts_bank_id_foreign` (`bank_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `deleted_at`, `created_at`, `updated_at`, `emp_id`, `bank_acc_name`, `bank_acc_no`, `bank_id`, `bank_branch`, `bank_branch_address`) VALUES
(1, NULL, '2017-05-25 06:41:16', '2017-05-25 06:41:16', 2, 'Salary Account', 'TB-22020', 1, 'Banani', 'Banani');

-- --------------------------------------------------------

--
-- Table structure for table `bank_branches`
--

CREATE TABLE IF NOT EXISTS `bank_branches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bank_branch_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `bank_id` int(10) unsigned NOT NULL DEFAULT '1',
  `bank_branch_address` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_branch_cell` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_branch_mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_branch_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bank_branches_bank_branch_name_unique` (`bank_branch_name`),
  UNIQUE KEY `bank_branches_bank_branch_cell_unique` (`bank_branch_cell`),
  UNIQUE KEY `bank_branches_bank_branch_mobile_unique` (`bank_branch_mobile`),
  KEY `bank_branches_bank_id_foreign` (`bank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `basic_informations`
--

CREATE TABLE IF NOT EXISTS `basic_informations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `emp_id` int(10) NOT NULL COMMENT 'Foreign Key: employees_info.emp_id',
  `bn_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `religion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '1 - Muslim, 2 - Hindu, 3 - Christian, 4 - Buddhist, 5 - Others',
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '1 - Male, 2 - Female',
  `marital_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `birth_place` int(10) unsigned DEFAULT NULL COMMENT 'District',
  `height` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `national_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_card_no` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `punch_card_no` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `driving_license` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_join_date` date DEFAULT NULL,
  `hoby` text COLLATE utf8_unicode_ci,
  `photo` int(11) DEFAULT NULL,
  `blood_group` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel_ofc` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel_home` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cell_ofc` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cell_personal_1` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cell_personal_2` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_ofc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_personal` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tribal` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `freedom_fighter` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `fax_home` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax_ofc` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pabx` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `basic_informations_national_id_unique` (`national_id`),
  KEY `basic_informations_birth_place_foreign` (`birth_place`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bm_paymentmst`
--

CREATE TABLE IF NOT EXISTS `bm_paymentmst` (
  `TRX_TRAN_NO` bigint(14) NOT NULL DEFAULT '0',
  `TRX_TRAN_DT` date DEFAULT NULL,
  `TRAN_AMT` double DEFAULT NULL,
  `VOUCHER_NO` bigint(14) DEFAULT NULL,
  `TRX_CODE_NO` varchar(10) DEFAULT NULL,
  `COLLECTED_BY` varchar(16) DEFAULT NULL,
  `TCANCEL_FG` varchar(1) DEFAULT NULL,
  `REMARKS` varchar(200) DEFAULT NULL,
  `ORG_ID` int(11) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(16) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_BY` varchar(16) DEFAULT NULL,
  `UPDATE_TIMESTAMP` date DEFAULT NULL,
  PRIMARY KEY (`TRX_TRAN_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bm_paymodeamt`
--

CREATE TABLE IF NOT EXISTS `bm_paymodeamt` (
  `MR_TRAN_NO` bigint(14) NOT NULL DEFAULT '0',
  `MR_TRAN_DT` date NOT NULL,
  `TRX_TRAN_NO` bigint(14) NOT NULL,
  `MR_TRAN_AMT` double NOT NULL,
  `VOUCHER_NO` bigint(14) NOT NULL,
  `PAYMENT_MODE` varchar(2) NOT NULL,
  `TRX_CODE_NO` varchar(10) NOT NULL,
  `MRCANCEL_FG` varchar(1) DEFAULT NULL,
  `REMARKS` varchar(200) DEFAULT NULL,
  `ORG_ID` int(11) NOT NULL,
  `CREATED_BY` varchar(16) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_BY` varchar(16) DEFAULT NULL,
  `UPDATE_TIMESTAMP` date DEFAULT NULL,
  PRIMARY KEY (`MR_TRAN_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bm_trxcode_info`
--

CREATE TABLE IF NOT EXISTS `bm_trxcode_info` (
  `TRX_CODE_NO` varchar(10) NOT NULL DEFAULT '',
  `NARRATION` varchar(30) NOT NULL,
  `CRDR_TAG` varchar(2) DEFAULT NULL,
  `REG_NO` bigint(14) DEFAULT NULL,
  PRIMARY KEY (`TRX_CODE_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bm_vn_ledgers`
--

CREATE TABLE IF NOT EXISTS `bm_vn_ledgers` (
  `VLEDGER_NO` bigint(14) NOT NULL DEFAULT '0',
  `VLEDGER_DT` date DEFAULT NULL,
  `TRX_CODE_NO` varchar(10) DEFAULT NULL,
  `TRX_TRAN_NO` bigint(14) DEFAULT NULL,
  `VOUCHER_NO` bigint(14) DEFAULT NULL,
  `APPROVAL_NO` bigint(14) DEFAULT NULL,
  `CR_AMT` double DEFAULT NULL,
  `DR_AMT` double DEFAULT NULL,
  `PITEM_TQTY` int(11) DEFAULT NULL,
  `CASH_POINT` int(11) DEFAULT NULL,
  `SHIFT_NO` varchar(5) DEFAULT NULL,
  `SHIFT_NAME` varchar(20) DEFAULT NULL,
  `START_TIME` date DEFAULT NULL,
  `END_TIME` date DEFAULT NULL,
  `LCANCEL_FG` varchar(1) DEFAULT NULL,
  `REMARKS` varchar(200) DEFAULT NULL,
  `ORG_ID` int(11) NOT NULL DEFAULT '1',
  `CREATED_BY` int(11) DEFAULT NULL,
  `CREATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_BY` int(11) DEFAULT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`VLEDGER_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bm_voucherchd`
--

CREATE TABLE IF NOT EXISTS `bm_voucherchd` (
  `TRX_TRAN_NO` bigint(14) NOT NULL DEFAULT '0',
  `TRX_TRAN_DT` date DEFAULT NULL,
  `VOUCHER_NO` bigint(14) DEFAULT NULL,
  `SESSION_ID` int(11) NOT NULL,
  `SEMISTER_ID` int(11) NOT NULL,
  `PRTCULR_NO` bigint(14) DEFAULT NULL,
  `PITEM_BQTY` int(11) DEFAULT NULL,
  `PITEM_CQTY` int(11) DEFAULT NULL,
  `PUNIT_PRICE` float DEFAULT NULL,
  `FEES_YYYYMM` int(6) DEFAULT NULL,
  `TCANCEL_FG` varchar(1) DEFAULT NULL,
  `DISC_AMT` int(11) DEFAULT NULL,
  `VAT_AMT` int(11) DEFAULT NULL,
  `BILL_AMT` float DEFAULT NULL,
  `SOWNER_PAY` int(11) DEFAULT NULL,
  `OOWNER_PAY` int(11) DEFAULT NULL,
  `REMARKS` varchar(200) DEFAULT NULL,
  `ORG_ID` int(11) NOT NULL,
  `CREATED_BY` int(11) DEFAULT NULL,
  `CREATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_BY` int(11) DEFAULT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`TRX_TRAN_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bm_vouchermst`
--

CREATE TABLE IF NOT EXISTS `bm_vouchermst` (
  `VOUCHER_NO` bigint(14) NOT NULL DEFAULT '0',
  `VOUCHER_DT` date DEFAULT NULL,
  `STUDENT_ID` bigint(14) NOT NULL,
  `ROLL_NO` varchar(20) DEFAULT NULL,
  `FACULTY_ID` smallint(6) NOT NULL,
  `DEPT_ID` int(11) NOT NULL,
  `PROGRAM_ID` int(11) NOT NULL,
  `SESSION_ID` int(11) NOT NULL,
  `SEMESTER_ID` int(11) DEFAULT NULL,
  `ORG_ID` int(11) NOT NULL,
  `VCANCEL_FG` varchar(1) DEFAULT NULL,
  `REMARKS` varchar(200) DEFAULT NULL,
  `CREATED_BY` int(11) DEFAULT NULL,
  `CREATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_BY` int(11) DEFAULT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`VOUCHER_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `client_info`
--

CREATE TABLE IF NOT EXISTS `client_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `agent_id` int(10) unsigned NOT NULL,
  `passport_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_image` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_image` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Inactive, 1=Active, 2=Medicale, 3=Visa_processing, 4=Training, 5=Flight, 6=Full Process Complete, 7=Passport Return',
  `medicale_status` tinyint(1) DEFAULT NULL COMMENT '0=Unfit, 1=Fit',
  `medicale_date` date DEFAULT NULL,
  `is_visa_processing` tinyint(1) DEFAULT NULL COMMENT '0=No, 1=Complete',
  `visa_processing_date` date DEFAULT NULL,
  `is_training_complete` tinyint(1) DEFAULT NULL COMMENT '0=No, 1=Complete',
  `training_date` date DEFAULT NULL,
  `flight_date` date DEFAULT NULL,
  `passport_return_date` date DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `client_interest_country`
--

CREATE TABLE IF NOT EXISTS `client_interest_country` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_client_interest_country_1_idx` (`client_id`),
  KEY `fk_client_interest_country_2_idx` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `short_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `countries_country_name_unique` (`country_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=243 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `deleted_at`, `created_at`, `updated_at`, `country_name`, `short_name`) VALUES
(1, NULL, '2017-03-11 10:43:33', '2017-03-11 10:43:33', 'Afghanistan', 'Ag'),
(2, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Albania', NULL),
(3, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Algeria', NULL),
(4, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Andorra', NULL),
(5, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Angola', NULL),
(6, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Anguilla', NULL),
(7, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Antarctica', NULL),
(8, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Antigua and Barbuda', NULL),
(9, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Argentina', NULL),
(10, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Armenia', NULL),
(11, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Aruba', NULL),
(12, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Ascension Island', NULL),
(13, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Australia', NULL),
(14, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Austria', NULL),
(15, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Azerbaijan', NULL),
(16, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Bahamas', NULL),
(17, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Bahrain', NULL),
(18, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Bangladesh', NULL),
(19, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Barbados', NULL),
(20, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Belarus', NULL),
(21, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Belgium', NULL),
(22, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Belize', NULL),
(23, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Benin', NULL),
(24, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Bermuda', NULL),
(25, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Bhutan', NULL),
(26, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Bolivia', NULL),
(27, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Bophuthatswana', NULL),
(28, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Bosnia-Herzegovina', NULL),
(29, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Botswana', NULL),
(30, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Bouvet Island', NULL),
(31, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Brazil', NULL),
(32, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'British Indian Ocean', NULL),
(33, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'British Virgin Islands', NULL),
(34, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Brunei Darussalam', NULL),
(35, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Bulgaria', NULL),
(36, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Burkina Faso', NULL),
(37, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Burundi', NULL),
(38, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Cambodia', NULL),
(39, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Cameroon', NULL),
(40, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Canada', NULL),
(41, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Cape Verde Island', NULL),
(42, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Cayman Islands', NULL),
(43, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Central Africa', NULL),
(44, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Chad', NULL),
(45, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Channel Islands', NULL),
(46, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Chile', NULL),
(47, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'China, Peoples Republic', NULL),
(48, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Christmas Island', NULL),
(49, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Cocos (Keeling) Islands', NULL),
(50, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Colombia', NULL),
(51, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Comoros Islands', NULL),
(52, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Congo', NULL),
(53, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Cook Islands', NULL),
(54, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Costa Rica', NULL),
(55, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Croatia', NULL),
(56, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Cuba', NULL),
(57, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Cyprus', NULL),
(58, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Czech Republic', NULL),
(59, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Denmark', NULL),
(60, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Djibouti', NULL),
(61, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Dominica', NULL),
(62, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Dominican Republic', NULL),
(63, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Easter Island', NULL),
(64, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Ecuador', NULL),
(65, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Egypt', NULL),
(66, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'El Salvador', NULL),
(67, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'England', NULL),
(68, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Equatorial Guinea', NULL),
(69, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Estonia', NULL),
(70, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Ethiopia', NULL),
(71, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Faeroe Islands', NULL),
(72, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Falkland Islands', NULL),
(73, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Fiji', NULL),
(74, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Finland', NULL),
(75, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'France', NULL),
(76, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'French Guyana', NULL),
(77, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'French Polynesia', NULL),
(78, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Gabon', NULL),
(79, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Gambia', NULL),
(80, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Georgia Republic', NULL),
(81, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Germany', NULL),
(82, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Gibraltar', NULL),
(83, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Greece', NULL),
(84, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Greenland', NULL),
(85, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Grenada', NULL),
(86, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Guadeloupe (French)', NULL),
(87, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Guatemala', NULL),
(88, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Guernsey Island', NULL),
(89, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Guinea', NULL),
(90, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Guinea Bissau', NULL),
(91, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Guyana', NULL),
(92, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Haiti', NULL),
(93, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Heard and McDonald Isls', NULL),
(94, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Honduras', NULL),
(95, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Hong Kong', NULL),
(96, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Hungary', NULL),
(97, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Iceland', NULL),
(98, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'India', NULL),
(99, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Indonesia', NULL),
(100, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Iran', NULL),
(101, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Iraq', NULL),
(102, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Ireland', NULL),
(103, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Isle of Man', NULL),
(104, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Israel', NULL),
(105, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Italy', NULL),
(106, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Ivory Coast', NULL),
(107, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Jamaica', NULL),
(108, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Japan', NULL),
(109, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Jersey Island', NULL),
(110, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Jordan', NULL),
(111, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Kazakhstan', NULL),
(112, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Kenya', NULL),
(113, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Kiribati', NULL),
(114, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Korea', NULL),
(115, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Kuwait', NULL),
(116, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Laos', NULL),
(117, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Latvia', NULL),
(118, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Lebanon', NULL),
(119, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Lesotho', NULL),
(120, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Liberia', NULL),
(121, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Libya', NULL),
(122, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Liechtenstein', NULL),
(123, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Lithuania', NULL),
(124, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Luxembourg', NULL),
(125, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Macao', NULL),
(126, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Macedonia', NULL),
(127, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Madagascar', NULL),
(128, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Malawi', NULL),
(129, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Malaysia', NULL),
(130, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Maldives', NULL),
(131, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Mali', NULL),
(132, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Malta', NULL),
(133, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Martinique (French)', NULL),
(134, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Mauritania', NULL),
(135, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Mauritius', NULL),
(136, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Mayotte', NULL),
(137, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Mexico', NULL),
(138, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Micronesia', NULL),
(139, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Moldavia', NULL),
(140, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Monaco', NULL),
(141, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Mongolia', NULL),
(142, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Montenegro', NULL),
(143, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Montserrat', NULL),
(144, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Morocco', NULL),
(145, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Mozambique', NULL),
(146, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Myanmar', NULL),
(147, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Namibia', NULL),
(148, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Nauru', NULL),
(149, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Nepal', NULL),
(150, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Netherlands', NULL),
(151, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Netherlands Antilles', NULL),
(152, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'New Caledonia (French)', NULL),
(153, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'New Zealand', NULL),
(154, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Nicaragua', NULL),
(155, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Niger', NULL),
(156, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Niue', NULL),
(157, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Norfolk Island', NULL),
(158, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'North Korea', NULL),
(159, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Northern Ireland', NULL),
(160, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Norway', NULL),
(161, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Oman', NULL),
(162, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Pakistan', NULL),
(163, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Panama', NULL),
(164, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Papua New Guinea', NULL),
(165, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Paraguay', NULL),
(166, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Peru', NULL),
(167, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Philippines', NULL),
(168, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Pitcairn Island', NULL),
(169, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Poland', NULL),
(170, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Polynesia (French)', NULL),
(171, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Portugal', NULL),
(172, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Qatar', NULL),
(173, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Reunion Island', NULL),
(174, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Romania', NULL),
(175, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Russia', NULL),
(176, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Rwanda', NULL),
(177, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'S.Georgia Sandwich Isls', NULL),
(178, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'San Marino', NULL),
(179, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Sao Tome, Principe', NULL),
(180, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Saudi Arabia', NULL),
(181, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Scotland', NULL),
(182, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Senegal', NULL),
(183, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Serbia', NULL),
(184, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Seychelles', NULL),
(185, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Shetland', NULL),
(186, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Sierra Leone', NULL),
(187, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Singapore', NULL),
(188, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Slovak Republic', NULL),
(189, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Slovenia', NULL),
(190, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Solomon Islands', NULL),
(191, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Somalia', NULL),
(192, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'South Africa', NULL),
(193, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'South Korea', NULL),
(194, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Spain', NULL),
(195, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Sri Lanka', NULL),
(196, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'St. Helena', NULL),
(197, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'St. Kitts Nevis Anguilla', NULL),
(198, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'St. Lucia', NULL),
(199, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'St. Martins', NULL),
(200, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'St. Pierre Miquelon', NULL),
(201, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'St. Vincent Grenadines', NULL),
(202, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Sudan', NULL),
(203, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Suriname', NULL),
(204, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Svalbard Jan Mayen', NULL),
(205, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Swaziland', NULL),
(206, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Sweden', NULL),
(207, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Switzerland', NULL),
(208, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Syria', NULL),
(209, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Tahiti', NULL),
(210, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Taiwan', NULL),
(211, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Tajikistan', NULL),
(212, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Tanzania', NULL),
(213, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Thailand', NULL),
(214, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Togo', NULL),
(215, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Tokelau', NULL),
(216, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Tonga', NULL),
(217, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Trinidad and Tobago', NULL),
(218, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Tunisia', NULL),
(219, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Turkmenistan', NULL),
(220, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Turks and Caicos Isls', NULL),
(221, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Turosko', NULL),
(222, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Tuvalu', NULL),
(223, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Uganda', NULL),
(224, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Ukraine', NULL),
(225, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'United Arab Emirates', NULL),
(226, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'United States of America', NULL),
(227, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Uruguay', NULL),
(228, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Uzbekistan', NULL),
(229, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Vanuatu', NULL),
(230, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Vatican City State', NULL),
(231, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Venezuela', NULL),
(232, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Vietnam', NULL),
(233, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Virgin Islands (Brit)', NULL),
(234, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Wales', NULL),
(235, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Wallis Futuna Islands', NULL),
(236, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Western Sahara', NULL),
(237, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Western Samoa', NULL),
(238, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Yemen', NULL),
(239, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Yugoslavia', NULL),
(240, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Zaire', NULL),
(241, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Zambia', NULL),
(242, NULL, '2017-04-27 08:22:55', '2017-04-27 08:22:55', 'Zimbabwe', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tags` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '[]',
  `color` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `departments_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `tags`, `color`, `deleted_at`, `created_at`, `updated_at`, `active`) VALUES
(1, 'Administration', '[]', '#000', '2017-05-13 06:45:14', '2017-02-19 02:35:02', '2017-02-19 02:35:02', 'Yes'),
(2, 'asdf', '[]', 'asdf', '2017-02-27 22:18:35', '2017-02-27 02:55:47', '2017-02-27 22:18:35', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE IF NOT EXISTS `designations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `designation_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `designation_level` int(10) unsigned NOT NULL DEFAULT '0',
  `desig_short_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `designations_designation_name_unique` (`designation_name`),
  UNIQUE KEY `designations_designation_level_unique` (`designation_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=39 ;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `deleted_at`, `created_at`, `updated_at`, `designation_name`, `designation_level`, `desig_short_name`) VALUES
(1, NULL, '2017-03-02 05:48:33', '2017-04-10 08:14:19', 'Director General', 1, 'DG'),
(2, NULL, '2017-03-02 05:49:06', '2017-04-10 08:14:38', 'Additional Director General', 2, 'ADG'),
(3, NULL, '2017-04-10 08:15:07', '2017-04-10 08:15:07', 'Director', 3, 'Dir'),
(4, NULL, '2017-04-10 08:25:57', '2017-04-10 08:25:57', 'Deputy Director', 4, 'DD'),
(5, NULL, '2017-04-12 12:17:18', '2017-04-12 12:17:18', 'Executive Engineer', 5, 'Executive Engr'),
(6, NULL, '2017-04-12 12:17:42', '2017-04-12 12:17:42', 'System Analyst', 6, 'SA'),
(7, NULL, '2017-04-12 12:18:07', '2017-04-12 12:18:07', 'Net Administrator', 7, 'Net Admin'),
(8, NULL, '2017-04-12 12:18:49', '2017-04-12 12:18:49', 'Coy Commander', 8, 'Coy Cmdr'),
(9, NULL, '2017-04-12 12:19:19', '2017-04-19 12:14:10', 'Senior Assistant Director', 9, 'Sr. AD'),
(10, NULL, '2017-04-12 12:20:17', '2017-04-19 12:14:22', 'Senior Assistant Director (Forensic)', 10, 'Sr. AD (Forensic)'),
(11, NULL, '2017-04-12 12:20:35', '2017-04-12 12:20:35', 'RMO', 11, 'RMO'),
(12, NULL, '2017-04-12 12:21:20', '2017-04-12 12:21:20', 'Veterinary Surgeon', 12, 'Vet. Srgn.'),
(13, NULL, '2017-04-12 12:21:45', '2017-04-12 12:21:45', 'Computer Programmer', 13, 'Com. Prog'),
(14, NULL, '2017-04-12 12:22:33', '2017-04-19 12:14:40', 'Assistant Director', 14, 'AD'),
(15, NULL, '2017-04-12 12:23:09', '2017-04-19 12:14:55', 'Assistant Director (Forensic)', 15, 'AD (Forensic)'),
(16, NULL, '2017-04-12 12:23:28', '2017-04-12 12:23:28', 'Law Officer', 16, 'Law Officer'),
(17, NULL, '2017-04-12 12:23:42', '2017-04-12 12:23:42', 'Budget Officer', 17, 'Budget Officer'),
(18, NULL, '2017-04-12 12:24:11', '2017-04-12 12:24:11', 'Accounts Officer', 18, 'Accounts Officer'),
(19, NULL, '2017-04-12 12:24:53', '2017-04-19 12:13:53', 'Deputy Assistant Director', 19, 'DAD'),
(20, NULL, '2017-04-12 12:25:24', '2017-04-20 08:05:12', 'Sergeant/SI', 20, 'Sgt/SI'),
(21, NULL, '2017-04-12 12:25:51', '2017-04-12 12:25:51', 'ASI/Hav', 21, 'ASI/Hav'),
(22, NULL, '2017-04-12 12:26:13', '2017-04-12 12:26:13', 'Nayek', 22, 'NK'),
(23, NULL, '2017-04-12 12:26:30', '2017-04-12 12:26:30', 'Constable', 23, 'Const.'),
(24, NULL, '2017-04-12 12:26:46', '2017-04-12 12:26:46', 'Cook', 24, 'Cook'),
(25, NULL, '2017-04-12 12:27:00', '2017-04-12 12:27:00', 'NCE', 25, 'NCE'),
(26, NULL, '2017-04-12 12:27:45', '2017-04-12 12:27:45', 'Sub Assistant Engineer ', 26, 'Sub Asst. Engr.'),
(27, NULL, '2017-04-12 12:28:01', '2017-04-12 12:28:01', 'RT', 27, 'RT'),
(28, NULL, '2017-04-12 12:28:27', '2017-04-12 12:28:27', 'Mess Waiter', 28, 'Mess Waiter'),
(29, NULL, '2017-04-12 12:28:48', '2017-04-12 12:28:48', 'MLSS', 29, 'MLSS'),
(30, NULL, '2017-04-12 12:29:09', '2017-04-12 12:29:09', 'Accountant', 30, 'Acct'),
(31, NULL, '2017-04-12 12:29:42', '2017-04-12 12:29:42', 'Cashier', 31, 'Cashier'),
(32, NULL, '2017-04-12 12:29:56', '2017-04-12 12:29:56', 'Mali', 32, 'Mali'),
(33, NULL, '2017-04-12 12:30:16', '2017-04-12 12:30:16', 'Technician', 33, 'Technician'),
(34, NULL, '2017-04-12 12:30:35', '2017-04-12 12:30:35', 'Lab Assistant', 34, 'Lab Asst'),
(35, NULL, '2017-04-12 12:31:16', '2017-04-12 12:31:16', 'Office Assistant', 35, 'Office Asst'),
(36, NULL, '2017-04-12 12:31:32', '2017-04-12 12:31:32', 'Ward Boy', 37, 'Ward Boy'),
(37, NULL, '2017-04-12 12:31:49', '2017-04-12 12:31:49', 'Mosalcy', 38, 'Mosalcy'),
(38, NULL, '2017-04-12 12:32:24', '2017-04-12 12:32:24', 'Dom/Sweeper', 39, 'Dom/Sweeper');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE IF NOT EXISTS `districts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `division_id` int(10) unsigned NOT NULL DEFAULT '1',
  `dis_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `districts_dis_name_unique` (`dis_name`),
  KEY `districts_division_id_foreign` (`division_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=65 ;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `deleted_at`, `created_at`, `updated_at`, `division_id`, `dis_name`) VALUES
(1, NULL, '2017-04-27 05:09:58', '2017-04-27 08:39:54', 8, 'Mymensingh'),
(2, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 1, 'Gopalganj'),
(3, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 1, 'Gazipur'),
(4, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 1, 'Rajbari'),
(5, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 1, 'Narayanganj'),
(6, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 1, 'Faridpur'),
(7, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 1, 'Dhaka'),
(8, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 1, 'Kishoreganj'),
(9, NULL, '2017-04-27 05:09:58', '2017-04-27 08:39:18', 8, 'Jamalpur'),
(10, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 1, 'Shariatpur'),
(11, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 1, 'Madaripur'),
(12, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 1, 'Munshiganj'),
(13, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 1, 'Tangail'),
(14, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 1, 'Manikganj'),
(15, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 1, 'Narsingdi'),
(16, NULL, '2017-04-27 05:09:58', '2017-04-27 08:38:00', 8, 'Sherpur'),
(17, NULL, '2017-04-27 05:09:58', '2017-04-27 08:37:38', 8, 'Netrokona'),
(18, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 2, 'Khagrachhari'),
(19, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 2, 'Lakshmipur'),
(20, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 2, 'Noakhali'),
(21, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 2, 'Chandpur'),
(22, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 2, 'Chittagong'),
(23, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 2, 'Rangamati'),
(24, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 2, 'Bandarban'),
(25, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 2, 'Feni'),
(26, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 2, 'Brahmanbaria'),
(27, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 2, 'Comilla'),
(28, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 2, 'Cox''s Bazar'),
(29, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 3, 'Sirajganj'),
(30, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 3, 'Naogaon'),
(31, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 3, 'Natore'),
(32, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 3, 'Chapai Nawabganj'),
(33, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 3, 'Bogra'),
(34, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 3, 'Joypurhat'),
(35, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 3, 'Pabna'),
(36, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 3, 'Rajshahi'),
(37, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 4, 'Narail'),
(38, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 4, 'Jhenaidah'),
(39, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 4, 'Satkhira'),
(40, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 4, 'Jessore'),
(41, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 4, 'Meherpur'),
(42, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 4, 'Magura'),
(43, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 4, 'Bagerhat'),
(44, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 4, 'Kushtia'),
(45, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 4, 'Chuadanga'),
(46, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 4, 'Khulna'),
(47, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 5, 'Habiganj'),
(48, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 5, 'Sunamganj'),
(49, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 5, 'Sylhet'),
(50, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 5, 'Moulavibazar'),
(51, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 6, 'Barisal'),
(52, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 6, 'Bhola'),
(53, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 6, 'Barguna'),
(54, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 6, 'Pirojpur'),
(55, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 6, 'Patuakhali'),
(56, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 6, 'Jhalakathi'),
(57, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 7, 'Lalmonirhat'),
(58, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 7, 'Nilphamari'),
(59, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 7, 'Kurigram'),
(60, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 7, 'Panchagarh'),
(61, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 7, 'Dinajpur'),
(62, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 7, 'Rangpur'),
(63, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 7, 'Gaibandha'),
(64, NULL, '2017-04-27 05:09:58', '2017-04-27 05:09:58', 7, 'Thakurgaon');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE IF NOT EXISTS `divisions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `div_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `divisions_div_name_unique` (`div_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `deleted_at`, `created_at`, `updated_at`, `div_name`) VALUES
(1, NULL, '2017-04-27 04:47:03', '2017-04-27 04:47:03', 'Dhaka'),
(2, NULL, '2017-04-27 04:47:03', '2017-04-27 04:47:03', 'Chittagong'),
(3, NULL, '2017-04-27 04:47:03', '2017-04-27 04:47:03', 'Rajshahi'),
(4, NULL, '2017-04-27 04:47:03', '2017-04-27 04:47:03', 'Khulna'),
(5, NULL, '2017-04-27 04:47:03', '2017-04-27 04:47:03', 'Sylhet'),
(6, NULL, '2017-04-27 04:47:03', '2017-04-27 04:47:03', 'Barisal'),
(7, NULL, '2017-04-27 04:47:03', '2017-04-27 04:47:03', 'Rangpur'),
(8, NULL, '2017-04-27 08:25:11', '2017-04-27 08:25:11', 'Mymensingh');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `designation` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Male',
  `mobile` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `mobile2` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dept` int(10) unsigned NOT NULL DEFAULT '1',
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `about` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_birth` date NOT NULL DEFAULT '1990-01-01',
  `date_hire` date NOT NULL,
  `date_left` date NOT NULL DEFAULT '1990-01-01',
  `salary_cur` decimal(15,3) NOT NULL DEFAULT '0.000',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_email_unique` (`email`),
  KEY `employees_dept_foreign` (`dept`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `designation`, `gender`, `mobile`, `mobile2`, `email`, `dept`, `city`, `address`, `about`, `date_birth`, `date_hire`, `date_left`, `salary_cur`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'Super Admin', 'Male', '8888888888', '', 'akebulr@gmail.com', 1, 'Dhaka', 'House No. #85, Road No. #04, Block No. #B, Apartment No. #B5 & #C4, Banani', 'About user / biography', '1988-02-21', '2017-01-21', '2017-01-21', 0.000, NULL, '2017-02-19 02:35:37', '2017-02-22 06:17:23'),
(2, 'Rahim', 'CLK', 'Male', '01458250565', '025584741055', 'rahim@gmail.com', 1, 'Dhaka', 'sdaf', 'asdf', '1990-01-01', '1970-01-01', '1990-01-01', 50000.000, NULL, '2017-03-04 00:27:29', '2017-03-04 00:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `employees_info`
--

CREATE TABLE IF NOT EXISTS `employees_info` (
  `emp_id` int(10) NOT NULL AUTO_INCREMENT,
  `department_id` int(10) unsigned DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `emp_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`emp_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `la_configs`
--

CREATE TABLE IF NOT EXISTS `la_configs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `section` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `la_configs`
--

INSERT INTO `la_configs` (`id`, `key`, `section`, `value`, `created_at`, `updated_at`) VALUES
(1, 'sitename', '', 'SHAMIM TRAVELS', '2017-02-18 20:35:04', '2017-12-04 15:17:59'),
(2, 'sitename_part1', '', 'SHAMIM', '2017-02-18 20:35:04', '2017-12-04 15:17:59'),
(3, 'sitename_part2', '', 'TRAVELS', '2017-02-18 20:35:04', '2017-12-04 15:17:59'),
(4, 'sitename_short', '', 'SM', '2017-02-18 20:35:04', '2017-12-04 15:17:59'),
(5, 'site_description', '', 'Shamim Travels', '2017-02-18 20:35:04', '2017-12-04 15:17:59'),
(6, 'sidebar_search', '', '0', '2017-02-18 20:35:04', '2017-12-04 15:17:59'),
(7, 'show_messages', '', '0', '2017-02-18 20:35:04', '2017-12-04 15:17:59'),
(8, 'show_notifications', '', '1', '2017-02-18 20:35:04', '2017-12-04 15:17:59'),
(9, 'show_tasks', '', '0', '2017-02-18 20:35:04', '2017-12-04 15:17:59'),
(10, 'show_rightsidebar', '', '0', '2017-02-18 20:35:05', '2017-12-04 15:17:59'),
(11, 'skin', '', 'skin-white', '2017-02-18 20:35:05', '2017-12-04 15:17:59'),
(12, 'layout', '', 'fixed', '2017-02-18 20:35:05', '2017-12-04 15:17:59'),
(13, 'default_email', '', 'test@example.com', '2017-02-18 20:35:05', '2017-12-04 15:17:59');

-- --------------------------------------------------------

--
-- Table structure for table `la_menus`
--

CREATE TABLE IF NOT EXISTS `la_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'fa-cube',
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'module',
  `parent` int(10) unsigned NOT NULL DEFAULT '0',
  `hierarchy` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=279 ;

--
-- Dumping data for table `la_menus`
--

INSERT INTO `la_menus` (`id`, `name`, `url`, `icon`, `type`, `parent`, `hierarchy`, `created_at`, `updated_at`) VALUES
(1, 'HR Settings', '#', 'fa-group', 'custom', 10, 2, '2017-02-18 20:35:02', '2017-10-08 01:27:14'),
(2, 'Users', 'users', 'fa-group', 'module', 37, 1, '2017-02-18 20:35:02', '2017-04-01 00:41:47'),
(3, 'Uploads', 'uploads', 'fa-files-o', 'module', 32, 2, '2017-02-18 20:35:02', '2017-03-11 03:33:53'),
(4, 'Departments', 'departments', 'fa-tags', 'module', 32, 4, '2017-02-18 20:35:02', '2017-04-02 02:33:57'),
(5, 'Employees', 'employees', 'fa-group', 'module', 32, 5, '2017-02-18 20:35:02', '2017-04-02 02:34:30'),
(6, 'Roles', 'roles', 'fa-user-plus', 'module', 37, 2, '2017-02-18 20:35:02', '2017-05-09 05:42:23'),
(7, 'Organizations', 'organizations', 'fa-university', 'module', 32, 3, '2017-02-18 20:35:02', '2017-03-11 03:33:56'),
(8, 'Permissions', 'permissions', 'fa-magic', 'module', 32, 6, '2017-02-18 20:35:02', '2017-05-11 01:01:59'),
(10, 'Settings', '#', 'fa-cogs', 'custom', 0, 1, '2017-02-26 21:05:33', '2017-10-08 01:27:14'),
(11, 'Divisions', 'divisions', 'fa-angle-double-right', 'module', 37, 20, '2017-02-26 21:05:40', '2017-07-22 06:40:55'),
(13, 'Districts', 'districts', 'fa-angle-double-right', 'module', 37, 21, '2017-02-26 21:14:23', '2017-07-22 06:40:55'),
(14, 'Upazillas', 'upazillas', 'fa fa-angle-double-right', 'module', 37, 22, '2017-02-26 21:25:26', '2017-07-22 06:40:55'),
(25, 'Designations', 'designations', 'fa fa-angle-double-right', 'module', 37, 16, '2017-03-01 23:40:19', '2017-07-22 06:40:55'),
(29, 'Payroll', '#', 'fa-bank', 'custom', 0, 3, '2017-03-03 20:55:50', '2017-10-08 01:27:15'),
(30, 'Role_Users', 'role_users', 'fa fa-angle-double-right', 'module', 37, 3, '2017-03-03 21:03:57', '2017-05-09 05:42:23'),
(32, 'Test', '#', 'fa-cube', 'custom', 0, 6, '2017-03-04 17:46:25', '2017-11-06 03:32:52'),
(33, 'Test 1', 'testController', 'fa-angle-double-right', 'custom', 32, 1, '2017-03-04 17:46:58', '2017-03-04 17:48:01'),
(35, 'Menu Permissions', 'menu_permissions', 'fa-angle-double-right', 'custom', 37, 4, '2017-03-05 16:39:34', '2017-05-09 05:42:23'),
(37, 'Admin_Settings', '#', 'fa-key', 'custom', 10, 1, '2017-03-06 16:58:30', '2017-10-08 01:27:14'),
(51, 'Payroll Settings', '#', 'fa-cog', 'custom', 10, 3, '2017-03-06 18:06:30', '2017-10-08 01:27:15'),
(54, 'HRM', '#', 'fa-group', 'custom', 0, 2, '2017-03-11 03:16:59', '2017-10-08 01:27:15'),
(57, 'Countries', 'countries', 'fa fa-angle-double-right', 'module', 37, 18, '2017-03-11 03:49:10', '2017-07-22 06:40:55'),
(58, 'Banks', 'banks', 'fa fa-angle-double-right', 'module', 37, 23, '2017-03-11 04:49:17', '2017-07-22 06:40:55'),
(59, 'Bank_Branches', 'bank_branches', 'fa fa-angle-double-right', 'module', 37, 24, '2017-03-11 06:32:51', '2017-07-22 06:40:55'),
(60, 'Leave_Types', 'leave_types', 'fa fa-angle-double-right', 'module', 1, 1, '2017-03-12 02:52:16', '2017-03-12 02:52:33'),
(88, 'Basic_Informations', 'basic_informations', 'fa fa-angle-double-right', 'module', 70, 13, '2017-03-22 22:16:13', '2017-08-08 23:06:37'),
(96, 'Leaves', 'leaves', 'fa fa-angle-double-right', 'module', 112, 3, '2017-04-01 03:56:35', '2017-04-05 21:46:09'),
(103, 'Increment_Infos', 'increment_infos', 'fa fa-angle-double-right', 'module', 70, 27, '2017-04-01 23:27:08', '2017-08-08 23:06:37'),
(105, 'Daily_Attendences', 'daily_attendences', 'fa fa-angle-double-right', 'module', 112, 1, '2017-04-02 03:41:12', '2017-04-02 21:43:50'),
(122, 'Bank_Accounts', 'bank_accounts', 'fa fa-angle-double-right', 'module', 70, 34, '2017-04-08 05:44:12', '2017-08-08 23:06:37'),
(259, 'Payroll_Types', 'payroll_types', 'fa fa-angle-double-right', 'module', 51, 1, '2017-08-23 03:13:52', '2017-08-23 03:14:12'),
(260, 'Payroll_Heads', 'payroll_heads', 'fa fa-angle-double-right', 'module', 51, 2, '2017-08-23 03:36:52', '2017-08-23 03:37:14'),
(263, 'Salary_Policy', 'payroll/salary_policy', 'fa-angle-double-right', 'custom', 29, 1, '2017-09-09 03:37:20', '2017-09-09 03:57:21'),
(266, 'Payroll_Allowances', 'payroll_allowances', 'fa fa-angle-double-right', 'module', 51, 4, '2017-09-14 04:50:54', '2017-09-20 02:40:22'),
(267, 'Pay_Scales', 'payroll/pay_scales', 'fa-angle-double-right', 'custom', 51, 3, '2017-09-16 03:51:17', '2017-09-20 02:40:22'),
(268, 'regular_salary_est_afd', 'payroll/regular_salary_est_afd', 'fa-angle-double-right', 'custom', 29, 4, '2017-09-18 23:40:56', '2017-11-16 03:59:39'),
(269, 'Payroll_Deductions', 'payroll_deductions', 'fa-angle-double-right', 'custom', 51, 5, '2017-09-20 02:40:03', '2017-09-20 02:40:22'),
(270, 'Payroll_Hrm', 'payroll_hrm', 'fa-angle-double-right', 'custom', 29, 2, '2017-09-21 02:48:02', '2017-09-21 02:49:05'),
(271, 'regular_salary_est_police', 'payroll/regular_salary_est_police', 'fa-angle-double-right', 'custom', 29, 5, '2017-09-22 23:17:35', '2017-11-16 03:59:39'),
(274, 'Salary_Process', 'salary_process', 'fa-angle-double-right', 'custom', 29, 3, '2017-10-03 00:10:42', '2017-10-03 00:11:45'),
(276, 'Payroll_5221', 'payroll_5221', 'fa-angle-double-right', 'custom', 277, 2, '2017-11-06 03:32:11', '2017-11-16 03:59:39'),
(277, 'Payroll_Reports', '#', 'fa-bar-chart-o', 'custom', 29, 6, '2017-11-06 03:35:12', '2017-11-16 03:59:39'),
(278, 'Regular_Salary_Sheet', 'payroll/regular_salary_sheet', 'fa-angle-double-right', 'custom', 277, 3, '2017-11-09 02:40:25', '2017-11-16 03:59:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_05_26_050000_create_modules_table', 1),
('2014_05_26_055000_create_module_field_types_table', 1),
('2014_05_26_060000_create_module_fields_table', 1),
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2014_12_01_000000_create_uploads_table', 1),
('2016_05_26_064006_create_departments_table', 1),
('2016_05_26_064007_create_employees_table', 1),
('2016_05_26_064446_create_roles_table', 1),
('2016_07_05_115343_create_role_user_table', 1),
('2016_07_06_140637_create_organizations_table', 1),
('2016_07_07_134058_create_backups_table', 1),
('2016_07_07_134058_create_menus_table', 1),
('2016_09_10_163337_create_permissions_table', 1),
('2016_09_10_163520_create_permission_role_table', 1),
('2016_09_22_105958_role_module_fields_table', 1),
('2016_09_22_110008_role_module_table', 1),
('2016_10_06_115413_create_la_configs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name_db` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `view_col` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `controller` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fa_icon` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'fa-cube',
  `is_gen` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=118 ;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `label`, `name_db`, `view_col`, `model`, `controller`, `fa_icon`, `is_gen`, `created_at`, `updated_at`) VALUES
(1, 'Users', 'Users', 'users', 'user_name', 'User', 'UsersController', 'fa-group', 1, '2017-02-19 02:34:47', '2017-03-22 12:14:10'),
(2, 'Uploads', 'Uploads', 'uploads', 'name', 'Upload', 'UploadsController', 'fa-files-o', 1, '2017-02-19 02:34:49', '2017-02-19 02:35:05'),
(3, 'Departments', 'Departments', 'departments', 'name', 'Department', 'DepartmentsController', 'fa-tags', 1, '2017-02-19 02:34:49', '2017-02-21 21:56:13'),
(4, 'Employees', 'Employees', 'employees', 'name', 'Employee', 'EmployeesController', 'fa-group', 1, '2017-02-19 02:34:50', '2017-02-19 02:35:05'),
(5, 'Roles', 'Roles', 'roles', 'name', 'Role', 'RolesController', 'fa-user-plus', 1, '2017-02-19 02:34:51', '2017-03-22 09:40:28'),
(6, 'Organizations', 'Organizations', 'organizations', 'name', 'Organization', 'OrganizationsController', 'fa-university', 1, '2017-02-19 02:34:54', '2017-02-19 02:35:05'),
(7, 'Backups', 'Backups', 'backups', 'name', 'Backup', 'BackupsController', 'fa-hdd-o', 1, '2017-02-19 02:34:56', '2017-02-19 02:35:05'),
(8, 'Permissions', 'Permissions', 'permissions', 'name', 'Permission', 'PermissionsController', 'fa-magic', 1, '2017-02-19 02:34:57', '2017-02-19 02:35:05'),
(9, 'Divisions', 'Divisions', 'divisions', 'div_name', 'Division', 'DivisionsController', 'fa-angle-double-right', 1, '2017-02-27 03:00:50', '2017-02-27 03:07:23'),
(10, 'Districts', 'Districts', 'districts', 'dis_name', 'District', 'DistrictsController', 'fa-angle-double-right', 1, '2017-02-27 03:11:51', '2017-02-27 03:14:11'),
(11, 'Upazillas', 'Upazillas', 'upazillas', 'upazilla_name', 'Upazilla', 'UpazillasController', 'fa-angle-double-right', 1, '2017-02-27 03:21:47', '2017-02-27 03:25:26'),
(19, 'Designations', 'Designations', 'designations', 'designation_name', 'Designation', 'DesignationsController', 'fa-angle-double-right', 1, '2017-03-02 05:32:02', '2017-03-02 05:40:19'),
(24, 'Role_Users', 'Role_Users', 'role_users', 'user_id', 'Role_User', 'Role_UsersController', 'fa-angle-double-right', 1, '2017-03-04 03:00:53', '2017-03-04 03:03:57'),
(27, 'Countries', 'Countries', 'countries', 'country_name', 'Country', 'CountriesController', 'fa-angle-double-right', 1, '2017-03-11 09:45:59', '2017-03-11 09:49:11'),
(28, 'Banks', 'Banks', 'banks', 'bank_name', 'Bank', 'BanksController', 'fa-angle-double-right', 1, '2017-03-11 10:44:31', '2017-03-11 10:49:17'),
(29, 'Bank_Branches', 'Bank_Branches', 'bank_branches', 'bank_branch_name', 'Bank_Branch', 'Bank_BranchesController', 'fa-angle-double-right', 1, '2017-03-11 12:19:26', '2017-03-11 12:32:52'),
(30, 'Leave_Types', 'Leave_Types', 'leave_types', 'leave_type', 'Leave_Type', 'Leave_TypesController', 'fa-angle-double-right', 1, '2017-03-12 08:49:21', '2017-03-12 08:52:16'),
(44, 'Basic_Informations', 'Basic_Informations', 'basic_informations', 'nationality', 'Basic_Information', 'Basic_InformationsController', 'fa-angle-double-right', 1, '2017-03-23 03:55:00', '2017-03-23 04:16:13'),
(61, 'Attendence_Statuses', 'Attendence_Statuses', 'attendence_statuses', 'attend_status', 'Attendence_Status', 'Attendence_StatusesController', 'fa-angle-double-right', 1, '2017-04-02 08:14:26', '2017-04-02 08:18:08'),
(75, 'Bank_Accounts', 'Bank_Accounts', 'bank_accounts', 'bank_acc_no', 'Bank_Account', 'Bank_AccountsController', 'fa-angle-double-right', 1, '2017-04-08 11:34:55', '2017-04-08 11:44:12'),
(114, 'Payroll_Types', 'Payroll_Types', 'payroll_types', 'name', 'Payroll_Type', 'Payroll_TypesController', 'fa-angle-double-right', 1, '2017-08-23 09:12:18', '2017-08-23 09:13:52'),
(116, 'Payroll_Heads', 'Payroll_Heads', 'payroll_heads', 'name', 'Payroll_Head', 'Payroll_HeadsController', 'fa-angle-double-right', 1, '2017-08-23 09:33:19', '2017-08-23 09:36:52'),
(117, 'Payroll_Allowances', 'Payroll_Allowances', 'payroll_allowances', 'allowance_name', 'Payroll_Allowance', 'Payroll_AllowancesController', 'fa-angle-double-right', 1, '2017-09-14 10:34:18', '2017-09-14 10:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `module_fields`
--

CREATE TABLE IF NOT EXISTS `module_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `colname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `module` int(10) unsigned NOT NULL,
  `field_type` int(10) unsigned NOT NULL,
  `unique` tinyint(1) NOT NULL DEFAULT '0',
  `defaultvalue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `minlength` int(10) unsigned NOT NULL DEFAULT '0',
  `maxlength` int(10) unsigned NOT NULL DEFAULT '0',
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `popup_vals` text COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module_fields_module_foreign` (`module`),
  KEY `module_fields_field_type_foreign` (`field_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=685 ;

--
-- Dumping data for table `module_fields`
--

INSERT INTO `module_fields` (`id`, `colname`, `label`, `module`, `field_type`, `unique`, `defaultvalue`, `minlength`, `maxlength`, `required`, `popup_vals`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'name', 'Name', 1, 16, 0, '', 5, 250, 1, '', 0, '2017-02-19 02:34:47', '2017-02-19 02:34:47'),
(2, 'context_id', 'Context', 1, 13, 0, '0', 0, 0, 0, '', 0, '2017-02-19 02:34:47', '2017-02-19 02:34:47'),
(3, 'email', 'Email', 1, 8, 1, '', 0, 250, 0, '', 0, '2017-02-19 02:34:47', '2017-02-19 02:34:47'),
(4, 'password', 'Password', 1, 17, 0, '', 6, 250, 1, '', 0, '2017-02-19 02:34:47', '2017-02-19 02:34:47'),
(5, 'type', 'User Type', 1, 7, 0, 'Employee', 0, 0, 0, '["Employee","Client"]', 0, '2017-02-19 02:34:47', '2017-02-19 02:34:47'),
(6, 'name', 'Name', 2, 16, 0, '', 5, 250, 1, '', 0, '2017-02-19 02:34:49', '2017-02-19 02:34:49'),
(7, 'path', 'Path', 2, 19, 0, '', 0, 250, 0, '', 0, '2017-02-19 02:34:49', '2017-02-19 02:34:49'),
(8, 'extension', 'Extension', 2, 19, 0, '', 0, 20, 0, '', 0, '2017-02-19 02:34:49', '2017-02-19 02:34:49'),
(9, 'caption', 'Caption', 2, 19, 0, '', 0, 250, 0, '', 0, '2017-02-19 02:34:49', '2017-02-19 02:34:49'),
(10, 'user_id', 'Owner', 2, 7, 0, '1', 0, 0, 0, '@users', 0, '2017-02-19 02:34:49', '2017-02-19 02:34:49'),
(11, 'hash', 'Hash', 2, 19, 0, '', 0, 250, 0, '', 0, '2017-02-19 02:34:49', '2017-02-19 02:34:49'),
(12, 'public', 'Is Public', 2, 2, 0, '0', 0, 0, 0, '', 0, '2017-02-19 02:34:49', '2017-02-19 02:34:49'),
(13, 'name', 'Name', 3, 16, 1, '', 1, 250, 1, '', 0, '2017-02-19 02:34:50', '2017-02-19 02:34:50'),
(14, 'tags', 'Tags', 3, 20, 0, '[]', 0, 0, 0, '', 0, '2017-02-19 02:34:50', '2017-02-19 02:34:50'),
(15, 'color', 'Color', 3, 19, 0, '', 0, 50, 1, '', 0, '2017-02-19 02:34:50', '2017-02-19 02:34:50'),
(16, 'name', 'Name', 4, 16, 0, '', 5, 250, 1, '', 0, '2017-02-19 02:34:50', '2017-02-19 02:34:50'),
(17, 'designation', 'Designation', 4, 19, 0, '', 0, 50, 1, '', 0, '2017-02-19 02:34:50', '2017-02-19 02:34:50'),
(18, 'gender', 'Gender', 4, 18, 0, 'Male', 0, 0, 1, '["Male","Female"]', 0, '2017-02-19 02:34:50', '2017-02-19 02:34:50'),
(19, 'mobile', 'Mobile', 4, 14, 0, '', 10, 20, 1, '', 0, '2017-02-19 02:34:50', '2017-02-19 02:34:50'),
(20, 'mobile2', 'Alternative Mobile', 4, 14, 0, '', 10, 20, 0, '', 0, '2017-02-19 02:34:50', '2017-02-19 02:34:50'),
(21, 'email', 'Email', 4, 8, 1, '', 5, 250, 1, '', 0, '2017-02-19 02:34:50', '2017-02-19 02:34:50'),
(22, 'dept', 'Department', 4, 7, 0, '0', 0, 0, 1, '@departments', 0, '2017-02-19 02:34:50', '2017-02-19 02:34:50'),
(23, 'city', 'City', 4, 19, 0, '', 0, 50, 0, '', 0, '2017-02-19 02:34:50', '2017-02-19 02:34:50'),
(24, 'address', 'Address', 4, 1, 0, '', 0, 1000, 0, '', 0, '2017-02-19 02:34:50', '2017-02-19 02:34:50'),
(25, 'about', 'About', 4, 19, 0, '', 0, 0, 0, '', 0, '2017-02-19 02:34:50', '2017-02-19 02:34:50'),
(26, 'date_birth', 'Date of Birth', 4, 4, 0, '1990-01-01', 0, 0, 0, '', 0, '2017-02-19 02:34:50', '2017-02-19 02:34:50'),
(27, 'date_hire', 'Hiring Date', 4, 4, 0, 'date(''Y-m-d'')', 0, 0, 0, '', 0, '2017-02-19 02:34:50', '2017-02-19 02:34:50'),
(28, 'date_left', 'Resignation Date', 4, 4, 0, '1990-01-01', 0, 0, 0, '', 0, '2017-02-19 02:34:50', '2017-02-19 02:34:50'),
(29, 'salary_cur', 'Current Salary', 4, 6, 0, '0.0', 0, 2, 0, '', 0, '2017-02-19 02:34:50', '2017-02-19 02:34:50'),
(30, 'name', 'Name', 5, 16, 1, '', 1, 250, 1, '', 0, '2017-02-19 02:34:51', '2017-02-19 02:34:51'),
(31, 'display_name', 'Display Name', 5, 19, 0, '', 0, 250, 1, '', 0, '2017-02-19 02:34:51', '2017-02-19 02:34:51'),
(32, 'description', 'Description', 5, 21, 0, '', 0, 1000, 0, '', 0, '2017-02-19 02:34:51', '2017-02-19 02:34:51'),
(35, 'name', 'Name', 6, 16, 1, '', 5, 250, 1, '', 0, '2017-02-19 02:34:54', '2017-02-19 02:34:54'),
(36, 'email', 'Email', 6, 8, 1, '', 0, 250, 0, '', 0, '2017-02-19 02:34:54', '2017-02-19 02:34:54'),
(37, 'phone', 'Phone', 6, 14, 0, '', 0, 20, 0, '', 0, '2017-02-19 02:34:54', '2017-02-19 02:34:54'),
(38, 'website', 'Website', 6, 23, 0, 'http://', 0, 250, 0, '', 0, '2017-02-19 02:34:54', '2017-02-19 02:34:54'),
(39, 'assigned_to', 'Assigned to', 6, 7, 0, '0', 0, 0, 0, '@employees', 0, '2017-02-19 02:34:54', '2017-02-19 02:34:54'),
(40, 'connect_since', 'Connected Since', 6, 4, 0, 'date(''Y-m-d'')', 0, 0, 0, '', 0, '2017-02-19 02:34:54', '2017-02-19 02:34:54'),
(41, 'address', 'Address', 6, 1, 0, '', 0, 1000, 1, '', 0, '2017-02-19 02:34:54', '2017-02-19 02:34:54'),
(42, 'city', 'City', 6, 19, 0, '', 0, 250, 1, '', 0, '2017-02-19 02:34:55', '2017-02-19 02:34:55'),
(43, 'description', 'Description', 6, 21, 0, '', 0, 1000, 0, '', 0, '2017-02-19 02:34:55', '2017-02-19 02:34:55'),
(44, 'profile_image', 'Profile Image', 6, 12, 0, '', 0, 250, 0, '', 0, '2017-02-19 02:34:55', '2017-02-19 02:34:55'),
(45, 'profile', 'Company Profile', 6, 9, 0, '', 0, 250, 0, '', 0, '2017-02-19 02:34:55', '2017-02-19 02:34:55'),
(46, 'name', 'Name', 7, 16, 1, '', 0, 250, 1, '', 0, '2017-02-19 02:34:56', '2017-02-19 02:34:56'),
(47, 'file_name', 'File Name', 7, 19, 1, '', 0, 250, 1, '', 0, '2017-02-19 02:34:56', '2017-02-19 02:34:56'),
(48, 'backup_size', 'File Size', 7, 19, 0, '0', 0, 10, 1, '', 0, '2017-02-19 02:34:56', '2017-02-19 02:34:56'),
(49, 'name', 'Name', 8, 16, 1, '', 1, 250, 1, '', 0, '2017-02-19 02:34:57', '2017-02-19 02:34:57'),
(50, 'display_name', 'Display Name', 8, 19, 0, '', 0, 250, 1, '', 0, '2017-02-19 02:34:57', '2017-02-19 02:34:57'),
(51, 'description', 'Description', 8, 21, 0, '', 0, 1000, 0, '', 0, '2017-02-19 02:34:57', '2017-02-19 02:34:57'),
(52, 'active', 'Active', 3, 18, 0, 'Yes', 0, 0, 1, '["Yes","No"]', 0, '2017-02-21 21:35:53', '2017-02-21 21:54:29'),
(53, 'div_name', 'Name', 9, 19, 1, '', 0, 255, 1, '', 0, '2017-02-27 03:02:37', '2017-02-27 03:02:37'),
(55, 'division_id', 'Division', 10, 7, 0, NULL, 0, 0, 1, '@divisions', 0, '2017-02-27 03:13:10', '2017-07-08 05:56:49'),
(56, 'dis_name', 'Name', 10, 19, 1, '', 0, 255, 1, '', 0, '2017-02-27 03:13:49', '2017-02-27 03:13:49'),
(57, 'district_id', 'District', 11, 7, 0, '', 0, 0, 1, '@districts', 0, '2017-02-27 03:23:45', '2017-02-27 03:23:45'),
(58, 'upazilla_name', 'Name', 11, 19, 1, NULL, 0, 255, 1, '', 0, '2017-02-27 03:25:10', '2017-04-04 05:47:56'),
(131, 'designation_name', 'Name', 19, 19, 1, NULL, 0, 255, 1, '', 1, '2017-03-02 05:32:54', '2017-03-02 05:32:54'),
(132, 'designation_level', 'Level', 19, 13, 1, NULL, 1, 11, 1, '', 3, '2017-03-02 05:39:57', '2017-03-02 05:40:07'),
(157, 'user_id', 'User', 24, 7, 0, NULL, 0, 0, 0, '@users', 0, '2017-03-04 03:03:01', '2017-03-04 03:03:01'),
(158, 'role_id', 'Role', 24, 7, 0, NULL, 0, 0, 0, '@roles', 0, '2017-03-04 03:03:49', '2017-03-04 03:15:57'),
(166, 'country_name', 'Name', 27, 19, 1, NULL, 0, 255, 1, '', 0, '2017-03-11 09:46:51', '2017-03-11 09:46:51'),
(167, 'short_name', 'Short Name', 27, 19, 0, NULL, 0, 256, 0, '', 0, '2017-03-11 09:48:36', '2017-03-11 09:48:36'),
(168, 'bank_name', 'Name', 28, 19, 1, NULL, 0, 255, 1, '', 0, '2017-03-11 10:45:05', '2017-03-11 10:45:05'),
(169, 'bank_short_name', 'Short Name', 28, 19, 0, NULL, 0, 256, 0, '', 0, '2017-03-11 10:46:11', '2017-03-11 10:46:11'),
(170, 'bank_address', 'Address', 28, 1, 0, NULL, 0, 256, 0, '', 0, '2017-03-11 10:46:31', '2017-03-11 10:46:31'),
(171, 'bank_cell_no', 'Cell No.', 28, 19, 1, NULL, 0, 20, 0, '', 0, '2017-03-11 10:47:23', '2017-03-11 10:47:23'),
(172, 'bank_mobile', 'Mobile No.', 28, 19, 1, NULL, 0, 20, 0, '', 0, '2017-03-11 10:47:53', '2017-03-11 10:47:53'),
(173, 'bank_email', 'E-mail', 28, 19, 0, NULL, 0, 100, 0, '', 0, '2017-03-11 10:48:31', '2017-03-11 10:48:31'),
(174, 'bank_website', 'Website', 28, 19, 0, NULL, 0, 255, 0, '', 0, '2017-03-11 10:48:59', '2017-03-11 10:48:59'),
(175, 'bank_branch_name', 'Name', 29, 19, 1, NULL, 0, 255, 1, '', 0, '2017-03-11 12:20:07', '2017-03-11 12:20:07'),
(176, 'bank_id', 'Bank', 29, 7, 0, NULL, 0, 0, 0, '@banks', 0, '2017-03-11 12:20:36', '2017-03-11 12:20:36'),
(177, 'bank_branch_address', 'Address', 29, 1, 0, NULL, 0, 256, 0, '', 0, '2017-03-11 12:21:09', '2017-03-11 12:21:09'),
(178, 'bank_branch_cell', 'Cell No.', 29, 19, 1, NULL, 0, 20, 0, '', 0, '2017-03-11 12:31:38', '2017-03-11 12:31:38'),
(179, 'bank_branch_mobile', 'Mobile No.', 29, 19, 1, NULL, 0, 20, 0, '', 0, '2017-03-11 12:32:06', '2017-03-11 12:32:06'),
(180, 'bank_branch_email', 'E-mail', 29, 19, 0, NULL, 0, 100, 0, '', 0, '2017-03-11 12:32:33', '2017-03-11 12:32:33'),
(181, 'leave_type', 'Leave Type', 30, 19, 1, NULL, 0, 50, 1, '', 0, '2017-03-12 08:49:56', '2017-03-12 09:10:10'),
(182, 'ltype_short', 'Short Code', 30, 19, 0, NULL, 0, 5, 0, '', 0, '2017-03-12 08:50:35', '2017-03-12 08:50:35'),
(183, 'is_service_book', 'Added Service Book?', 30, 18, 0, NULL, 0, 0, 0, '["Yes","No"]', 0, '2017-03-12 08:52:04', '2017-03-12 08:52:04'),
(238, 'user_name', 'User Name', 1, 19, 0, NULL, 0, 100, 0, '', 0, '2017-03-22 12:12:31', '2017-03-22 12:12:31'),
(239, 'emp_id', 'RAB ID', 44, 7, 0, NULL, 0, 0, 1, '@employees_info', 0, '2017-03-23 03:58:20', '2017-03-23 03:58:20'),
(240, 'nationality', 'Nationality', 44, 22, 0, NULL, 0, 256, 0, '', 0, '2017-03-23 03:59:48', '2017-03-23 03:59:48'),
(241, 'religion', 'Religion', 44, 7, 0, NULL, 0, 256, 0, '["Islam","Christianity","Hinduism","Buddhism","Others"]', 0, '2017-03-23 04:00:40', '2017-04-04 06:02:46'),
(242, 'gender', 'Gender', 44, 7, 0, NULL, 0, 0, 0, '["Male","Female"]', 0, '2017-03-23 04:02:21', '2017-04-04 06:03:22'),
(243, 'marital_status', 'Marital Status', 44, 7, 0, NULL, 0, 0, 0, '["Married","Unmarried","Devorced"]', 0, '2017-03-23 04:03:50', '2017-03-23 04:03:50'),
(244, 'dob', 'Date of Birth', 44, 4, 0, NULL, 0, 0, 0, '', 0, '2017-03-23 04:04:45', '2017-03-23 04:04:45'),
(245, 'birth_place', 'Birth Place', 44, 7, 0, NULL, 0, 0, 0, '@districts', 0, '2017-03-23 04:05:53', '2017-03-23 04:05:53'),
(246, 'height', 'Height', 44, 22, 0, NULL, 0, 256, 0, '', 0, '2017-03-23 04:06:43', '2017-03-23 04:07:21'),
(247, 'weight', 'Weight', 44, 22, 0, NULL, 0, 256, 0, '', 0, '2017-03-23 04:07:06', '2017-03-23 04:07:06'),
(248, 'national_id', 'National ID', 44, 22, 0, NULL, 0, 256, 0, '', 0, '2017-03-23 04:08:14', '2017-03-23 04:08:14'),
(249, 'passport_no', 'Passport No.', 44, 22, 0, NULL, 0, 256, 0, '', 0, '2017-03-23 04:09:36', '2017-03-23 04:09:36'),
(250, 'id_card_no', 'ID No.', 44, 22, 0, NULL, 0, 256, 0, '', 0, '2017-03-23 04:10:03', '2017-03-23 04:10:03'),
(251, 'punch_card_no', 'Punch Card No.', 44, 22, 0, NULL, 0, 256, 0, '', 0, '2017-03-23 04:10:45', '2017-03-23 04:10:45'),
(252, 'driving_license', 'Driving License', 44, 22, 0, NULL, 0, 256, 0, '', 0, '2017-03-23 04:11:46', '2017-03-23 04:11:46'),
(253, 'job_join_date', 'Joining Date', 44, 4, 0, NULL, 0, 0, 0, '', 0, '2017-03-23 04:12:17', '2017-03-23 04:12:17'),
(254, 'hoby', 'hoby', 44, 22, 0, NULL, 0, 256, 0, '', 0, '2017-03-23 04:13:36', '2017-03-23 04:13:36'),
(256, 'photo', 'Photo', 44, 12, 0, NULL, 0, 0, 0, '', 0, '2017-03-23 04:29:44', '2017-04-04 12:38:23'),
(354, 'attend_status', 'Attendence Status', 61, 22, 0, NULL, 0, 256, 0, '', 0, '2017-04-02 08:18:01', '2017-04-02 08:18:01'),
(427, 'blood_group', 'Blood Group', 44, 7, 0, NULL, 0, 0, 0, '["O+","O-","A+","A-","B+","B-","AB+","AB-"]', 0, '2017-04-04 04:12:28', '2017-04-04 04:12:28'),
(428, 'tel_ofc', 'Telephone Office', 44, 22, 0, NULL, 0, 256, 0, '', 0, '2017-04-04 05:27:58', '2017-04-04 05:27:58'),
(429, 'tel_home', 'Telephone Home', 44, 22, 0, NULL, 0, 256, 0, '', 0, '2017-04-04 05:29:34', '2017-04-04 05:29:34'),
(430, 'cell_ofc', 'Cell Office', 44, 22, 0, NULL, 0, 256, 0, '', 0, '2017-04-04 05:30:40', '2017-04-04 05:30:40'),
(431, 'cell_personal_1', 'Cell Personal 1', 44, 14, 0, NULL, 0, 256, 0, '', 0, '2017-04-04 05:31:31', '2017-04-04 05:43:10'),
(432, 'cell_personal_2', 'Cell Personal 2', 44, 14, 0, NULL, 0, 256, 0, '', 0, '2017-04-04 05:32:02', '2017-04-04 05:43:24'),
(433, 'email_ofc', 'Email Office', 44, 8, 0, NULL, 0, 256, 0, '', 0, '2017-04-04 05:33:06', '2017-04-04 05:33:06'),
(434, 'email_personal', 'Email Personal', 44, 8, 0, NULL, 0, 256, 0, '', 0, '2017-04-04 05:34:00', '2017-04-04 05:34:00'),
(435, 'tribal', 'Tribal', 44, 7, 0, NULL, 0, 0, 0, '["Yes","No"]', 0, '2017-04-04 05:37:19', '2017-04-04 05:37:19'),
(436, 'freedom_fighter', 'Freedom Fighter', 44, 7, 0, NULL, 0, 0, 0, '["Yes","No"]', 0, '2017-04-04 05:39:00', '2017-04-04 05:39:00'),
(437, 'as_short_code', 'Short Code', 61, 22, 0, NULL, 0, 10, 1, '', 0, '2017-04-04 06:32:58', '2017-04-04 06:32:58'),
(462, 'emp_id', 'RAB ID', 75, 7, 0, NULL, 0, 0, 0, '@employees_info', 0, '2017-04-08 11:37:04', '2017-04-08 11:37:04'),
(463, 'bank_acc_name', 'Account Name', 75, 22, 0, NULL, 0, 256, 1, '', 0, '2017-04-08 11:39:33', '2017-04-08 11:39:33'),
(464, 'bank_acc_no', 'Account No.', 75, 22, 0, NULL, 0, 256, 1, '', 0, '2017-04-08 11:40:11', '2017-04-08 11:40:11'),
(465, 'bank_id', 'Bank', 75, 7, 0, NULL, 0, 0, 0, '@banks', 0, '2017-04-08 11:41:03', '2017-04-08 11:41:03'),
(466, 'bank_branch', 'Branch', 75, 22, 0, NULL, 0, 256, 0, '', 0, '2017-04-08 11:42:36', '2017-04-08 11:42:36'),
(467, 'bank_branch_address', 'Branch Location', 75, 21, 0, NULL, 0, 0, 0, '', 0, '2017-04-08 11:43:20', '2017-04-08 11:43:20'),
(468, 'fax_home', 'FAX Resident', 44, 22, 0, NULL, 0, 256, 0, '', 0, '2017-04-09 04:01:30', '2017-04-09 07:21:31'),
(469, 'fax_ofc', 'FAX Office', 44, 22, 0, NULL, 0, 256, 0, '', 0, '2017-04-09 04:02:15', '2017-04-09 04:02:15'),
(470, 'pabx', 'PABX', 44, 22, 0, NULL, 0, 256, 0, '', 0, '2017-04-09 04:02:38', '2017-04-09 04:02:38'),
(488, 'desig_short_name', 'Short Name', 19, 22, 0, NULL, 0, 256, 0, '', 2, '2017-04-10 08:13:27', '2017-04-10 08:13:27'),
(511, 'academy_course_id', 'Academy Course', 44, 7, 0, NULL, 0, 0, 0, '@academy_courses', 0, '2017-04-19 11:24:26', '2017-04-19 11:24:26'),
(673, 'name', 'Name', 114, 22, 1, NULL, 0, 256, 1, '', 0, '2017-08-23 09:13:28', '2017-08-23 09:13:28'),
(675, 'name', 'Name', 116, 22, 1, NULL, 0, 256, 1, '', 1, '2017-08-23 09:33:53', '2017-08-23 09:33:53'),
(676, 'payroll_type', 'Type', 116, 7, 0, NULL, 0, 0, 1, '@payroll_types', 3, '2017-08-23 09:35:04', '2017-08-23 09:35:04'),
(677, 'salary_head', 'Salary Head', 116, 2, 0, '0', 0, 0, 0, '', 4, '2017-08-23 09:36:34', '2017-10-26 08:08:25'),
(678, 'code', 'Code', 116, 22, 0, NULL, 0, 100, 1, '', 2, '2017-09-14 09:16:25', '2017-10-26 09:52:32'),
(679, 'allowance_name', 'Name', 117, 22, 1, NULL, 0, 100, 1, '', 0, '2017-09-14 10:35:16', '2017-09-14 10:35:16'),
(680, 'payroll_head_id', 'Payroll Head', 117, 7, 0, NULL, 0, 0, 1, '@payroll_heads', 0, '2017-09-14 10:36:52', '2017-09-14 10:36:52'),
(681, 'salary_head_id', 'Salary Head', 117, 7, 0, NULL, 0, 0, 0, '@payroll_heads', 0, '2017-09-14 10:41:42', '2017-09-14 10:45:01'),
(682, 'allowance_amount', 'Amount', 117, 6, 0, NULL, 0, 11, 1, '', 0, '2017-09-14 10:48:17', '2017-09-14 10:48:17'),
(683, 'allowance_max_amount', 'Maximum Amount', 117, 6, 0, '0', 0, 11, 0, '', 0, '2017-09-14 10:49:07', '2017-09-14 11:06:55'),
(684, 'allowance_min_amount', 'Minimum Amount', 117, 6, 0, '0', 0, 11, 0, '', 0, '2017-09-14 10:49:37', '2017-09-14 11:07:06');

-- --------------------------------------------------------

--
-- Table structure for table `module_field_types`
--

CREATE TABLE IF NOT EXISTS `module_field_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `module_field_types`
--

INSERT INTO `module_field_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Address', '2017-02-18 20:34:45', '2017-02-18 20:34:45'),
(2, 'Checkbox', '2017-02-18 20:34:45', '2017-02-18 20:34:45'),
(3, 'Currency', '2017-02-18 20:34:45', '2017-02-18 20:34:45'),
(4, 'Date', '2017-02-18 20:34:45', '2017-02-18 20:34:45'),
(5, 'Datetime', '2017-02-18 20:34:45', '2017-02-18 20:34:45'),
(6, 'Decimal', '2017-02-18 20:34:45', '2017-02-18 20:34:45'),
(7, 'Dropdown', '2017-02-18 20:34:45', '2017-02-18 20:34:45'),
(8, 'Email', '2017-02-18 20:34:45', '2017-02-18 20:34:45'),
(9, 'File', '2017-02-18 20:34:45', '2017-02-18 20:34:45'),
(10, 'Float', '2017-02-18 20:34:45', '2017-02-18 20:34:45'),
(11, 'HTML', '2017-02-18 20:34:45', '2017-02-18 20:34:45'),
(12, 'Image', '2017-02-18 20:34:45', '2017-02-18 20:34:45'),
(13, 'Integer', '2017-02-18 20:34:45', '2017-02-18 20:34:45'),
(14, 'Mobile', '2017-02-18 20:34:45', '2017-02-18 20:34:45'),
(15, 'Multiselect', '2017-02-18 20:34:45', '2017-02-18 20:34:45'),
(16, 'Name', '2017-02-18 20:34:46', '2017-02-18 20:34:46'),
(17, 'Password', '2017-02-18 20:34:46', '2017-02-18 20:34:46'),
(18, 'Radio', '2017-02-18 20:34:46', '2017-02-18 20:34:46'),
(19, 'String', '2017-02-18 20:34:46', '2017-02-18 20:34:46'),
(20, 'Taginput', '2017-02-18 20:34:46', '2017-02-18 20:34:46'),
(21, 'Textarea', '2017-02-18 20:34:46', '2017-02-18 20:34:46'),
(22, 'TextField', '2017-02-18 20:34:46', '2017-02-18 20:34:46'),
(23, 'URL', '2017-02-18 20:34:46', '2017-02-18 20:34:46'),
(24, 'Files', '2017-02-18 20:34:46', '2017-02-18 20:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('akebulr@gmail.com', '39db44802e4c1be71e762d2354d9408d59b39333f03fdce27fb3550c8bb76323', '2017-03-10 23:23:38');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_allowances`
--

CREATE TABLE IF NOT EXISTS `payroll_allowances` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `allowance_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=fixed,2=percentage',
  `payroll_head_id` int(10) unsigned NOT NULL DEFAULT '1',
  `salary_head_id` int(10) unsigned DEFAULT NULL,
  `allowance_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `allowance_max_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `allowance_min_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `time_interval` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=monthly,2=daily,3=weekly,4=Quarterly',
  PRIMARY KEY (`id`),
  UNIQUE KEY `payroll_allowances_allowance_name_unique` (`allowance_name`),
  KEY `payroll_allowances_payroll_head_id_foreign` (`payroll_head_id`),
  KEY `salary_head_id` (`salary_head_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `payroll_allowances`
--

INSERT INTO `payroll_allowances` (`id`, `deleted_at`, `created_at`, `updated_at`, `allowance_name`, `type`, `payroll_head_id`, `salary_head_id`, `allowance_amount`, `allowance_max_amount`, `allowance_min_amount`, `time_interval`) VALUES
(15, NULL, '2017-10-25 22:54:17', '2017-10-25 22:54:17', 'বাড়ীভাড়া ভাতা', 2, 2, 1, 40.00, 0.00, 0.00, 1),
(16, NULL, '2017-10-25 22:57:16', '2017-10-26 04:07:10', 'চিকিৎসা ভাতা', 1, 20, NULL, 1500.00, 0.00, 0.00, 1),
(17, NULL, '2017-10-26 01:23:16', '2017-10-26 01:23:16', 'মহার্ঘ ভাতা', 1, 12, NULL, 2604.00, 0.00, 0.00, 1),
(18, NULL, '2017-10-26 01:24:04', '2017-10-26 01:24:04', 'যাতায়াত ভাতা', 1, 11, NULL, 150.00, 0.00, 0.00, 1),
(19, NULL, '2017-10-26 03:58:07', '2017-10-26 03:58:07', 'ক্ষৌর ও ধৌত ভাতা ', 1, 22, NULL, 490.00, 0.00, 0.00, 1),
(20, NULL, '2017-10-26 04:00:32', '2017-10-26 04:00:32', 'ব্যাটম্যান ভাতা', 2, 22, 1, 20.00, 0.00, 0.00, 1),
(21, NULL, '2017-10-26 04:01:28', '2017-10-26 04:01:28', 'প্রতিরক্ষা ভাতা', 2, 22, 1, 10.00, 0.00, 0.00, 1),
(22, NULL, '2017-10-26 04:02:20', '2017-10-26 04:02:20', 'দক্ষতা ভাতা', 2, 22, 1, 15.00, 0.00, 0.00, 1),
(23, NULL, '2017-10-26 04:02:44', '2017-10-26 04:02:44', 'সুআচরণ ভাতা', 2, 22, 1, 5.00, 0.00, 0.00, 1),
(24, NULL, '2017-10-26 04:05:02', '2017-10-26 04:05:02', 'র‍্যাব ভাতা', 2, 22, 1, 25.00, 0.00, 0.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_deductions`
--

CREATE TABLE IF NOT EXISTS `payroll_deductions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deduction_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=fixed,2=percentage',
  `payroll_head_id` int(10) unsigned NOT NULL DEFAULT '1',
  `salary_head_id` int(10) unsigned DEFAULT NULL COMMENT 'allowance_id,0=basic',
  `deduction_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `deduction_max_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `deduction_min_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `time_interval` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=monthly,2=daily,3=weekly,4=Quarterly',
  PRIMARY KEY (`id`),
  UNIQUE KEY `payroll_deductions_deduction_name_unique` (`deduction_name`),
  KEY `payroll_deductions_payroll_head_id_foreign` (`payroll_head_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `payroll_deductions`
--

INSERT INTO `payroll_deductions` (`id`, `deleted_at`, `created_at`, `updated_at`, `deduction_name`, `type`, `payroll_head_id`, `salary_head_id`, `deduction_amount`, `deduction_max_amount`, `deduction_min_amount`, `time_interval`) VALUES
(1, '2017-11-06 03:46:31', '2017-10-26 04:33:41', '2017-10-26 04:33:41', 'সাধারণ ভবিষ্য তহবিল', 1, 19, NULL, 500.00, 0.00, 0.00, 1),
(2, NULL, '2017-10-26 04:48:31', '2017-11-01 02:28:35', 'বাড়ীভাড়া', 2, 23, 0, 40.00, 0.00, 0.00, 1),
(3, NULL, '2017-10-26 04:50:30', '2017-10-26 04:50:30', 'গ্যাস', 1, 6, NULL, 950.00, 0.00, 0.00, 1),
(4, NULL, '2017-10-26 04:51:02', '2017-10-26 04:51:02', 'পানি ও পয়ঃপ্রনালী', 1, 5, NULL, 500.00, 0.00, 0.00, 1),
(5, NULL, '2017-11-01 03:30:29', '2017-11-01 03:31:57', 'মোটর সাইকেলের  অগ্রিমের কিস্তি পরিশোধ', 2, 7, 15, 10.00, 0.00, 0.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_heads`
--

CREATE TABLE IF NOT EXISTS `payroll_heads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `payroll_type` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '1=earning,2=deduction,3=Taxation,4=festival earning',
  `salary_head` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=salary head,0=not salary head',
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `payroll_heads_payroll_type_foreign` (`payroll_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `payroll_heads`
--

INSERT INTO `payroll_heads` (`id`, `deleted_at`, `created_at`, `updated_at`, `name`, `payroll_type`, `salary_head`, `code`) VALUES
(1, NULL, '2017-08-23 03:47:57', '2017-10-26 04:52:23', 'মূল বেতন', 1, 1, '৪৬০১'),
(2, NULL, '2017-08-23 03:48:20', '2017-10-26 02:45:10', 'বাড়ীভাড়া  ভাতা', 1, 1, '৪৭০৫'),
(3, NULL, '2017-08-23 03:48:46', '2017-10-26 04:13:54', 'মোটর গাড়ীর  অগ্রিমের কিস্তি পরিশোধ', 2, 0, '১-০৯৬৫-০০০১-৩৯১১'),
(4, NULL, '2017-08-23 03:49:05', '2017-10-26 04:13:03', 'গৃহ নির্মাণ অগ্রিমের কিস্তি পরিশোধ', 2, 0, '১-০৯৬৫-০০০১-৩৯০১'),
(5, NULL, '2017-08-23 03:49:24', '2017-10-26 02:58:47', 'পানি ও পয়ঃপ্রনালী ', 2, 0, '১-৩২৩৭-০০১-২১২৩'),
(6, NULL, '2017-08-23 03:51:39', '2017-10-26 02:58:19', 'গ্যাস', 2, 0, '১-৩২৩৭-০০১-২১১৫'),
(7, NULL, '2017-08-23 03:52:26', '2017-10-26 04:15:05', 'মোটর সাইকেলের  অগ্রিমের কিস্তি পরিশোধ', 2, 0, '১-০৯৬৫-০০০১-৩৯২১'),
(8, NULL, '2017-09-14 03:18:33', '2017-10-26 04:15:43', 'বাই সাইকেলের  অগ্রিমের কিস্তি পরিশোধ', 2, 0, '১-০৯৬৫-০০০১-৩৯৩১'),
(9, NULL, '2017-09-20 03:24:34', '2017-10-26 04:16:28', 'করমচারিদেরকে প্রদত্ত ঋণের সুদ পরিশোধ', 2, 0, '১-০৯৬৫-০০০১-১৬৩১'),
(10, NULL, '2017-09-20 03:25:12', '2017-10-26 04:16:56', 'জরিমানা ও দণ্ড ', 2, 0, '১-২২১১-০০০০-১৯০১'),
(11, NULL, '2017-10-25 23:08:22', '2017-10-26 04:12:06', 'যাতায়াত  ভাতা', 1, 0, '৪৭৬৫'),
(12, NULL, '2017-10-26 01:21:55', '2017-10-26 02:44:48', 'মহার্ঘ ভাতা', 1, 0, '৪৭০১'),
(13, NULL, '2017-10-26 01:32:31', '2017-10-26 04:11:34', 'পৌরকর কর্তন', 2, 0, '১-৩২৩৭-০০০০-২১২৭'),
(14, NULL, '2017-10-26 01:33:46', '2017-10-26 04:11:01', 'অতিরিক্ত গৃহীত কর্তন', 2, 0, '১-২২১১-০০০০-২৬৭১'),
(15, NULL, '2017-10-26 01:34:21', '2017-10-26 02:47:22', 'শিক্ষা ভাতা', 1, 0, '৪৭৭৩'),
(16, NULL, '2017-10-26 01:34:49', '2017-10-26 04:10:12', 'ডাক জীবন বীমা কিস্তি', 2, 0, '৬-৫৪৩১-০০০০-৮০৪১'),
(17, NULL, '2017-10-26 02:12:47', '2017-10-26 04:09:33', 'সরকারি কর্মচারীগণের গোষ্ঠী বীমা', 2, 0, '৬-০৭৭১-০০০১-৮২৪৬'),
(18, NULL, '2017-10-26 02:21:32', '2017-10-26 04:09:02', 'সরকারি কর্মচারীগণের কল্যাণ তহবিল', 2, 0, '৬-০৭৭১-০০০১-৮২৪১'),
(19, NULL, '2017-10-26 02:22:09', '2017-10-26 04:08:30', 'সাধারণ ভবিষ্যৎ তহবিল', 2, 0, '৬-০৯৩৭-০০০০-৮১০১'),
(20, NULL, '2017-10-26 02:46:26', '2017-10-26 02:46:26', 'চিকিৎসা ভাতা', 1, 0, '৪৭১৭'),
(21, NULL, '2017-10-26 02:47:05', '2017-10-26 02:47:05', 'টিফিন ভাতা', 1, 0, '৪৭৫৫'),
(22, NULL, '2017-10-26 02:48:33', '2017-10-26 03:08:50', 'অন্যান্য ভাতা', 1, 0, '৪৭৯৫'),
(23, NULL, '2017-10-26 02:56:46', '2017-10-26 02:56:46', 'বাড়ীভাড়া', 2, 0, '১-৩২৩৭-০০১২১১১');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_hrm`
--

CREATE TABLE IF NOT EXISTS `payroll_hrm` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `pay_scale_id` int(10) unsigned NOT NULL,
  `basic_salary` decimal(10,2) NOT NULL,
  `effective_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `payroll_hrm_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=edit disable,1=edit enable',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `emp_id` (`emp_id`),
  KEY `pay_scale_id` (`pay_scale_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `payroll_hrm`
--

INSERT INTO `payroll_hrm` (`id`, `emp_id`, `pay_scale_id`, `basic_salary`, `effective_date`, `end_date`, `payroll_hrm_status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10151, 1, 22000.00, '2017-10-01', NULL, 1, 1, 1, '2017-10-29 22:27:32', '2017-10-29 22:28:29', NULL),
(2, 1, 2, 35500.00, '2017-10-15', NULL, 1, 1, 1, '2017-10-29 22:32:01', '2017-10-30 04:21:58', NULL),
(3, 10143, 5, 16000.00, '2017-08-10', NULL, 1, 1, 1, '2017-10-29 22:37:34', '2017-10-29 22:39:02', NULL),
(4, 1, 1, 22000.00, '2017-03-03', '2017-10-14', 0, 1, NULL, '2017-10-31 00:45:45', '2017-10-31 00:45:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_hrm_details`
--

CREATE TABLE IF NOT EXISTS `payroll_hrm_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payroll_hrm_id` int(10) unsigned NOT NULL,
  `payroll_allowance_id` int(10) unsigned DEFAULT NULL,
  `payroll_deduction_id` int(10) unsigned DEFAULT NULL,
  `payroll_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=allowance,2=deduction',
  `effective_from_date` date DEFAULT NULL,
  `effective_to_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active,2=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payroll_hrm_id` (`payroll_hrm_id`),
  KEY `payroll_allowance_id` (`payroll_allowance_id`),
  KEY `payroll_deduction_id` (`payroll_deduction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `payroll_hrm_details`
--

INSERT INTO `payroll_hrm_details` (`id`, `payroll_hrm_id`, `payroll_allowance_id`, `payroll_deduction_id`, `payroll_type`, `effective_from_date`, `effective_to_date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 17, NULL, 1, NULL, NULL, 1, '2017-10-29 22:27:32', '2017-10-29 22:27:32', NULL),
(2, 1, 15, NULL, 1, NULL, NULL, 1, '2017-10-29 22:27:32', '2017-10-29 22:27:32', NULL),
(3, 1, 16, NULL, 1, NULL, NULL, 1, '2017-10-29 22:27:32', '2017-10-29 22:27:32', NULL),
(4, 1, 23, NULL, 1, NULL, NULL, 1, '2017-10-29 22:27:32', '2017-10-29 22:27:32', NULL),
(5, 1, 19, NULL, 1, NULL, NULL, 1, '2017-10-29 22:27:32', '2017-10-29 22:27:32', NULL),
(6, 1, 24, NULL, 1, NULL, NULL, 1, '2017-10-29 22:27:32', '2017-10-29 22:27:32', NULL),
(7, 1, NULL, 3, 2, NULL, NULL, 1, '2017-10-29 22:28:29', '2017-10-29 22:28:29', NULL),
(8, 1, NULL, 4, 2, NULL, NULL, 1, '2017-10-29 22:28:29', '2017-10-29 22:28:29', NULL),
(9, 2, 15, NULL, 1, NULL, NULL, 1, '2017-10-29 22:32:01', '2017-10-29 22:32:01', NULL),
(10, 2, 16, NULL, 1, NULL, NULL, 1, '2017-10-29 22:32:01', '2017-10-29 22:32:01', NULL),
(11, 2, 19, NULL, 1, NULL, NULL, 1, '2017-10-29 22:32:01', '2017-10-29 22:32:01', NULL),
(12, 2, 18, NULL, 1, NULL, NULL, 1, '2017-10-29 22:32:01', '2017-10-29 22:32:01', NULL),
(13, 2, 17, NULL, 1, NULL, NULL, 1, '2017-10-29 22:32:01', '2017-10-29 22:32:01', NULL),
(14, 2, 20, NULL, 1, NULL, NULL, 1, '2017-10-29 22:32:01', '2017-10-29 22:32:01', NULL),
(15, 2, 22, NULL, 1, NULL, NULL, 1, '2017-10-29 22:32:01', '2017-10-29 22:32:01', NULL),
(16, 2, 24, NULL, 1, NULL, NULL, 1, '2017-10-29 22:32:01', '2017-10-29 22:32:01', NULL),
(17, 2, NULL, 3, 2, '2017-11-04', '2017-11-10', 1, '2017-10-29 22:32:01', '2017-10-30 04:21:59', NULL),
(18, 3, 16, NULL, 1, '2017-10-10', '2017-10-15', 1, '2017-10-29 22:37:34', '2017-10-29 22:37:34', NULL),
(19, 3, 17, NULL, 1, NULL, NULL, 1, '2017-10-29 22:37:34', '2017-10-29 22:37:34', NULL),
(20, 3, 18, NULL, 1, '2017-10-17', '2017-10-20', 1, '2017-10-29 22:37:34', '2017-10-29 22:37:34', NULL),
(21, 3, 19, NULL, 1, NULL, NULL, 1, '2017-10-29 22:37:34', '2017-10-29 22:37:34', NULL),
(22, 3, 20, NULL, 1, NULL, NULL, 1, '2017-10-29 22:37:34', '2017-10-29 22:37:34', NULL),
(23, 3, 22, NULL, 1, NULL, NULL, 1, '2017-10-29 22:37:34', '2017-10-29 22:37:34', NULL),
(24, 3, NULL, 1, 2, NULL, NULL, 1, '2017-10-29 22:37:34', '2017-10-29 22:37:34', NULL),
(25, 3, NULL, 2, 2, '2017-11-01', '2017-11-20', 1, '2017-10-29 22:37:34', '2017-11-03 23:57:55', '2017-11-03 23:57:55'),
(26, 3, 15, NULL, 1, NULL, NULL, 1, '2017-10-30 23:54:42', '2017-10-30 23:54:42', NULL),
(27, 4, 15, NULL, 1, NULL, NULL, 1, '2017-10-31 00:45:45', '2017-10-31 00:45:45', NULL),
(28, 4, 17, NULL, 1, NULL, NULL, 1, '2017-10-31 00:45:45', '2017-10-31 00:45:45', NULL),
(29, 4, 21, NULL, 1, NULL, NULL, 1, '2017-10-31 00:45:45', '2017-10-31 00:45:45', NULL),
(30, 4, NULL, 3, 2, NULL, NULL, 1, '2017-10-31 00:45:45', '2017-10-31 00:45:45', NULL),
(31, 4, NULL, 4, 2, NULL, NULL, 1, '2017-10-31 00:45:45', '2017-10-31 00:45:45', NULL),
(32, 3, NULL, 2, 2, '2017-11-14', '2017-11-20', 1, '2017-11-04 00:27:15', '2017-11-04 00:27:15', NULL),
(33, 2, NULL, 4, 2, NULL, NULL, 1, '2017-11-04 03:00:11', '2017-11-04 03:00:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_pay_scales`
--

CREATE TABLE IF NOT EXISTS `payroll_pay_scales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pay_scale_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `payroll_head_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'Basic',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payroll_head_id` (`payroll_head_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `payroll_pay_scales`
--

INSERT INTO `payroll_pay_scales` (`id`, `pay_scale_name`, `payroll_head_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '22000-53060', 1, '2017-10-29 22:15:46', '2017-10-29 22:19:08', NULL),
(2, '35500-67000', 1, '2017-10-29 22:17:34', '2017-10-29 22:17:34', NULL),
(3, '43000-69850', 1, '2017-10-29 22:18:27', '2017-10-29 22:18:27', NULL),
(4, '56500-74400', 1, '2017-10-29 22:19:45', '2017-10-29 22:19:45', NULL),
(5, '16000-38640', 1, '2017-10-29 22:20:10', '2017-10-29 22:20:10', NULL),
(6, '12500-30230', 1, '2017-10-29 22:20:48', '2017-10-29 22:20:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_pay_scale_details`
--

CREATE TABLE IF NOT EXISTS `payroll_pay_scale_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pay_scale_id` int(10) unsigned NOT NULL,
  `pay_scale_year` tinyint(4) NOT NULL COMMENT '1=1st,2=2nd,3=3rd,4=4th....',
  `pay_scale_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pay_scale_id` (`pay_scale_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `payroll_pay_scale_details`
--

INSERT INTO `payroll_pay_scale_details` (`id`, `pay_scale_id`, `pay_scale_year`, `pay_scale_amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 22000.00, '2017-10-29 22:15:46', '2017-10-29 22:19:08', '2017-10-29 22:19:08'),
(2, 2, 1, 35500.00, '2017-10-29 22:17:34', '2017-10-29 22:17:34', NULL),
(3, 3, 1, 43000.00, '2017-10-29 22:18:27', '2017-10-29 22:18:27', NULL),
(4, 1, 1, 22000.00, '2017-10-29 22:19:08', '2017-10-29 22:19:08', NULL),
(5, 4, 1, 56500.00, '2017-10-29 22:19:45', '2017-10-29 22:19:45', NULL),
(6, 5, 1, 16000.00, '2017-10-29 22:20:10', '2017-10-29 22:20:10', NULL),
(7, 6, 1, 12500.00, '2017-10-29 22:20:48', '2017-10-29 22:20:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_policy`
--

CREATE TABLE IF NOT EXISTS `payroll_policy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `policy_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `policy_type` tinyint(4) NOT NULL COMMENT '1=salary policy',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `policy_name` (`policy_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `payroll_policy`
--

INSERT INTO `payroll_policy` (`id`, `policy_name`, `policy_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, '10th grade', 1, '2017-09-13 05:06:17', '2017-09-13 05:06:17', NULL),
(14, '9th', 1, '2017-09-13 05:13:56', '2017-09-13 05:29:09', NULL),
(15, 'asdfasf', 1, '2017-09-13 05:56:32', '2017-09-13 05:56:32', NULL),
(16, '9700 dhaka city', 1, '2017-09-14 00:32:24', '2017-09-14 00:32:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_policy_details`
--

CREATE TABLE IF NOT EXISTS `payroll_policy_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `policy_id` int(10) unsigned NOT NULL,
  `payroll_head` int(10) unsigned NOT NULL,
  `salary_head` int(10) unsigned DEFAULT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1=Fixed,2=Percentage',
  `amount` decimal(10,2) DEFAULT NULL,
  `salary_amount` decimal(10,2) NOT NULL COMMENT 'update by process',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `policy_id` (`policy_id`),
  KEY `payroll_head` (`payroll_head`),
  KEY `salary_head` (`salary_head`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=53 ;

--
-- Dumping data for table `payroll_policy_details`
--

INSERT INTO `payroll_policy_details` (`id`, `policy_id`, `payroll_head`, `salary_head`, `type`, `amount`, `salary_amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 13, 2, 1, 2, 10.00, 2000.00, '2017-09-13 05:06:17', '2017-09-13 05:11:09', '2017-09-13 05:11:09'),
(2, 13, 1, NULL, 1, 20000.00, 20000.00, '2017-09-13 05:06:17', '2017-09-13 05:11:10', '2017-09-13 05:11:10'),
(3, 13, 2, 1, 2, 10.00, 2000.00, '2017-09-13 05:11:10', '2017-09-13 05:11:10', NULL),
(4, 13, 1, NULL, 1, 20000.00, 20000.00, '2017-09-13 05:11:10', '2017-09-13 05:11:10', NULL),
(5, 13, 3, 2, 2, 5.00, 100.00, '2017-09-13 05:11:10', '2017-09-13 05:11:10', NULL),
(6, 14, 1, 1, 2, 15000.00, 0.00, '2017-09-13 05:13:56', '2017-09-13 05:14:26', '2017-09-13 05:14:26'),
(7, 14, 2, 3, 2, 10.00, 0.00, '2017-09-13 05:13:56', '2017-09-13 05:14:26', '2017-09-13 05:14:26'),
(8, 14, 3, 2, 2, 5.00, 0.00, '2017-09-13 05:13:56', '2017-09-13 05:14:26', '2017-09-13 05:14:26'),
(9, 14, 1, NULL, 1, 15000.00, 15000.00, '2017-09-13 05:14:26', '2017-09-13 05:15:19', '2017-09-13 05:15:19'),
(10, 14, 2, 3, 2, 10.00, 0.00, '2017-09-13 05:14:27', '2017-09-13 05:15:19', '2017-09-13 05:15:19'),
(11, 14, 3, 2, 2, 5.00, 0.00, '2017-09-13 05:14:27', '2017-09-13 05:15:19', '2017-09-13 05:15:19'),
(12, 14, 1, NULL, 1, 15000.00, 15000.00, '2017-09-13 05:15:19', '2017-09-13 05:15:36', '2017-09-13 05:15:36'),
(13, 14, 2, 3, 2, 10.00, 0.00, '2017-09-13 05:15:19', '2017-09-13 05:15:36', '2017-09-13 05:15:36'),
(14, 14, 3, 2, 2, 5.00, 0.00, '2017-09-13 05:15:19', '2017-09-13 05:15:36', '2017-09-13 05:15:36'),
(15, 14, 5, NULL, 1, 500.00, 500.00, '2017-09-13 05:15:19', '2017-09-13 05:15:36', '2017-09-13 05:15:36'),
(16, 14, 1, NULL, 1, 15000.00, 15000.00, '2017-09-13 05:15:36', '2017-09-13 05:15:51', '2017-09-13 05:15:51'),
(17, 14, 2, 2, 2, 10.00, 0.00, '2017-09-13 05:15:36', '2017-09-13 05:15:51', '2017-09-13 05:15:51'),
(18, 14, 3, 2, 2, 5.00, 0.00, '2017-09-13 05:15:36', '2017-09-13 05:15:51', '2017-09-13 05:15:51'),
(19, 14, 5, NULL, 1, 500.00, 500.00, '2017-09-13 05:15:36', '2017-09-13 05:15:51', '2017-09-13 05:15:51'),
(20, 14, 1, NULL, 1, 15000.00, 15000.00, '2017-09-13 05:15:51', '2017-09-13 05:18:23', '2017-09-13 05:18:23'),
(21, 14, 2, 1, 2, 10.00, 1500.00, '2017-09-13 05:15:51', '2017-09-13 05:18:23', '2017-09-13 05:18:23'),
(22, 14, 3, 2, 2, 5.00, 75.00, '2017-09-13 05:15:52', '2017-09-13 05:18:23', '2017-09-13 05:18:23'),
(23, 14, 5, NULL, 1, 500.00, 500.00, '2017-09-13 05:15:52', '2017-09-13 05:18:23', '2017-09-13 05:18:23'),
(24, 14, 1, NULL, 1, 15000.00, 15000.00, '2017-09-13 05:18:23', '2017-09-13 05:29:09', '2017-09-13 05:29:09'),
(25, 14, 2, 3, 2, 10.00, 75.00, '2017-09-13 05:18:23', '2017-09-13 05:29:09', '2017-09-13 05:29:09'),
(26, 14, 3, 1, 2, 5.00, 750.00, '2017-09-13 05:18:23', '2017-09-13 05:29:09', '2017-09-13 05:29:09'),
(27, 14, 5, NULL, 1, 500.00, 500.00, '2017-09-13 05:18:24', '2017-09-13 05:29:09', '2017-09-13 05:29:09'),
(28, 14, 1, NULL, 1, 15000.00, 15000.00, '2017-09-13 05:29:09', '2017-09-13 05:53:40', '2017-09-13 05:53:40'),
(29, 14, 2, 3, 2, 10.00, 75.00, '2017-09-13 05:29:09', '2017-09-13 05:53:40', '2017-09-13 05:53:40'),
(30, 14, 3, 1, 2, 5.00, 750.00, '2017-09-13 05:29:09', '2017-09-13 05:53:40', '2017-09-13 05:53:40'),
(31, 14, 5, NULL, 1, 500.00, 500.00, '2017-09-13 05:29:09', '2017-09-13 05:53:40', '2017-09-13 05:53:40'),
(32, 14, 1, NULL, 1, 15000.00, 15000.00, '2017-09-13 05:53:40', '2017-09-13 05:54:14', '2017-09-13 05:54:14'),
(33, 14, 2, 3, 2, 10.00, 75.00, '2017-09-13 05:53:40', '2017-09-13 05:54:14', '2017-09-13 05:54:14'),
(34, 14, 3, 1, 2, 5.00, 750.00, '2017-09-13 05:53:40', '2017-09-13 05:54:14', '2017-09-13 05:54:14'),
(35, 14, 5, NULL, 1, 500.00, 500.00, '2017-09-13 05:53:40', '2017-09-13 05:54:15', '2017-09-13 05:54:15'),
(36, 14, 4, 2, 2, 2.00, 0.00, '2017-09-13 05:53:40', '2017-09-13 05:54:15', '2017-09-13 05:54:15'),
(37, 14, 1, NULL, 1, 15000.00, 15000.00, '2017-09-13 05:54:15', '2017-09-13 05:55:46', '2017-09-13 05:55:46'),
(38, 14, 2, 3, 2, 10.00, 75.00, '2017-09-13 05:54:15', '2017-09-13 05:55:46', '2017-09-13 05:55:46'),
(39, 14, 3, 1, 2, 5.00, 750.00, '2017-09-13 05:54:15', '2017-09-13 05:55:46', '2017-09-13 05:55:46'),
(40, 14, 5, NULL, 1, 500.00, 500.00, '2017-09-13 05:54:15', '2017-09-13 05:55:46', '2017-09-13 05:55:46'),
(41, 14, 4, 1, 2, 2.00, 300.00, '2017-09-13 05:54:15', '2017-09-13 05:55:46', '2017-09-13 05:55:46'),
(42, 14, 1, NULL, 1, 15000.00, 15000.00, '2017-09-13 05:55:46', '2017-09-13 05:55:47', NULL),
(43, 14, 2, 3, 2, 10.00, 75.00, '2017-09-13 05:55:46', '2017-09-13 05:55:47', NULL),
(44, 14, 3, 1, 2, 5.00, 750.00, '2017-09-13 05:55:46', '2017-09-13 05:55:47', NULL),
(45, 14, 5, NULL, 1, 500.00, 500.00, '2017-09-13 05:55:46', '2017-09-13 05:55:47', NULL),
(46, 14, 4, 3, 2, 2.00, 15.00, '2017-09-13 05:55:46', '2017-09-13 05:55:47', NULL),
(47, 15, 1, NULL, 1, 50000.00, 50000.00, '2017-09-13 05:56:32', '2017-09-13 05:56:32', NULL),
(48, 15, 2, 1, 2, 40.00, 20000.00, '2017-09-13 05:56:32', '2017-09-13 05:56:32', NULL),
(49, 16, 1, NULL, 1, 97000.00, 97000.00, '2017-09-14 00:32:24', '2017-09-14 00:32:50', '2017-09-14 00:32:50'),
(50, 16, 2, 1, 2, 60.00, 58200.00, '2017-09-14 00:32:24', '2017-09-14 00:32:50', '2017-09-14 00:32:50'),
(51, 16, 1, NULL, 1, 9700.00, 9700.00, '2017-09-14 00:32:50', '2017-09-14 00:32:50', NULL),
(52, 16, 2, 1, 2, 60.00, 5820.00, '2017-09-14 00:32:50', '2017-09-14 00:32:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_salary_process`
--

CREATE TABLE IF NOT EXISTS `payroll_salary_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `posting_rec_id` int(11) NOT NULL,
  `salary_date` date NOT NULL,
  `salary_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posting_rec_id` (`posting_rec_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `payroll_salary_process`
--

INSERT INTO `payroll_salary_process` (`id`, `posting_rec_id`, `salary_date`, `salary_amount`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '2017-10-01', 56472.71, 1, NULL, '2017-11-04 02:36:15', '2017-11-04 03:02:44', NULL),
(2, 13, '2017-10-01', 40544.00, 1, NULL, '2017-11-04 02:36:16', '2017-11-04 02:36:17', NULL),
(3, 19, '2017-10-01', 30903.67, 1, NULL, '2017-11-04 02:36:17', '2017-11-04 02:36:17', NULL),
(4, 1, '2017-11-01', 75022.33, 1, NULL, '2017-11-04 03:19:36', '2017-11-04 03:19:37', NULL),
(5, 19, '2017-11-01', 29600.67, 1, NULL, '2017-11-20 02:48:14', '2017-11-20 02:48:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_salary_process_details`
--

CREATE TABLE IF NOT EXISTS `payroll_salary_process_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `salary_process_id` int(10) unsigned NOT NULL,
  `payroll_hrm_id` int(10) unsigned NOT NULL,
  `pay_scale_id` int(10) unsigned DEFAULT NULL,
  `allowance_id` int(10) unsigned DEFAULT NULL,
  `deduction_id` int(10) unsigned DEFAULT NULL,
  `process_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=allowance,2=deduction,3=pay scale',
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `basic_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `salary_process_id` (`salary_process_id`),
  KEY `pay_scale_id` (`pay_scale_id`),
  KEY `allowance_id` (`allowance_id`),
  KEY `dedeuction_id` (`deduction_id`),
  KEY `payroll_hrm_id` (`payroll_hrm_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=54 ;

--
-- Dumping data for table `payroll_salary_process_details`
--

INSERT INTO `payroll_salary_process_details` (`id`, `salary_process_id`, `payroll_hrm_id`, `pay_scale_id`, `allowance_id`, `deduction_id`, `process_type`, `from_date`, `to_date`, `amount`, `basic_amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 2, NULL, NULL, 3, '2017-10-15', '2017-10-31', 19467.74, 35500.00, '2017-11-04 02:36:15', '2017-11-04 03:11:38', NULL),
(2, 1, 2, NULL, NULL, 3, 2, '2017-11-04', '2017-11-10', 214.52, 0.00, '2017-11-04 02:36:15', '2017-11-04 02:47:47', '2017-11-04 02:47:47'),
(3, 1, 2, NULL, 15, NULL, 1, '2017-10-15', '2017-10-31', 7787.10, 0.00, '2017-11-04 02:36:15', '2017-11-04 03:11:38', NULL),
(4, 1, 2, NULL, 18, NULL, 1, '2017-10-15', '2017-10-31', 82.26, 0.00, '2017-11-04 02:36:15', '2017-11-04 03:11:38', NULL),
(5, 1, 2, NULL, 17, NULL, 1, '2017-10-15', '2017-10-31', 1428.00, 0.00, '2017-11-04 02:36:15', '2017-11-04 03:11:38', NULL),
(6, 1, 2, NULL, 16, NULL, 1, '2017-10-15', '2017-10-31', 822.58, 0.00, '2017-11-04 02:36:15', '2017-11-04 03:11:39', NULL),
(7, 1, 2, NULL, 24, NULL, 1, '2017-10-15', '2017-10-31', 4866.94, 0.00, '2017-11-04 02:36:15', '2017-11-04 03:11:39', NULL),
(8, 1, 2, NULL, 20, NULL, 1, '2017-10-15', '2017-10-31', 3893.55, 0.00, '2017-11-04 02:36:16', '2017-11-04 03:11:39', NULL),
(9, 1, 2, NULL, 19, NULL, 1, '2017-10-15', '2017-10-31', 268.71, 0.00, '2017-11-04 02:36:16', '2017-11-04 03:11:39', NULL),
(10, 1, 2, NULL, 22, NULL, 1, '2017-10-15', '2017-10-31', 2920.16, 0.00, '2017-11-04 02:36:16', '2017-11-04 03:11:39', NULL),
(11, 1, 4, 1, NULL, NULL, 3, '2017-10-01', '2017-10-14', 9935.48, 22000.00, '2017-11-04 02:36:16', '2017-11-04 03:11:39', NULL),
(12, 1, 4, NULL, NULL, 4, 2, '2017-10-01', '2017-10-14', 225.81, 0.00, '2017-11-04 02:36:16', '2017-11-04 03:11:39', NULL),
(13, 1, 4, NULL, NULL, 3, 2, '2017-10-01', '2017-10-14', 429.03, 0.00, '2017-11-04 02:36:16', '2017-11-04 03:11:39', NULL),
(14, 1, 4, NULL, 15, NULL, 1, '2017-10-01', '2017-10-14', 3974.19, 0.00, '2017-11-04 02:36:16', '2017-11-04 03:11:39', NULL),
(15, 1, 4, NULL, 17, NULL, 1, '2017-10-01', '2017-10-14', 1176.00, 0.00, '2017-11-04 02:36:16', '2017-11-04 03:11:39', NULL),
(16, 1, 4, NULL, 21, NULL, 1, '2017-10-01', '2017-10-14', 993.55, 0.00, '2017-11-04 02:36:16', '2017-11-04 03:11:39', NULL),
(17, 2, 1, 1, NULL, NULL, 3, '2017-10-01', '2017-10-31', 22000.00, 22000.00, '2017-11-04 02:36:16', '2017-11-04 02:36:16', NULL),
(18, 2, 1, NULL, NULL, 4, 2, '2017-10-01', '2017-10-31', 500.00, 0.00, '2017-11-04 02:36:16', '2017-11-04 02:36:16', NULL),
(19, 2, 1, NULL, NULL, 3, 2, '2017-10-01', '2017-10-31', 950.00, 0.00, '2017-11-04 02:36:16', '2017-11-04 02:36:16', NULL),
(20, 2, 1, NULL, 15, NULL, 1, '2017-10-01', '2017-10-31', 8800.00, 0.00, '2017-11-04 02:36:16', '2017-11-04 02:36:16', NULL),
(21, 2, 1, NULL, 17, NULL, 1, '2017-10-01', '2017-10-31', 2604.00, 0.00, '2017-11-04 02:36:16', '2017-11-04 02:36:16', NULL),
(22, 2, 1, NULL, 16, NULL, 1, '2017-10-01', '2017-10-31', 1500.00, 0.00, '2017-11-04 02:36:16', '2017-11-04 02:36:16', NULL),
(23, 2, 1, NULL, 23, NULL, 1, '2017-10-01', '2017-10-31', 1100.00, 0.00, '2017-11-04 02:36:16', '2017-11-04 02:36:16', NULL),
(24, 2, 1, NULL, 19, NULL, 1, '2017-10-01', '2017-10-31', 490.00, 0.00, '2017-11-04 02:36:17', '2017-11-04 02:36:17', NULL),
(25, 2, 1, NULL, 24, NULL, 1, '2017-10-01', '2017-10-31', 5500.00, 0.00, '2017-11-04 02:36:17', '2017-11-04 02:36:17', NULL),
(26, 3, 3, 5, NULL, NULL, 3, '2017-10-01', '2017-10-31', 16000.00, 16000.00, '2017-11-04 02:36:17', '2017-11-04 02:36:17', NULL),
(27, 3, 3, NULL, NULL, 1, 2, '2017-10-01', '2017-10-31', 500.00, 0.00, '2017-11-04 02:36:17', '2017-11-04 02:36:17', NULL),
(28, 3, 3, NULL, 15, NULL, 1, '2017-10-01', '2017-10-31', 6400.00, 0.00, '2017-11-04 02:36:17', '2017-11-04 02:36:17', NULL),
(29, 3, 3, NULL, 18, NULL, 1, '2017-10-17', '2017-10-20', 19.35, 0.00, '2017-11-04 02:36:17', '2017-11-04 02:36:17', NULL),
(30, 3, 3, NULL, 17, NULL, 1, '2017-10-01', '2017-10-31', 2604.00, 0.00, '2017-11-04 02:36:17', '2017-11-04 02:36:17', NULL),
(31, 3, 3, NULL, 16, NULL, 1, '2017-10-10', '2017-10-15', 290.32, 0.00, '2017-11-04 02:36:17', '2017-11-04 02:36:17', NULL),
(32, 3, 3, NULL, 19, NULL, 1, '2017-10-01', '2017-10-31', 490.00, 0.00, '2017-11-04 02:36:17', '2017-11-04 02:36:17', NULL),
(33, 3, 3, NULL, 20, NULL, 1, '2017-10-01', '2017-10-31', 3200.00, 0.00, '2017-11-04 02:36:17', '2017-11-04 02:36:17', NULL),
(34, 3, 3, NULL, 22, NULL, 1, '2017-10-01', '2017-10-31', 2400.00, 0.00, '2017-11-04 02:36:17', '2017-11-04 02:36:17', NULL),
(35, 1, 2, NULL, NULL, 4, 2, '2017-10-15', '2017-10-31', 274.19, 0.00, '2017-11-04 03:02:44', '2017-11-04 03:11:38', NULL),
(36, 4, 2, 2, NULL, NULL, 3, '2017-11-01', '2017-11-30', 35500.00, 35500.00, '2017-11-04 03:19:36', '2017-11-13 03:22:55', NULL),
(37, 4, 2, NULL, NULL, 4, 2, '2017-11-01', '2017-11-30', 500.00, 0.00, '2017-11-04 03:19:36', '2017-11-13 03:22:56', NULL),
(38, 4, 2, NULL, NULL, 3, 2, '2017-11-04', '2017-11-10', 221.67, 0.00, '2017-11-04 03:19:36', '2017-11-13 03:22:56', NULL),
(39, 4, 2, NULL, 15, NULL, 1, '2017-11-01', '2017-11-30', 14200.00, 0.00, '2017-11-04 03:19:36', '2017-11-13 03:22:56', NULL),
(40, 4, 2, NULL, 18, NULL, 1, '2017-11-01', '2017-11-30', 150.00, 0.00, '2017-11-04 03:19:36', '2017-11-13 03:22:56', NULL),
(41, 4, 2, NULL, 17, NULL, 1, '2017-11-01', '2017-11-30', 2604.00, 0.00, '2017-11-04 03:19:36', '2017-11-13 03:22:56', NULL),
(42, 4, 2, NULL, 16, NULL, 1, '2017-11-01', '2017-11-30', 1500.00, 0.00, '2017-11-04 03:19:36', '2017-11-13 03:22:56', NULL),
(43, 4, 2, NULL, 24, NULL, 1, '2017-11-01', '2017-11-30', 8875.00, 0.00, '2017-11-04 03:19:36', '2017-11-13 03:22:56', NULL),
(44, 4, 2, NULL, 20, NULL, 1, '2017-11-01', '2017-11-30', 7100.00, 0.00, '2017-11-04 03:19:36', '2017-11-13 03:22:56', NULL),
(45, 4, 2, NULL, 19, NULL, 1, '2017-11-01', '2017-11-30', 490.00, 0.00, '2017-11-04 03:19:36', '2017-11-13 03:22:56', NULL),
(46, 4, 2, NULL, 22, NULL, 1, '2017-11-01', '2017-11-30', 5325.00, 0.00, '2017-11-04 03:19:37', '2017-11-13 03:22:56', NULL),
(47, 5, 3, 5, NULL, NULL, 3, '2017-11-01', '2017-11-30', 16000.00, 16000.00, '2017-11-20 02:48:14', '2017-11-20 02:48:14', NULL),
(48, 5, 3, NULL, NULL, 2, 2, '2017-11-14', '2017-11-20', 1493.33, 0.00, '2017-11-20 02:48:14', '2017-11-20 02:48:14', NULL),
(49, 5, 3, NULL, 15, NULL, 1, '2017-11-01', '2017-11-30', 6400.00, 0.00, '2017-11-20 02:48:14', '2017-11-20 02:48:14', NULL),
(50, 5, 3, NULL, 17, NULL, 1, '2017-11-01', '2017-11-30', 2604.00, 0.00, '2017-11-20 02:48:14', '2017-11-20 02:48:14', NULL),
(51, 5, 3, NULL, 22, NULL, 1, '2017-11-01', '2017-11-30', 2400.00, 0.00, '2017-11-20 02:48:14', '2017-11-20 02:48:14', NULL),
(52, 5, 3, NULL, 19, NULL, 1, '2017-11-01', '2017-11-30', 490.00, 0.00, '2017-11-20 02:48:14', '2017-11-20 02:48:14', NULL),
(53, 5, 3, NULL, 20, NULL, 1, '2017-11-01', '2017-11-30', 3200.00, 0.00, '2017-11-20 02:48:14', '2017-11-20 02:48:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_types`
--

CREATE TABLE IF NOT EXISTS `payroll_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `payroll_types`
--

INSERT INTO `payroll_types` (`id`, `deleted_at`, `created_at`, `updated_at`, `name`) VALUES
(1, NULL, '2017-08-23 03:18:09', '2017-08-23 03:18:09', 'Earning'),
(2, NULL, '2017-08-23 03:18:36', '2017-08-23 03:18:36', 'Deduction'),
(3, NULL, '2017-08-23 03:22:31', '2017-08-23 03:22:31', 'Taxation'),
(4, NULL, '2017-08-23 03:22:51', '2017-08-23 03:22:51', 'Festival Earning');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `display_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN_PANEL', 'Admin Panel', 'Admin Panel Permission', NULL, '2017-02-18 20:35:04', '2017-02-18 20:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `display_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'SUPER_ADMIN', 'Super Admin', 'Full Access Role', NULL, '2017-02-18 20:35:02', '2017-02-18 20:35:02'),
(2, 'ADMIN', 'Admin', '', NULL, '2017-02-26 21:58:32', '2017-02-26 21:58:32'),
(3, 'EMPLOYEE', 'Employee', 'Employee', NULL, '2017-05-12 23:19:12', '2017-05-12 23:19:12');

-- --------------------------------------------------------

--
-- Table structure for table `role_menu`
--

CREATE TABLE IF NOT EXISTS `role_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `menu_id` int(10) unsigned NOT NULL,
  `acc_view` tinyint(1) NOT NULL,
  `acc_create` tinyint(1) NOT NULL,
  `acc_edit` tinyint(1) NOT NULL,
  `acc_delete` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_module_role_id_foreign` (`role_id`),
  KEY `role_module_module_id_foreign` (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=398 ;

--
-- Dumping data for table `role_menu`
--

INSERT INTO `role_menu` (`id`, `role_id`, `menu_id`, `acc_view`, `acc_create`, `acc_edit`, `acc_delete`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 30, 1, 1, 1, 1, '2017-03-04 12:00:00', '2017-03-06 16:23:04', NULL),
(2, 1, 33, 1, 0, 0, 0, '2017-03-04 12:00:00', '2017-03-06 16:52:35', '2017-03-06 15:54:22'),
(3, 1, 18, 1, 1, 1, 1, '2017-03-04 12:00:00', '2017-03-06 16:23:04', '2017-03-06 15:58:39'),
(4, 1, 1, 1, 1, 1, 1, NULL, '2017-03-06 16:23:04', NULL),
(5, 1, 2, 1, 1, 1, 1, NULL, '2017-03-06 16:23:04', NULL),
(6, 1, 4, 1, 1, 1, 1, '2017-03-04 12:00:00', '2017-03-06 16:23:04', NULL),
(7, 1, 29, 1, 1, 1, 1, NULL, '2017-03-06 16:23:04', NULL),
(8, 1, 35, 1, 1, 1, 1, '2017-03-05 12:00:00', '2017-03-06 18:23:13', NULL),
(9, 1, 10, 1, 0, 0, 0, NULL, '2017-03-06 17:39:01', NULL),
(11, 1, 11, 1, 1, 1, 1, NULL, '2017-03-06 16:23:04', NULL),
(12, 1, 13, 1, 1, 1, 1, NULL, '2017-03-06 16:23:04', NULL),
(26, 1, 3, 1, 1, 1, 1, '2017-03-06 16:23:04', NULL, NULL),
(27, 1, 5, 1, 1, 1, 1, '2017-03-06 16:23:04', NULL, NULL),
(28, 1, 6, 1, 1, 1, 1, '2017-03-06 16:23:04', NULL, NULL),
(29, 1, 7, 1, 1, 1, 1, '2017-03-06 16:23:04', NULL, NULL),
(30, 1, 8, 1, 1, 1, 1, '2017-03-06 16:23:04', NULL, NULL),
(31, 1, 14, 1, 1, 1, 1, '2017-03-06 16:23:04', NULL, NULL),
(32, 1, 19, 1, 1, 1, 1, '2017-03-06 16:23:04', NULL, NULL),
(33, 1, 20, 1, 1, 1, 1, '2017-03-06 16:23:04', NULL, NULL),
(34, 1, 21, 1, 1, 1, 1, '2017-03-06 16:23:04', NULL, NULL),
(35, 1, 22, 1, 1, 1, 1, '2017-03-06 16:23:04', NULL, NULL),
(36, 1, 23, 1, 1, 1, 1, '2017-03-06 16:23:04', NULL, NULL),
(37, 1, 24, 1, 1, 1, 1, '2017-03-06 16:23:04', NULL, NULL),
(38, 1, 25, 1, 1, 1, 1, '2017-03-06 16:23:04', NULL, NULL),
(39, 1, 26, 1, 1, 1, 1, '2017-03-06 16:23:04', NULL, NULL),
(40, 1, 27, 1, 1, 1, 1, '2017-03-06 16:23:04', NULL, NULL),
(41, 1, 28, 1, 1, 1, 1, '2017-03-06 16:23:04', NULL, NULL),
(42, 1, 32, 1, 0, 0, 0, '2017-03-06 16:52:35', '2017-03-06 16:58:37', '2017-03-06 16:58:37'),
(43, 1, 32, 1, 0, 0, 1, '2017-03-06 17:03:46', '2017-03-06 17:04:04', '2017-03-06 17:04:04'),
(44, 1, 32, 1, 0, 0, 0, '2017-03-06 17:04:20', '2017-04-03 06:26:21', NULL),
(46, 1, 37, 1, 0, 0, 0, '2017-03-06 20:07:17', '2017-03-06 20:07:17', NULL),
(47, 1, 51, 1, 0, 0, 0, '2017-03-06 20:09:34', '2017-03-06 20:09:34', NULL),
(48, 1, 52, 1, 1, 1, 1, '2017-03-07 15:22:31', '2017-03-07 15:22:31', NULL),
(49, 1, 53, 1, 1, 1, 1, '2017-03-07 15:56:13', '2017-03-14 23:48:02', NULL),
(50, 1, 18, 1, 1, 1, 1, '2017-03-09 06:09:44', '2017-03-09 06:09:44', NULL),
(51, 1, 54, 1, 1, 1, 0, '2017-03-11 03:33:08', '2017-03-11 03:33:08', NULL),
(52, 1, 55, 1, 1, 1, 0, '2017-03-11 03:33:08', '2017-03-11 03:33:08', NULL),
(53, 1, 56, 1, 1, 1, 1, '2017-03-11 03:33:08', '2017-05-18 00:57:21', NULL),
(54, 1, 57, 1, 1, 1, 1, '2017-03-11 03:49:11', '2017-03-11 03:49:11', NULL),
(55, 1, 58, 1, 1, 1, 1, '2017-03-11 04:49:17', '2017-03-11 04:49:17', NULL),
(56, 1, 59, 1, 1, 1, 1, '2017-03-11 06:32:52', '2017-03-11 06:32:52', NULL),
(57, 1, 60, 1, 1, 1, 1, '2017-03-12 02:52:16', '2017-03-12 02:52:16', NULL),
(58, 1, 61, 1, 1, 1, 1, '2017-03-12 03:09:06', '2017-03-12 03:09:06', NULL),
(59, 1, 62, 1, 1, 1, 1, '2017-03-12 03:13:45', '2017-03-12 03:13:45', NULL),
(60, 1, 63, 1, 1, 1, 1, '2017-03-12 03:19:54', '2017-03-12 03:19:54', NULL),
(61, 1, 64, 1, 1, 1, 0, '2017-03-12 04:13:47', '2017-03-12 04:13:47', NULL),
(62, 1, 65, 1, 1, 1, 1, '2017-03-12 04:37:06', '2017-03-12 04:37:06', NULL),
(63, 1, 66, 1, 1, 1, 1, '2017-03-12 04:59:49', '2017-03-12 04:59:49', NULL),
(64, 1, 67, 1, 1, 1, 1, '2017-03-12 05:05:32', '2017-03-12 05:05:32', NULL),
(65, 1, 68, 1, 1, 1, 1, '2017-03-12 05:17:34', '2017-03-12 05:17:34', NULL),
(66, 1, 69, 1, 1, 1, 1, '2017-03-12 05:51:10', '2017-03-12 05:51:10', NULL),
(67, 1, 70, 1, 0, 0, 0, '2017-03-12 06:14:39', '2017-03-12 06:14:39', NULL),
(68, 1, 71, 1, 1, 1, 1, '2017-03-14 05:47:33', '2017-03-14 05:47:33', NULL),
(69, 1, 72, 1, 1, 1, 1, '2017-03-14 05:49:48', '2017-09-27 23:11:44', '2017-09-27 23:11:44'),
(70, 1, 73, 1, 1, 1, 1, '2017-03-14 06:09:40', '2017-03-14 06:09:40', NULL),
(72, 1, 75, 1, 1, 1, 1, '2017-03-16 00:02:20', '2017-03-16 00:02:32', NULL),
(73, 1, 76, 1, 1, 0, 0, '2017-03-19 21:59:15', '2017-03-19 21:59:43', NULL),
(74, 1, 81, 1, 1, 1, 1, '2017-03-21 03:44:56', '2017-03-21 03:44:56', NULL),
(77, 1, 88, 1, 1, 1, 1, '2017-03-22 22:16:13', '2017-03-22 22:16:13', NULL),
(79, 1, 90, 1, 1, 1, 1, '2017-03-23 00:23:54', '2017-03-23 00:23:54', NULL),
(80, 1, 91, 1, 1, 1, 1, '2017-03-29 02:54:46', '2017-03-29 02:54:46', NULL),
(81, 1, 92, 1, 1, 1, 1, '2017-03-30 04:11:13', '2017-03-30 04:11:13', NULL),
(82, 1, 93, 1, 1, 1, 1, '2017-04-01 00:41:15', '2017-04-01 00:41:15', NULL),
(83, 1, 94, 1, 1, 1, 1, '2017-04-01 03:07:03', '2017-04-01 03:07:03', NULL),
(84, 1, 95, 1, 1, 1, 1, '2017-04-01 03:40:15', '2017-04-01 03:40:15', NULL),
(85, 1, 96, 1, 1, 1, 1, '2017-04-01 03:56:35', '2017-04-01 03:56:35', NULL),
(86, 1, 97, 1, 1, 1, 1, '2017-04-01 04:32:08', '2017-04-01 04:32:08', NULL),
(87, 1, 98, 1, 1, 1, 1, '2017-04-01 04:53:09', '2017-04-01 04:53:09', NULL),
(88, 1, 99, 1, 1, 1, 1, '2017-04-01 05:20:26', '2017-04-01 05:20:26', NULL),
(89, 1, 100, 1, 1, 1, 1, '2017-04-01 05:37:23', '2017-04-01 05:37:23', NULL),
(90, 1, 101, 1, 1, 1, 1, '2017-04-01 21:56:19', '2017-04-01 21:56:19', NULL),
(91, 1, 102, 1, 1, 1, 1, '2017-04-01 23:16:20', '2017-04-01 23:16:20', NULL),
(92, 1, 103, 1, 1, 1, 1, '2017-04-01 23:27:09', '2017-04-01 23:27:09', NULL),
(93, 1, 104, 1, 1, 1, 1, '2017-04-02 02:18:09', '2017-04-02 02:18:09', NULL),
(94, 1, 105, 1, 1, 1, 1, '2017-04-02 03:41:12', '2017-04-02 03:41:12', NULL),
(95, 1, 106, 1, 1, 1, 1, '2017-04-02 04:10:40', '2017-04-02 04:10:40', NULL),
(96, 1, 107, 1, 1, 1, 1, '2017-04-02 04:30:10', '2017-04-02 04:30:10', NULL),
(97, 1, 108, 1, 1, 1, 1, '2017-04-02 04:31:16', '2017-04-02 04:31:16', NULL),
(98, 1, 109, 1, 1, 1, 1, '2017-04-02 04:36:52', '2017-04-02 04:36:52', NULL),
(100, 1, 111, 1, 1, 1, 1, '2017-04-02 06:10:29', '2017-04-02 06:10:29', NULL),
(101, 1, 112, 1, 1, 1, 1, '2017-04-02 21:48:28', '2017-04-02 21:48:28', NULL),
(102, 1, 113, 1, 1, 1, 1, '2017-04-02 22:19:38', '2017-04-02 22:19:38', NULL),
(103, 1, 114, 1, 1, 1, 1, '2017-04-02 23:54:17', '2017-06-05 23:06:47', NULL),
(110, 1, 116, 1, 1, 1, 1, '2017-04-05 00:40:20', '2017-04-05 00:40:20', NULL),
(111, 1, 117, 1, 1, 1, 1, '2017-04-05 02:44:26', '2017-04-05 02:44:26', NULL),
(112, 1, 118, 1, 1, 1, 1, '2017-04-05 05:37:11', '2017-04-05 05:37:11', NULL),
(113, 1, 119, 1, 1, 1, 1, '2017-04-05 05:52:23', '2017-04-05 05:52:23', NULL),
(114, 1, 120, 1, 1, 1, 1, '2017-04-05 22:39:24', '2017-04-05 22:39:25', NULL),
(115, 1, 122, 1, 1, 1, 1, '2017-04-08 05:44:12', '2017-04-08 05:44:12', NULL),
(116, 1, 123, 1, 1, 1, 1, '2017-04-09 02:36:04', '2017-04-09 02:36:04', NULL),
(117, 1, 124, 1, 1, 1, 1, '2017-04-09 04:59:19', '2017-04-09 04:59:19', NULL),
(118, 1, 125, 1, 1, 1, 1, '2017-04-10 00:38:37', '2017-04-10 00:38:37', NULL),
(119, 1, 126, 1, 0, 0, 0, '2017-04-10 03:33:47', '2017-04-10 03:33:47', NULL),
(120, 1, 127, 1, 1, 1, 1, '2017-04-11 03:04:58', '2017-04-11 03:04:58', NULL),
(121, 1, 128, 1, 1, 1, 1, '2017-04-11 03:05:13', '2017-04-11 03:05:13', NULL),
(122, 1, 129, 1, 1, 1, 1, '2017-04-11 05:13:18', '2017-04-11 05:13:18', NULL),
(123, 1, 130, 1, 1, 1, 1, '2017-04-11 23:16:35', '2017-04-11 23:16:35', NULL),
(124, 1, 132, 1, 1, 1, 1, '2017-04-12 03:19:13', '2017-04-12 03:19:13', NULL),
(125, 1, 131, 1, 1, 1, 1, '2017-04-12 03:26:59', '2017-04-12 03:26:59', NULL),
(126, 1, 133, 1, 1, 0, 0, '2017-04-12 04:57:52', '2017-04-12 04:57:52', NULL),
(127, 1, 134, 1, 1, 0, 0, '2017-04-13 05:53:21', '2017-04-13 05:53:21', NULL),
(128, 1, 135, 1, 1, 0, 0, '2017-04-14 22:20:49', '2017-04-14 22:20:49', NULL),
(129, 1, 136, 1, 1, 1, 1, '2017-04-16 01:15:33', '2017-04-16 01:15:33', NULL),
(130, 1, 137, 1, 1, 1, 1, '2017-04-17 00:06:29', '2017-04-17 00:06:29', NULL),
(132, 1, 138, 1, 1, 1, 1, '2017-04-17 23:43:58', '2017-04-17 23:43:58', NULL),
(133, 1, 139, 1, 1, 0, 0, '2017-04-18 05:48:35', '2017-04-18 05:48:35', NULL),
(134, 1, 140, 1, 1, 1, 1, '2017-04-18 08:35:53', '2017-04-18 08:35:53', NULL),
(135, 1, 141, 1, 1, 1, 1, '2017-04-18 21:17:21', '2017-04-18 21:18:44', NULL),
(136, 1, 142, 1, 1, 1, 1, '2017-04-18 21:52:56', '2017-04-18 21:52:56', NULL),
(137, 4, 119, 1, 1, 1, 1, '2017-04-18 22:56:39', '2017-04-18 22:56:39', NULL),
(138, 4, 136, 1, 1, 1, 1, '2017-04-18 22:56:39', '2017-04-18 22:56:39', NULL),
(139, 4, 141, 1, 1, 1, 1, '2017-04-18 22:56:39', '2017-04-18 22:56:40', NULL),
(140, 4, 10, 1, 1, 1, 1, '2017-04-18 22:57:35', '2017-04-18 22:57:35', NULL),
(141, 4, 55, 1, 1, 1, 1, '2017-04-18 22:57:35', '2017-04-18 22:57:35', NULL),
(142, 4, 64, 1, 1, 1, 1, '2017-04-18 22:57:35', '2017-04-18 22:57:35', NULL),
(143, 1, 143, 1, 0, 0, 0, '2017-04-19 00:06:15', '2017-04-19 00:06:15', NULL),
(144, 4, 143, 1, 0, 0, 0, '2017-04-19 00:06:15', '2017-04-19 00:06:15', NULL),
(145, 1, 144, 1, 1, 1, 1, '2017-04-19 00:57:42', '2017-04-19 00:57:42', NULL),
(146, 4, 144, 1, 1, 1, 1, '2017-04-19 00:57:42', '2017-04-19 00:57:42', NULL),
(147, 1, 145, 1, 1, 1, 1, '2017-04-19 05:13:52', '2017-04-19 05:15:40', NULL),
(148, 1, 146, 1, 1, 1, 1, '2017-04-22 02:13:07', '2017-04-26 02:50:25', NULL),
(151, 4, 146, 1, 1, 1, 1, '2017-04-22 02:13:07', '2017-05-11 01:05:40', '2017-05-11 01:05:40'),
(163, 5, 54, 1, 1, 1, 1, '2017-04-22 05:42:31', '2017-04-22 05:43:49', '2017-04-22 05:43:49'),
(164, 5, 76, 1, 0, 0, 0, '2017-04-22 05:43:02', '2017-04-22 05:44:26', '2017-04-22 05:44:26'),
(165, 5, 54, 1, 0, 0, 0, '2017-04-22 05:48:28', '2017-04-22 05:48:28', NULL),
(166, 5, 70, 1, 0, 0, 0, '2017-04-22 05:48:28', '2017-04-22 05:48:28', NULL),
(167, 5, 76, 1, 1, 1, 1, '2017-04-22 05:48:28', '2017-05-09 21:39:51', NULL),
(168, 5, 88, 1, 1, 1, 1, '2017-04-22 06:03:43', '2017-04-22 06:03:43', NULL),
(169, 5, 91, 1, 1, 1, 1, '2017-04-22 06:03:43', '2017-04-22 06:03:43', NULL),
(170, 5, 53, 1, 1, 1, 1, '2017-04-22 06:05:12', '2017-04-22 06:05:12', NULL),
(171, 1, 147, 1, 1, 0, 0, '2017-04-22 22:11:20', '2017-04-22 22:11:20', NULL),
(172, 1, 148, 1, 1, 1, 1, '2017-04-23 00:43:09', '2017-04-23 00:44:02', NULL),
(173, 1, 149, 1, 1, 1, 1, '2017-04-23 01:17:41', '2017-04-23 01:18:35', NULL),
(174, 1, 150, 1, 1, 0, 0, '2017-04-23 02:23:45', '2017-04-23 02:23:45', NULL),
(175, 1, 151, 1, 1, 0, 0, '2017-04-24 00:05:33', '2017-04-24 00:05:33', NULL),
(176, 1, 152, 1, 1, 1, 1, '2017-04-24 22:47:39', '2017-04-24 22:47:39', NULL),
(177, 1, 153, 1, 1, 0, 0, '2017-04-25 04:45:18', '2017-04-25 04:45:18', NULL),
(178, 1, 154, 1, 1, 0, 0, '2017-04-25 06:37:28', '2017-04-25 06:37:28', NULL),
(179, 1, 156, 1, 1, 1, 1, '2017-04-26 03:08:15', '2017-04-26 03:08:15', NULL),
(180, 4, 156, 1, 1, 1, 1, '2017-04-26 03:08:15', '2017-04-26 03:08:15', NULL),
(181, 6, 54, 1, 1, 1, 1, '2017-04-26 03:18:26', '2017-04-26 03:18:26', NULL),
(182, 6, 132, 1, 1, 1, 1, '2017-04-26 03:18:26', '2017-04-26 03:18:26', NULL),
(183, 6, 155, 1, 1, 1, 1, '2017-04-26 03:18:26', '2017-04-26 05:33:32', NULL),
(184, 1, 157, 1, 1, 1, 1, '2017-04-26 03:54:24', '2017-04-26 03:55:20', NULL),
(185, 1, 158, 1, 1, 1, 1, '2017-04-26 04:01:30', '2017-04-26 04:02:19', NULL),
(186, 1, 159, 1, 1, 1, 1, '2017-04-26 04:07:26', '2017-04-26 04:09:19', NULL),
(187, 4, 160, 1, 1, 1, 1, '2017-04-26 05:24:23', '2017-04-26 05:24:23', NULL),
(189, 4, 161, 1, 1, 1, 1, '2017-04-26 07:30:47', '2017-04-26 07:30:47', NULL),
(190, 5, 100, 1, 1, 1, 1, '2017-04-27 00:21:22', '2017-04-27 00:21:22', NULL),
(191, 5, 112, 1, 0, 0, 0, '2017-04-27 00:22:13', '2017-04-27 00:22:13', NULL),
(192, 1, 162, 1, 1, 1, 1, '2017-04-27 03:00:04', '2017-04-27 03:01:15', NULL),
(193, 1, 163, 1, 1, 1, 1, '2017-04-27 04:35:03', '2017-04-27 04:35:57', NULL),
(194, 1, 164, 1, 1, 1, 1, '2017-04-27 05:53:35', '2017-04-27 05:54:38', NULL),
(196, 4, 166, 1, 1, 1, 1, '2017-04-29 01:20:33', '2017-04-29 01:20:33', NULL),
(197, 4, 117, 1, 1, 1, 1, '2017-04-29 21:00:13', '2017-04-29 21:00:13', NULL),
(198, 1, 167, 1, 1, 0, 0, '2017-04-29 23:07:04', '2017-04-29 23:07:04', NULL),
(199, 4, 168, 1, 1, 1, 1, '2017-04-30 00:08:42', '2017-04-30 00:08:42', NULL),
(200, 6, 96, 1, 1, 1, 1, '2017-04-30 05:35:22', '2017-04-30 05:35:22', NULL),
(201, 6, 99, 1, 1, 1, 1, '2017-04-30 05:35:22', '2017-04-30 05:35:22', NULL),
(202, 6, 100, 1, 1, 1, 1, '2017-04-30 05:35:22', '2017-04-30 05:35:22', NULL),
(203, 6, 105, 1, 1, 1, 1, '2017-04-30 05:35:22', '2017-04-30 05:35:22', NULL),
(204, 6, 112, 1, 1, 1, 1, '2017-04-30 05:35:22', '2017-04-30 05:35:22', NULL),
(205, 1, 169, 1, 1, 1, 1, '2017-05-02 22:56:42', '2017-05-02 22:58:09', NULL),
(206, 1, 170, 1, 1, 1, 1, '2017-05-02 23:07:19', '2017-05-02 23:07:19', NULL),
(207, 1, 171, 1, 1, 1, 1, '2017-05-05 22:41:15', '2017-05-05 22:41:15', NULL),
(209, 1, 172, 1, 1, 1, 1, '2017-05-06 05:21:15', '2017-05-06 05:21:15', NULL),
(211, 1, 173, 1, 1, 1, 1, '2017-05-07 01:34:34', '2017-05-07 01:34:34', NULL),
(212, 1, 174, 1, 1, 1, 1, '2017-05-07 03:03:39', '2017-05-07 03:03:39', NULL),
(213, 1, 175, 1, 1, 1, 1, '2017-05-07 03:03:39', '2017-05-07 03:03:39', NULL),
(214, 1, 176, 1, 1, 0, 0, '2017-05-07 03:41:31', '2017-05-07 03:41:31', NULL),
(215, 1, 177, 1, 1, 1, 1, '2017-05-08 05:29:50', '2017-05-08 05:29:50', NULL),
(217, 1, 178, 1, 1, 1, 1, '2017-05-09 05:42:58', '2017-05-09 05:42:58', NULL),
(218, 5, 2, 1, 1, 1, 1, '2017-05-09 21:33:40', '2017-05-09 21:33:40', NULL),
(219, 4, 132, 1, 1, 1, 1, '2017-05-11 00:44:09', '2017-05-12 22:20:35', '2017-05-12 22:20:35'),
(220, 4, 146, 1, 1, 1, 1, '2017-05-11 01:06:29', '2017-05-11 01:06:29', NULL),
(221, 4, 180, 1, 1, 1, 1, '2017-05-11 02:50:49', '2017-05-11 02:50:49', NULL),
(222, 4, 181, 1, 1, 1, 1, '2017-05-12 22:21:17', '2017-05-12 22:21:17', NULL),
(223, 1, 183, 1, 1, 1, 1, '2017-05-12 23:38:41', '2017-05-12 23:38:41', NULL),
(224, 4, 182, 1, 1, 1, 1, '2017-05-12 23:39:39', '2017-05-12 23:39:39', NULL),
(225, 6, 184, 1, 1, 1, 1, '2017-05-13 01:06:08', '2017-05-13 01:06:08', NULL),
(226, 1, 185, 1, 0, 0, 0, '2017-05-13 04:59:40', '2017-05-13 04:59:40', NULL),
(228, 1, 186, 1, 1, 1, 1, '2017-05-14 00:03:03', '2017-05-14 00:03:03', NULL),
(230, 1, 187, 1, 1, 1, 1, '2017-05-15 00:35:51', '2017-05-15 00:35:51', NULL),
(232, 5, 187, 1, 1, 1, 1, '2017-05-15 03:39:13', '2017-05-15 03:39:13', NULL),
(233, 6, 187, 1, 1, 1, 1, '2017-05-15 03:39:13', '2017-05-15 03:39:13', NULL),
(234, 1, 188, 1, 1, 1, 1, '2017-05-15 21:44:23', '2017-05-15 21:51:11', NULL),
(235, 7, 188, 1, 1, 1, 1, '2017-05-15 21:51:56', '2017-05-15 21:51:56', NULL),
(236, 7, 183, 1, 1, 0, 0, '2017-05-15 21:52:54', '2017-05-15 21:52:54', NULL),
(237, 5, 96, 1, 1, 1, 1, '2017-05-15 22:11:18', '2017-05-15 22:11:18', NULL),
(238, 1, 189, 1, 1, 0, 0, '2017-05-15 22:30:54', '2017-05-15 22:30:54', NULL),
(239, 5, 132, 1, 1, 1, 1, '2017-05-15 22:34:36', '2017-05-15 22:34:36', NULL),
(241, 1, 191, 1, 1, 1, 1, '2017-05-16 02:05:55', '2017-05-16 02:05:55', NULL),
(242, 5, 193, 1, 1, 1, 1, '2017-05-16 05:28:44', '2017-05-16 05:28:44', NULL),
(243, 1, 192, 1, 0, 0, 0, '2017-05-16 05:31:20', '2017-05-16 05:31:20', NULL),
(244, 1, 194, 1, 1, 1, 1, '2017-05-16 22:29:47', '2017-05-16 22:29:47', NULL),
(246, 1, 195, 1, 1, 1, 1, '2017-05-18 00:41:54', '2017-05-18 00:41:54', NULL),
(247, 1, 196, 1, 1, 1, 1, '2017-05-18 00:59:30', '2017-05-18 00:59:30', NULL),
(248, 1, 197, 1, 1, 1, 1, '2017-05-18 01:02:36', '2017-05-18 01:02:36', NULL),
(249, 7, 191, 1, 1, 1, 0, '2017-05-18 03:46:27', '2017-05-18 03:46:27', NULL),
(250, 1, 198, 1, 1, 1, 1, '2017-05-19 22:29:27', '2017-05-19 22:29:27', NULL),
(251, 1, 199, 1, 1, 1, 1, '2017-05-19 22:39:07', '2017-05-19 22:39:07', NULL),
(253, 1, 201, 1, 1, 1, 1, '2017-05-19 23:40:47', '2017-05-19 23:40:47', NULL),
(254, 1, 202, 1, 1, 1, 1, '2017-05-20 00:40:21', '2017-05-20 00:40:21', NULL),
(255, 1, 203, 1, 1, 1, 1, '2017-05-20 01:06:59', '2017-05-20 01:06:59', NULL),
(256, 1, 204, 1, 1, 1, 1, '2017-05-20 02:11:38', '2017-05-20 02:11:38', NULL),
(257, 1, 205, 1, 1, 1, 1, '2017-05-21 05:08:11', '2017-05-21 05:08:11', NULL),
(259, 1, 206, 1, 1, 1, 1, '2017-05-22 03:10:14', '2017-05-22 03:10:14', NULL),
(260, 1, 207, 1, 1, 1, 1, '2017-05-22 04:14:22', '2017-05-25 04:13:50', '2017-05-25 04:13:50'),
(261, 1, 208, 1, 1, 1, 1, '2017-05-22 23:50:38', '2017-05-22 23:50:38', NULL),
(262, 1, 209, 1, 1, 1, 1, '2017-05-23 05:00:45', '2017-05-23 05:00:45', NULL),
(263, 1, 210, 1, 1, 1, 1, '2017-05-23 06:21:11', '2017-05-23 06:21:11', NULL),
(264, 1, 211, 1, 1, 1, 1, '2017-05-24 02:33:11', '2017-05-24 02:33:11', NULL),
(265, 1, 212, 1, 1, 1, 1, '2017-05-25 01:13:57', '2017-05-25 01:13:57', NULL),
(266, 14, 207, 1, 1, 1, 1, '2017-05-25 04:14:44', '2017-05-25 04:14:44', NULL),
(267, 1, 213, 1, 1, 1, 1, '2017-05-28 22:57:46', '2017-05-28 22:57:46', NULL),
(268, 1, 214, 1, 1, 1, 1, '2017-05-28 23:30:07', '2017-05-28 23:30:07', NULL),
(269, 1, 215, 1, 1, 1, 1, '2017-05-28 23:57:09', '2017-05-28 23:57:09', NULL),
(271, 1, 217, 1, 1, 1, 1, '2017-05-30 02:53:49', '2017-05-30 02:53:49', NULL),
(273, 1, 218, 1, 1, 1, 1, '2017-05-31 21:57:33', '2017-05-31 21:57:33', NULL),
(275, 1, 219, 1, 1, 1, 1, '2017-06-02 23:37:57', '2017-06-02 23:37:57', NULL),
(276, 1, 220, 1, 1, 1, 1, '2017-06-05 23:08:48', '2017-06-05 23:08:48', NULL),
(277, 1, 221, 1, 1, 1, 1, '2017-06-07 21:14:04', '2017-06-07 21:14:04', NULL),
(278, 1, 223, 1, 1, 1, 1, '2017-06-12 03:24:13', '2017-06-12 03:24:13', NULL),
(279, 1, 224, 1, 1, 1, 0, '2017-06-13 00:32:02', '2017-06-13 00:32:02', NULL),
(280, 15, 54, 1, 1, 1, 1, '2017-06-13 23:34:03', '2017-06-17 02:28:23', NULL),
(281, 15, 70, 1, 1, 1, 1, '2017-06-13 23:34:03', '2017-06-13 23:34:03', NULL),
(282, 15, 221, 1, 1, 1, 1, '2017-06-13 23:34:03', '2017-06-13 23:34:03', NULL),
(283, 15, 146, 1, 1, 1, 1, '2017-06-17 02:28:23', '2017-06-17 02:28:23', NULL),
(284, 15, 132, 1, 1, 1, 1, '2017-06-17 02:30:14', '2017-06-17 02:30:14', NULL),
(285, 14, 54, 1, 1, 1, 1, '2017-06-17 02:32:53', '2017-06-17 02:32:53', NULL),
(286, 14, 132, 1, 1, 1, 1, '2017-06-17 02:32:53', '2017-06-17 02:32:53', NULL),
(287, 14, 155, 1, 1, 1, 1, '2017-06-17 02:32:53', '2017-06-17 02:32:53', NULL),
(288, 1, 225, 1, 1, 1, 1, '2017-06-17 23:16:59', '2017-06-17 23:16:59', NULL),
(289, 1, 226, 1, 1, 1, 1, '2017-06-19 02:13:47', '2017-06-19 02:13:47', NULL),
(290, 1, 227, 1, 1, 1, 1, '2017-06-20 02:51:05', '2017-06-20 02:51:05', NULL),
(292, 5, 227, 1, 1, 1, 1, '2017-06-20 02:51:05', '2017-06-20 02:51:05', NULL),
(293, 6, 227, 1, 1, 1, 1, '2017-06-20 02:51:05', '2017-06-20 02:51:05', NULL),
(294, 1, 228, 1, 0, 0, 0, '2017-06-20 22:32:29', '2017-06-20 22:32:29', NULL),
(295, 1, 230, 1, 1, 1, 1, '2017-06-21 02:08:15', '2017-06-21 02:08:15', NULL),
(297, 5, 230, 1, 1, 1, 1, '2017-06-21 02:08:15', '2017-06-21 02:08:15', NULL),
(298, 6, 230, 1, 1, 1, 1, '2017-06-21 02:08:15', '2017-06-21 02:08:15', NULL),
(299, 1, 231, 1, 1, 1, 1, '2017-06-21 02:34:53', '2017-06-21 02:34:53', NULL),
(301, 5, 231, 1, 1, 1, 1, '2017-06-21 02:34:53', '2017-06-21 02:34:53', NULL),
(302, 6, 231, 1, 1, 1, 1, '2017-06-21 02:34:53', '2017-06-21 02:34:53', NULL),
(303, 1, 232, 1, 1, 1, 1, '2017-07-03 00:05:15', '2017-07-03 00:05:15', NULL),
(304, 1, 233, 1, 1, 1, 1, '2017-07-03 02:55:26', '2017-07-03 02:55:26', NULL),
(306, 5, 233, 1, 1, 1, 1, '2017-07-03 02:55:26', '2017-07-03 02:55:26', NULL),
(307, 6, 233, 1, 1, 1, 1, '2017-07-03 02:55:26', '2017-07-03 02:55:26', NULL),
(308, 1, 234, 1, 0, 0, 0, '2017-07-04 22:48:27', '2017-07-04 22:48:27', NULL),
(309, 1, 235, 1, 1, 1, 1, '2017-07-04 23:53:40', '2017-07-04 23:53:40', NULL),
(311, 5, 235, 1, 1, 1, 1, '2017-07-04 23:53:40', '2017-07-04 23:53:41', NULL),
(312, 6, 235, 1, 1, 1, 1, '2017-07-04 23:53:40', '2017-07-04 23:53:41', NULL),
(313, 1, 236, 1, 0, 0, 0, '2017-07-05 04:26:52', '2017-07-05 04:26:52', NULL),
(314, 1, 161, 1, 1, 1, 1, '2017-07-12 01:04:20', '2017-07-12 01:04:20', NULL),
(315, 1, 168, 1, 1, 1, 1, '2017-07-12 01:04:20', '2017-07-12 01:04:20', NULL),
(316, 1, 166, 1, 1, 1, 1, '2017-07-12 01:05:13', '2017-07-12 01:05:13', NULL),
(317, 1, 238, 1, 1, 1, 1, '2017-07-13 05:40:51', '2017-07-13 05:40:51', NULL),
(319, 6, 238, 1, 1, 1, 1, '2017-07-13 05:40:51', '2017-07-13 05:40:51', NULL),
(320, 1, 239, 1, 1, 1, 1, '2017-07-14 22:41:49', '2017-07-14 22:41:49', NULL),
(321, 1, 240, 1, 1, 1, 1, '2017-07-15 01:24:02', '2017-07-15 01:24:02', NULL),
(322, 1, 241, 1, 1, 0, 0, '2017-07-15 04:07:08', '2017-07-15 04:07:08', NULL),
(323, 1, 242, 1, 1, 1, 1, '2017-07-21 22:13:49', '2017-07-21 22:13:49', NULL),
(325, 5, 242, 1, 1, 1, 1, '2017-07-21 22:13:49', '2017-07-21 22:13:50', NULL),
(326, 1, 243, 1, 1, 1, 1, '2017-07-21 23:16:35', '2017-07-21 23:16:35', NULL),
(327, 4, 244, 1, 1, 1, 1, '2017-07-22 04:15:46', '2017-07-22 04:16:49', NULL),
(328, 1, 244, 1, 1, 1, 1, '2017-07-22 04:21:24', '2017-07-22 04:21:24', NULL),
(330, 14, 56, 1, 1, 1, 1, '2017-07-23 22:42:20', '2017-07-23 22:42:20', NULL),
(331, 14, 196, 1, 1, 1, 1, '2017-07-23 22:43:16', '2017-07-23 22:43:16', NULL),
(332, 14, 209, 1, 1, 1, 1, '2017-07-23 22:43:16', '2017-07-23 22:43:16', NULL),
(333, 14, 211, 1, 1, 1, 1, '2017-07-23 22:43:16', '2017-07-23 22:43:16', NULL),
(334, 14, 201, 1, 1, 1, 1, '2017-07-23 22:52:51', '2017-07-23 22:52:51', NULL),
(335, 14, 202, 1, 1, 1, 1, '2017-07-23 22:52:51', '2017-07-23 22:52:52', NULL),
(336, 14, 203, 1, 1, 1, 1, '2017-07-23 22:52:51', '2017-07-23 22:52:52', NULL),
(337, 14, 205, 1, 1, 1, 1, '2017-07-23 22:52:51', '2017-07-23 22:52:52', NULL),
(338, 14, 206, 1, 1, 1, 1, '2017-07-23 22:52:51', '2017-07-23 22:52:52', NULL),
(339, 14, 210, 1, 1, 1, 1, '2017-07-23 22:52:51', '2017-07-23 22:52:52', NULL),
(340, 14, 212, 1, 1, 1, 1, '2017-07-23 22:52:51', '2017-07-23 22:52:52', NULL),
(341, 14, 213, 1, 1, 1, 1, '2017-07-23 22:52:51', '2017-07-23 22:52:52', NULL),
(342, 14, 214, 1, 1, 1, 1, '2017-07-23 22:52:51', '2017-07-23 22:52:52', NULL),
(343, 14, 215, 1, 1, 1, 1, '2017-07-23 22:52:51', '2017-07-23 22:52:52', NULL),
(344, 14, 217, 1, 1, 1, 1, '2017-07-23 22:52:51', '2017-07-23 22:52:52', NULL),
(345, 14, 218, 1, 1, 1, 1, '2017-07-23 22:52:51', '2017-07-23 22:52:52', NULL),
(346, 14, 219, 1, 1, 1, 1, '2017-07-23 22:52:51', '2017-07-23 22:52:52', NULL),
(347, 14, 224, 1, 1, 1, 1, '2017-07-23 22:52:51', '2017-07-23 22:52:52', NULL),
(348, 14, 227, 1, 1, 1, 1, '2017-07-23 22:52:51', '2017-07-23 22:52:52', NULL),
(349, 14, 230, 1, 1, 1, 1, '2017-07-23 22:52:51', '2017-07-23 22:52:52', NULL),
(350, 14, 231, 1, 1, 1, 1, '2017-07-23 22:52:51', '2017-07-23 22:52:52', NULL),
(351, 14, 238, 1, 1, 1, 1, '2017-07-23 22:52:51', '2017-07-23 22:52:52', NULL),
(352, 14, 242, 1, 1, 1, 1, '2017-07-23 22:52:51', '2017-07-23 22:52:53', NULL),
(353, 1, 246, 1, 0, 0, 0, '2017-07-26 23:11:41', '2017-07-26 23:11:41', NULL),
(354, 4, 247, 1, 0, 0, 0, '2017-07-28 22:50:58', '2017-07-28 22:52:38', NULL),
(355, 1, 248, 1, 1, 1, 1, '2017-07-30 03:56:28', '2017-07-30 03:56:28', NULL),
(356, 1, 249, 1, 1, 1, 1, '2017-08-04 23:18:58', '2017-08-04 23:18:58', NULL),
(358, 14, 249, 1, 1, 1, 1, '2017-08-04 23:18:58', '2017-08-04 23:18:58', NULL),
(359, 1, 250, 1, 1, 1, 1, '2017-08-05 00:21:14', '2017-08-05 00:21:14', NULL),
(360, 4, 251, 1, 1, 1, 1, '2017-08-06 00:05:48', '2017-08-06 03:37:01', NULL),
(361, 1, 252, 1, 1, 1, 1, '2017-08-07 02:52:38', '2017-08-07 02:52:38', NULL),
(362, 4, 253, 1, 1, 1, 1, '2017-08-08 23:07:28', '2017-08-08 23:07:28', NULL),
(363, 1, 254, 1, 1, 1, 1, '2017-08-10 00:20:42', '2017-08-10 00:20:42', NULL),
(364, 14, 255, 1, 1, 1, 1, '2017-08-10 04:15:50', '2017-08-10 04:15:50', NULL),
(365, 14, 256, 1, 1, 1, 1, '2017-08-11 23:56:24', '2017-08-11 23:56:24', NULL),
(366, 4, 257, 1, 1, 1, 1, '2017-08-14 01:27:56', '2017-08-14 01:27:56', NULL),
(367, 4, 258, 1, 1, 1, 1, '2017-08-18 22:46:44', '2017-08-18 22:46:44', NULL),
(368, 1, 259, 1, 1, 1, 1, '2017-08-23 03:13:52', '2017-08-23 03:15:39', NULL),
(369, 1, 260, 1, 1, 1, 1, '2017-08-23 03:36:52', '2017-08-23 03:36:52', NULL),
(370, 1, 261, 1, 1, 1, 1, '2017-08-24 02:51:43', '2017-08-24 02:51:43', NULL),
(372, 5, 262, 1, 1, 1, 1, '2017-08-30 00:45:08', '2017-08-30 00:45:08', NULL),
(373, 6, 262, 1, 1, 1, 1, '2017-08-30 00:45:08', '2017-08-30 00:45:08', NULL),
(374, 14, 262, 1, 1, 1, 1, '2017-08-30 00:45:08', '2017-08-30 00:45:08', NULL),
(375, 1, 263, 1, 1, 1, 1, '2017-09-09 03:38:32', '2017-09-09 03:38:32', NULL),
(376, 4, 264, 1, 1, 1, 1, '2017-09-11 00:14:06', '2017-09-11 00:14:06', NULL),
(377, 1, 265, 1, 1, 1, 1, '2017-09-14 03:40:10', '2017-09-14 03:40:11', NULL),
(378, 1, 266, 1, 1, 1, 1, '2017-09-14 04:50:55', '2017-09-14 04:50:55', NULL),
(379, 1, 267, 1, 1, 1, 1, '2017-09-16 04:31:38', '2017-09-16 04:31:38', NULL),
(380, 1, 268, 1, 1, 1, 1, '2017-09-19 00:38:37', '2017-09-19 00:38:37', NULL),
(381, 1, 269, 1, 1, 1, 1, '2017-09-20 02:41:03', '2017-09-20 02:41:03', NULL),
(382, 1, 270, 1, 1, 1, 1, '2017-09-21 02:49:54', '2017-09-21 02:49:54', NULL),
(383, 1, 271, 1, 1, 1, 1, '2017-09-22 23:19:27', '2017-09-22 23:19:27', NULL),
(384, 4, 272, 1, 1, 1, 1, '2017-09-23 23:08:03', '2017-09-23 23:08:03', NULL),
(385, 4, 273, 1, 1, 1, 1, '2017-09-26 00:58:56', '2017-09-26 00:58:56', NULL),
(386, 1, 72, 1, 1, 1, 1, '2017-09-27 23:12:52', '2017-11-15 02:56:12', NULL),
(387, 1, 274, 1, 1, 1, 1, '2017-10-03 00:12:37', '2017-10-03 00:12:37', NULL),
(388, 4, 275, 1, 1, 1, 0, '2017-10-26 02:34:54', '2017-10-26 02:34:54', NULL),
(389, 1, 276, 1, 1, 1, 1, '2017-11-06 03:37:59', '2017-11-06 03:37:59', NULL),
(390, 1, 277, 1, 1, 1, 1, '2017-11-06 03:37:59', '2017-11-06 03:37:59', NULL),
(391, 1, 278, 1, 1, 1, 0, '2017-11-09 02:41:20', '2017-11-09 02:41:20', NULL),
(392, 1, 279, 1, 1, 0, 0, '2017-11-12 23:56:55', '2017-11-12 23:56:55', NULL),
(393, 1, 280, 1, 1, 0, 0, '2017-11-14 03:20:32', '2017-11-14 03:20:33', NULL),
(394, 4, 281, 1, 1, 1, 1, '2017-11-19 03:17:42', '2017-11-19 03:17:42', NULL),
(395, 1, 181, 1, 1, 1, 1, '2017-11-19 05:04:23', '2017-11-19 05:04:23', NULL),
(396, 1, 281, 1, 1, 1, 1, '2017-11-19 05:04:23', '2017-11-19 05:04:23', NULL),
(397, 4, 282, 1, 1, 1, 1, '2017-11-20 01:30:43', '2017-11-20 01:30:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_module`
--

CREATE TABLE IF NOT EXISTS `role_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `module_id` int(10) unsigned NOT NULL,
  `acc_view` tinyint(1) NOT NULL,
  `acc_create` tinyint(1) NOT NULL,
  `acc_edit` tinyint(1) NOT NULL,
  `acc_delete` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_module_role_id_foreign` (`role_id`),
  KEY `role_module_module_id_foreign` (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=137 ;

--
-- Dumping data for table `role_module`
--

INSERT INTO `role_module` (`id`, `role_id`, `module_id`, `acc_view`, `acc_create`, `acc_edit`, `acc_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, '2017-02-18 20:35:02', '2017-02-18 20:35:02'),
(2, 1, 2, 1, 1, 1, 1, '2017-02-18 20:35:02', '2017-02-18 20:35:02'),
(3, 1, 3, 1, 1, 1, 1, '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(4, 1, 4, 1, 1, 1, 1, '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(5, 1, 5, 1, 1, 1, 1, '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(6, 1, 6, 1, 1, 1, 1, '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(7, 1, 7, 1, 1, 1, 1, '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(8, 1, 8, 1, 1, 1, 1, '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(9, 1, 9, 1, 1, 1, 1, '2017-02-26 21:07:23', '2017-02-26 21:07:23'),
(10, 1, 10, 1, 1, 1, 1, '2017-02-26 21:14:11', '2017-02-26 21:14:11'),
(11, 1, 11, 1, 1, 1, 1, '2017-02-26 21:25:26', '2017-02-26 21:25:26'),
(12, 2, 1, 1, 0, 0, 0, '2017-02-26 21:58:32', '2017-02-26 21:58:32'),
(13, 2, 2, 1, 0, 0, 0, '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(14, 2, 3, 1, 0, 0, 0, '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(15, 2, 4, 1, 0, 0, 0, '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(16, 2, 5, 1, 0, 0, 0, '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(17, 2, 6, 1, 0, 0, 0, '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(18, 2, 7, 1, 0, 0, 0, '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(19, 2, 8, 1, 0, 0, 0, '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(20, 2, 9, 1, 1, 1, 1, '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(21, 2, 10, 0, 0, 0, 0, '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(22, 2, 11, 1, 0, 0, 0, '2017-02-26 21:58:35', '2017-02-26 21:58:35'),
(24, 3, 1, 1, 0, 0, 0, '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(25, 3, 2, 1, 0, 0, 0, '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(26, 3, 3, 1, 0, 0, 0, '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(27, 3, 4, 1, 0, 0, 0, '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(28, 3, 5, 1, 0, 0, 0, '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(29, 3, 6, 1, 0, 0, 0, '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(30, 3, 7, 1, 0, 0, 0, '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(31, 3, 8, 1, 0, 0, 0, '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(32, 3, 9, 1, 0, 0, 0, '2017-02-27 23:00:03', '2017-02-27 23:00:03'),
(33, 3, 10, 0, 0, 0, 0, '2017-02-27 23:00:03', '2017-02-27 23:00:03'),
(34, 3, 11, 1, 0, 0, 0, '2017-02-27 23:00:03', '2017-02-27 23:00:03'),
(35, 1, 12, 1, 1, 1, 1, '2017-02-28 16:28:54', '2017-02-28 16:28:54'),
(36, 1, 13, 1, 1, 1, 1, '2017-03-01 18:06:08', '2017-03-01 18:06:08'),
(37, 1, 14, 1, 1, 1, 1, '2017-03-01 21:34:24', '2017-03-01 21:34:24'),
(38, 1, 15, 1, 1, 1, 1, '2017-03-01 22:07:13', '2017-03-01 22:07:13'),
(39, 1, 16, 1, 1, 1, 1, '2017-03-01 22:47:29', '2017-03-01 22:47:29'),
(40, 1, 17, 1, 1, 1, 1, '2017-03-01 22:59:00', '2017-03-01 22:59:00'),
(41, 1, 18, 1, 1, 1, 1, '2017-03-01 23:18:34', '2017-03-01 23:18:34'),
(42, 1, 19, 1, 1, 1, 1, '2017-03-01 23:40:19', '2017-03-01 23:40:19'),
(43, 1, 20, 1, 1, 1, 1, '2017-03-03 15:25:04', '2017-03-03 15:25:04'),
(44, 1, 21, 1, 1, 1, 1, '2017-03-03 15:45:03', '2017-03-03 15:45:03'),
(45, 1, 22, 1, 1, 1, 1, '2017-03-03 16:13:48', '2017-03-03 16:13:48'),
(46, 1, 24, 1, 1, 1, 1, '2017-03-03 21:03:57', '2017-03-03 21:03:57'),
(47, 2, 24, 0, 0, 0, 0, '2017-03-03 21:10:29', '2017-03-03 21:10:29'),
(48, 3, 24, 0, 0, 0, 0, '2017-03-03 21:10:29', '2017-03-03 21:10:29'),
(49, 1, 26, 1, 1, 1, 1, '2017-03-07 15:22:31', '2017-03-07 15:22:31'),
(50, 1, 27, 1, 1, 1, 1, '2017-03-11 03:49:11', '2017-03-11 03:49:11'),
(51, 1, 28, 1, 1, 1, 1, '2017-03-11 04:49:17', '2017-03-11 04:49:17'),
(52, 1, 29, 1, 1, 1, 1, '2017-03-11 06:32:52', '2017-03-11 06:32:52'),
(53, 1, 30, 1, 1, 1, 1, '2017-03-12 02:52:16', '2017-03-12 02:52:16'),
(54, 1, 31, 1, 1, 1, 1, '2017-03-12 03:09:06', '2017-03-12 03:09:06'),
(55, 1, 32, 1, 1, 1, 1, '2017-03-12 03:13:45', '2017-03-12 03:13:45'),
(56, 1, 33, 1, 1, 1, 1, '2017-03-12 03:19:54', '2017-03-12 03:19:54'),
(57, 1, 34, 1, 1, 1, 1, '2017-03-12 04:37:06', '2017-03-12 04:37:06'),
(58, 1, 35, 1, 1, 1, 1, '2017-03-12 04:59:49', '2017-03-12 04:59:49'),
(59, 1, 36, 1, 1, 1, 1, '2017-03-12 05:05:32', '2017-03-12 05:05:32'),
(60, 1, 37, 1, 1, 1, 1, '2017-03-12 05:17:34', '2017-03-12 05:17:34'),
(61, 1, 38, 1, 1, 1, 1, '2017-03-12 05:51:10', '2017-03-12 05:51:10'),
(62, 1, 39, 1, 1, 1, 1, '2017-03-14 05:47:33', '2017-03-14 05:47:33'),
(63, 1, 40, 1, 1, 1, 1, '2017-03-14 06:09:40', '2017-03-14 06:09:40'),
(65, 1, 43, 1, 1, 1, 1, '2017-03-21 03:44:56', '2017-03-21 03:44:56'),
(66, 1, 44, 1, 1, 1, 1, '2017-03-22 22:16:13', '2017-03-22 22:16:13'),
(68, 1, 46, 1, 1, 1, 1, '2017-03-23 00:23:54', '2017-03-23 00:23:54'),
(69, 1, 47, 1, 1, 1, 1, '2017-03-29 02:54:46', '2017-03-29 02:54:46'),
(70, 1, 48, 1, 1, 1, 1, '2017-03-30 04:11:13', '2017-03-30 04:11:13'),
(71, 1, 50, 1, 1, 1, 1, '2017-04-01 00:41:15', '2017-04-01 00:41:15'),
(72, 1, 51, 1, 1, 1, 1, '2017-04-01 03:07:03', '2017-04-01 03:07:03'),
(73, 1, 52, 1, 1, 1, 1, '2017-04-01 03:40:15', '2017-04-01 03:40:15'),
(74, 1, 53, 1, 1, 1, 1, '2017-04-01 03:56:35', '2017-04-01 03:56:35'),
(75, 1, 54, 1, 1, 1, 1, '2017-04-01 04:32:08', '2017-04-01 04:32:08'),
(76, 1, 55, 1, 1, 1, 1, '2017-04-01 04:53:09', '2017-04-01 04:53:09'),
(77, 1, 56, 1, 1, 1, 1, '2017-04-01 05:20:26', '2017-04-01 05:20:26'),
(78, 1, 57, 1, 1, 1, 1, '2017-04-01 05:37:23', '2017-04-01 05:37:23'),
(79, 1, 49, 1, 1, 1, 1, '2017-04-01 21:56:19', '2017-04-01 21:56:19'),
(80, 1, 59, 1, 1, 1, 1, '2017-04-01 23:16:20', '2017-04-01 23:16:20'),
(81, 1, 58, 1, 1, 1, 1, '2017-04-01 23:27:09', '2017-04-01 23:27:09'),
(82, 1, 61, 1, 1, 1, 1, '2017-04-02 02:18:09', '2017-04-02 02:18:09'),
(83, 1, 60, 1, 1, 1, 1, '2017-04-02 03:41:12', '2017-04-02 03:41:12'),
(84, 1, 62, 1, 1, 1, 1, '2017-04-02 04:10:40', '2017-04-02 04:10:40'),
(85, 1, 65, 1, 1, 1, 1, '2017-04-02 04:30:10', '2017-04-02 04:30:10'),
(86, 1, 64, 1, 1, 1, 1, '2017-04-02 04:31:16', '2017-04-02 04:31:16'),
(87, 1, 66, 1, 1, 1, 1, '2017-04-02 04:36:52', '2017-04-02 04:36:52'),
(89, 1, 68, 1, 1, 1, 1, '2017-04-02 06:10:29', '2017-04-02 06:10:29'),
(90, 1, 69, 1, 1, 1, 1, '2017-04-02 22:19:38', '2017-04-02 22:19:38'),
(91, 1, 70, 1, 1, 1, 1, '2017-04-02 23:54:17', '2017-04-02 23:54:17'),
(93, 1, 72, 1, 1, 1, 1, '2017-04-05 00:40:20', '2017-04-05 00:40:20'),
(94, 1, 73, 1, 1, 1, 1, '2017-04-05 02:44:26', '2017-04-05 02:44:26'),
(95, 1, 74, 1, 1, 1, 1, '2017-04-05 05:37:11', '2017-04-05 05:37:11'),
(96, 1, 75, 1, 1, 1, 1, '2017-04-08 05:44:12', '2017-04-08 05:44:12'),
(97, 1, 76, 1, 1, 1, 1, '2017-04-10 00:38:37', '2017-04-10 00:38:37'),
(98, 1, 77, 1, 1, 1, 1, '2017-04-11 05:13:18', '2017-04-11 05:13:18'),
(99, 1, 78, 1, 1, 1, 1, '2017-04-11 23:16:35', '2017-04-11 23:16:35'),
(100, 1, 79, 1, 1, 1, 1, '2017-04-17 23:43:58', '2017-04-17 23:43:58'),
(101, 1, 80, 1, 1, 1, 1, '2017-04-19 05:13:52', '2017-04-19 05:13:52'),
(102, 1, 81, 1, 1, 1, 1, '2017-04-23 00:43:09', '2017-04-23 00:43:09'),
(103, 1, 82, 1, 1, 1, 1, '2017-04-23 01:17:41', '2017-04-23 01:17:41'),
(104, 1, 83, 1, 1, 1, 1, '2017-04-26 03:54:24', '2017-04-26 03:54:24'),
(105, 1, 84, 1, 1, 1, 1, '2017-04-26 04:01:30', '2017-04-26 04:01:30'),
(106, 1, 85, 1, 1, 1, 1, '2017-04-26 04:07:26', '2017-04-26 04:07:26'),
(107, 1, 86, 1, 1, 1, 1, '2017-04-27 03:00:04', '2017-04-27 03:00:04'),
(108, 1, 87, 1, 1, 1, 1, '2017-04-27 04:35:03', '2017-04-27 04:35:03'),
(109, 1, 88, 1, 1, 1, 1, '2017-04-27 05:53:35', '2017-04-27 05:53:35'),
(110, 1, 89, 1, 1, 1, 1, '2017-05-02 22:56:42', '2017-05-02 22:56:42'),
(111, 1, 90, 1, 1, 1, 1, '2017-05-02 23:07:19', '2017-05-02 23:07:19'),
(112, 1, 91, 1, 1, 1, 1, '2017-05-15 21:44:23', '2017-05-15 21:44:23'),
(113, 1, 92, 1, 1, 1, 1, '2017-05-16 02:05:55', '2017-05-16 02:05:55'),
(114, 1, 93, 1, 1, 1, 1, '2017-05-18 00:41:54', '2017-05-18 00:41:54'),
(115, 1, 94, 1, 1, 1, 1, '2017-05-18 01:02:36', '2017-05-18 01:02:36'),
(116, 1, 96, 1, 1, 1, 1, '2017-05-19 22:29:27', '2017-05-19 22:29:27'),
(117, 1, 97, 1, 1, 1, 1, '2017-05-19 22:39:07', '2017-05-19 22:39:07'),
(119, 1, 98, 1, 1, 1, 1, '2017-05-19 23:40:47', '2017-05-19 23:40:47'),
(120, 1, 99, 1, 1, 1, 1, '2017-05-20 00:40:21', '2017-05-20 00:40:21'),
(121, 1, 100, 1, 1, 1, 1, '2017-05-20 01:06:59', '2017-05-20 01:06:59'),
(122, 1, 101, 1, 1, 1, 1, '2017-05-20 02:11:38', '2017-05-20 02:11:38'),
(123, 1, 102, 1, 1, 1, 1, '2017-05-22 03:10:14', '2017-05-22 03:10:14'),
(124, 1, 103, 1, 1, 1, 1, '2017-05-22 04:14:22', '2017-05-22 04:14:22'),
(125, 1, 104, 1, 1, 1, 1, '2017-05-22 23:50:38', '2017-05-22 23:50:38'),
(126, 1, 105, 1, 1, 1, 1, '2017-05-23 06:21:11', '2017-05-23 06:21:11'),
(127, 1, 106, 1, 1, 1, 1, '2017-05-28 22:57:46', '2017-05-28 22:57:46'),
(128, 1, 107, 1, 1, 1, 1, '2017-05-28 23:30:07', '2017-05-28 23:30:07'),
(129, 1, 108, 1, 1, 1, 1, '2017-05-28 23:57:09', '2017-05-28 23:57:09'),
(131, 1, 111, 1, 1, 1, 1, '2017-06-12 03:24:13', '2017-06-12 03:24:13'),
(132, 1, 112, 1, 1, 1, 1, '2017-06-19 02:13:47', '2017-06-19 02:13:47'),
(133, 1, 113, 1, 1, 1, 1, '2017-07-30 03:56:28', '2017-07-30 03:56:28'),
(134, 1, 114, 1, 1, 1, 1, '2017-08-23 03:13:52', '2017-08-23 03:13:52'),
(135, 1, 116, 1, 1, 1, 1, '2017-08-23 03:36:52', '2017-08-23 03:36:52'),
(136, 1, 117, 1, 1, 1, 1, '2017-09-14 04:50:55', '2017-09-14 04:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `role_module_fields`
--

CREATE TABLE IF NOT EXISTS `role_module_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `field_id` int(10) unsigned NOT NULL,
  `access` enum('invisible','readonly','write') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_module_fields_role_id_foreign` (`role_id`),
  KEY `role_module_fields_field_id_foreign` (`field_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=793 ;

--
-- Dumping data for table `role_module_fields`
--

INSERT INTO `role_module_fields` (`id`, `role_id`, `field_id`, `access`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'write', '2017-02-18 20:35:02', '2017-02-18 20:35:02'),
(2, 1, 2, 'write', '2017-02-18 20:35:02', '2017-02-18 20:35:02'),
(3, 1, 3, 'write', '2017-02-18 20:35:02', '2017-02-18 20:35:02'),
(4, 1, 4, 'write', '2017-02-18 20:35:02', '2017-02-18 20:35:02'),
(5, 1, 5, 'write', '2017-02-18 20:35:02', '2017-02-18 20:35:02'),
(6, 1, 6, 'write', '2017-02-18 20:35:02', '2017-02-18 20:35:02'),
(7, 1, 7, 'write', '2017-02-18 20:35:02', '2017-02-18 20:35:02'),
(8, 1, 8, 'write', '2017-02-18 20:35:02', '2017-02-18 20:35:02'),
(9, 1, 9, 'write', '2017-02-18 20:35:02', '2017-02-18 20:35:02'),
(10, 1, 10, 'write', '2017-02-18 20:35:02', '2017-02-18 20:35:02'),
(11, 1, 11, 'write', '2017-02-18 20:35:02', '2017-02-18 20:35:02'),
(12, 1, 12, 'write', '2017-02-18 20:35:02', '2017-02-18 20:35:02'),
(13, 1, 13, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(14, 1, 14, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(15, 1, 15, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(16, 1, 16, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(17, 1, 17, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(18, 1, 18, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(19, 1, 19, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(20, 1, 20, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(21, 1, 21, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(22, 1, 22, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(23, 1, 23, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(24, 1, 24, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(25, 1, 25, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(26, 1, 26, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(27, 1, 27, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(28, 1, 28, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(29, 1, 29, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(30, 1, 30, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(31, 1, 31, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(32, 1, 32, 'write', '2017-02-18 20:35:03', '2017-02-18 20:35:03'),
(35, 1, 35, 'write', '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(36, 1, 36, 'write', '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(37, 1, 37, 'write', '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(38, 1, 38, 'write', '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(39, 1, 39, 'write', '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(40, 1, 40, 'write', '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(41, 1, 41, 'write', '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(42, 1, 42, 'write', '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(43, 1, 43, 'write', '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(44, 1, 44, 'write', '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(45, 1, 45, 'write', '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(46, 1, 46, 'write', '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(47, 1, 47, 'write', '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(48, 1, 48, 'write', '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(49, 1, 49, 'write', '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(50, 1, 50, 'write', '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(51, 1, 51, 'write', '2017-02-18 20:35:04', '2017-02-18 20:35:04'),
(52, 1, 52, 'write', '2017-02-21 15:35:54', '2017-02-21 15:35:54'),
(53, 1, 53, 'write', '2017-02-26 21:02:38', '2017-02-26 21:02:38'),
(55, 1, 55, 'write', '2017-02-26 21:13:11', '2017-02-26 21:13:11'),
(56, 1, 56, 'write', '2017-02-26 21:13:50', '2017-02-26 21:13:50'),
(57, 1, 57, 'write', '2017-02-26 21:23:47', '2017-02-26 21:23:47'),
(58, 1, 58, 'write', '2017-02-26 21:25:11', '2017-02-26 21:25:11'),
(59, 2, 1, 'readonly', '2017-02-26 21:58:32', '2017-02-26 21:58:32'),
(60, 2, 2, 'readonly', '2017-02-26 21:58:32', '2017-02-26 21:58:32'),
(61, 2, 3, 'readonly', '2017-02-26 21:58:32', '2017-02-26 21:58:32'),
(62, 2, 4, 'readonly', '2017-02-26 21:58:32', '2017-02-26 21:58:32'),
(63, 2, 5, 'readonly', '2017-02-26 21:58:32', '2017-02-26 21:58:32'),
(64, 2, 6, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(65, 2, 7, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(66, 2, 8, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(67, 2, 9, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(68, 2, 10, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(69, 2, 11, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(70, 2, 12, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(71, 2, 13, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(72, 2, 14, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(73, 2, 15, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(74, 2, 52, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(75, 2, 16, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(76, 2, 17, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(77, 2, 18, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(78, 2, 19, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(79, 2, 20, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(80, 2, 21, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(81, 2, 22, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(82, 2, 23, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(83, 2, 24, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(84, 2, 25, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(85, 2, 26, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(86, 2, 27, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(87, 2, 28, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(88, 2, 29, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(89, 2, 30, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(90, 2, 31, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(91, 2, 32, 'readonly', '2017-02-26 21:58:33', '2017-02-26 21:58:33'),
(94, 2, 35, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(95, 2, 36, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(96, 2, 37, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(97, 2, 38, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(98, 2, 39, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(99, 2, 40, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(100, 2, 41, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(101, 2, 42, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(102, 2, 43, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(103, 2, 44, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(104, 2, 45, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(105, 2, 46, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(106, 2, 47, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(107, 2, 48, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(108, 2, 49, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(109, 2, 50, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(110, 2, 51, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(111, 2, 53, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(113, 2, 55, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(114, 2, 56, 'readonly', '2017-02-26 21:58:34', '2017-02-26 21:58:34'),
(115, 2, 57, 'readonly', '2017-02-26 21:58:35', '2017-02-26 21:58:35'),
(116, 2, 58, 'readonly', '2017-02-26 21:58:35', '2017-02-26 21:58:35'),
(119, 3, 1, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(120, 3, 2, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(121, 3, 3, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(122, 3, 4, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(123, 3, 5, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(124, 3, 6, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(125, 3, 7, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(126, 3, 8, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(127, 3, 9, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(128, 3, 10, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(129, 3, 11, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(130, 3, 12, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(131, 3, 13, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(132, 3, 14, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(133, 3, 15, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(134, 3, 52, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(135, 3, 16, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(136, 3, 17, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(137, 3, 18, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(138, 3, 19, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(139, 3, 20, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(140, 3, 21, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(141, 3, 22, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(142, 3, 23, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(143, 3, 24, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(144, 3, 25, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(145, 3, 26, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(146, 3, 27, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(147, 3, 28, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(148, 3, 29, 'readonly', '2017-02-27 23:00:01', '2017-02-27 23:00:01'),
(149, 3, 30, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(150, 3, 31, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(151, 3, 32, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(154, 3, 35, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(155, 3, 36, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(156, 3, 37, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(157, 3, 38, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(158, 3, 39, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(159, 3, 40, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(160, 3, 41, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(161, 3, 42, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(162, 3, 43, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(163, 3, 44, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(164, 3, 45, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(165, 3, 46, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(166, 3, 47, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(167, 3, 48, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(168, 3, 49, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(169, 3, 50, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(170, 3, 51, 'readonly', '2017-02-27 23:00:02', '2017-02-27 23:00:02'),
(171, 3, 53, 'readonly', '2017-02-27 23:00:03', '2017-02-27 23:00:03'),
(173, 3, 55, 'readonly', '2017-02-27 23:00:03', '2017-02-27 23:00:03'),
(174, 3, 56, 'readonly', '2017-02-27 23:00:03', '2017-02-27 23:00:03'),
(175, 3, 57, 'readonly', '2017-02-27 23:00:03', '2017-02-27 23:00:03'),
(176, 3, 58, 'readonly', '2017-02-27 23:00:03', '2017-02-27 23:00:03'),
(177, 1, 59, 'write', '2017-02-28 16:13:55', '2017-02-28 16:13:55'),
(178, 1, 60, 'write', '2017-02-28 16:15:48', '2017-02-28 16:15:48'),
(179, 1, 61, 'write', '2017-02-28 16:16:59', '2017-02-28 16:16:59'),
(180, 1, 62, 'write', '2017-02-28 16:19:52', '2017-02-28 16:19:52'),
(181, 1, 63, 'write', '2017-02-28 16:20:50', '2017-02-28 16:20:50'),
(182, 1, 64, 'write', '2017-02-28 16:21:33', '2017-02-28 16:21:33'),
(183, 1, 65, 'write', '2017-02-28 16:22:15', '2017-02-28 16:22:15'),
(184, 1, 66, 'write', '2017-03-01 15:33:50', '2017-03-01 15:33:50'),
(200, 1, 84, 'write', '2017-03-01 17:44:57', '2017-03-01 17:44:57'),
(201, 1, 85, 'write', '2017-03-01 17:50:32', '2017-03-01 17:50:32'),
(202, 1, 86, 'write', '2017-03-01 17:54:22', '2017-03-01 17:54:22'),
(203, 1, 87, 'write', '2017-03-01 17:57:13', '2017-03-01 17:57:13'),
(204, 1, 88, 'write', '2017-03-01 17:59:18', '2017-03-01 17:59:18'),
(205, 1, 89, 'write', '2017-03-01 17:59:53', '2017-03-01 17:59:53'),
(206, 1, 90, 'write', '2017-03-01 18:00:48', '2017-03-01 18:00:48'),
(221, 1, 106, 'write', '2017-03-01 21:26:31', '2017-03-01 21:26:31'),
(222, 1, 107, 'write', '2017-03-01 21:27:15', '2017-03-01 21:27:15'),
(223, 1, 108, 'write', '2017-03-01 21:28:04', '2017-03-01 21:28:04'),
(224, 1, 109, 'write', '2017-03-01 21:29:43', '2017-03-01 21:29:43'),
(225, 1, 110, 'write', '2017-03-01 21:30:43', '2017-03-01 21:30:43'),
(226, 1, 111, 'write', '2017-03-01 21:32:00', '2017-03-01 21:32:00'),
(227, 1, 112, 'write', '2017-03-01 21:32:56', '2017-03-01 21:32:56'),
(228, 1, 113, 'write', '2017-03-01 21:38:27', '2017-03-01 21:38:27'),
(229, 1, 114, 'write', '2017-03-01 21:40:04', '2017-03-01 21:40:04'),
(230, 1, 115, 'write', '2017-03-01 21:58:49', '2017-03-01 21:58:49'),
(231, 1, 116, 'write', '2017-03-01 21:59:50', '2017-03-01 21:59:50'),
(232, 1, 117, 'write', '2017-03-01 22:01:24', '2017-03-01 22:01:24'),
(233, 1, 118, 'write', '2017-03-01 22:02:08', '2017-03-01 22:02:08'),
(234, 1, 119, 'write', '2017-03-01 22:02:53', '2017-03-01 22:02:53'),
(235, 1, 120, 'write', '2017-03-01 22:03:38', '2017-03-01 22:03:38'),
(236, 1, 121, 'write', '2017-03-01 22:04:44', '2017-03-01 22:04:44'),
(237, 1, 122, 'write', '2017-03-01 22:45:12', '2017-03-01 22:45:12'),
(238, 1, 123, 'write', '2017-03-01 22:46:14', '2017-03-01 22:46:14'),
(239, 1, 124, 'write', '2017-03-01 22:46:56', '2017-03-01 22:46:56'),
(240, 1, 125, 'write', '2017-03-01 22:57:38', '2017-03-01 22:57:38'),
(241, 1, 126, 'write', '2017-03-01 22:58:36', '2017-03-01 22:58:36'),
(242, 1, 127, 'write', '2017-03-01 23:09:55', '2017-03-01 23:09:55'),
(243, 1, 128, 'write', '2017-03-01 23:10:45', '2017-03-01 23:10:45'),
(245, 1, 130, 'write', '2017-03-01 23:29:12', '2017-03-01 23:29:12'),
(246, 1, 131, 'write', '2017-03-01 23:32:55', '2017-03-01 23:32:55'),
(247, 1, 132, 'write', '2017-03-01 23:39:57', '2017-03-01 23:39:57'),
(248, 1, 133, 'write', '2017-03-03 15:16:47', '2017-03-03 15:16:47'),
(249, 1, 134, 'write', '2017-03-03 15:17:31', '2017-03-03 15:17:31'),
(250, 1, 135, 'write', '2017-03-03 15:18:13', '2017-03-03 15:18:13'),
(251, 1, 136, 'write', '2017-03-03 15:19:06', '2017-03-03 15:19:06'),
(252, 1, 137, 'write', '2017-03-03 15:20:20', '2017-03-03 15:20:20'),
(253, 1, 138, 'write', '2017-03-03 15:21:47', '2017-03-03 15:21:47'),
(254, 1, 139, 'write', '2017-03-03 15:22:26', '2017-03-03 15:22:26'),
(255, 1, 140, 'write', '2017-03-03 15:23:29', '2017-03-03 15:23:29'),
(256, 1, 141, 'write', '2017-03-03 15:34:26', '2017-03-03 15:34:26'),
(257, 1, 142, 'write', '2017-03-03 15:39:18', '2017-03-03 15:39:18'),
(258, 1, 143, 'write', '2017-03-03 15:39:57', '2017-03-03 15:39:57'),
(259, 1, 144, 'write', '2017-03-03 15:40:39', '2017-03-03 15:40:39'),
(260, 1, 145, 'write', '2017-03-03 15:41:34', '2017-03-03 15:41:34'),
(261, 1, 146, 'write', '2017-03-03 15:42:02', '2017-03-03 15:42:02'),
(262, 1, 147, 'write', '2017-03-03 15:42:35', '2017-03-03 15:42:35'),
(263, 1, 148, 'write', '2017-03-03 15:43:15', '2017-03-03 15:43:15'),
(264, 1, 149, 'write', '2017-03-03 16:05:51', '2017-03-03 16:05:51'),
(265, 1, 150, 'write', '2017-03-03 16:08:26', '2017-03-03 16:08:26'),
(266, 1, 151, 'write', '2017-03-03 16:09:09', '2017-03-03 16:09:09'),
(267, 1, 152, 'write', '2017-03-03 16:09:55', '2017-03-03 16:09:55'),
(268, 1, 153, 'write', '2017-03-03 16:10:45', '2017-03-03 16:10:45'),
(269, 1, 154, 'write', '2017-03-03 16:11:36', '2017-03-03 16:11:36'),
(270, 1, 155, 'write', '2017-03-03 16:12:35', '2017-03-03 16:12:35'),
(271, 1, 156, 'write', '2017-03-03 16:13:22', '2017-03-03 16:13:22'),
(272, 1, 157, 'write', '2017-03-03 21:03:02', '2017-03-03 21:03:02'),
(273, 1, 158, 'write', '2017-03-03 21:03:50', '2017-03-03 21:03:50'),
(274, 2, 157, 'invisible', '2017-03-03 21:10:29', '2017-03-03 21:10:29'),
(275, 2, 158, 'invisible', '2017-03-03 21:10:29', '2017-03-03 21:10:29'),
(276, 3, 157, 'invisible', '2017-03-03 21:10:29', '2017-03-03 21:10:29'),
(277, 3, 158, 'invisible', '2017-03-03 21:10:29', '2017-03-03 21:10:29'),
(281, 1, 162, 'write', '2017-03-06 23:42:56', '2017-03-06 23:42:56'),
(283, 1, 164, 'write', '2017-03-07 15:21:40', '2017-03-07 15:21:40'),
(284, 1, 165, 'write', '2017-03-07 15:22:17', '2017-03-07 15:22:17'),
(285, 1, 166, 'write', '2017-03-11 03:46:51', '2017-03-11 03:46:51'),
(286, 1, 167, 'write', '2017-03-11 03:48:36', '2017-03-11 03:48:36'),
(287, 1, 168, 'write', '2017-03-11 04:45:05', '2017-03-11 04:45:05'),
(288, 1, 169, 'write', '2017-03-11 04:46:11', '2017-03-11 04:46:11'),
(289, 1, 170, 'write', '2017-03-11 04:46:32', '2017-03-11 04:46:32'),
(290, 1, 171, 'write', '2017-03-11 04:47:23', '2017-03-11 04:47:23'),
(291, 1, 172, 'write', '2017-03-11 04:47:53', '2017-03-11 04:47:53'),
(292, 1, 173, 'write', '2017-03-11 04:48:31', '2017-03-11 04:48:31'),
(293, 1, 174, 'write', '2017-03-11 04:48:59', '2017-03-11 04:48:59'),
(294, 1, 175, 'write', '2017-03-11 06:20:08', '2017-03-11 06:20:08'),
(295, 1, 176, 'write', '2017-03-11 06:20:36', '2017-03-11 06:20:36'),
(296, 1, 177, 'write', '2017-03-11 06:21:09', '2017-03-11 06:21:09'),
(297, 1, 178, 'write', '2017-03-11 06:31:39', '2017-03-11 06:31:39'),
(298, 1, 179, 'write', '2017-03-11 06:32:06', '2017-03-11 06:32:06'),
(299, 1, 180, 'write', '2017-03-11 06:32:34', '2017-03-11 06:32:34'),
(300, 1, 181, 'write', '2017-03-12 02:49:56', '2017-03-12 02:49:56'),
(301, 1, 182, 'write', '2017-03-12 02:50:35', '2017-03-12 02:50:35'),
(302, 1, 183, 'write', '2017-03-12 02:52:04', '2017-03-12 02:52:04'),
(303, 1, 184, 'write', '2017-03-12 03:07:58', '2017-03-12 03:07:58'),
(304, 1, 185, 'write', '2017-03-12 03:08:40', '2017-03-12 03:08:40'),
(305, 1, 186, 'write', '2017-03-12 03:13:08', '2017-03-12 03:13:08'),
(306, 1, 187, 'write', '2017-03-12 03:13:38', '2017-03-12 03:13:38'),
(307, 1, 188, 'write', '2017-03-12 03:19:02', '2017-03-12 03:19:02'),
(308, 1, 189, 'write', '2017-03-12 03:19:48', '2017-03-12 03:19:48'),
(309, 1, 190, 'write', '2017-03-12 04:34:09', '2017-03-12 04:34:09'),
(310, 1, 191, 'write', '2017-03-12 04:58:57', '2017-03-12 04:58:57'),
(311, 1, 192, 'write', '2017-03-12 04:59:31', '2017-03-12 04:59:31'),
(312, 1, 193, 'write', '2017-03-12 05:03:12', '2017-03-12 05:03:12'),
(313, 1, 194, 'write', '2017-03-12 05:04:16', '2017-03-12 05:04:16'),
(314, 1, 195, 'write', '2017-03-12 05:04:48', '2017-03-12 05:04:48'),
(315, 1, 196, 'write', '2017-03-12 05:16:17', '2017-03-12 05:16:17'),
(316, 1, 197, 'write', '2017-03-12 05:17:20', '2017-03-12 05:17:20'),
(317, 1, 198, 'write', '2017-03-12 05:24:26', '2017-03-12 05:24:26'),
(318, 1, 199, 'write', '2017-03-12 05:25:18', '2017-03-12 05:25:18'),
(319, 1, 200, 'write', '2017-03-12 05:40:16', '2017-03-12 05:40:16'),
(320, 1, 201, 'write', '2017-03-12 05:41:06', '2017-03-12 05:41:06'),
(321, 1, 202, 'write', '2017-03-12 05:42:21', '2017-03-12 05:42:21'),
(322, 1, 203, 'write', '2017-03-12 05:42:59', '2017-03-12 05:42:59'),
(323, 1, 204, 'write', '2017-03-12 05:44:27', '2017-03-12 05:44:27'),
(324, 1, 205, 'write', '2017-03-12 05:45:02', '2017-03-12 05:45:02'),
(325, 1, 206, 'write', '2017-03-12 05:47:05', '2017-03-12 05:47:05'),
(326, 1, 207, 'write', '2017-03-12 05:47:46', '2017-03-12 05:47:46'),
(327, 1, 208, 'write', '2017-03-12 05:48:10', '2017-03-12 05:48:10'),
(328, 1, 209, 'write', '2017-03-12 05:49:41', '2017-03-12 05:49:41'),
(329, 1, 210, 'write', '2017-03-14 05:46:52', '2017-03-14 05:46:52'),
(330, 1, 211, 'write', '2017-03-14 05:47:28', '2017-03-14 05:47:28'),
(331, 1, 212, 'write', '2017-03-14 06:08:19', '2017-03-14 06:08:19'),
(332, 1, 213, 'write', '2017-03-14 06:09:23', '2017-03-14 06:09:23'),
(352, 1, 236, 'write', '2017-03-21 03:11:43', '2017-03-21 03:11:43'),
(354, 1, 239, 'write', '2017-03-22 22:16:13', '2017-03-22 22:16:13'),
(355, 1, 240, 'write', '2017-03-22 22:16:13', '2017-03-22 22:16:13'),
(356, 1, 241, 'write', '2017-03-22 22:16:13', '2017-03-22 22:16:13'),
(357, 1, 242, 'write', '2017-03-22 22:16:13', '2017-03-22 22:16:13'),
(358, 1, 243, 'write', '2017-03-22 22:16:13', '2017-03-22 22:16:13'),
(359, 1, 244, 'write', '2017-03-22 22:16:13', '2017-03-22 22:16:13'),
(360, 1, 245, 'write', '2017-03-22 22:16:13', '2017-03-22 22:16:13'),
(361, 1, 246, 'write', '2017-03-22 22:16:13', '2017-03-22 22:16:13'),
(362, 1, 247, 'write', '2017-03-22 22:16:13', '2017-03-22 22:16:13'),
(363, 1, 248, 'write', '2017-03-22 22:16:13', '2017-03-22 22:16:13'),
(364, 1, 249, 'write', '2017-03-22 22:16:13', '2017-03-22 22:16:13'),
(365, 1, 250, 'write', '2017-03-22 22:16:13', '2017-03-22 22:16:13'),
(366, 1, 251, 'write', '2017-03-22 22:16:13', '2017-03-22 22:16:13'),
(367, 1, 252, 'write', '2017-03-22 22:16:13', '2017-03-22 22:16:13'),
(368, 1, 253, 'write', '2017-03-22 22:16:13', '2017-03-22 22:16:13'),
(369, 1, 254, 'write', '2017-03-22 22:16:13', '2017-03-22 22:16:13'),
(371, 1, 256, 'write', '2017-03-22 22:29:44', '2017-03-22 22:29:44'),
(383, 1, 268, 'write', '2017-03-23 00:23:54', '2017-03-23 00:23:54'),
(384, 1, 270, 'write', '2017-03-23 00:43:29', '2017-03-23 00:43:29'),
(385, 1, 271, 'write', '2017-03-23 00:44:27', '2017-03-23 00:44:27'),
(386, 1, 272, 'write', '2017-03-23 00:45:15', '2017-03-23 00:45:15'),
(387, 1, 273, 'write', '2017-03-23 00:45:52', '2017-03-23 00:45:52'),
(388, 1, 274, 'write', '2017-03-23 00:46:29', '2017-03-23 00:46:29'),
(389, 1, 275, 'write', '2017-03-23 00:47:40', '2017-03-23 00:47:40'),
(390, 1, 276, 'write', '2017-03-23 00:48:32', '2017-03-23 00:48:32'),
(391, 1, 277, 'write', '2017-03-23 00:49:37', '2017-03-23 00:49:37'),
(392, 1, 279, 'write', '2017-03-29 01:30:15', '2017-03-29 01:30:15'),
(393, 1, 280, 'write', '2017-03-29 01:31:20', '2017-03-29 01:31:20'),
(394, 1, 281, 'write', '2017-03-29 02:39:11', '2017-03-29 02:39:11'),
(395, 1, 282, 'write', '2017-03-29 02:40:04', '2017-03-29 02:40:04'),
(396, 1, 283, 'write', '2017-03-29 02:41:05', '2017-03-29 02:41:05'),
(397, 1, 284, 'write', '2017-03-29 02:41:41', '2017-03-29 02:41:41'),
(398, 1, 285, 'write', '2017-03-29 02:42:49', '2017-03-29 02:42:49'),
(399, 1, 286, 'write', '2017-03-29 02:43:15', '2017-03-29 02:43:15'),
(400, 1, 287, 'write', '2017-03-29 02:51:32', '2017-03-29 02:51:32'),
(401, 1, 278, 'write', '2017-03-29 02:54:46', '2017-03-29 02:54:46'),
(402, 1, 288, 'write', '2017-03-30 04:11:00', '2017-03-30 04:11:00'),
(403, 1, 289, 'write', '2017-03-30 04:53:26', '2017-03-30 04:53:26'),
(404, 1, 290, 'write', '2017-03-30 05:06:58', '2017-03-30 05:06:58'),
(405, 1, 291, 'write', '2017-03-30 05:08:16', '2017-03-30 05:08:16'),
(406, 1, 292, 'write', '2017-03-30 05:09:06', '2017-03-30 05:09:06'),
(407, 1, 293, 'write', '2017-04-01 00:33:24', '2017-04-01 00:33:24'),
(410, 1, 296, 'write', '2017-04-01 00:47:29', '2017-04-01 00:47:29'),
(411, 1, 297, 'write', '2017-04-01 00:52:34', '2017-04-01 00:52:34'),
(412, 1, 298, 'write', '2017-04-01 00:57:58', '2017-04-01 00:57:58'),
(413, 1, 299, 'write', '2017-04-01 00:58:41', '2017-04-01 00:58:41'),
(414, 1, 301, 'write', '2017-04-01 03:01:33', '2017-04-01 03:01:33'),
(415, 1, 302, 'write', '2017-04-01 03:02:34', '2017-04-01 03:02:34'),
(416, 1, 303, 'write', '2017-04-01 03:02:58', '2017-04-01 03:02:58'),
(417, 1, 304, 'write', '2017-04-01 03:03:25', '2017-04-01 03:03:25'),
(418, 1, 305, 'write', '2017-04-01 03:04:29', '2017-04-01 03:04:29'),
(419, 1, 306, 'write', '2017-04-01 03:05:31', '2017-04-01 03:05:31'),
(420, 1, 300, 'write', '2017-04-01 03:07:03', '2017-04-01 03:07:03'),
(421, 1, 308, 'write', '2017-04-01 03:27:32', '2017-04-01 03:27:32'),
(422, 1, 309, 'write', '2017-04-01 03:28:00', '2017-04-01 03:28:00'),
(423, 1, 310, 'write', '2017-04-01 03:28:21', '2017-04-01 03:28:21'),
(424, 1, 311, 'write', '2017-04-01 03:29:13', '2017-04-01 03:29:13'),
(425, 1, 312, 'write', '2017-04-01 03:29:53', '2017-04-01 03:29:53'),
(426, 1, 313, 'write', '2017-04-01 03:30:54', '2017-04-01 03:30:54'),
(427, 1, 314, 'write', '2017-04-01 03:31:23', '2017-04-01 03:31:23'),
(428, 1, 315, 'write', '2017-04-01 03:32:02', '2017-04-01 03:32:02'),
(429, 1, 307, 'write', '2017-04-01 03:40:15', '2017-04-01 03:40:15'),
(430, 1, 317, 'write', '2017-04-01 03:53:22', '2017-04-01 03:53:22'),
(431, 1, 318, 'write', '2017-04-01 03:54:12', '2017-04-01 03:54:12'),
(432, 1, 319, 'write', '2017-04-01 03:54:32', '2017-04-01 03:54:32'),
(433, 1, 320, 'write', '2017-04-01 03:55:18', '2017-04-01 03:55:18'),
(434, 1, 321, 'write', '2017-04-01 03:55:43', '2017-04-01 03:55:43'),
(435, 1, 316, 'write', '2017-04-01 03:56:35', '2017-04-01 03:56:35'),
(436, 1, 323, 'write', '2017-04-01 04:20:11', '2017-04-01 04:20:11'),
(437, 1, 324, 'write', '2017-04-01 04:21:38', '2017-04-01 04:21:38'),
(440, 1, 327, 'write', '2017-04-01 04:31:29', '2017-04-01 04:31:29'),
(441, 1, 322, 'write', '2017-04-01 04:32:08', '2017-04-01 04:32:08'),
(442, 1, 329, 'write', '2017-04-01 04:50:36', '2017-04-01 04:50:36'),
(443, 1, 330, 'write', '2017-04-01 04:51:49', '2017-04-01 04:51:49'),
(444, 1, 331, 'write', '2017-04-01 04:52:31', '2017-04-01 04:52:31'),
(445, 1, 328, 'write', '2017-04-01 04:53:09', '2017-04-01 04:53:09'),
(446, 1, 333, 'write', '2017-04-01 05:17:10', '2017-04-01 05:17:10'),
(447, 1, 334, 'write', '2017-04-01 05:19:03', '2017-04-01 05:19:03'),
(448, 1, 332, 'write', '2017-04-01 05:20:26', '2017-04-01 05:20:26'),
(449, 1, 336, 'write', '2017-04-01 05:30:30', '2017-04-01 05:30:30'),
(450, 1, 337, 'write', '2017-04-01 05:31:09', '2017-04-01 05:31:09'),
(451, 1, 340, 'write', '2017-04-01 05:36:34', '2017-04-01 05:36:34'),
(452, 1, 335, 'write', '2017-04-01 05:37:23', '2017-04-01 05:37:23'),
(453, 1, 338, 'write', '2017-04-01 05:37:23', '2017-04-01 05:37:23'),
(454, 1, 339, 'write', '2017-04-01 05:37:23', '2017-04-01 05:37:23'),
(456, 1, 342, 'write', '2017-04-01 21:51:22', '2017-04-01 21:51:22'),
(457, 1, 343, 'write', '2017-04-01 21:52:20', '2017-04-01 21:52:20'),
(458, 1, 344, 'write', '2017-04-01 21:53:37', '2017-04-01 21:53:37'),
(459, 1, 345, 'write', '2017-04-01 21:55:50', '2017-04-01 21:55:50'),
(460, 1, 346, 'write', '2017-04-01 23:14:53', '2017-04-01 23:14:53'),
(461, 1, 347, 'write', '2017-04-01 23:16:05', '2017-04-01 23:16:05'),
(462, 1, 348, 'write', '2017-04-01 23:26:11', '2017-04-01 23:26:11'),
(463, 1, 349, 'write', '2017-04-01 23:26:47', '2017-04-01 23:26:47'),
(464, 1, 350, 'write', '2017-04-02 02:09:46', '2017-04-02 02:09:46'),
(465, 1, 351, 'write', '2017-04-02 02:10:15', '2017-04-02 02:10:15'),
(466, 1, 352, 'write', '2017-04-02 02:10:51', '2017-04-02 02:10:51'),
(467, 1, 353, 'write', '2017-04-02 02:11:36', '2017-04-02 02:11:36'),
(468, 1, 354, 'write', '2017-04-02 02:18:02', '2017-04-02 02:18:02'),
(469, 1, 355, 'write', '2017-04-02 03:40:45', '2017-04-02 03:40:45'),
(471, 1, 357, 'write', '2017-04-02 04:08:55', '2017-04-02 04:08:55'),
(472, 1, 358, 'write', '2017-04-02 04:09:47', '2017-04-02 04:09:47'),
(473, 1, 359, 'write', '2017-04-02 04:10:06', '2017-04-02 04:10:06'),
(475, 1, 362, 'write', '2017-04-02 04:14:00', '2017-04-02 04:14:00'),
(476, 1, 363, 'write', '2017-04-02 04:14:50', '2017-04-02 04:14:50'),
(477, 1, 364, 'write', '2017-04-02 04:15:20', '2017-04-02 04:15:20'),
(480, 1, 367, 'write', '2017-04-02 04:17:33', '2017-04-02 04:17:33'),
(483, 1, 370, 'write', '2017-04-02 04:19:04', '2017-04-02 04:19:04'),
(485, 1, 372, 'write', '2017-04-02 04:21:05', '2017-04-02 04:21:05'),
(487, 1, 374, 'write', '2017-04-02 04:22:29', '2017-04-02 04:22:29'),
(489, 1, 377, 'write', '2017-04-02 04:24:56', '2017-04-02 04:24:56'),
(490, 1, 378, 'write', '2017-04-02 04:26:20', '2017-04-02 04:26:20'),
(491, 1, 379, 'write', '2017-04-02 04:27:04', '2017-04-02 04:27:04'),
(492, 1, 380, 'write', '2017-04-02 04:27:25', '2017-04-02 04:27:25'),
(493, 1, 382, 'write', '2017-04-02 04:28:12', '2017-04-02 04:28:12'),
(494, 1, 383, 'write', '2017-04-02 04:28:25', '2017-04-02 04:28:25'),
(495, 1, 384, 'write', '2017-04-02 04:28:58', '2017-04-02 04:28:58'),
(496, 1, 385, 'write', '2017-04-02 04:29:08', '2017-04-02 04:29:08'),
(497, 1, 375, 'write', '2017-04-02 04:30:10', '2017-04-02 04:30:10'),
(498, 1, 386, 'write', '2017-04-02 04:30:57', '2017-04-02 04:30:57'),
(499, 1, 387, 'write', '2017-04-02 04:30:48', '2017-04-02 04:30:48'),
(500, 1, 388, 'write', '2017-04-02 04:31:37', '2017-04-02 04:31:37'),
(501, 1, 389, 'write', '2017-04-02 04:32:41', '2017-04-02 04:32:41'),
(502, 1, 390, 'write', '2017-04-02 04:32:55', '2017-04-02 04:32:55'),
(503, 1, 391, 'write', '2017-04-02 04:33:24', '2017-04-02 04:33:24'),
(504, 1, 392, 'write', '2017-04-02 04:34:26', '2017-04-02 04:34:26'),
(505, 1, 393, 'write', '2017-04-02 04:35:29', '2017-04-02 04:35:29'),
(506, 1, 394, 'write', '2017-04-02 04:36:25', '2017-04-02 04:36:25'),
(507, 1, 381, 'write', '2017-04-02 04:36:52', '2017-04-02 04:36:52'),
(513, 1, 400, 'write', '2017-04-02 05:48:26', '2017-04-02 05:48:26'),
(514, 1, 402, 'write', '2017-04-02 05:55:14', '2017-04-02 05:55:14'),
(515, 1, 403, 'write', '2017-04-02 05:56:55', '2017-04-02 05:56:55'),
(516, 1, 404, 'write', '2017-04-02 05:58:27', '2017-04-02 05:58:27'),
(517, 1, 405, 'write', '2017-04-02 05:58:58', '2017-04-02 05:58:58'),
(518, 1, 406, 'write', '2017-04-02 06:00:09', '2017-04-02 06:00:09'),
(519, 1, 401, 'write', '2017-04-02 06:10:29', '2017-04-02 06:10:29'),
(525, 1, 412, 'write', '2017-04-02 22:22:06', '2017-04-02 22:22:06'),
(526, 1, 413, 'write', '2017-04-02 22:22:29', '2017-04-02 22:22:29'),
(527, 1, 414, 'write', '2017-04-02 22:23:05', '2017-04-02 22:23:05'),
(528, 1, 415, 'write', '2017-04-02 22:23:57', '2017-04-02 22:23:57'),
(529, 1, 416, 'write', '2017-04-02 22:25:01', '2017-04-02 22:25:01'),
(530, 1, 417, 'write', '2017-04-02 23:37:47', '2017-04-02 23:37:47'),
(531, 1, 418, 'write', '2017-04-02 23:39:31', '2017-04-02 23:39:31'),
(532, 1, 419, 'write', '2017-04-02 23:41:15', '2017-04-02 23:41:15'),
(533, 1, 420, 'write', '2017-04-02 23:43:09', '2017-04-02 23:43:09'),
(534, 1, 421, 'write', '2017-04-02 23:43:34', '2017-04-02 23:43:34'),
(535, 1, 422, 'write', '2017-04-02 23:44:42', '2017-04-02 23:44:42'),
(536, 1, 423, 'write', '2017-04-02 23:47:47', '2017-04-02 23:47:47'),
(539, 1, 426, 'write', '2017-04-02 23:52:30', '2017-04-02 23:52:30'),
(540, 1, 427, 'write', '2017-04-03 22:12:29', '2017-04-03 22:12:29'),
(541, 1, 428, 'write', '2017-04-03 23:27:59', '2017-04-03 23:27:59'),
(542, 1, 429, 'write', '2017-04-03 23:29:35', '2017-04-03 23:29:35'),
(543, 1, 430, 'write', '2017-04-03 23:30:41', '2017-04-03 23:30:41'),
(544, 1, 431, 'write', '2017-04-03 23:31:31', '2017-04-03 23:31:31'),
(545, 1, 432, 'write', '2017-04-03 23:32:03', '2017-04-03 23:32:03'),
(546, 1, 433, 'write', '2017-04-03 23:33:06', '2017-04-03 23:33:06'),
(547, 1, 434, 'write', '2017-04-03 23:34:01', '2017-04-03 23:34:01'),
(548, 1, 435, 'write', '2017-04-03 23:37:20', '2017-04-03 23:37:20'),
(549, 1, 436, 'write', '2017-04-03 23:39:01', '2017-04-03 23:39:01'),
(550, 1, 437, 'write', '2017-04-04 00:32:58', '2017-04-04 00:32:58'),
(566, 1, 453, 'write', '2017-04-05 00:38:28', '2017-04-05 00:38:28'),
(567, 1, 454, 'write', '2017-04-05 02:37:26', '2017-04-05 02:37:26'),
(568, 1, 455, 'write', '2017-04-05 02:39:21', '2017-04-05 02:39:21'),
(569, 1, 456, 'write', '2017-04-05 02:44:15', '2017-04-05 02:44:15'),
(570, 1, 458, 'write', '2017-04-05 05:31:51', '2017-04-05 05:31:51'),
(571, 1, 459, 'write', '2017-04-05 05:34:43', '2017-04-05 05:34:43'),
(572, 1, 460, 'write', '2017-04-05 05:35:12', '2017-04-05 05:35:12'),
(573, 1, 457, 'write', '2017-04-05 05:37:11', '2017-04-05 05:37:11'),
(574, 1, 461, 'write', '2017-04-05 22:42:41', '2017-04-05 22:42:41'),
(575, 1, 463, 'write', '2017-04-08 05:39:34', '2017-04-08 05:39:34'),
(576, 1, 464, 'write', '2017-04-08 05:40:11', '2017-04-08 05:40:11'),
(577, 1, 465, 'write', '2017-04-08 05:41:03', '2017-04-08 05:41:03'),
(578, 1, 466, 'write', '2017-04-08 05:42:36', '2017-04-08 05:42:36'),
(579, 1, 467, 'write', '2017-04-08 05:43:20', '2017-04-08 05:43:20'),
(580, 1, 462, 'write', '2017-04-08 05:44:12', '2017-04-08 05:44:12'),
(581, 1, 468, 'write', '2017-04-08 22:01:31', '2017-04-08 22:01:31'),
(582, 1, 469, 'write', '2017-04-08 22:02:15', '2017-04-08 22:02:15'),
(583, 1, 470, 'write', '2017-04-08 22:02:38', '2017-04-08 22:02:38'),
(584, 1, 471, 'write', '2017-04-08 22:18:05', '2017-04-08 22:18:05'),
(585, 1, 472, 'write', '2017-04-08 22:19:50', '2017-04-08 22:19:50'),
(586, 1, 473, 'write', '2017-04-08 22:22:13', '2017-04-08 22:22:13'),
(587, 1, 474, 'write', '2017-04-08 22:22:39', '2017-04-08 22:22:39'),
(588, 1, 475, 'write', '2017-04-08 22:23:19', '2017-04-08 22:23:19'),
(589, 1, 476, 'write', '2017-04-08 22:23:40', '2017-04-08 22:23:40'),
(590, 1, 477, 'write', '2017-04-08 23:57:50', '2017-04-08 23:57:50'),
(591, 1, 478, 'write', '2017-04-09 00:05:11', '2017-04-09 00:05:11'),
(592, 1, 479, 'write', '2017-04-09 00:06:00', '2017-04-09 00:06:00'),
(593, 1, 480, 'write', '2017-04-09 00:07:49', '2017-04-09 00:07:49'),
(594, 1, 481, 'write', '2017-04-09 03:47:08', '2017-04-09 03:47:08'),
(595, 1, 482, 'write', '2017-04-09 03:48:07', '2017-04-09 03:48:07'),
(596, 1, 483, 'write', '2017-04-09 04:59:53', '2017-04-09 04:59:53'),
(597, 1, 484, 'write', '2017-04-09 05:18:17', '2017-04-09 05:18:17'),
(598, 1, 485, 'write', '2017-04-10 00:36:41', '2017-04-10 00:36:41'),
(599, 1, 486, 'write', '2017-04-10 00:37:59', '2017-04-10 00:37:59'),
(600, 1, 487, 'write', '2017-04-10 00:38:21', '2017-04-10 00:38:21'),
(601, 1, 488, 'write', '2017-04-10 02:13:28', '2017-04-10 02:13:28'),
(602, 1, 489, 'write', '2017-04-11 05:06:50', '2017-04-11 05:06:50'),
(603, 1, 490, 'write', '2017-04-11 05:08:10', '2017-04-11 05:08:10'),
(604, 1, 491, 'write', '2017-04-11 05:09:30', '2017-04-11 05:09:30'),
(605, 1, 492, 'write', '2017-04-11 05:12:44', '2017-04-11 05:12:44'),
(606, 1, 493, 'write', '2017-04-11 23:08:47', '2017-04-11 23:08:47'),
(607, 1, 494, 'write', '2017-04-11 23:09:34', '2017-04-11 23:09:34'),
(608, 1, 495, 'write', '2017-04-11 23:10:03', '2017-04-11 23:10:03'),
(609, 1, 496, 'write', '2017-04-11 23:11:53', '2017-04-11 23:11:53'),
(610, 1, 497, 'write', '2017-04-11 23:12:29', '2017-04-11 23:12:29'),
(611, 1, 498, 'write', '2017-04-11 23:13:10', '2017-04-11 23:13:10'),
(612, 1, 499, 'write', '2017-04-11 23:13:52', '2017-04-11 23:13:52'),
(613, 1, 500, 'write', '2017-04-12 03:52:08', '2017-04-12 03:52:08'),
(614, 1, 501, 'write', '2017-04-13 00:57:50', '2017-04-13 00:57:50'),
(615, 1, 502, 'write', '2017-04-15 22:03:04', '2017-04-15 22:03:04'),
(616, 1, 503, 'write', '2017-04-15 22:04:34', '2017-04-15 22:04:34'),
(617, 1, 505, 'write', '2017-04-15 22:39:40', '2017-04-15 22:39:40'),
(618, 1, 506, 'write', '2017-04-17 02:17:22', '2017-04-17 02:17:22'),
(619, 1, 507, 'write', '2017-04-17 23:41:46', '2017-04-17 23:41:46'),
(620, 1, 508, 'write', '2017-04-17 23:42:48', '2017-04-17 23:42:48'),
(621, 1, 509, 'write', '2017-04-17 23:43:43', '2017-04-17 23:43:43'),
(622, 1, 510, 'write', '2017-04-19 05:13:34', '2017-04-19 05:13:34'),
(623, 1, 511, 'write', '2017-04-19 05:24:26', '2017-04-19 05:24:26'),
(624, 1, 512, 'write', '2017-04-22 03:56:47', '2017-04-22 03:56:47'),
(625, 1, 513, 'write', '2017-04-22 06:30:05', '2017-04-22 06:30:05'),
(626, 1, 515, 'write', '2017-04-23 00:28:54', '2017-04-23 00:28:54'),
(627, 1, 516, 'write', '2017-04-23 00:37:26', '2017-04-23 00:37:26'),
(628, 1, 517, 'write', '2017-04-23 00:37:52', '2017-04-23 00:37:52'),
(629, 1, 518, 'write', '2017-04-23 00:39:23', '2017-04-23 00:39:23'),
(630, 1, 519, 'write', '2017-04-23 00:42:17', '2017-04-23 00:42:17'),
(631, 1, 514, 'write', '2017-04-23 00:43:09', '2017-04-23 00:43:09'),
(632, 1, 521, 'write', '2017-04-23 01:15:33', '2017-04-23 01:15:33'),
(633, 1, 522, 'write', '2017-04-23 01:16:19', '2017-04-23 01:16:19'),
(634, 1, 523, 'write', '2017-04-23 01:16:40', '2017-04-23 01:16:40'),
(635, 1, 520, 'write', '2017-04-23 01:17:41', '2017-04-23 01:17:41'),
(636, 1, 524, 'write', '2017-04-26 03:53:01', '2017-04-26 03:53:01'),
(637, 1, 525, 'write', '2017-04-26 03:54:05', '2017-04-26 03:54:05'),
(638, 1, 526, 'write', '2017-04-26 04:01:24', '2017-04-26 04:01:24'),
(639, 1, 527, 'write', '2017-04-26 04:07:22', '2017-04-26 04:07:22'),
(640, 1, 529, 'write', '2017-04-27 02:58:48', '2017-04-27 02:58:48'),
(641, 1, 530, 'write', '2017-04-27 02:59:56', '2017-04-27 02:59:56'),
(642, 1, 528, 'write', '2017-04-27 03:00:04', '2017-04-27 03:00:04'),
(643, 1, 532, 'write', '2017-04-27 04:32:35', '2017-04-27 04:32:35'),
(644, 1, 533, 'write', '2017-04-27 04:33:20', '2017-04-27 04:33:20'),
(645, 1, 534, 'write', '2017-04-27 04:34:43', '2017-04-27 04:34:43'),
(646, 1, 531, 'write', '2017-04-27 04:35:03', '2017-04-27 04:35:03'),
(647, 1, 536, 'write', '2017-04-27 05:50:25', '2017-04-27 05:50:25'),
(648, 1, 537, 'write', '2017-04-27 05:52:26', '2017-04-27 05:52:26'),
(649, 1, 538, 'write', '2017-04-27 05:53:17', '2017-04-27 05:53:17'),
(650, 1, 535, 'write', '2017-04-27 05:53:35', '2017-04-27 05:53:35'),
(651, 1, 539, 'write', '2017-05-02 22:55:37', '2017-05-02 22:55:37'),
(652, 1, 540, 'write', '2017-05-02 22:56:31', '2017-05-02 22:56:31'),
(653, 1, 542, 'write', '2017-05-02 23:05:27', '2017-05-02 23:05:27'),
(654, 1, 543, 'write', '2017-05-02 23:07:00', '2017-05-02 23:07:00'),
(655, 1, 541, 'write', '2017-05-02 23:07:19', '2017-05-02 23:07:19'),
(656, 1, 544, 'write', '2017-05-06 23:30:59', '2017-05-06 23:30:59'),
(657, 1, 545, 'write', '2017-05-07 00:16:10', '2017-05-07 00:16:10'),
(658, 1, 547, 'write', '2017-05-15 00:36:45', '2017-05-15 00:36:45'),
(659, 1, 546, 'write', '2017-05-15 21:44:23', '2017-05-15 21:44:23'),
(660, 1, 549, 'write', '2017-05-16 02:04:14', '2017-05-16 02:04:14'),
(661, 1, 550, 'write', '2017-05-16 02:05:08', '2017-05-16 02:05:08'),
(662, 1, 548, 'write', '2017-05-16 02:05:55', '2017-05-16 02:05:55'),
(663, 1, 551, 'write', '2017-05-16 04:12:56', '2017-05-16 04:12:56'),
(664, 1, 552, 'write', '2017-05-18 00:39:49', '2017-05-18 00:39:49'),
(665, 1, 553, 'write', '2017-05-18 00:41:28', '2017-05-18 00:41:28'),
(666, 1, 554, 'write', '2017-05-18 00:52:18', '2017-05-18 00:52:18'),
(667, 1, 555, 'write', '2017-05-18 00:53:38', '2017-05-18 00:53:38'),
(668, 1, 556, 'write', '2017-05-18 00:55:04', '2017-05-18 00:55:04'),
(669, 1, 557, 'write', '2017-05-18 00:56:06', '2017-05-18 00:56:06'),
(670, 1, 558, 'write', '2017-05-18 00:57:51', '2017-05-18 00:57:51'),
(671, 1, 559, 'write', '2017-05-18 00:58:39', '2017-05-18 00:58:39'),
(672, 1, 560, 'write', '2017-05-18 00:59:14', '2017-05-18 00:59:14'),
(673, 1, 561, 'write', '2017-05-18 00:59:48', '2017-05-18 00:59:48'),
(674, 1, 562, 'write', '2017-05-18 01:01:41', '2017-05-18 01:01:41'),
(677, 1, 565, 'write', '2017-05-19 22:29:07', '2017-05-19 22:29:07'),
(678, 1, 566, 'write', '2017-05-19 22:37:26', '2017-05-19 22:37:26'),
(679, 1, 567, 'write', '2017-05-19 22:38:55', '2017-05-19 22:38:55'),
(683, 1, 571, 'write', '2017-05-19 23:39:38', '2017-05-19 23:39:38'),
(684, 1, 572, 'write', '2017-05-19 23:40:37', '2017-05-19 23:40:37'),
(691, 1, 573, 'write', '2017-05-20 00:40:21', '2017-05-20 00:40:21'),
(693, 1, 581, 'write', '2017-05-20 01:04:57', '2017-05-20 01:04:57'),
(694, 1, 582, 'write', '2017-05-20 01:05:32', '2017-05-20 01:05:32'),
(695, 1, 583, 'write', '2017-05-20 01:06:12', '2017-05-20 01:06:12'),
(696, 1, 584, 'write', '2017-05-20 02:05:56', '2017-05-20 02:05:56'),
(697, 1, 585, 'write', '2017-05-20 02:09:27', '2017-05-20 02:09:27'),
(698, 1, 586, 'write', '2017-05-20 02:09:53', '2017-05-20 02:09:53'),
(699, 1, 587, 'write', '2017-05-20 02:11:24', '2017-05-20 02:11:24'),
(700, 1, 588, 'write', '2017-05-22 03:03:07', '2017-05-22 03:03:07'),
(701, 1, 589, 'write', '2017-05-22 03:04:08', '2017-05-22 03:04:08'),
(702, 1, 590, 'write', '2017-05-22 03:04:40', '2017-05-22 03:04:40'),
(703, 1, 591, 'write', '2017-05-22 03:05:07', '2017-05-22 03:05:07'),
(704, 1, 592, 'write', '2017-05-22 03:05:29', '2017-05-22 03:05:29'),
(705, 1, 593, 'write', '2017-05-22 03:06:13', '2017-05-22 03:06:13'),
(706, 1, 594, 'write', '2017-05-22 03:06:37', '2017-05-22 03:06:37'),
(707, 1, 595, 'write', '2017-05-22 03:08:45', '2017-05-22 03:08:45'),
(708, 1, 596, 'write', '2017-05-22 03:09:28', '2017-05-22 03:09:28'),
(709, 1, 597, 'write', '2017-05-22 03:09:52', '2017-05-22 03:09:52'),
(710, 1, 598, 'write', '2017-05-22 04:02:27', '2017-05-22 04:02:27'),
(711, 1, 599, 'write', '2017-05-22 04:05:58', '2017-05-22 04:05:58'),
(712, 1, 600, 'write', '2017-05-22 04:09:03', '2017-05-22 04:09:03'),
(713, 1, 601, 'write', '2017-05-22 04:10:59', '2017-05-22 04:10:59'),
(714, 1, 602, 'write', '2017-05-22 04:12:01', '2017-05-22 04:12:01'),
(715, 1, 603, 'write', '2017-05-22 04:12:26', '2017-05-22 04:12:26'),
(716, 1, 604, 'write', '2017-05-22 04:13:19', '2017-05-22 04:13:19'),
(717, 1, 605, 'write', '2017-05-22 04:13:52', '2017-05-22 04:13:52'),
(718, 1, 606, 'write', '2017-05-22 23:49:59', '2017-05-22 23:49:59'),
(719, 1, 607, 'write', '2017-05-22 23:50:26', '2017-05-22 23:50:26'),
(720, 1, 608, 'write', '2017-05-23 06:19:36', '2017-05-23 06:19:36'),
(722, 1, 611, 'write', '2017-05-23 22:32:23', '2017-05-23 22:32:23'),
(723, 1, 612, 'write', '2017-05-23 22:34:26', '2017-05-23 22:34:26'),
(724, 1, 613, 'write', '2017-05-23 22:36:53', '2017-05-23 22:36:53'),
(725, 1, 614, 'write', '2017-05-23 22:37:42', '2017-05-23 22:37:42'),
(726, 1, 615, 'write', '2017-05-23 22:38:46', '2017-05-23 22:38:46'),
(727, 1, 616, 'write', '2017-05-23 22:41:08', '2017-05-23 22:41:08'),
(728, 1, 617, 'write', '2017-05-23 22:41:42', '2017-05-23 22:41:42'),
(729, 1, 618, 'write', '2017-05-23 22:43:14', '2017-05-23 22:43:14'),
(730, 1, 619, 'write', '2017-05-23 22:43:53', '2017-05-23 22:43:53'),
(731, 1, 620, 'write', '2017-05-23 22:48:58', '2017-05-23 22:48:58'),
(732, 1, 621, 'write', '2017-05-25 03:08:43', '2017-05-25 03:08:43'),
(733, 1, 624, 'write', '2017-05-25 03:22:22', '2017-05-25 03:22:22'),
(735, 1, 626, 'write', '2017-05-25 04:56:46', '2017-05-25 04:56:46'),
(737, 1, 628, 'write', '2017-05-28 23:04:28', '2017-05-28 23:04:28'),
(738, 1, 629, 'write', '2017-05-28 23:06:58', '2017-05-28 23:06:58'),
(739, 1, 630, 'write', '2017-05-28 23:07:32', '2017-05-28 23:07:32'),
(740, 1, 631, 'write', '2017-05-28 23:08:33', '2017-05-28 23:08:33'),
(741, 1, 632, 'write', '2017-05-28 23:14:28', '2017-05-28 23:14:28'),
(742, 1, 633, 'write', '2017-05-28 23:24:21', '2017-05-28 23:24:21'),
(743, 1, 634, 'write', '2017-05-28 23:25:16', '2017-05-28 23:25:16'),
(744, 1, 635, 'write', '2017-05-28 23:26:08', '2017-05-28 23:26:08'),
(745, 1, 636, 'write', '2017-05-28 23:27:17', '2017-05-28 23:27:17'),
(746, 1, 637, 'write', '2017-05-28 23:29:01', '2017-05-28 23:29:01'),
(747, 1, 638, 'write', '2017-05-28 23:29:34', '2017-05-28 23:29:34'),
(748, 1, 639, 'write', '2017-05-28 23:29:57', '2017-05-28 23:29:57'),
(749, 1, 640, 'write', '2017-05-28 23:48:31', '2017-05-28 23:48:31'),
(750, 1, 641, 'write', '2017-05-28 23:50:15', '2017-05-28 23:50:15'),
(751, 1, 642, 'write', '2017-05-28 23:50:54', '2017-05-28 23:50:54'),
(752, 1, 643, 'write', '2017-05-28 23:52:33', '2017-05-28 23:52:33'),
(753, 1, 644, 'write', '2017-05-28 23:54:09', '2017-05-28 23:54:09'),
(754, 1, 645, 'write', '2017-05-28 23:56:38', '2017-05-28 23:56:38'),
(755, 1, 646, 'write', '2017-05-28 23:57:02', '2017-05-28 23:57:02'),
(757, 1, 651, 'write', '2017-05-31 02:49:19', '2017-05-31 02:49:19'),
(759, 1, 653, 'write', '2017-06-12 03:12:07', '2017-06-12 03:12:07'),
(760, 1, 654, 'write', '2017-06-12 03:13:19', '2017-06-12 03:13:19'),
(761, 1, 655, 'write', '2017-06-12 03:15:13', '2017-06-12 03:15:13'),
(762, 1, 656, 'write', '2017-06-12 03:16:42', '2017-06-12 03:16:42'),
(763, 1, 657, 'write', '2017-06-12 03:20:13', '2017-06-12 03:20:13'),
(764, 1, 658, 'write', '2017-06-12 03:21:09', '2017-06-12 03:21:09'),
(765, 1, 659, 'write', '2017-06-19 02:10:42', '2017-06-19 02:10:42'),
(766, 1, 660, 'write', '2017-06-19 02:13:10', '2017-06-19 02:13:10'),
(767, 1, 661, 'write', '2017-06-19 02:13:33', '2017-06-19 02:13:33'),
(768, 1, 662, 'write', '2017-06-19 02:50:40', '2017-06-19 02:50:40'),
(769, 1, 663, 'write', '2017-06-19 03:20:55', '2017-06-19 03:20:55'),
(770, 1, 664, 'write', '2017-06-19 03:21:29', '2017-06-19 03:21:29'),
(771, 1, 665, 'write', '2017-06-19 22:59:08', '2017-06-19 22:59:08'),
(772, 1, 666, 'write', '2017-06-21 20:57:51', '2017-06-21 20:57:51'),
(773, 1, 667, 'write', '2017-06-21 23:34:49', '2017-06-21 23:34:49'),
(774, 1, 668, 'write', '2017-07-23 02:23:34', '2017-07-23 02:23:34'),
(775, 1, 669, 'write', '2017-07-30 03:55:45', '2017-07-30 03:55:45'),
(776, 1, 670, 'write', '2017-07-30 04:15:12', '2017-07-30 04:15:12'),
(777, 1, 671, 'write', '2017-08-02 05:16:49', '2017-08-02 05:16:49'),
(778, 1, 672, 'write', '2017-08-14 00:25:32', '2017-08-14 00:25:32'),
(779, 1, 673, 'write', '2017-08-23 03:13:30', '2017-08-23 03:13:30'),
(781, 1, 675, 'write', '2017-08-23 03:33:53', '2017-08-23 03:33:53'),
(782, 1, 676, 'write', '2017-08-23 03:35:04', '2017-08-23 03:35:04'),
(783, 1, 677, 'write', '2017-08-23 03:36:34', '2017-08-23 03:36:34'),
(784, 1, 679, 'write', '2017-09-14 04:35:17', '2017-09-14 04:35:17'),
(785, 1, 680, 'write', '2017-09-14 04:36:53', '2017-09-14 04:36:53'),
(786, 1, 681, 'write', '2017-09-14 04:41:43', '2017-09-14 04:41:43'),
(787, 1, 682, 'write', '2017-09-14 04:48:17', '2017-09-14 04:48:17'),
(788, 1, 683, 'write', '2017-09-14 04:49:07', '2017-09-14 04:49:07'),
(789, 1, 684, 'write', '2017-09-14 04:49:38', '2017-09-14 04:49:38'),
(792, 1, 687, 'write', '2017-09-27 05:01:29', '2017-09-27 05:01:29');

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE IF NOT EXISTS `role_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `role_id` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `role_users_user_id_foreign` (`user_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`id`, `deleted_at`, `created_at`, `updated_at`, `user_id`, `role_id`) VALUES
(1, NULL, '2017-05-20 02:29:02', '2017-05-20 02:29:02', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `upazillas`
--

CREATE TABLE IF NOT EXISTS `upazillas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `district_id` int(10) unsigned NOT NULL DEFAULT '1',
  `upazilla_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upazillas_district_id_foreign` (`district_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=536 ;

--
-- Dumping data for table `upazillas`
--

INSERT INTO `upazillas` (`id`, `deleted_at`, `created_at`, `updated_at`, `district_id`, `upazilla_name`) VALUES
(1, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 51, 'Muladi'),
(2, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 51, 'Babuganj'),
(3, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 51, 'Airport'),
(4, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 51, 'Agailjhara'),
(5, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 51, 'Sadar'),
(6, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 51, 'Bakerganj'),
(7, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 51, 'Banaripara'),
(8, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 51, 'Gaurnadi'),
(9, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 51, 'Hizla'),
(10, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 51, 'Mehendiganj'),
(11, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 51, 'Wazirpur'),
(12, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 53, 'Amtali'),
(13, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 53, 'Bamna'),
(14, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 53, 'Sadar'),
(15, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 53, 'Betagi'),
(16, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 53, 'Patharghata'),
(17, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 53, 'Taltali'),
(18, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 52, 'Sadar'),
(19, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 52, 'Daulatkhan'),
(20, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 52, 'Burhanuddin'),
(21, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 52, 'Tazumuddin'),
(22, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 52, 'Lalmohan'),
(23, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 52, 'Char Fasson'),
(24, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 52, 'Manpura'),
(25, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 56, 'Sadar'),
(26, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 56, 'Kathalia'),
(27, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 56, 'Nalchity'),
(28, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 56, 'Rajapur'),
(29, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 55, 'Kalapara'),
(30, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 55, 'Mirzaganj'),
(31, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 55, 'Sadar'),
(32, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 55, 'Dumki'),
(33, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 55, 'Rangabali'),
(34, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 55, 'Bauphal'),
(35, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 55, 'Dashmina'),
(36, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 55, 'Galachipa'),
(37, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 54, 'Bhandaria'),
(38, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 54, 'Kawkhali'),
(39, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 54, 'Mathbaria'),
(40, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 54, 'Nazirpur'),
(41, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 54, 'Nesarabad'),
(42, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 54, 'Sadar'),
(43, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 54, 'Zianagar'),
(44, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 26, 'Sadar'),
(45, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 26, 'Ashuganj'),
(46, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 26, 'Nasirnagar'),
(47, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 26, 'Nabinagar'),
(48, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 26, 'Sarail'),
(49, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 26, 'Kasba'),
(50, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 26, 'Akhaura'),
(51, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 26, 'Bancharampur'),
(52, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 26, 'Bijoynagar'),
(53, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 27, 'Meghna'),
(54, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 27, 'Muradnagar'),
(55, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 27, 'Nangalkot'),
(56, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 27, 'Comilla Sadar Dakshin Upazila'),
(57, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 27, 'Titas'),
(58, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 27, 'Barura'),
(59, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 27, 'Brahmanpara'),
(60, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 27, 'Burichong'),
(61, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 27, 'Chandina'),
(62, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 27, 'Chauddagram'),
(63, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 27, 'Daudkandi'),
(64, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 27, 'Debidwar'),
(65, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 27, 'Homna'),
(66, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 27, 'Sadar'),
(67, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 27, 'Laksam'),
(68, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 27, 'Monohorgonj'),
(69, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 21, 'Sadar'),
(70, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 21, 'Faridganj'),
(71, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 21, 'Haimchar'),
(72, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 21, 'Haziganj'),
(73, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 21, 'Kachua'),
(74, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 21, 'Matlab Uttar Upazila'),
(75, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 21, 'Matlab Dakkhin'),
(76, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 21, 'Shahrasti'),
(77, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 19, 'Sadar'),
(78, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 19, 'Raipur'),
(79, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 19, 'Ramganj'),
(80, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 19, 'Ramgati'),
(81, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 19, 'Kamalnagar'),
(82, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 20, 'Sadar'),
(83, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 20, 'Begumganj'),
(84, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 20, 'Chatkhil'),
(85, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 20, 'Companiganj'),
(86, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 20, 'Senbagh'),
(87, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 20, 'Hatiya'),
(88, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 20, 'Kabirhat'),
(89, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 20, 'Sonaimuri'),
(90, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 20, 'Suborno Char'),
(91, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 25, 'Parshuram'),
(92, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 25, 'Sadar'),
(93, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 25, 'Fulgazi'),
(94, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 25, 'Sonagazi'),
(95, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 25, 'Chagalnaiya'),
(96, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 25, 'Daganbhuiyan'),
(97, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 22, 'Anwara'),
(98, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 22, 'Banshkhali'),
(99, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 22, 'Boalkhali'),
(100, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 22, 'Chandanaish'),
(101, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 22, 'Fatikchhari'),
(102, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 22, 'Hathazari'),
(103, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 22, 'Lohagara'),
(104, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 22, 'Mirsharai'),
(105, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 22, 'Patiya'),
(106, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 22, 'Rangunia'),
(107, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 22, 'Raozan'),
(108, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 22, 'Sandwip'),
(109, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 22, 'Satkania'),
(110, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 22, 'Sitakunda'),
(111, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 18, 'Dighinala'),
(112, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 18, 'Sadar'),
(113, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 18, 'Lakshmichhari'),
(114, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 18, 'Mahalchhari'),
(115, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 18, 'Manikchhari'),
(116, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 18, 'Matiranga'),
(117, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 18, 'Panchhari'),
(118, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 18, 'Ramgarh'),
(119, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 23, 'kaukhali'),
(120, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 23, 'Sadar'),
(121, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 23, 'Belaichhari'),
(122, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 23, 'Bagaichhari'),
(123, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 23, 'Barkal'),
(124, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 23, 'Juraichhari'),
(125, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 23, 'Rajasthali'),
(126, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 23, 'Kaptai'),
(127, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 23, 'Langadu'),
(128, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 23, 'Naniarchar'),
(129, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 24, 'Sadar'),
(130, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 24, 'Thanchi'),
(131, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 24, 'Lama'),
(132, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 24, 'Naikhongchhari'),
(133, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 24, 'Ali kadam'),
(134, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 24, 'Rowangchhari'),
(135, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 24, 'Ruma'),
(136, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 28, 'Chakaria'),
(137, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 28, 'Sadar'),
(138, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 28, 'Kutubdia'),
(139, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 28, 'Maheshkhali'),
(140, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 28, 'Ramu'),
(141, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 28, 'Teknaf'),
(142, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 28, 'Ukhia'),
(143, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 28, 'Pekua'),
(144, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Gendaria'),
(145, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Khilkhet'),
(146, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Gulshan'),
(147, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Khilgaon'),
(148, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Hazaribagh'),
(149, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Lalbagh'),
(150, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Jatrabari'),
(151, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Mirpur'),
(152, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Kadamtali'),
(153, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Mohammadpur'),
(154, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Motijheel'),
(155, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Kafrul'),
(156, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'New Market'),
(157, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Kalabagan'),
(158, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Pallabi'),
(159, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Kamringir Char'),
(160, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Paltan'),
(161, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Ramna'),
(162, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Rampura'),
(163, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Sabujbagh'),
(164, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Shah Ali'),
(165, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Shahbagh'),
(166, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Sher-e-Bangla Nagor'),
(167, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Shyampur'),
(168, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Sutrapur'),
(169, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Dhamrai'),
(170, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Tejgaon'),
(171, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Dohar'),
(172, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Tejgaon Industrial Area'),
(173, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Keraniganj'),
(174, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Turag'),
(175, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Nawabganj'),
(176, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Uttar Khan'),
(177, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Savar'),
(178, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Uttara'),
(179, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Adabor'),
(180, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Badda'),
(181, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Biman Bandar'),
(182, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Bangshal'),
(183, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Cantonment'),
(184, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Chawkbazar Model'),
(185, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Dakshinkhan'),
(186, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Darus Salam'),
(187, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Dhanmondi'),
(188, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Demra'),
(189, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 7, 'Kotwali'),
(190, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 6, 'Sadar'),
(191, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 6, 'Boalmari'),
(192, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 6, 'Alfadanga'),
(193, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 6, 'Bhanga'),
(194, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 6, 'Nagarkanda'),
(195, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 6, 'Charbhadrasan'),
(196, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 6, 'Sadarpur'),
(197, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 6, 'Shaltha'),
(198, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 3, 'Sadar'),
(199, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 3, 'Tongi'),
(200, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 3, 'Sreepur'),
(201, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 3, 'Kaliakoir'),
(202, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 3, 'Kapasia'),
(203, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 3, 'Kaligonj'),
(204, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 2, 'Sadar'),
(205, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 2, 'Kashiani'),
(206, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 2, 'Kotalipara Upazila'),
(207, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 2, 'Muksudpur Upazila'),
(208, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 2, 'Tungipara Upazila'),
(209, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 8, 'Astagram'),
(210, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 8, 'Bajitpur'),
(211, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 8, 'Bhairab'),
(212, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 8, 'Hossainpur'),
(213, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 8, 'Itna'),
(214, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 8, 'Karimganj'),
(215, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 8, 'Katiadi'),
(216, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 8, 'Sadar'),
(217, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 8, 'Kuliarchar'),
(218, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 8, 'Mithamain'),
(219, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 8, 'Nikli'),
(220, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 8, 'Pakundia'),
(221, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 8, 'Tarail'),
(222, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 11, 'Sadar'),
(223, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 11, 'Kalkini'),
(224, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 11, 'Rajoir'),
(225, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 11, 'Shibchar'),
(226, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 14, 'Harirampur'),
(227, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 14, 'Ghior'),
(228, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 14, 'Daulatpur'),
(229, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 14, 'Sadar'),
(230, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 14, 'Singair'),
(231, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 14, 'Shibalaya'),
(232, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 14, 'Saturia'),
(233, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 12, 'Lohajang'),
(234, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 12, 'Sreenagar'),
(235, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 12, 'Sadar'),
(236, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 12, 'Sirajdikhan'),
(237, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 12, 'Tongibari'),
(238, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 12, 'Gazaria'),
(239, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 5, 'Araihazar'),
(240, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 5, 'Sonargaon'),
(241, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 5, 'Bandar'),
(242, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 5, 'Sadar'),
(243, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 5, 'Rupganj'),
(244, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 15, 'Belabo'),
(245, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 15, 'Monohardi'),
(246, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 15, 'Sadar'),
(247, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 15, 'Palash'),
(248, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 15, 'Raipura'),
(249, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 15, 'Shibpur'),
(250, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 4, 'Baliakandi'),
(251, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 4, 'Goalandaghat'),
(252, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 4, 'Pangsha'),
(253, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 4, 'Kalukhali'),
(254, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 4, 'Sadar'),
(255, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 10, 'Sadar'),
(256, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 10, 'Damudya'),
(257, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 10, 'Naria'),
(258, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 10, 'Zajira'),
(259, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 10, 'Bhedarganj'),
(260, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 10, 'Gosairhat'),
(261, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 10, 'Shakhipur'),
(262, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 13, 'Sadar'),
(263, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 13, 'Sakhipur'),
(264, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 13, 'Basail'),
(265, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 13, 'Madhupur'),
(266, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 13, 'Ghatail'),
(267, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 13, 'Kalihati'),
(268, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 13, 'Nagarpur'),
(269, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 13, 'Mirzapur'),
(270, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 13, 'Gopalpur'),
(271, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 13, 'Delduar'),
(272, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 13, 'Bhuapur'),
(273, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 13, 'Dhanbari'),
(274, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 13, 'Madhukhali'),
(275, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 43, 'Sadar'),
(276, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 43, 'Chitalmari'),
(277, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 43, 'Fakirhat'),
(278, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 43, 'Kachua'),
(279, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 43, 'Mollahat'),
(280, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 43, 'Mongla'),
(281, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 43, 'Morrelganj'),
(282, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 43, 'Rampal'),
(283, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 43, 'Sarankhola'),
(284, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 45, 'Sadar'),
(285, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 45, 'Jibannagar'),
(286, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 45, 'Damurhuda'),
(287, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 45, 'Alamdanga'),
(288, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 40, 'Abhaynagar'),
(289, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 40, 'Bagherpara'),
(290, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 40, 'Chaugachha'),
(291, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 40, 'Sadar'),
(292, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 40, 'Jhikargachha'),
(293, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 40, 'Keshabpur'),
(294, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 40, 'Manirampur'),
(295, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 40, 'Sharsha'),
(296, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 38, 'Sadar'),
(297, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 38, 'Maheshpur'),
(298, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 38, 'Kaliganj'),
(299, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 38, 'Kotchandpur'),
(300, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 38, 'Shailkupa'),
(301, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 38, 'Harinakunda'),
(302, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 46, 'Terokhada'),
(303, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 46, 'Batiaghata'),
(304, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 46, 'Dacope'),
(305, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 46, 'Dumuria'),
(306, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 46, 'Dighalia'),
(307, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 46, 'Koyra'),
(308, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 46, 'Paikgachha'),
(309, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 46, 'Phultala'),
(310, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 46, 'Rupsa'),
(311, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 46, 'khanjahan ali'),
(312, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 44, 'Mirpur'),
(313, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 44, 'Sadar'),
(314, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 44, 'Kumarkhali'),
(315, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 44, 'Bheramara'),
(316, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 44, 'Khoksa'),
(317, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 44, 'Daulatpur'),
(318, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 42, 'Sadar'),
(319, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 42, 'Mohammadpur'),
(320, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 42, 'Shalikha'),
(321, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 42, 'Sreepur'),
(322, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 41, 'Gangni'),
(323, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 41, 'Sadar'),
(324, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 41, 'Mujibnagar'),
(325, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 37, 'Sadar'),
(326, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 37, 'Kalia'),
(327, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 37, 'Lohagara'),
(328, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 39, 'Sadar'),
(329, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 39, 'Assasuni'),
(330, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 39, 'Debhata'),
(331, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 39, 'Tala'),
(332, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 39, 'Kalaroa'),
(333, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 39, 'Kaliganj'),
(334, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 39, 'Shyamnagar'),
(335, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 9, 'Dewanganj'),
(336, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 9, 'Baksiganj'),
(337, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 9, 'Islampur'),
(338, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 9, 'Sadar'),
(339, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 9, 'Madarganj'),
(340, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 9, 'Melandaha'),
(341, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 9, 'Sarishabari'),
(342, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 9, 'Narundi Police I.C'),
(343, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 1, 'Bhaluka'),
(344, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 1, 'Trishal'),
(345, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 1, 'Haluaghat'),
(346, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 1, 'Muktagachha'),
(347, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 1, 'Dhobaura'),
(348, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 1, 'Fulbaria'),
(349, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 1, 'Gaffargaon'),
(350, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 1, 'Gauripur'),
(351, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 1, 'Ishwarganj'),
(352, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 1, 'Mymensingh Sadar'),
(353, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 1, 'Nandail'),
(354, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 1, 'Phulpur'),
(355, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 1, 'Tarakanda'),
(356, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 17, 'Kalmakanda'),
(357, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 17, 'Kendua'),
(358, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 17, 'Madan'),
(359, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 17, 'Mohanganj'),
(360, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 17, 'Netrokona Sadar'),
(361, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 17, 'Purbadhala'),
(362, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 17, 'Atpara'),
(363, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 17, 'Barhatta'),
(364, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 17, 'Durgapur'),
(365, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 17, 'Khaliajuri'),
(366, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 16, 'Nalitabari'),
(367, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 16, 'Sadar'),
(368, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 16, 'Sreebardi'),
(369, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 16, 'Jhenaigati'),
(370, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 16, 'Nakla'),
(371, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 34, 'Joypurhat Sadar'),
(372, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 34, 'Akkelpur'),
(373, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 34, 'Kalai'),
(374, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 34, 'Khetlal'),
(375, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 34, 'Panchbibi'),
(376, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 33, 'Sariakandi'),
(377, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 33, 'Gabtali'),
(378, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 33, 'Sonatala'),
(379, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 33, 'Dhunat'),
(380, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 33, 'Adamdighi'),
(381, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 33, 'Bogra Sadar'),
(382, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 33, 'Sherpur'),
(383, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 33, 'Kahaloo'),
(384, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 33, 'Dhupchanchia'),
(385, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 33, 'Shibganj'),
(386, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 33, 'Nandigram'),
(387, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 33, 'Shajahanpur'),
(388, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 30, 'Sadar'),
(389, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 30, 'Mohadevpur'),
(390, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 30, 'Manda'),
(391, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 30, 'Niamatpur'),
(392, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 30, 'Atrai'),
(393, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 30, 'Raninagar'),
(394, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 30, 'Patnitala'),
(395, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 30, 'Dhamoirhat'),
(396, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 30, 'Sapahar'),
(397, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 30, 'Porsha'),
(398, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 30, 'Badalgachhi'),
(399, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 31, 'Singra'),
(400, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 31, 'Gurudaspur'),
(401, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 31, 'Sadar'),
(402, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 31, 'Baraigram'),
(403, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 31, 'Bagatipara'),
(404, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 31, 'Lalpur'),
(405, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 31, 'Naldanga'),
(406, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 32, 'Bholahat'),
(407, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 32, 'Gomastapur'),
(408, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 32, 'Nachole'),
(409, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 32, 'Shibganj'),
(410, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 32, 'Sadar'),
(411, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 35, 'Sujanagar'),
(412, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 35, 'Atgharia'),
(413, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 35, 'Bera'),
(414, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 35, 'Bhangura'),
(415, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 35, 'Chatmohar'),
(416, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 35, 'Faridpur'),
(417, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 35, 'Ishwardi'),
(418, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 35, 'Sadar'),
(419, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 35, 'Santhia'),
(420, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 36, 'Puthia'),
(421, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 36, 'Bagha'),
(422, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 36, 'Tanore'),
(423, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 36, 'Bagmara'),
(424, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 36, 'Charghat'),
(425, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 36, 'Durgapur'),
(426, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 36, 'Godagari'),
(427, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 36, 'Mohanpur'),
(428, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 36, 'Paba'),
(429, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 29, 'Sadar'),
(430, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 29, 'Ullahpara'),
(431, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 29, 'Shahjadpur'),
(432, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 29, 'Raiganj'),
(433, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 29, 'Kamarkhanda'),
(434, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 29, 'Tarash'),
(435, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 29, 'Belkuchi'),
(436, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 29, 'Chauhali'),
(437, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 29, 'Kazipur'),
(438, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 62, 'Badarganj'),
(439, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 62, 'Mithapukur'),
(440, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 62, 'Gangachara'),
(441, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 62, 'Kaunia'),
(442, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 62, 'Rangpur Sadar'),
(443, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 62, 'Pirgachha'),
(444, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 62, 'Pirganj'),
(445, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 62, 'Taraganj'),
(446, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 61, 'Ghoraghat'),
(447, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 61, 'Hakimpur'),
(448, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 61, 'Kaharole'),
(449, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 61, 'Khansama'),
(450, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 61, 'Nawabganj'),
(451, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 61, 'Parbatipur'),
(452, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 61, 'Phulbari'),
(453, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 61, 'Biral'),
(454, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 61, 'Birampur'),
(455, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 61, 'Birganj'),
(456, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 61, 'Bochaganj'),
(457, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 61, 'Chirirbandar'),
(458, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 61, 'Sadar'),
(459, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 59, 'Sadar'),
(460, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 59, 'Nageshwari'),
(461, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 59, 'Bhurungamari'),
(462, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 59, 'Phulbari'),
(463, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 59, 'Rajarhat'),
(464, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 59, 'Ulipur'),
(465, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 59, 'Chilmari'),
(466, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 59, 'Raomari'),
(467, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 59, 'Char Rajibpur'),
(468, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 63, 'Char Rajibpur'),
(469, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 63, 'Sadar'),
(470, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 63, 'Gobindaganj'),
(471, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 63, 'Palashbari'),
(472, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 63, 'Sadullapur'),
(473, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 63, 'Saghata'),
(474, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 63, 'Sundarganj'),
(475, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 58, 'Sadar'),
(476, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 58, 'Saidpur'),
(477, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 58, 'Jaldhaka'),
(478, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 58, 'Kishoreganj'),
(479, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 58, 'Domar'),
(480, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 58, 'Dimla'),
(481, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 60, 'Atwari'),
(482, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 60, 'Tetulia'),
(483, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 60, 'Sadar'),
(484, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 60, 'Debiganj'),
(485, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 60, 'Boda'),
(486, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 64, 'Sadar'),
(487, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 64, 'Pirganj'),
(488, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 64, 'Baliadangi'),
(489, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 64, 'Haripur'),
(490, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 64, 'Ranisankail'),
(491, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 57, 'Patgram'),
(492, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 57, 'Hatibandha'),
(493, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 57, 'Kaligonj'),
(494, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 57, 'Aditmari'),
(495, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 57, 'Sadar'),
(496, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 47, 'Ajmiriganj'),
(497, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 47, 'Baniachang'),
(498, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 47, 'Bahubal'),
(499, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 47, 'Chunarughat'),
(500, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 47, 'Sadar'),
(501, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 47, 'Lakhai'),
(502, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 47, 'Madhabpur'),
(503, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 47, 'Nabiganj'),
(504, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 47, 'Shaistagonj'),
(505, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 50, 'Sadar'),
(506, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 50, 'Barlekha'),
(507, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 50, 'Juri'),
(508, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 50, 'Kamalganj'),
(509, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 50, 'Kulaura'),
(510, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 50, 'Rajnagar'),
(511, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 50, 'Sreemangal'),
(512, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 48, 'Bishwamvarpur'),
(513, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 48, 'Chhatak'),
(514, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 48, 'Derai'),
(515, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 48, 'Dharampasha'),
(516, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 48, 'Dowarabazar'),
(517, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 48, 'Jagannathpur'),
(518, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 48, 'Jamalganj'),
(519, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 48, 'Sullah'),
(520, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 48, 'Sadar'),
(521, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 48, 'Dokkin Sunamganj'),
(522, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 48, 'Tahirpur'),
(523, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 49, 'Golapganj'),
(524, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 49, 'Osmani Nagar'),
(525, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 49, 'Balaganj'),
(526, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 49, 'Bishwanath'),
(527, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 49, 'Beanibazar'),
(528, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 49, 'Companiganj'),
(529, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 49, 'Gowainghat'),
(530, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 49, 'Jaintiapur'),
(531, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 49, 'Kanaighat'),
(532, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 49, 'Zakiganj'),
(533, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 49, 'Fenchuganj'),
(534, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 49, 'Sadar'),
(535, NULL, '2017-04-27 00:35:57', '2017-04-27 00:35:57', 49, 'South Surma');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `path` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `caption` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `hash` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uploads_user_id_foreign` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `name`, `path`, `extension`, `caption`, `user_id`, `hash`, `public`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'download.jpg', 'E:\\xampp\\htdocs\\rab-erp\\storage\\uploads\\2017-03-15-184025-download.jpg', 'jpg', '', 1, 'ap0dhttktoeequd89trr', 0, '2017-04-04 05:00:18', '2017-03-15 06:40:25', '2017-04-04 05:00:18'),
(2, 'download.jpg', 'E:\\xampp\\htdocs\\rab-erp\\storage\\uploads\\2017-03-15-184119-download.jpg', 'jpg', '', 1, 'futzyrboogm9krrq64io', 0, '2017-04-04 05:00:24', '2017-03-15 06:41:19', '2017-04-04 05:00:24'),
(3, 'download.jpg', 'E:\\wamp\\www\\rab-erp\\storage\\uploads\\2017-03-23-102405-download.jpg', 'jpg', '', 1, 'micsegtzp3miy7koyvwb', 0, '2017-04-04 05:00:28', '2017-03-22 22:24:05', '2017-04-04 05:00:28'),
(4, 'download.jpg', 'E:\\wamp\\www\\rab-erp\\storage\\uploads\\2017-03-23-102417-download.jpg', 'jpg', '', 1, 'yyj0pczzbqgpnhvkr9wu', 0, NULL, '2017-03-22 22:24:17', '2017-03-22 22:24:17'),
(5, 'download.jpg', 'E:\\wamp\\www\\rab-erp\\storage\\uploads\\2017-03-23-103120-download.jpg', 'jpg', '', 1, 'rj171kz9wjjmagdy9fzj', 0, NULL, '2017-03-22 22:31:20', '2017-03-22 22:31:20'),
(6, '4437cd540892fa32be7d8ec59235b9aa-58d167ca3d171.jpg', 'D:\\xampp\\htdocs\\rab-erp\\storage\\uploads\\2017-03-23-104824-4437cd540892fa32be7d8ec59235b9aa-58d167ca3d171.jpg', 'jpg', 'Test', 1, 'qf2vmtv0zlucgwvpdjjm', 0, '2017-03-22 23:26:45', '2017-03-22 22:48:24', '2017-03-22 23:26:45'),
(7, 'user.png', 'E:\\wamp\\www\\rab-erp\\storage\\uploads\\2017-03-29-165623-user.png', 'png', '', 1, 'a9ujfrf9k1hedvfxn0ue', 0, NULL, '2017-03-29 04:56:23', '2017-03-29 04:56:23'),
(8, '4437cd540892fa32be7d8ec59235b9aa-58d167ca3d171.jpg', 'D:\\xampp\\htdocs\\rab-erp\\storage\\uploads\\2017-04-02-124957-4437cd540892fa32be7d8ec59235b9aa-58d167ca3d171.jpg', 'jpg', 'Uploaded Image', 1, 'umbifyd0vbithr6qswdj', 0, NULL, '2017-04-02 00:49:57', '2017-04-04 05:06:42'),
(9, 'user.png', 'E:\\wamp\\www\\rab-erp\\storage\\uploads\\2017-04-04-132018-user.png', 'png', '', 1, 'opv4mnn0cahd5tl7pdqz', 0, NULL, '2017-04-04 01:20:18', '2017-04-04 01:20:18'),
(10, '4437cd540892fa32be7d8ec59235b9aa-58d167ca3d171.jpg', 'D:\\xampp\\htdocs\\rab-erp\\storage\\uploads\\2017-04-04-181136-4437cd540892fa32be7d8ec59235b9aa-58d167ca3d171.jpg', 'jpg', '', 1, 'hchb8pwquezvxqlsltbn', 0, NULL, '2017-04-04 06:11:36', '2017-04-04 06:11:36'),
(11, 'user.png', 'E:\\wamp\\www\\rab-erp\\storage\\uploads\\2017-05-25-120912-user.png', 'png', '', 1, 'yqilkn8l0p8h49xb870q', 0, NULL, '2017-05-25 00:09:12', '2017-05-25 00:09:12'),
(12, '21369141_1293670534070213_5419430949716946692_n.jpg', '/var/www/html/project/rab-erp/storage/uploads/2017-09-28-153016-21369141_1293670534070213_5419430949716946692_n.jpg', 'jpg', '', 1, 'un9g8gcgjkyrbz6ecycr', 0, NULL, '2017-09-28 03:30:17', '2017-09-28 03:30:17'),
(13, 'Image_from_Skype.jpg', '/var/www/html/project/rab-erp/storage/uploads/2017-09-28-155121-Image_from_Skype.jpg', 'jpg', '', 1, 'pvsn7ouwb8rriut0abwl', 0, NULL, '2017-09-28 03:51:21', '2017-09-28 03:51:21'),
(14, 'avro-phonetic-preferences.png', '/var/www/html/project/rab-erp/storage/uploads/2017-09-28-155146-avro-phonetic-preferences.png', 'png', '', 1, 'pq6o5b5ccp1jdw384ms6', 0, NULL, '2017-09-28 03:51:46', '2017-09-28 03:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `context_id` int(10) unsigned NOT NULL DEFAULT '0',
  `emp_id` int(10) DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Employee',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_level` tinyint(4) NOT NULL DEFAULT '4' COMMENT '0=Super Admin,1=Admin,2=Employee',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `context_id`, `emp_id`, `email`, `user_name`, `password`, `type`, `remember_token`, `user_level`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 1, NULL, 'akebulr@gmail.com', 'admin', '$2y$10$lhA9VpYOcEpQwpghPFbUYOGDXP7995LcljguFYCBnKJNii4BNbmey', 'Employee', 'nvYKHNCdV5hMZGBFs2YEGDedvspuFT3sjir9asEGJqocf8HRrkPU89CeGWPA', 0, NULL, '2017-02-18 20:35:37', '2017-10-13 22:05:57');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_info`
--
ALTER TABLE `client_info`
  ADD CONSTRAINT `fk_client_info_1` FOREIGN KEY (`id`) REFERENCES `agent_info` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `client_interest_country`
--
ALTER TABLE `client_interest_country`
  ADD CONSTRAINT `fk_client_interest_country_1` FOREIGN KEY (`client_id`) REFERENCES `client_info` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_client_interest_country_2` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
