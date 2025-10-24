-- Ocean View Hotel Database Setup
-- Complete database structure for hotel management system
-- Date: 2025-09-30
-- Updated for deployment with all features

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Create database
CREATE DATABASE IF NOT EXISTS hotel;
USE hotel;

-- ==============================
-- CORE HOTEL TABLES
-- ==============================

-- Contact form submissions
CREATE TABLE IF NOT EXISTS contact (
    id int(11) NOT NULL AUTO_INCREMENT,
    fullname varchar(100) NOT NULL,
    phoneno varchar(20) NOT NULL,
    email varchar(100) NOT NULL,
    cdate datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    approval varchar(20) NOT NULL DEFAULT 'Not Allowed',
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Admin users
CREATE TABLE IF NOT EXISTS login (
    id int(11) NOT NULL AUTO_INCREMENT,
    username varchar(50) NOT NULL,
    password varchar(50) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Payment table for room bookings
CREATE TABLE IF NOT EXISTS payment (
    id int(11) NOT NULL AUTO_INCREMENT,
    title varchar(5) NOT NULL,
    fname varchar(30) NOT NULL,
    lname varchar(30) NOT NULL,
    troom varchar(30) NOT NULL,
    tbed varchar(30) NOT NULL,
    nroom int(11) NOT NULL,
    cin date NOT NULL,
    cout date NOT NULL,
    ttot double NOT NULL,
    meal varchar(30) NOT NULL,
    btot double NOT NULL,
    mepr double NOT NULL,
    fintot double NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Rooms table
CREATE TABLE IF NOT EXISTS room (
    id int(11) NOT NULL AUTO_INCREMENT,
    type varchar(100) NOT NULL,
    bedding varchar(100) NOT NULL,
    place varchar(100) NOT NULL,
    area varchar(100) NOT NULL,
    size varchar(100) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Room booking table
CREATE TABLE IF NOT EXISTS roombook (
    id int(11) NOT NULL AUTO_INCREMENT,
    Title varchar(5) NOT NULL,
    FName varchar(50) NOT NULL,
    LName varchar(50) NOT NULL,
    Email varchar(50) NOT NULL,
    National varchar(20) NOT NULL,
    Country varchar(30) NOT NULL,
    Phone varchar(20) NOT NULL,
    TRoom varchar(20) NOT NULL,
    Bed varchar(20) NOT NULL,
    NRoom varchar(20) NOT NULL,
    Meal varchar(20) NOT NULL,
    cin date NOT NULL,
    cout date NOT NULL,
    stat varchar(15) NOT NULL DEFAULT 'NotConfirm',
    nodays int(11) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ==============================
-- FOOD ORDERING SYSTEM
-- ==============================

-- Food items table
CREATE TABLE IF NOT EXISTS foods (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    category varchar(50) NOT NULL,
    price decimal(10,2) NOT NULL,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Food orders table
CREATE TABLE IF NOT EXISTS food_orders (
    id int(11) NOT NULL AUTO_INCREMENT,
    email varchar(100) NOT NULL,
    food_id int(11) NOT NULL,
    quantity int(11) NOT NULL,
    order_time datetime NOT NULL,
    status varchar(20) DEFAULT 'pending',
    bill_amount decimal(10,2) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (food_id) REFERENCES foods(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Food payments table
CREATE TABLE IF NOT EXISTS food_payments (
    id int(11) NOT NULL AUTO_INCREMENT,
    customer_name varchar(100) NOT NULL,
    customer_email varchar(100) NOT NULL,
    order_date datetime NOT NULL,
    total_amount decimal(10,2) NOT NULL,
    payment_status varchar(20) DEFAULT 'pending',
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Food payment items table
CREATE TABLE IF NOT EXISTS food_payment_items (
    id int(11) NOT NULL AUTO_INCREMENT,
    payment_id int(11) NOT NULL,
    food_name varchar(100) NOT NULL,
    category varchar(50) NOT NULL,
    quantity int(11) NOT NULL,
    unit_price decimal(10,2) NOT NULL,
    total_price decimal(10,2) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (payment_id) REFERENCES food_payments(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ==============================
-- SAMPLE DATA
-- ==============================

-- Insert default admin user (username: admin, password: admin)
INSERT INTO login (username, password) VALUES ('admin', 'admin');

-- Insert sample room types for Ocean View Hotel
INSERT INTO room (type, bedding, place, area, size) VALUES
('Ocean View Single', 'Single', 'Ocean Front', 'Free WiFi, AC, Balcony', 'Compact 200 sq ft'),
('Ocean View Double', 'Double', 'Ocean Front', 'Free WiFi, AC, Balcony, Mini Bar', 'Standard 300 sq ft'),
('Beach Suite', 'King Size', 'Ocean Front', 'Free WiFi, AC, Living Area, Balcony', 'Luxury 500 sq ft'),
('Family Room', 'Twin + Sofa Bed', 'Garden View', 'Free WiFi, AC, Kitchenette', 'Large 400 sq ft'),
('Deluxe Suite', 'King Size', 'Ocean Front', 'Free WiFi, AC, Jacuzzi, Balcony', 'Premium 600 sq ft'),
('Deluxe Room', 'Double', 'Ocean Front', 'Free WiFi, AC, Mini Bar, Balcony', 'Deluxe 350 sq ft'),
('Luxury Room', 'King Size', 'Garden View', 'Free WiFi, AC, Premium Amenities', 'Spacious 380 sq ft'),
('Guest House', 'Twin', 'Garden View', 'Free WiFi, Fan, Shared Kitchen', 'Budget 250 sq ft'),
('Single Room', 'Single', 'City View', 'Free WiFi, AC, Work Desk', 'Cozy 180 sq ft'),
('Superior Room', 'Queen Size', 'Ocean Front', 'Free WiFi, AC, Premium Toiletries', 'Superior 320 sq ft'),
('Presidential Suite', 'King Size', 'Penthouse', 'Free WiFi, AC, Full Kitchen, Living & Dining', 'Exclusive 800 sq ft'),
('Honeymoon Suite', 'King Size', 'Ocean Front', 'Free WiFi, AC, Jacuzzi, Champagne', 'Romantic 650 sq ft');

-- Insert sample food items for Ocean View Hotel
INSERT INTO foods (name, category, price) VALUES
-- Beverages
('Fresh Coconut Water', 'Beverage', 200.00),
('Ceylon Tea', 'Beverage', 250.00),
('Filter Coffee', 'Beverage', 300.00),
('Fresh Juice (Orange/Mango)', 'Beverage', 350.00),
('Fresh Lime Juice', 'Beverage', 250.00),
('Iced Coffee', 'Beverage', 350.00),

-- Breakfast
('Sri Lankan Breakfast', 'Breakfast', 800.00),
('Egg Hoppers (2 pcs)', 'Breakfast', 350.00),
('String Hoppers with Curry', 'Breakfast', 450.00),
('Fresh Fruit Platter', 'Breakfast', 500.00),
('Pancakes with Honey', 'Breakfast', 400.00),
('Toast with Jam & Butter', 'Breakfast', 300.00),

-- Main Course
('Chicken Fried Rice', 'Main Course', 1200.00),
('Seafood Fried Rice', 'Main Course', 1400.00),
('Fish Curry with Rice', 'Main Course', 1300.00),
('Chicken Curry with Rice', 'Main Course', 1100.00),
('Vegetable Kottu Roti', 'Main Course', 900.00),
('Chicken Kottu Roti', 'Main Course', 1100.00),
('Grilled Fish with Vegetables', 'Main Course', 1500.00),
('Prawn Curry with Rice', 'Main Course', 1600.00),

-- Desserts
('Chocolate Cake', 'Dessert', 600.00),
('Vanilla Ice Cream', 'Dessert', 400.00),
('Fresh Fruit Salad', 'Dessert', 450.00),
('Coconut Pudding', 'Dessert', 500.00),
('Chocolate Ice Cream', 'Dessert', 400.00);

-- Sample contact for demo
INSERT INTO contact (fullname, phoneno, email, approval) VALUES 
('Demo Guest', '+94771234567', 'demo@oceanviewhotel.com', 'Approved');

-- ==============================
-- INDEXES FOR PERFORMANCE
-- ==============================

-- Add indexes for better performance
CREATE INDEX idx_roombook_email ON roombook(Email);
CREATE INDEX idx_roombook_dates ON roombook(cin, cout);
CREATE INDEX idx_food_orders_email ON food_orders(email);
CREATE INDEX idx_food_orders_status ON food_orders(status);
CREATE INDEX idx_food_orders_time ON food_orders(order_time);
CREATE INDEX idx_food_payments_email ON food_payments(customer_email);
CREATE INDEX idx_food_payments_status ON food_payments(payment_status);

-- ==============================
-- AUTO INCREMENT SETTINGS
-- ==============================

ALTER TABLE contact MODIFY id int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE login MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE payment MODIFY id int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE room MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
ALTER TABLE roombook MODIFY id int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE foods MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
ALTER TABLE food_orders MODIFY id int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE food_payments MODIFY id int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE food_payment_items MODIFY id int(11) NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- ==============================
-- DATABASE SETUP COMPLETE
-- ==============================
-- Ocean View Hotel Management System Ready for Deployment
-- Features included:
-- * Room Management & Booking System
-- * Payment Processing for Rooms & Food
-- * Complete Food Ordering System
-- * Admin Panel with Full Management
-- * Print Functionality for Bills
-- * Contact Management System
-- ==============================