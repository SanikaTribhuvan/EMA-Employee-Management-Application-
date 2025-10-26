# Employee Management System - PHP Organizational Chart Panel

A comprehensive PHP-based admin panel for managing employees with organizational chart visualization.

## Features

- **Authentication System**: Secure login with session management
- **Employee CRUD**: Complete Create, Read, Update, Delete operations
- **Organizational Chart**: Visual hierarchy display using Google Charts
- **Search & Pagination**: Search employees by name, code, or designation
- **Data Validation**: Comprehensive validation rules and business logic
- **Responsive Design**: Bootstrap-based responsive UI

## Tech Stack

- **Backend**: PHP with CodeIgniter 3 framework
- **Database**: MySQL with PDO and prepared statements
- **Frontend**: HTML5, CSS3, Bootstrap 4, JavaScript
- **Visualization**: Google Charts API for organizational chart
- **Server**: XAMPP (Apache + MySQL + PHP)

## System Requirements

- PHP 7.0 or higher
- MySQL 5.6 or higher
- Apache web server
- XAMPP recommended for local development

## Installation & Setup

### 1. Download and Extract
- Download the project files
- Extract to `C:\xampp\htdocs\employee_management\`

### 2. Database Setup
- Start XAMPP and ensure MySQL is running
- Open phpMyAdmin (`http://localhost/phpmyadmin`)
- Import the provided `employee_management.sql` file
- This creates the database and populates sample data

### 3. Configuration
- Database configuration is already set in `application/config/database.php`
- Default MySQL port: 3307 (adjust if different)
- No additional configuration needed

### 4. Access Application
- URL: `http://localhost/employee_management/index.php`
- Login Credentials:
  - **Username**: `admin`
  - **Password**: `admin123`

## Database Schema

### Employees Table
| Field | Type | Description |
|-------|------|-------------|
| empid | INT | Primary key, auto-increment |
| name | VARCHAR(100) | Employee full name |
| mob | VARCHAR(20) | Mobile number (optional) |
| ename | VARCHAR(50) | Unique employee code |
| designation | VARCHAR(100) | Job title |
| level | TINYINT | Hierarchy level (1=CEO) |
| manager | VARCHAR(50) | Manager's employee code |
| mgrid | INT | Manager's employee ID |
| created_at | TIMESTAMP | Record creation time |
| updated_at | TIMESTAMP | Record update time |

## Validation Rules

- **Name**: Required field
- **Employee Code (ename)**: Required, unique, alphanumeric + underscore/dash
- **Mobile**: Optional, 10-15 digits, + and - allowed
- **Designation**: Required field
- **Level**: Required, integer ≥ 1
- **Manager**: Must reference existing employee
- **Business Rules**:
  - Only one CEO allowed (level = 1)
  - Manager level must be less than employee level
  - No circular management relationships
  - CEO cannot have a manager

## Application Structure

```
employee_management/
├── application/
│   ├── controllers/
│   │   ├── Auth.php          # Authentication
│   │   ├── Dashboard.php     # Dashboard
│   │   ├── Employees.php     # Employee CRUD
│   │   └── Chart.php         # Org Chart
│   ├── models/
│   │   └── Employee_model.php # Data layer
│   ├── views/
│   │   ├── auth/
│   │   │   └── login.php     # Login form
│   │   ├── employees/
│   │   │   ├── index.php     # Employee listing
│   │   │   ├── create.php    # Add employee
│   │   │   └── edit.php      # Edit employee
│   │   ├── chart/
│   │   │   └── index.php     # Org chart view
│   │   ├── templates/
│   │   │   ├── header.php    # Common header
│   │   │   └── footer.php    # Common footer
│   │   └── dashboard.php     # Dashboard view
│   └── config/
│       ├── database.php      # DB configuration
│       └── routes.php        # URL routing
├── system/                   # CodeIgniter core
├── index.php                # Application entry point
└── employee_management.sql   # Database schema
```

## Key Features Implemented

### 1. Authentication
- Secure login system with hardcoded admin credentials
- Session-based authentication with automatic redirects
- Logout functionality with session cleanup

### 2. Employee Management
- **Create**: Add new employees with full validation
- **Read**: Paginated list with search functionality
- **Update**: Edit existing employee details
- **Delete**: Remove employees with confirmation

### 3. Organizational Chart
- Visual hierarchy representation using Google Charts
- Interactive nodes with tooltips
- Fallback table view
- Real-time data integration

### 4. Data Validation
- Client-side HTML5 validation
- Server-side PHP validation
- Business rule enforcement
- Error message display

### 5. Search & Navigation
- Search by name, employee code, or designation
- Pagination with configurable page size
- Clean URL structure
- Responsive navigation

## Sample Data

The system includes 8 sample employees in a hierarchical structure:
- 1 CEO (Level 1)
- 2 Department heads (Level 2)
- 2 Managers (Level 3)
- 2 Senior staff (Level 4)
- 1 Junior staff (Level 5)

## Usage Guide

### Adding Employees
1. Login with admin credentials
2. Navigate to Employees section
3. Click "Add Employee"
4. Fill required fields with proper validation
5. Select appropriate manager and hierarchy level

### Viewing Organizational Chart
1. Navigate to Chart section
2. View interactive hierarchy visualization
3. Hover over nodes for additional details
4. Use table fallback if needed

### Searching Employees
1. Use search box in employee listing
2. Search by name, employee code, or designation
3. Results update with pagination

## Troubleshooting

### Common Issues
- **Database Connection**: Verify MySQL port (default: 3307)
- **Login Issues**: Use exact credentials (admin/admin123)
- **URL Errors**: Use full path with index.php
- **Permission Issues**: Ensure proper file permissions

### Support
- Verify XAMPP services are running
- Check error logs in XAMPP control panel
- Ensure database import completed successfully

## Project Completion Status

✅ **Authentication System** - Fully implemented
✅ **Employee CRUD Operations** - Complete with validation
✅ **Database Design** - Normalized schema with constraints
✅ **Organizational Chart** - Interactive visualization
✅ **Search & Pagination** - Working functionality
✅ **Responsive UI** - Bootstrap-based design
✅ **Data Validation** - Comprehensive rule enforcement
✅ **Business Logic** - Hierarchy constraints implemented

**Project Completion: 100%**

## Demo Video
*(Optional: Add link to demo video if created)*

## Developer Notes
- Built with CodeIgniter 3 MVC framework
- Follows PHP coding standards
- Implements prepared statements for security
- Uses responsive design principles
- Includes comprehensive error handling