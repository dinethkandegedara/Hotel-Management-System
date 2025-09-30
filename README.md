# Ocean View Hotel Management System

A complete hotel management system with room booking, food ordering, and payment processing capabilities.

## Features

- **Room Management**: View and book different room types with pricing
- **Food Ordering System**: Complete food ordering with categorized menu
- **Payment Processing**: Integrated payment system for both rooms and food orders
- **Admin Panel**: Full administrative control over bookings, orders, and payments
- **Bill Printing**: Professional bill printing for both room and food services
- **Contact Management**: Guest inquiry and contact form handling

## Quick Deployment Setup

### 1. Database Setup

1. Import the `hotel.sql` file into your MySQL database
2. This will create the `hotel` database with all required tables and sample data

```sql
-- Run this command in your MySQL client
SOURCE hotel.sql;
```

### 2. Web Server Setup

1. Copy all files to your web server directory (e.g., `htdocs` for XAMPP)
2. Update database connection in `db.php` if needed:

```php
$connection = mysqli_connect("localhost", "root", "", "hotel");
```

### 3. Admin Access

- **Username**: admin
- **Password**: admin
- **Admin Panel**: `/admin/index.php`

## File Structure

```
Hotel-q/
├── hotel.sql           # Complete database setup
├── index.php           # Main hotel homepage
├── food_order.php      # Food ordering page
├── db.php              # Database connection
├── admin/              # Admin panel files
│   ├── index.php       # Admin login
│   ├── home.php        # Admin dashboard
│   ├── foods.php       # Food management
│   ├── food_orders.php # Food order management
│   ├── payment.php     # Payment management
│   ├── print_food.php  # Food bill printing
│   └── ...             # Other admin files
├── css/                # Stylesheets
├── js/                 # JavaScript files
├── images/             # Image assets
└── fonts/              # Font files
```

## Database Tables

### Core Hotel Tables
- `login` - Admin user authentication
- `room` - Room types and details
- `roombook` - Room bookings
- `payment` - Room payment records
- `contact` - Contact form submissions

### Food System Tables
- `foods` - Food items with categories and pricing
- `food_orders` - Individual food orders
- `food_payments` - Food payment records
- `food_payment_items` - Food payment line items

## Sample Data Included

The database includes sample data for:
- 5 different room types (Ocean View, Beach Suite, etc.)
- 22 food items across 4 categories (Beverages, Breakfast, Main Course, Desserts)
- Default admin user
- Sample contact entry

## Technology Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL 5.6+
- **Frontend**: Bootstrap 3, jQuery
- **Server**: Apache (XAMPP recommended for local development)

## Support

This is a complete, production-ready hotel management system with all features fully implemented and tested.

For local development, use XAMPP and access via `http://localhost/Hotel-q/`

---
*Ocean View Hotel Management System - Ready for Deployment*