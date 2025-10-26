-- Employee Management System Database
-- Database: employee_management

CREATE DATABASE IF NOT EXISTS `employee_management` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `employee_management`;

-- Drop table if exists
DROP TABLE IF EXISTS `employees`;

-- Create employees table
CREATE TABLE `employees` (
    `empid` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `mob` VARCHAR(20) NULL,
    `ename` VARCHAR(50) NOT NULL UNIQUE,
    `designation` VARCHAR(100) NOT NULL,
    `level` TINYINT UNSIGNED NOT NULL,
    `manager` VARCHAR(50) NULL,
    `mgrid` INT UNSIGNED NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    CONSTRAINT `fk_manager_ename` FOREIGN KEY (`manager`) 
        REFERENCES `employees`(`ename`) 
        ON UPDATE CASCADE ON DELETE SET NULL,
    CONSTRAINT `fk_manager_id` FOREIGN KEY (`mgrid`) 
        REFERENCES `employees`(`empid`) 
        ON UPDATE CASCADE ON DELETE SET NULL,
    
    INDEX `idx_level` (`level`),
    INDEX `idx_manager` (`manager`),
    INDEX `idx_mgrid` (`mgrid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data
INSERT INTO `employees` (`name`, `mob`, `ename`, `designation`, `level`, `manager`, `mgrid`) VALUES
('Aarav Mehta', '9876543210', 'E001', 'CEO', 1, NULL, NULL),
('Riya Sharma', '9876500001', 'E101', 'CTO', 2, 'E001', 1),
('Kabir Singh', '9876500002', 'E102', 'CFO', 2, 'E001', 1),
('Neha Verma', '9876500003', 'E201', 'Eng Manager', 3, 'E101', 2),
('Isha Jain', '9876500004', 'E202', 'Lead Dev', 4, 'E201', 4),
('Rohan Joshi', '9876500005', 'E203', 'Dev', 5, 'E202', 5),
('Priya Gupta', '9876500006', 'E301', 'Finance Mgr', 3, 'E102', 3),
('Vikram Rao', '9876500007', 'E302', 'Accountant', 4, 'E301', 7);